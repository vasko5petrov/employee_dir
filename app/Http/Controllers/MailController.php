<?php

namespace App\Http\Controllers;

use App\PendingUser;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    // Show an administrator invitation form
    public function showInvitationForm()
    {
        return view('mail.showInvitationForm');
    }

    // Send an invitation email
    public function sendInvitation(Request $request)
    {
        $messages = [
            'admin-email.required' => 'The email field is required.',
            'admin-email.email' => 'Please provide a valid email address.',
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
            $flag = true;
        }
        else {
            $flag = false;
        }
        return view('mail.showInvitationForm', compact('flag'));
    }
}
