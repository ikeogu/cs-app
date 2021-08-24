<?php

namespace App\Imports;

use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {


            $str = Str::random(8);
            $userreg = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'keep_track' => $str,
                'password' => Hash::make($str),
                'phone' => $row['phone'],
                'can_pay' => $row['can_pay'],
                'salary' => $row['salary'],
                'isAdmin' => 2,
                'status' => 1



            ]);
            $email = $row['email'];

            if ($userreg->save()) {
                $userAcc = new Account();
                $userAcc->user_id = $userreg->id;
                $userAcc->acct_bal = 0;
                $userAcc->loan_bal = 0;
                $userAcc->acct_number = substr($userreg->phone, -10);
                $userAcc->status = 1;
                $userAcc->save();
                $data = ([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'password' => $str,
                    'Account Number' => $userAcc->acct_no,
                    'Account Balance' => $userAcc->acct_bal
                ]);

                // Mail::to($email)->send(new WelcomeMail($data));


            }
        }
        return back()->with('success', 'Users has been added');
    }
}