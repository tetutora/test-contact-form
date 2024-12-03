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

    public function store(ContactRequest $request)
{
    $contact = $request->only([
        'last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category', 'detail'
    ]);

    // genderを文字列から数値に変換
    $contact['gender'] = $this->getGenderId($contact['gender']);

    // categoryの変換
    $categoryId = $this->getCategoryId($contact['category']);
    $contact['category_id'] = $categoryId;

    // category_nameの設定
    $contact['category_name'] = $this->getCategoryName($categoryId);

    // セッションに保存
    $request->session()->put('contact', $contact);

    // DBに保存
    Contact::create($contact);

    // 確認画面に遷移
    return view('confirm', compact('contact'));
}

// genderを文字列から数値に変換するヘルパー
private function getGenderId($gender)
{
    $genderMap = [
        '男性' => 1,
        '女性' => 2,
        'その他' => 3,
    ];

    return $genderMap[$gender] ?? 3;  // デフォルトを 'その他' (3) に
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

private function getCategoryName($categoryId)
{
    $categoryMap = [
        1 => 'ご質問',
        2 => 'ご意見',
        3 => 'その他',
    ];

    return $categoryMap[$categoryId] ?? '未選択';
}



    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail'
        ]);

        $contact['category_name'] = $this->getCategoryName($contact['category_id']);

        return view('confirm', compact('contact'));
    }

    public function thanks(Request $request)
    {

        return view('thanks');
    }



}
