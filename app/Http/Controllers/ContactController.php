<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Contracts\MailInterface;
use Validator;

class ContactController extends Controller
{
   /**
     * Get contact page.
     *
     * @return
     */
    public function showPage() {
        return view('contact.contact');
    }

    public function postSendEmail(Request $request,MailInterface $mailRepo)
    {
    	$data = $request->all();
    	$validator = Validator::make($data, [
            'full_name' => 'required',
            'email' => 'email|required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();
            return redirect()->back()->with(['errors'=>$errors]);
        }else{
        	$dataEmail = [
                'email' => $request->get('email'),
                'subject' => $request->get('subject'),
                'msg' => $request->get('message'),
                'full_name' => $request->get('full_name'),
            ];
        	$sendEmail = $mailRepo->sendContact($dataEmail, $request->get('email'));
        	return redirect()->back();
        }
    }
}
