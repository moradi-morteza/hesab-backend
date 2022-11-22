<?php

namespace App\Http\Controllers;

use App\Exporter;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        return view('welcome');
    }

    public function home()
    {
        return view('home');
    }

    public function develop()
    {
        return view('develop');
    }

}
