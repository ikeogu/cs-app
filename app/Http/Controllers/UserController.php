<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\Account;
use Illuminate\Http\Request;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()

    {
        $users = User::where('isAdmin', 2)->latest()->get();
        return view('users.index', ['users' => $users]);
    }

    public function store(Request $request)
    {

        $str = Str::random(8);
        $str2 = Str::random(5);
        $userreg = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'keep_track' => $str,
            'password' => Hash::make($str),
            'phone' => $request->phone,
            'can_pay' => $request->can_pay,
            'code' => $str2,
            'share'=>$request->shares,

            'salary' => $request->salary,
            'isAdmin' => 2,
            'status' => 1


        ]);
        $email = $request->email;

        if ($userreg->save()) {
            $userAcc = new Account();
            $userAcc->user_id = $userreg->id;
            $userAcc->acct_bal = 0;
            $userAcc->loan_bal = 0;
            $userAcc->acct_number = substr($userreg->phone, -10);
            $userAcc->status = 1;
            $userAcc->save();
            $data = ([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $str,
                'code' => $str2,
                'shares'=> $userreg->shares,
                'Account Number' => $userAcc->acct_no,
                'Account Balance' => $userAcc->acct_bal
            ]);

            Mail::to($email)->send(new WelcomeMail($data));

            return back()->with('success', 'User has been added');
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExportView()
    {
        return view('import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new UsersImport, request()->file('file'));

        return back();
    }

    public function update(Request $request, $id)
    {
        User::whereId($id)->update($request->except('_token', '_method', 'code'));
        return back()->with('success', "User Updated");
    }

    public function grantor($code)
    {
        $data = User::select('name','salary','id','can_pay')->where('code', $code)->first();
        if($data){
            return response()->json($data);
        }else{
            return response()->json(['msg'=>'Not Found!']);
        }



    }
}