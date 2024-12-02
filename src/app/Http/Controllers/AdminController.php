<?php

namespace App\Http\Controllers;
use App\Models\Contact;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function search(Request $request)
    {
        // 検索条件を取得
        $keyword = $request->input('keyword');
        $gender = $request->input('gender');
        $category = $request->input('category');
        $date = $request->input('date');

        $query = Contact::query();

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($gender) {
            $query->where('gender', $gender);
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        $contacts = $query->paginate(7);

        return view('admin', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::find($id);

        if ($contact) {
            return response()->json([
                'last_name' => $contact->last_name,
                'first_name' => $contact->first_name,
                'gender' => $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                'email' => $contact->email,
                'category' => $contact->category_id == 1 ? 'ご質問' : ($contact->category_id == 2 ? 'ご意見' : 'その他'),
                'detail' => $contact->detail
            ]);
        }

            return response()->json(['error' => 'Contact not found'], 404);
}


}
