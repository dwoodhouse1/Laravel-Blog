<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use League\Config\Exception\ValidationException as ExceptionValidationException;
use Nette\Schema\ValidationException as SchemaValidationException;

class SessionsController extends Controller
{
    
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);
       
        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (auth()->attempt($attributes))
        {
            // session is regenerated to prevent "session fixation" attacks (google to find out more)
            session()->regenerate();

            // redirect with a success flash message
            return redirect('/')->with('success', 'Welcome Back!');
        }

        return back()->withErrors(['email' => 'Your provided credentials could not be verified.']);
    }
    
    public function destroy()
    {
        auth()->logout();

        session()->flash('success', 'See you next time!'); //same result below
        return redirect('/');//->with('success', 'Your account has been created.');
    }
    
}
