<?php

namespace App\Http\Controllers;

use App\Employee;
use Session;
use App\PendingUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    // Show an administrator invitation form
    public function showInvitationForm()
    {
        if (Auth::user()->email != 'example@gmail.com') {
            return redirect('/');
        }
        return view('mail.showInvitationForm');
    }

    // Send an invitation email
    public function sendInvitation(Request $request)
    {
        if (Auth::user()->email != 'example@gmail.com') {
            return redirect('/');
        }

        $messages = [
            'admin-email.required' => 'The email field is required.',
            'admin-email.email' => 'Please provide a valid email address.',
            'admin-username.required' => 'The username field is required.',
        ];
        $rules = [
            'admin-email' => 'required|email',
            'admin-username' => 'required|string'
        ];

        $this->validate($request, $rules, $messages);

        // Generate a random password with length of 6
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
        $randomPassword = '';
        for ($i = 0; $i < 6; $i++) {
            $randomPassword = $randomPassword.$chars[rand(0, strlen($chars)-1)];
        }
        $link = env('APP_URL').'/login';

        $user = User::where('email', $request->input('admin-email'))->first();
        if (!$user) {
            $pending_user = PendingUser::where('email', $request->input('admin-email'))->first();
            if ($pending_user) {
                // Update new random generated password
                $pending_user->username = $request->input('admin-username');
                $pending_user->password = bcrypt($randomPassword);
                $pending_user->save();
            }
            else {
                // Create pending user
                $pending_user = new PendingUser();
                $pending_user->email = $request->input('admin-email');
                $pending_user->username = $request->input('admin-username');
                $pending_user->password = bcrypt($randomPassword);
                $pending_user->save();
            }

            // Send email
            Mail::send('mail.invitationEmail', [
                'link' => $link,
                'email' => $request->input('admin-email'),
                'password' => $randomPassword,
            ],
                function ($m) use ($request) {
                    $m->from('employee.directory.team@gmail.com', 'Employee Directory Team');
                    $m->to($request->input('admin-email'))->subject('Admin invitation letter');
                });

            // Success flag
            $flag = 1;
        }
        else {
            $flag = 0;
        }
        return view('mail.showInvitationForm', compact('flag'));
    }

    public function helpdeskForm() {
        return view('mail.helpdeskForm');
    }

    public function helpdeskSend(Request $request) {

        $messages = [
            'message' => 'The message field is required.',
            'subject.required' => 'The subject field is required.',
        ];
        $rules = [
            'message' => 'required|string|min:10',
            'subject' => 'required|string|min:5'
        ];

        $this->validate($request, $rules, $messages);

        $computer_ip = $_SERVER['REMOTE_ADDR'];

        $query = Employee::where('ip_address', 'like', $computer_ip);
        $employee = $query->orderBy('name')->get();

        if(count($employee) != 0) {
            $data = array(
            'emailMessage' => $request->message,
            'subject' => $request->subject,
            'computer_ip' => $computer_ip,
            'employee_name' => $employee[0]->name,
            'employee_email' => $employee[0]->email
            );
            dd($data);

            Session::flash('success', 'Email has been send successfully.');
            return redirect('/helpdesk');
        } else {
            Session::flash('warning', 'This is an unknown IP! - '. $computer_ip);
            return redirect('/helpdesk');
        }
        
    }
}
