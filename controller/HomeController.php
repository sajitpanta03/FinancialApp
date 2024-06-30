<?php 

namespace controller;

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
        echo "Welcome to contact page";
    }
}