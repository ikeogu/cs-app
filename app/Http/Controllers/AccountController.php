<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contribution;
use App\Models\History;
use App\Models\Loan;
use App\Models\MemberLoan;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $account = Account::with('user')->latest()->get();
        return view('account.index', ['accounts' => $account]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show($account)
    {
        //
        $acct = Account::where('user_id', $account)->first();
        $loans = Loan::all();

        return view('account.show', ['acct' => $acct, 'loans' => $loans]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy($account)
    {

        //
        $a = Account::findOrFail($account);
        $a->delete();
        return back()->with('success', 'Account Deleted!');
    }
    public function credit(Request $request, $id)
    {

        $history = new History();
        $contr = new Contribution();
        $acct = Account::with('user')->find($id);
        $acct->acct_bal += $request->amount;
        if ($acct->save()) {

            $history->account_id = $acct->id;
            $history->user_id = $acct->user->id;
            $history->amount = $request->amount;
            $history->acct_bal = $acct->acct_bal;
            $history->can_pay = $acct->user->can_pay;
            $history->status = 'Credit';


            $contr->user_id = $acct->user->id;
            $contr->account_id = $acct->id;
            $contr->reciept = $request->reciept;
            $contr->paid_via = $request->paid_via;
            $contr->amount = $request->amount;
            $contr->acct_bal = $acct->acct_bal;
            $contr->status = 1;

            $contr->save();
            $history->save();
        }
        return back()->with('success', 'Account Credited!');
    }
    public function creditAll()
    {
        $acct = Account::with('user')->where('status', 1)->get();

        foreach ($acct as $i) {
            $history = new History();
            $i->acct_bal += ($i->user->can_pay / 100) * $i->user->salary;

            if ($i->save()) {
                $history->account_id = $i->id;
                $history->user_id = $i->user->id;
                $history->amount = ($i->user->can_pay / 100) * $i->user->salary;
                $history->acct_bal = $i->acct_bal;
                $history->can_pay = $i->user->can_pay;
                $history->status = 'Credit';
                $history->save();
            }
        }
        return back()->with('success', 'Accounts Credited!');
    }
    public function suspend($id)
    {
        $acct = Account::with('user')->find($id);
        $acct->status = 2;
        $acct->save();

        return back()->with('success', 'Account Suspended!');
    }
    public function unsuspend($id)
    {
        $acct = Account::with('user')->find($id);
        $acct->status = 1;
        $acct->save();

        return back()->with('success', 'Account unsuspended!');
    }
    public function debit(Request $request)
    {
        $history = new History();
        $acct = Account::with('user')->find($request->id);
        $acct->acct_bal -=  $request->amount;
        if ($acct->save()) {
            $history->account_id = $acct->id;
            $history->user_id = $acct->user->id;
            $history->amount = $request->amount;
            $history->acct_bal = $acct->acct_bal;
            $history->can_pay = $acct->user->can_pay;
            $history->status = 'Debit';
            $history->save();
        }
        return back()->with('success', 'Account Debited!');
    }
    public function withdraw(Request $request)
    {
        $with = new Withdrawal();
        $with->user_id = auth()->user()->id;
        $with->amount = $request->amount;
        $with->status = 3;
        $with->reason = $request->reason;
        $with->save();
        return back()->with('success', 'Withdrawal application successful. kindly wait for approval');
    }
    public function loan(Request $request)
    {
        $with = new MemberLoan();
        $with->user_id = auth()->user()->id;
        $with->loan_id = $request->loan_id;
        $with->status = 3;
        $with->reason = $request->reason;

        $with->save();
        return back()->with('success', 'Loan application successful. Kindly  wait for approval');
    }

    public function loans()
    {
        $loans = Loan::latest()->get();
        return view('loans', ['loans' => $loans]);
    }
    public function with_Draw()
    {
        $with = Withdrawal::latest()->get();
        return view('withdraws', ['withdrawals' => $with]);
    }
    public function loanStatus(Request $request)
    {
        $loan = Loan::find($request->id);
        $loan->status = $request->status;
        $loan->save();
        return back()->with('success', 'Laon request status updated.');
    }
    public function withdrawStatus(Request $request)
    {
        $loan = Withdrawal::find($request->id);
        $loan->status = $request->status;
        $loan->save();
        return back()->with('success', 'Withdraw request status updated.');
    }

    public function mycontributions($id)
    {
        $user = User::with('contribution', 'account')->find($id);

        return view('finan.mycontr', ['user' => $user]);
    }
}