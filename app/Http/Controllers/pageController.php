<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class pageController extends Controller
{
    public function index()
    {
        $pages = Pages::all();
        // foreach ($pages as $a) {
        //     $d = $a->categories->title;
        // }
        // dd($d);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('admin.pages.pagesCreate', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories_id' => 'required|exists:categories,id',
            'is_active' => 'required|boolean'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pages', 'public');
        } else {
            $imagePath = 'users/default.jpg';
        }
        // dd($request->all());

        Pages::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'categories_id' => $request->categories_id,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('pages.index')->with('success', 'Page berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pages = Pages::findOrFail($id);
        // dd($page);
        $categories = Categories::all();
        return view('admin.pages.pagesEdit', compact('pages', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $page = Pages::findOrFail($id);

        $request->validate([
            'title' => 'nullable|max:255',
            'content' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'categories_id' => 'required|exists:categories,id',
            'is_active' => 'nullable|boolean'
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
            'categories_id' => $request->categories_id,
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
