<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contact = $request->session()->get('contact',[]);

        return view('index',compact('contact'));
    }

    public function store(Request $request)
{
    $contact = $request->only([
        'last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category', 'detail'
    ]);

    $categoryId = $this->getCategoryId($contact['category']);
    $contact['category_id'] = $categoryId;

    Contact::create($contact);

    return view('confirm', compact('contact'));
    }

private function getCategoryId($category)
{
    $categoryMap = [
        'ご質問' => 1,
        'ご意見' => 2,
        'その他' => 3,
    ];

    return $categoryMap[$category] ?? null;
}


    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail'
        ]);

        return view('confirm', compact('contact'));
    }

    public function thanks(Request $request)
    {

        return view('thanks');
    }



}
