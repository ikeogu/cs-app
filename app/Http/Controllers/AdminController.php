<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contribution;
use App\Models\Deduction;
use App\Models\Dividend;
use App\Models\Expenditure;
use App\Models\Income;
use App\Models\Loan;
use App\Models\MemberLoan;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['income'] = Income::latest()->get();
        $data['expense'] = Expenditure::latest()->get();
        return view('finan.finstatement')->with($data);
    }
    public function div()
    {
        $div = Dividend::latest()->get();
        return view('finan.dividend', ['dividend' => $div]);
    }
    public function loan()
    {
        $div = Loan::latest()->get();
        return view('finan.loans', ['loans' => $div]);
    }
    public function showloan($id)
    {
        $div = MemberLoan::with('loan', 'user')->latest()->where('loan_id', $id)->get();
        return view('finan.memberloans', ['loans' => $div]);
    }

    // save funcyions
    public function saveIncome(Request $request)
    {
        Income::create($request->all());
        return back()->with('success', 'Revenue Added!');
    }
    public function saveExpense(Request $request)
    {
        Expenditure::create($request->all());
        return back()->with('success', 'Expenditure Added!');
    }
    public function saveLoan(Request $request)
    {
        $newloan = new MemberLoan();
        $loan = Loan::find($request->loan_id);
        $arr = explode('-', $loan->amount_range);
        $grantor = User::where('code', $request->grantor_code)->first();
        if ($grantor) {
            if ($request->amount >= $arr[0] && $request->amount <= $arr[1]) {
                $newloan->user_id = auth()->user()->id;
                $newloan->amount = $request->amount;
                $newloan->loan_id = $request->loan_id;
                $newloan->reason = $request->reason;

                $newloan->payback = $request->payback;
                $newloan->gcode = $request->grantor_code;
                $newloan->duration = $request->duration;
                $newloan->intrest = $request->intrest;

                if (auth()->user()->salary > $newloan->amount) {
                    $newloan->status = 4;
                } elseif (auth()->user()->salary < $newloan->amount) {
                    $newloan->status = 5;
                }
                $newloan->loan()->associate($loan);
                $newloan->user()->associate($grantor);
                if ($newloan->save()) {
                    $newloan->code = 'NLOAN' . $newloan->id . 'MB' . auth()->user()->id;
                    $newloan->save();
                }
                return redirect(route('ML'))->with('success', 'Loan application in progress');
            } else {
                return back()->with('warning', 'Amount is out of range.');
            }
        } else {
            return back()->with('warning', 'Grantor does not exist');
        }

        return back()->with('success', 'Loan  Added!');
    }
    public function saveDividend(Request $request)
    {
        Dividend::create($request->all());
        return back()->with('success', 'Dividened Added!');
    }


    // Update functions
    public function updateExpense(Request $request, $id)
    {
        Expenditure::whereId($id)->update($request->except('_token', '_method'));
        return back()->with('success', 'Expenditure Updated!');
    }
    public function updateIncome(Request $request, $id)
    {
        Income::whereId($id)->update($request->except('_token', '_method'));
        return back()->with('success', 'Income Updated!');
    }
    public function updateDividend(Request $request, $id)
    {
        Dividend::whereId($id)->update($request->except('_token', '_method'));
        return back()->with('success', 'Dividend Updated!');
    }
    public function updateLoan(Request $request, $id)
    {
        Loan::whereId($id)->update($request->except('_token', '_method'));
        return back()->with('success', 'Loan Updated!');
    }

    public function contributionManager()
    {
        $account = Account::with('user')->latest()->get();
        return view('finan.contribution', ['accounts' => $account]);
    }
    // deduction shedule
    public function generateDeduction(Request $request)
    {
        $month  = date('M', strtotime($request->month));
        $year = date('Y', strtotime($request->month));


        $users = User::where('isAdmin', '!=', 1)->get();
        foreach ($users as $user) {
            $dection = new Deduction();
            $dection->user_id = $user->id;
            $dection->account_id = $user->account->id;
            $dection->earns = $user->salary;
            $dection->contribution = $user->salary * ($user->can_pay / 100);
            $dection->unrecovered_loan = $user->account->loan_bal;
            $dection->month = $month;
            $dection->year = $year;
            $dection->total = $dection->contribution + $dection->unrecovered_loan;
            $dection->save();
        }
        $dection = Deduction::where('month', $month)->where('year', $year)->get();

        return view('finan.deduction', ['deduction' => $dection]);
    }
    public function deductionShedule()
    {

        return view('finan.deduction');
    }
    public function downloadDeduction($month, $year)
    {
        $dection = Deduction::where('month', $month)->where('year', $year)->get();

        $pdf = PDF::loadView('pdf_view', ['dection' => $dection]);

        // download PDF file with download method
        return $pdf->download('Deduction Schedule.pdf');

        return view('finan.deduction');
    }

    // find loan
    public function loanShow($id)
    {

        $data = Loan::select('amount_range', 'intrest', 'duration', 'id')->where('id', $id)->first();

        return response()->json($data);
    }

    public function myLoan()
    {
        $data['loans1'] = MemberLoan::with('loan')->where('user_id', auth()->user()->id)->get();
        $data['loans'] = Loan::all();
        return view('profile.myloans')->with($data);
    }
    public function mycontribution()
    {
        $data['contributions'] = Contribution::where('user_id', auth()->user()->id)->get();


        return view('profile.contributions')->with($data);
    }
    public function changeMemberStatus(Request $request, $id)
    {
        $loan = MemberLoan::find($id);
        $loan->status = $request->status;
        if ($loan->status == 1) {
            $acct = Account::where('user_id', $loan->user_id)->first();
            $acct->loan_bal += $loan->amount;
            $acct->save();
            $loan->save();
            return back()->with('success', 'Loan approved successfully');
        } elseif ($loan->status == 3) {
            $loan->save();
            return back()->with('success', 'Loan is pending approval ');
        } elseif ($loan->status == 5) {
            $loan->save();
            return back()->with('success', 'Loan is Declined ');
        } else {
            $loan->save();
            return back()->with('success', 'Loan approval in progress ');
        }
    }
}