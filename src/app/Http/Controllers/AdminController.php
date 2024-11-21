<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Shop;

class AdminController extends Controller
{

    public function getEditorRegister() {
        $shops = Shop::select('id', 'name')->get();

        return view('admin/register-for-editor', compact('shops'));
    }

    public function postEditorRegister(RegisterRequest $request) {

        $editor = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $editor->assignRole('editor');

        if($request['shop_id'] !== 'new') {
            $shop = Shop::find($request['shop_id']);
            $shop->fill([
                'user_id'=>$editor->id,
            ])->save();
        }

        return redirect('/editor/list')->with('result', '店舗管理者を登録しました');
    }

    public function list() {
        return view('admin/admin-list');
    }
}
