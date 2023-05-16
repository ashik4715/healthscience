<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Contact;
use App\Models\Image;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $aboutUs = About::all();
        $pictures = Image::all();
        $contact = Contact::all();
        return view('website.pages.about', compact('aboutUs','pictures','contact'));
    }
}