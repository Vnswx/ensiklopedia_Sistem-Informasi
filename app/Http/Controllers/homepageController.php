<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Category;

class homepageController extends Controller
{
    public function index()
    {
        $profil = Pages::whereHas('categories', function ($q) {
            $q->where('title', 'profil');
        })
            ->where('is_active', 1)
            ->first();

        $akademik = Pages::whereHas('categories', function ($q) {
            $q->where('title', 'akademik');
        })
            ->where('is_active', 1)
            ->get();

        $sdm = Pages::whereHas('categories', function ($q) {
            $q->where('title', 'sdm');
        })
            ->where('is_active', 1)
            ->get();

        $administrasi = Pages::whereHas('categories', function ($q) {
            $q->where('title', 'administrasi');
        })
            ->where('is_active', 1)
            ->get();

        $media = Pages::whereHas('categories', function ($q) {
            $q->where('title', 'media');
        })
            ->where('is_active', 1)
            ->latest()
            ->take(3)
            ->get();

        return view('main.homepage', compact('profil', 'akademik', 'sdm', 'administrasi', 'media'));
    }
}
