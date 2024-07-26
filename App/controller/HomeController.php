<?php 

namespace App\controller;

class HomeController
{
    public function home()
    {
        return view('/LandingPage/home');
    }

    public function about() 
    {
        return view('/LandingPage/about');
    }

    public function contact() 
    {
        return view('/LandingPage/contact');
    }
}