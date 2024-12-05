<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditorRegisterRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Shop;
use App\Models\Shop_representative;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function getEditorRegister() {
        $shops = Shop::select('id', 'name')->get();

        return view('admin/register-for-editor', compact('shops'));
    }

    public function postEditorRegister(EditorRegisterRequest $request) {
        $editor = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $editor->assignRole('editor');

        $user_id = User::where('email', $request['email'])->first()->id;

        if($request['shop_id'] !== 'new') {
            $shop = new Shop_representative();
            $shop->fill([
                'user_id'=>$user_id,
                'shop_id'=>$request['shop_id'],
            ])->save();
        }

        return redirect('/admin/user/index')->with('result', '店舗管理者を登録しました');
    }

    public function list() {
        
        return view('admin/admin-list');
    }

    public function getSendView() {
        
        return view('admin/email-notification');
    }

    public function sendNotification(Request $request)
    {
        $address = $request->input('address');
        $text = $request->input('text');

        if ($address === 'all') {
            $users = User::all();
        } elseif ($address === 'user') {
            $users = User::doesntHave('roles')->get();
        } else {
            $role = Role::findByName($address);
            $users = $role ? $role->users : collect();
        }

        foreach ($users as $user) {
            $user->notify(new AdminNotification($user, $text));
        }

        return back()->with('result', '送信完了しました。');
    }
}
