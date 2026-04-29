<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        return view('confirm', compact('request'));
    }

    public function store(Request $request)
    {
        if ($request->action === 'back') {
            return redirect('/')->withInput();
        }

        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'detail',
        ]);

        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        Contact::create($contact);

        return redirect('/thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
