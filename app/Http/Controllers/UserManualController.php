<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManualController extends Controller
{
    public function index()
    {
        return view('usermanual.index'); // Assuming you have a "usermanual" folder inside the "resources/views" directory
    }
}
