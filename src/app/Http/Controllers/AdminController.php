<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function register() {
        return view('admin/register-for-editor');
    }

    public function list() {
        return view('admin/admin-list');
    }

    public function getRegister() {
        return view('admin/register-for-admin');
    }
}
