<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use Illuminate\Support\Str;

class pageController extends Controller
{
    public function index()
    {
        $pages = Pages::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.pagesCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'required|boolean'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pages', 'public');
        } else {
            $imagePath = 'users/default.jpg';
        }

        Pages::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('pages.index')->with('success', 'Page berhasil ditambahkan');
    }

    public function edit($id)
    {
        $page = Pages::findOrFail($id);
        return view('admin.pages.pagesEdit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Pages::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'required|boolean'
        ]);

        $imagePath = $page->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pages', 'public');
        }else{
            $imagePath = 'users/default.jpg';
        }

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('pages.index')->with('success', 'Page berhasil diupdate');
    }

    public function destroy($id)
    {
        $page = Pages::findOrFail($id);
        $page->delete();

        return redirect()->route('pages.index')->with('success', 'Page berhasil dihapus');
    }
}
