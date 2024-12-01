<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contact = $request->session()->get('contact',[]);

        return view('index',compact('contact'));
    }

    public function confirm(Request $request)
    {
        $contact = $request->only([
            'last-name','first-name','gender','email','tel1','tel2','tel3','address','building','category','content'
        ]);

        $request->session()->put('contact', $contact);

        return view('confirm',compact('contact'));
    }


    public function store(Request $request)
    {
        $contact = $request->session()->get('contact');
        $request->session()->forget('contact');

        return redirect('/');
    }

    public function thanks(Request $request)
    {
        $contact = $request->session()->get('contact');

        return view('thanks', compact('contact'));
    }


}
