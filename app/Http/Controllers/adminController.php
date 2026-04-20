<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pages;
use App\Models\Articles;


class adminController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Akses khusus Admin.');
        }

        $pages = Pages::all();
        // dd($pages);
        return view('admin.mainAdmin', compact('pages',));
    }

    public function articleApprove(){
        $article = Articles::where('status', 'pending')->get();
        // dd($article);
        return view('admin.articleAdmin', compact( 'article'));
    }

    public function approve($id)
    {
        $article = Articles::findOrFail($id);

        $article->update([
            'status' => 'approved',
            'is_active' => true
        ]);

        return redirect()->route('admin.panel')->with('success', 'Artikel disetujui');
    }

    public function reject($id)
    {
        $article = Articles::findOrFail($id);

        $article->update([
            'status' => 'rejected',
            'is_active' => false
        ]);

        return redirect()->route('admin.panel')->with('success', 'ditolak');
    }
}
