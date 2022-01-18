<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function sendMail(ContactRequest $request)
    {
        try {
            $data = $request->validated();

            Mail::to('aahmedessam30@gmail.com', 'Ahmed Essam')->send(new ContactMail($data));

            return response()->json([
                'msg'   => 'Your email sent successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'err' => 'an error occurred, please try again',
            ]);
        }
    }
}
