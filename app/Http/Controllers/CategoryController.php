<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // direct category page
    public function categoryPage()
    {
        return view('author.pages.category');
    }
}
