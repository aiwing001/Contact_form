<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
    $items = Contact::with('category')->paginate(7);
    return view('admin', compact('items'));
    }

    public function search(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword'))
            {
                $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%')
                ->orWhere('detail', 'like', '%' . $request->keyword . '%');
                });
            }

        if ($request->filled('gender')) {
                $query->where('gender', $request->gender);
            }

        if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

        if ($request->filled('date')) {
                $query->whereDate('created_at', $request->date);
            }

        $items = $query->paginate(7);

        return view('admin', compact('items'));
    }

    public function export(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('detail', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        $contacts =$query->get();

        $csvHeader = ['お名前' , '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容'];

        $callback = function () use ($contacts, $csvHeader) {
            $file = fopen('php://output', 'w');

            fputcsv($file, $csvHeader);

            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                    $contact->email,
                    optional($contact->category)->content,
                    $contact->detail,
                ]);
            }

        fclose($file);
        };

    return response()->streamDownload($callback, 'contacts.csv', [
        'Content-Type' => 'text/csv',
        ]);
    }

    public function destroy(Request $request)
    {
        Contact::findOrFail($request->id)->delete();
        return redirect('/admin')->with('message', '削除しました');
    }
}