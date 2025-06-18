<?php

namespace App\Http\Controllers;

use App\Models\AturanFuzzy;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AturanFuzzyController extends Controller
{
    public function index()
    {
         $rules = AturanFuzzy::all();
        return view('pages.rules.index', compact('rules'));
    }
}
