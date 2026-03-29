<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $userScores = Cache::remember("scores_user_{$user->id}", 60, function () use ($user) {
            return Score::where('user_id', $user->id)
                ->select('qcm_name', DB::raw('MAX(percentage) as best'), DB::raw('COUNT(*) as attempts'), DB::raw('MAX(completed_at) as last_at'))
                ->groupBy('qcm_name')
                ->get()
                ->keyBy('qcm_name');
        });

        $totalCompleted = $userScores->count();
        $totalAttempts = $userScores->sum('attempts');
        $avgBest = $totalCompleted > 0 ? round($userScores->avg('best')) : 0;

        $userProgress = Cache::remember("progress_user_{$user->id}", 60, function () use ($user) {
            return Progress::where('user_id', $user->id)->get()->keyBy('qcm_name');
        });

        $canCertificate = isset($userScores['qcm-exam']) && (int)$userScores['qcm-exam']->best >= 80;

        $path_steps = [
            ['name' => 'C++',  'qcm' => 'qcm-cpp',  'color' => '#00599C'],
            ['name' => 'HTML', 'qcm' => 'qcm-html', 'color' => '#e44d26'],
            ['name' => 'CSS',  'qcm' => 'qcm-css',  'color' => '#2965f1'],
            ['name' => 'JS',   'qcm' => 'qcm-js',   'color' => '#f0db4f'],
            ['name' => 'SQL',  'qcm' => 'qcm-sql',  'color' => '#00BCD4'],
            ['name' => 'PHP',  'qcm' => 'qcm-php',  'color' => '#8892BF'],
        ];

        return view('dashboard', compact('user', 'userScores', 'userProgress', 'totalCompleted', 'totalAttempts', 'avgBest', 'canCertificate', 'path_steps'));
    }
}
