<?php

namespace App\Controllers;

use App\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->view('\home\index', [
            'title' => 'Home'
        ]);
    }
}