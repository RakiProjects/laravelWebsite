<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\Mail\EmailSend;
use Mail;

class ContactController extends FrontEndController
{
    public function __construct(){
        parent::__construct();
    }

    public function showContact(){
        return view("pages.contact", $this->data);
    }

    public function contactFormSubmit(ContactFormRequest $request){       
        $mail['email'] = $request->email;   
        $mail['headline'] = $request->headline;
        $mail['name'] = $request->name;
        $mail['phone'] = $request->phone;
        $mail['bodyMessage'] = $request->message;

        Mail::to('radakovic.nemanja3301@gmail.com')
            ->send(new EmailSend($mail));

        session()->flash('successEmail', 'Hvala na poruci, vas email je uspešno poslat.');
        return redirect()->back();
        
    }
}
