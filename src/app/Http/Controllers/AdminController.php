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
}
