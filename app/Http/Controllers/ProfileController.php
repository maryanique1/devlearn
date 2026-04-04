<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $allScores = Score::where('user_id', $user->id)->orderByDesc('completed_at')->get();

        $totalAttempts = $allScores->count();
        $avgPct = $totalAttempts > 0 ? round($allScores->avg('percentage')) : 0;
        $bestPct = $totalAttempts > 0 ? $allScores->max('percentage') : 0;
        $totalTime = $allScores->sum('duration_seconds');

        $bestPerQcm = [];
        foreach ($allScores as $s) {
            if (!isset($bestPerQcm[$s->qcm_name]) || $s->percentage > $bestPerQcm[$s->qcm_name]) {
                $bestPerQcm[$s->qcm_name] = (int)$s->percentage;
            }
        }

        $progress = Progress::where('user_id', $user->id)->get()->keyBy('qcm_name');

        $qcmColors = [
            'qcm-cpp' => '#00599C', 'qcm-html' => '#e44d26', 'qcm-css' => '#2965f1', 'qcm-js' => '#f0db4f',
            'qcm-sql' => '#00BCD4', 'qcm-php' => '#8892BF', 'qcm1' => '#e94560', 'qcm2' => '#e94560',
            'qcm3' => '#e94560', 'qcm-exam' => '#ff9800',
        ];

        return view('profil', compact('user', 'allScores', 'totalAttempts', 'avgPct', 'bestPct', 'totalTime', 'bestPerQcm', 'progress', 'qcmColors'));
    }

    public function updateName(Request $request)
    {
        $request->validate(['nom' => 'required|max:100']);
        $user = Auth::user();
        $user->update(['nom' => $request->nom, 'name' => $request->nom]);
        return back()->with('success', 'Nom mis a jour.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Ancien mot de passe incorrect.']);
        }

        $request->validate([
            'new_password' => 'required|min:4|confirmed',
        ], [
            'new_password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'new_password.min' => 'Le nouveau mot de passe doit faire au moins 4 caracteres.',
        ]);

        $user->update(['password' => $request->new_password]);
        return back()->with('success', 'Mot de passe mis a jour.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate(['avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048']);
        $user = Auth::user();

        $file = $request->file('avatar');
        $mime = $file->getMimeType();
        $base64 = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));

        $user->update(['avatar' => $base64]);
        return back()->with('success', 'Photo de profil mise a jour.');
    }

    public function updateBio(Request $request)
    {
        $request->validate(['bio' => 'nullable|max:500']);
        Auth::user()->update(['bio' => $request->bio]);
        return back()->with('success', 'Bio mise a jour.');
    }
}
