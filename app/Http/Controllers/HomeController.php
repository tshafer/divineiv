<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Review;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('active', true)->where('featured', true)->orderBy('sort_order')->get();
        $reviews = Review::where('active', true)->where('featured', true)->take(3)->get();
        $aboutPage = Page::where('slug', 'about-us')->first();

        return view('home', compact('services', 'reviews', 'aboutPage'));
    }

    public function services()
    {
        $services = Service::where('active', true)->orderBy('sort_order')->get();

        return view('services', compact('services'));
    }

    public function service($slug)
    {
        $service = Service::where('slug', $slug)->where('active', true)->firstOrFail();

        return view('service', compact('service'));
    }

    public function reviews()
    {
        $reviews = Review::where('active', true)->orderBy('created_at', 'desc')->get();

        return view('reviews', compact('reviews'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('active', true)->firstOrFail();

        return view('page', compact('page'));
    }

    public function blog()
    {
        $posts = Page::where('type', 'blog_post')->where('active', true)->orderBy('created_at', 'desc')->get();

        return view('blog', compact('posts'));
    }
}
