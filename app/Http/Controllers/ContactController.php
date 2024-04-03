<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    // DBにcontactメッセージを保存
    public function contact(Request $request) {
        $param = [
            'name' => $request->name,
            'address' => $request->email,
            'message' => $request->message,
        ];
        DB::insert('insert into contact (name, address, message) values (:name, :address, :message)', $param);

        return redirect('/contact_out');
    }

    // 送られてきたメッセージ確認画面表示
    public function message() {
        // メッセージ取得
        $messages = DB::select('select * from contact');
        $empty = empty($messages);

        return view('message', ['messages' => $messages, 'empty' => $empty]);
    }
}
