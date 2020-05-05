<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //function to return the homepage
    public function index(){
        return view('pages.index');
    }

    //function to return the about page
    public function about(){
        return view('pages.about');
    }

    //function to return the register page
    public function register(){
        return view('pages.register');
    }

    //function to store the credentials of the user registration
    public function store(Request $request){
        $this->validate($request, [
            'name'=> 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        return redirect('/about');
    }
}
