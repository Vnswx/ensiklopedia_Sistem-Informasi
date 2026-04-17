<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pages;


class adminController extends Controller
{
    public function index(){
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Akses khusus Admin.');
        }

        $pages = Pages::all();
        // dd($pages);
        return view('admin.mainAdmin', compact('pages'));
    }
}
