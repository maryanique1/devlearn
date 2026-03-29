<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $qcmFilter = $request->get('qcm', 'global');
        $validQcms = ['global', 'qcm-cpp', 'qcm-html', 'qcm-css', 'qcm-js', 'qcm-sql', 'qcm-php', 'qcm1', 'qcm2', 'qcm3', 'qcm-exam'];
        if (!in_array($qcmFilter, $validQcms)) {
            $qcmFilter = 'global';
        }

        if ($qcmFilter === 'global') {
            $rankings = DB::select('SELECT u.id, u.nom, ROUND(AVG(best_pct)) as avg_score, SUM(attempts) as total_attempts FROM users u JOIN (SELECT user_id, qcm_name, MAX(percentage) as best_pct, COUNT(*) as attempts FROM scores GROUP BY user_id, qcm_name) s ON u.id = s.user_id GROUP BY u.id, u.nom ORDER BY avg_score DESC LIMIT 50');
        } else {
            $rankings = DB::select('SELECT u.id, u.nom, MAX(s.percentage) as avg_score, COUNT(*) as total_attempts FROM users u JOIN scores s ON u.id = s.user_id WHERE s.qcm_name = ? GROUP BY u.id, u.nom ORDER BY avg_score DESC LIMIT 50', [$qcmFilter]);
        }

        $totalUsers = DB::selectOne('SELECT COUNT(DISTINCT user_id) as cnt FROM scores')->cnt ?? 0;

        $myRank = 0;
        foreach ($rankings as $i => $r) {
            if ($r->id === auth()->id()) {
                $myRank = $i + 1;
                break;
            }
        }

        $tabs = [
            ['label' => 'Global', 'key' => 'global', 'color' => '#e94560'],
            ['label' => 'C++', 'key' => 'qcm-cpp', 'color' => '#00599C'],
            ['label' => 'HTML', 'key' => 'qcm-html', 'color' => '#e44d26'],
            ['label' => 'CSS', 'key' => 'qcm-css', 'color' => '#2965f1'],
            ['label' => 'JS', 'key' => 'qcm-js', 'color' => '#f0db4f'],
            ['label' => 'SQL', 'key' => 'qcm-sql', 'color' => '#00BCD4'],
            ['label' => 'PHP', 'key' => 'qcm-php', 'color' => '#8892BF'],
            ['label' => 'Serie 1', 'key' => 'qcm1', 'color' => '#e94560'],
            ['label' => 'Serie 2', 'key' => 'qcm2', 'color' => '#e94560'],
            ['label' => 'Serie 3', 'key' => 'qcm3', 'color' => '#e94560'],
            ['label' => 'Examen', 'key' => 'qcm-exam', 'color' => '#ff9800'],
        ];

        return view('classement', compact('rankings', 'qcmFilter', 'totalUsers', 'myRank', 'tabs'));
    }
}
