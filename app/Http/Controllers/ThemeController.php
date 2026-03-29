<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function update(Request $request)
    {
        $theme = $request->input('theme') === 'light' ? 'light' : 'dark';
        Auth::user()->update(['theme' => $theme]);
        return response()->json(['success' => true, 'theme' => $theme]);
    }
}
