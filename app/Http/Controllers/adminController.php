<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class adminController extends Controller
{
    public function index(){
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Akses khusus Admin.');
        }

        return view('admin.mainAdmin');
    }
}
