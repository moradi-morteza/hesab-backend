<?php

namespace App\Http\Controllers;

use App\Exporter;
use Maatwebsite\Excel\Facades\Excel;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function admin(){
        return view('admin');
    }

    public function index()
    {
        return view('welcome');
    }

    public function app()
    {
        return view('app');
    }

    public function develop()
    {
        return view('develop');
    }

}
