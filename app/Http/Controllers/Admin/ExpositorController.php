<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expositor;

class ExpositorController extends Controller
{
    public function index()
    {
        $expositors = Expositor::orderBy('id', 'desc')->paginate(15);
        return view('admin.expositors.index', compact('expositors'));
    }
}
