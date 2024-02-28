<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function sendForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ]);
    
        Mail::to('regionalnisandomierz@op.pl')->send(new ContactFormMail($data));
    
        return response()->json(['message' => 'E-mail wysłany pomyślnie']);
    }
}
