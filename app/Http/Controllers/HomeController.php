<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\MemberLoan;
use App\Models\Loan;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->isAdmin == 1) {
            $data['withdrawals'] = Withdrawal::latest()->take(15)->get();
            $data['loans'] = Loan::latest()->take(15)->get();


            return view('dashboard')->with($data);
        } else {
            $data['histories'] = History::where('user_id', auth()->user()->id)->latest()->get();
            $data['withdrawals'] = Withdrawal::where('user_id', auth()->user()->id)->latest()->get();
            $data['loans'] = MemberLoan::where('user_id', auth()->user()->id)->latest()->get();

            return view('userdashboard')->with($data);
        }
    }
}