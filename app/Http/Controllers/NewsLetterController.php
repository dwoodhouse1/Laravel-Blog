<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsLetterController extends Controller
{
    public function __invoke(Newsletter $newsletter) //MailchimpNewsletter $newsletter
    {
    
        request()->validate(['email' => 'required|email']);

        try 
        {
            
            $newsletter->subscribe(request('email'));
        }
        catch (\Exception $e)
        {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ])->redirectTo('/#newsletter');
        }
        
        return redirect('/#newsletter')->with('success', 'You are now signed up for our newsletter!');
    }
}
