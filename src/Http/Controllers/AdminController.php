<?php namespace Laradic\Admin\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;



class AdminController extends Controller
{
    /**
     * Show the application dashboard to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laradic/admin::index');
    }
}
