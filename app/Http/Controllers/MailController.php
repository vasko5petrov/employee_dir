<?php

namespace App\Http\Controllers;

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
            'admin-email' => 'required|email'
        ];

        $this->validate($request, $rules, $messages);

        // Generate a random password with length of 6
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
        $randomPassword = '';
        for ($i = 0; $i < 6; $i++) {
            $randomPassword = $randomPassword.$chars[rand(0, strlen($chars)-1)];
        }
        $link = env('APP_URL').'/login';
        
        // Send email
        Mail::send('mail.invitationEmail', [
                'link' => $link,
                'email' => $request->input('admin-email'),
                'password' => $randomPassword
            ],
            function ($m) use ($request) {
                $m->from('employee.directory.team@gmail.com', 'Employee Directory Team');
                $m->to($request->input('admin-email'))->subject('Admin invitation letter');
        });

        return $randomPassword;

//        Mail::send('mail.invitationEmail', ['name' => 'Hihihi'], function($message) {
//            $message->to('dangtrieu25@gmail.com', 'Very nice developer')->subject('Nananan');
//        });
        return 'Sent';
    }
}
