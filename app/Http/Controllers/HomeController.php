<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Landing Page.
     * 
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Home Page.
     * 
     */
    public function home()
    {
        return view('home');
    }

    /**
     * About Page.
     * 
     */
    public function about()
    {
        return view('about');
    }
     /**
     * Contact Page.
     * 
     */
    public function contact()
    {
        return view('contact');
    }
     /**
     * privacy Page.
     * 
     */
    public function privacy()
    {
        return view('privacy');
    }

     /**
     * Terms Page.
     * 
     */
    public function terms()
    {
        return view('terms');
    }
}
