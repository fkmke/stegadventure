<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use Mail;
use App\Mail\ContactMail;

class ContactFormController extends Controller
{
    public function submit(ContactFormRequest $request)
    {

        Mail::to('cocclashofclanscoc01@gmail.com')->send(new ContactMail([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message'),
        ]));

        return response(200);
    }
}
