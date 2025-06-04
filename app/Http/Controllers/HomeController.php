<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Celebrity\CelebrityRepositoryInterface;

class HomeController extends Controller
{
    private $celebrities;

    public function __construct(CelebrityRepositoryInterface $celebrities)
    {
        $this->celebrities = $celebrities;
    }

    public function index()
    {
        $celebrities = $this->celebrities->getRandom(6);
        return view('welcome', compact('celebrities'));
    }

    public function showCelebrity($id)
    {
        $celebrity = $this->celebrities->find($id);
        if (!$celebrity) {
            abort(404);
        }
        return view('celebrity', compact('celebrity'));
    }
}
