<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class articleController extends Controller
{
    public function index()
    {
        $article = Articles::all();
        // dd($article);
        return view('main.article.index', compact('article'));
    }

    public function create(){
        $categories = Categories::all();
        return view('main.article.articleCreate', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categories_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

       if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('article', 'public');
        } else {
            $imagePath = 'users/default.jpg';
        }

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $status = 'approved';
            $is_active = true;
        } else {
            $status = 'pending';
            $is_active = false;
        }

        Articles::create([
            'user_id' => Auth::id(),
            'categories_id' => $request->categories_id,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $status, 
            'is_active' => $is_active 
        ]);

        // dd($a);

        return redirect()->route('article.index')->with('success', 'Artikel berhasil dikirim, menunggu review');
    }

    public function edit($id){
        $article = Articles::findOrFail($id);
        $categories = Categories::all();

        return view('main.article.articleEdit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Articles::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'categories_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

       if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('article', 'public');
        } else {
            $imagePath = 'users/default.jpg';
        }

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $status = 'approved';
            $is_active = true;
        } else {
            $status = 'pending';
            $is_active = false;
        }

        $article->update([
            'user_id' => Auth::id(),
            'categories_id' => $request->categories_id,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $status, 
            'is_active' => $is_active 
        ]);

        // dd($a);

        return redirect()->route('article.index')->with('success', 'Artikel berhasil dikirim, menunggu review');
    }

    public function destroy($id)
    {
        $article = Articles::findOrFail($id);
        $article->delete();

        return redirect()->route('article.index')->with('success', 'Page berhasil dihapus');
    }
}
