<?php

namespace App;

class Controller
{
    public function view(string $path, array $data)
    {
        require_once __DIR__ . '\..\resources\views' . $path . '.php';
    }
}