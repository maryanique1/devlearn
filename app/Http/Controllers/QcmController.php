<?php

namespace App\Http\Controllers;

class QcmController extends Controller
{
    private array $validSlugs = [
        'html', 'css', 'js', 'php', 'sql', 'cpp', 'exam', '1', '2', '3',
    ];

    public function show(string $slug)
    {
        if (!in_array($slug, $this->validSlugs)) {
            abort(404);
        }

        $viewName = 'qcm.' . $slug;
        $user = auth()->user();

        return view($viewName, compact('user'));
    }
}
