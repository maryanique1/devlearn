@extends('layouts.app')

@section('title', 'Dev Learn — Tableau de bord')

@section('styles')
    .container { max-width:900px; margin:0 auto; }

    /* Welcome */
    .welcome { margin-bottom:36px; }
    .welcome h1 { font-size:28px; font-weight:800; margin-bottom:4px; }
    .welcome h1 span { color:var(--accent); }
    .welcome p { color:var(--muted); font-size:14px; }

    /* Stats */
    .stats { display:grid; grid-template-columns:repeat(3, 1fr); gap:16px; margin-bottom:36px; }
    .stat { background:var(--card); border-radius:14px; padding:22px; text-align:center; border:1px solid var(--border); transition:transform .2s; animation:fadeUp .5s ease both; }
    .stat:nth-child(1) { animation-delay:.05s; } .stat:nth-child(2) { animation-delay:.1s; } .stat:nth-child(3) { animation-delay:.15s; }
    .stat:hover { transform:translateY(-2px); }
    .stat-num { font-size:32px; font-weight:800; color:var(--accent); line-height:1; }
    .stat-lbl { font-size:11px; color:var(--dim); margin-top:6px; text-transform:uppercase; letter-spacing:1px; }
    @keyframes fadeUp { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }

    /* Continue card */
    .continue-card { background:var(--card); border-radius:16px; padding:28px; margin-bottom:36px; border:1px solid var(--border); display:flex; align-items:center; gap:20px; transition:transform .2s; }
    .continue-card:hover { transform:translateY(-2px); }
    .continue-icon { width:56px; height:56px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-weight:bold; font-size:16px; flex-shrink:0; color:#fff; }
    .continue-info { flex:1; }
    .continue-info h3 { font-size:17px; font-weight:700; margin-bottom:4px; }
    .continue-info p { font-size:13px; color:var(--muted); }
    .continue-btn { padding:10px 24px; background:var(--accent); color:#fff; border:none; border-radius:8px; font-size:13px; font-weight:700; text-decoration:none; flex-shrink:0; transition:opacity .2s; }
    .continue-btn:hover { opacity:.85; }

    /* Parcours rapide */
    .path { display:flex; align-items:center; justify-content:center; gap:0; flex-wrap:wrap; padding:20px 0; margin-bottom:36px; }
    .path-step { display:flex; flex-direction:column; align-items:center; gap:6px; }
    .path-circle { width:48px; height:48px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:13px; color:#fff; border:3px solid transparent; }
    .path-circle.done { box-shadow:0 0 12px rgba(76,175,80,0.4); border-color:#4caf50; }
    .path-circle .check { font-size:20px; }
    .path-label { font-size:11px; font-weight:600; color:var(--muted); text-transform:uppercase; }
    .path-arrow { width:36px; height:3px; background:var(--border); margin:0 4px; margin-bottom:20px; border-radius:2px; position:relative; }
    .path-arrow::after { content:''; position:absolute; right:-3px; top:-3px; border:4px solid transparent; border-left-color:var(--border); }
    .path-arrow.done { background:#4caf50; } .path-arrow.done::after { border-left-color:#4caf50; }

    /* Quick links */
    .quick-links { display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:16px; margin-bottom:36px; }
    .quick-link { background:var(--card); border-radius:14px; padding:24px; text-decoration:none; color:inherit; text-align:center; border:1px solid var(--border); transition:all .2s; }
    .quick-link:hover { border-color:var(--accent); transform:translateY(-3px); box-shadow:0 8px 24px rgba(0,0,0,0.2); }
    .quick-link .icon { font-size:28px; margin-bottom:10px; }
    .quick-link h3 { font-size:15px; font-weight:700; margin-bottom:4px; }
    .quick-link p { font-size:12px; color:var(--muted); }

    /* Motivation */
    .motivation { background:var(--card); border-radius:16px; padding:32px; text-align:center; border:1px solid var(--border); margin-bottom:36px; }
    .motivation .quote { font-size:18px; font-style:italic; line-height:1.6; margin-bottom:12px; color:var(--text); }
    .motivation .author { font-size:13px; color:var(--accent); font-weight:600; }

    /* Donut + objectif row */
    .dash-row { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:36px; }
    .dash-card { background:var(--card); border-radius:16px; padding:24px; border:1px solid var(--border); }
    .dash-card h3 { font-size:14px; font-weight:700; margin-bottom:16px; color:var(--accent); }

    /* Donut */
    .donut-wrap { display:flex; align-items:center; justify-content:center; gap:24px; }
    .donut { position:relative; width:120px; height:120px; }
    .donut svg { transform:rotate(-90deg); }
    .donut-label { position:absolute; inset:0; display:flex; flex-direction:column; align-items:center; justify-content:center; }
    .donut-pct { font-size:28px; font-weight:800; color:var(--accent); }
    .donut-sub { font-size:10px; color:var(--muted); }
    .donut-legend { font-size:12px; color:var(--muted); line-height:2; }
    .donut-legend span { display:inline-block; width:10px; height:10px; border-radius:3px; margin-right:6px; vertical-align:middle; }

    /* Objectif du jour */
    .goal-card { display:flex; align-items:center; gap:16px; }
    .goal-icon { width:52px; height:52px; border-radius:14px; background:rgba(137,111,61,0.1); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .goal-text h4 { font-size:15px; font-weight:700; margin-bottom:4px; }
    .goal-text p { font-size:13px; color:var(--muted); line-height:1.5; }
    .goal-btn { display:inline-block; margin-top:10px; padding:8px 20px; background:var(--accent); color:#fff; border-radius:8px; font-size:12px; font-weight:700; text-decoration:none; transition:opacity .2s; }
    .goal-btn:hover { opacity:.85; }

    /* Heatmap */
    .heatmap-card { margin-bottom:36px; }
    .heatmap { display:flex; gap:3px; flex-wrap:wrap; justify-content:flex-start; }
    .heatmap-day { width:14px; height:14px; border-radius:3px; background:var(--input); transition:transform .2s; }
    .heatmap-day:hover { transform:scale(1.5); }
    .heatmap-day.l1 { background:rgba(137,111,61,0.25); }
    .heatmap-day.l2 { background:rgba(137,111,61,0.5); }
    .heatmap-day.l3 { background:rgba(137,111,61,0.75); }
    .heatmap-day.l4 { background:#896f3d; }
    .heatmap-legend { display:flex; align-items:center; gap:6px; margin-top:10px; font-size:11px; color:var(--muted); }
    .heatmap-legend .box { width:12px; height:12px; border-radius:2px; }

    /* Responsive */
    @media (max-width:768px) {
        .stats { grid-template-columns:1fr 1fr 1fr; gap:10px; }
        .stat { padding:16px; }
        .stat-num { font-size:24px; }
        .continue-card { flex-direction:column; text-align:center; gap:14px; }
        .path { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; } .path-arrow { display:none; }
        .quick-links { grid-template-columns:1fr 1fr; }
        .dash-row { grid-template-columns:1fr; }
    }
    @media (max-width:480px) {
        .welcome h1 { font-size:22px; }
        .stats { grid-template-columns:1fr; gap:10px; }
        .stat { padding:14px; } .stat-num { font-size:22px; }
        .quick-links { grid-template-columns:1fr; }
        .motivation .quote { font-size:15px; }
    }
@endsection

@section('content')
<div class="container">

    <!-- Welcome -->
    @php
        $hour = (int) now()->format('H');
        if ($hour < 12) $greeting = 'Bonjour';
        elseif ($hour < 18) $greeting = 'Bon apres-midi';
        else $greeting = 'Bonsoir';
        $u = auth()->user();
    @endphp
    <div class="welcome">
        <h1>{{ $greeting }}, <span>{{ $u->nom ?? $u->name }}</span></h1>
        <p>Pret a progresser aujourd'hui ?</p>
    </div>

    <!-- Stats -->
    <div class="stats">
        <div class="stat">
            <div class="stat-num">{{ $totalCompleted }}</div>
            <div class="stat-lbl">QCM completes</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $avgBest }}%</div>
            <div class="stat-lbl">Score moyen</div>
        </div>
        <div class="stat">
            <div class="stat-num">{{ $totalAttempts }}</div>
            <div class="stat-lbl">Tentatives</div>
        </div>
    </div>

    <!-- Donut + Objectif -->
    @php
        $techScores = [];
        $techColors = ['C++'=>'#00599C','HTML'=>'#e44d26','CSS'=>'#2965f1','JS'=>'#f0db4f','SQL'=>'#00BCD4','PHP'=>'#8892BF'];
        $techMap = ['qcm-cpp'=>'C++','qcm-html'=>'HTML','qcm-css'=>'CSS','qcm-js'=>'JS','qcm-sql'=>'SQL','qcm-php'=>'PHP'];
        foreach($techMap as $qcm => $name) {
            $techScores[$name] = isset($userScores[$qcm]) ? (int)$userScores[$qcm]->best : 0;
        }
        $completedTechs = count(array_filter($techScores, fn($s) => $s >= 60));
        $donutPct = round(($completedTechs / 6) * 100);
        $donutDash = round(($donutPct / 100) * 339);

        // Objectif du jour
        $weakest = null; $weakScore = 101;
        foreach($techScores as $name => $sc) { if ($sc < $weakScore) { $weakScore = $sc; $weakest = $name; } }
        $weakSlug = array_search($weakest, $techMap) ? str_replace('qcm-', '', array_search($weakest, $techMap)) : 'html';
    @endphp
    <div class="dash-row">
        <div class="dash-card">
            <h3>Progression globale</h3>
            <div class="donut-wrap">
                <div class="donut">
                    <svg width="120" height="120" viewBox="0 0 120 120">
                        <circle cx="60" cy="60" r="54" fill="none" stroke="var(--input)" stroke-width="10"/>
                        <circle cx="60" cy="60" r="54" fill="none" stroke="var(--accent)" stroke-width="10"
                            stroke-dasharray="{{ $donutDash }} 339" stroke-linecap="round">
                            <animate attributeName="stroke-dasharray" from="0 339" to="{{ $donutDash }} 339" dur="1s" fill="freeze"/>
                        </circle>
                    </svg>
                    <div class="donut-label">
                        <div class="donut-pct">{{ $completedTechs }}/6</div>
                        <div class="donut-sub">valides</div>
                    </div>
                </div>
                <div class="donut-legend">
                    @foreach($techScores as $name => $sc)
                        <div><span style="background:{{ $techColors[$name] }}"></span>{{ $name }} — {{ $sc }}%</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="dash-card">
            <h3>Objectif du jour</h3>
            <div class="goal-card">
                <div class="goal-icon"><i data-lucide="target" style="width:24px;height:24px;color:var(--accent);"></i></div>
                <div class="goal-text">
                    @if($weakScore >= 60 && $completedTechs >= 6)
                        <h4>Tous les parcours valides !</h4>
                        <p>Tentez l'examen final pour obtenir votre certificat.</p>
                        <a href="/quiz/exam" class="goal-btn">Passer l'examen</a>
                    @elseif($weakest)
                        <h4>Ameliorez votre score en {{ $weakest }}</h4>
                        <p>Votre score actuel est de {{ $weakScore }}%. Visez au moins 60% pour valider ce parcours.</p>
                        <a href="/quiz/{{ $weakSlug }}" class="goal-btn">Commencer</a>
                    @else
                        <h4>Commencez votre premier parcours</h4>
                        <p>Choisissez une technologie et lancez-vous !</p>
                        <a href="/parcours" class="goal-btn">Voir les parcours</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Heatmap d'activite -->
    @php
        $heatmapData = \App\Models\Score::where('user_id', $u->id)
            ->where('completed_at', '>=', now()->subDays(90))
            ->selectRaw('DATE(completed_at) as day, COUNT(*) as cnt')
            ->groupByRaw('DATE(completed_at)')->pluck('cnt', 'day')->toArray();
        $today = now();
    @endphp
    <div class="dash-card heatmap-card">
        <h3>Activite (90 derniers jours)</h3>
        <div class="heatmap">
            @for($d = 89; $d >= 0; $d--)
                @php
                    $date = $today->copy()->subDays($d)->format('Y-m-d');
                    $cnt = $heatmapData[$date] ?? 0;
                    $lvl = $cnt === 0 ? '' : ($cnt <= 1 ? 'l1' : ($cnt <= 3 ? 'l2' : ($cnt <= 5 ? 'l3' : 'l4')));
                @endphp
                <div class="heatmap-day {{ $lvl }}" title="{{ $date }} : {{ $cnt }} quiz"></div>
            @endfor
        </div>
        <div class="heatmap-legend">
            <span>Moins</span>
            <div class="box" style="background:var(--input);"></div>
            <div class="box" style="background:rgba(137,111,61,0.25);"></div>
            <div class="box" style="background:rgba(137,111,61,0.5);"></div>
            <div class="box" style="background:rgba(137,111,61,0.75);"></div>
            <div class="box" style="background:#896f3d;"></div>
            <span>Plus</span>
        </div>
    </div>

    <!-- Continue where you left off -->
    @php
        $lastProgress = $userProgress->filter(fn($p) => $p->chapter_completed > 0 && $p->chapter_completed < $p->total_chapters)->sortByDesc('updated_at')->first();
        $progressMap = [
            'qcm-cpp' => ['name'=>'C++','color'=>'#00599C','slug'=>'cpp'],
            'qcm-html' => ['name'=>'HTML','color'=>'#e44d26','slug'=>'html'],
            'qcm-css' => ['name'=>'CSS','color'=>'#2965f1','slug'=>'css'],
            'qcm-js' => ['name'=>'JavaScript','color'=>'#f0db4f','slug'=>'js'],
            'qcm-sql' => ['name'=>'SQL','color'=>'#00BCD4','slug'=>'sql'],
            'qcm-php' => ['name'=>'PHP','color'=>'#8892BF','slug'=>'php'],
        ];
    @endphp
    @if($lastProgress && isset($progressMap[$lastProgress->qcm_name]))
        @php $lp = $progressMap[$lastProgress->qcm_name]; @endphp
        <div class="continue-card">
            <div class="continue-icon" style="background:{{ $lp['color'] }}">{{ strtoupper(substr($lp['name'], 0, 3)) }}</div>
            <div class="continue-info">
                <h3>Reprendre {{ $lp['name'] }}</h3>
                <p>Chapitre {{ $lastProgress->chapter_completed + 1 }} / {{ $lastProgress->total_chapters }} &bull; {{ round(($lastProgress->chapter_completed / $lastProgress->total_chapters) * 100) }}% termine</p>
            </div>
            <a href="/quiz/{{ $lp['slug'] }}" class="continue-btn">Continuer</a>
        </div>
    @endif

    <!-- Parcours rapide -->
    <div class="path">
        @foreach($path_steps as $i => $step)
            @php
                $has_score = isset($userScores[$step['qcm']]);
                $best = $has_score ? (float)($userScores[$step['qcm']]->best ?? 0) : 0;
                $passed = $has_score && $best >= 60;
            @endphp
            <div class="path-step">
                <div class="path-circle {{ $passed ? 'done' : '' }}" style="background:{{ $step['color'] }}">
                    @if($passed)<span class="check">&#10003;</span>@elseif($has_score){{ round($best) }}%@else{{ $i+1 }}@endif
                </div>
                <span class="path-label">{{ $step['name'] }}</span>
            </div>
            @if($i < count($path_steps) - 1)
                <div class="path-arrow {{ $passed ? 'done' : '' }}"></div>
            @endif
        @endforeach
    </div>

    <!-- Quick links -->
    <div class="quick-links">
        <a href="/parcours" class="quick-link">
            <div class="icon"><i data-lucide="book-open" style="width:28px;height:28px;color:var(--accent);"></i></div>
            <h3>Parcours</h3>
            <p>6 technologies, 7 chapitres chacune</p>
        </a>
        <a href="/epreuves" class="quick-link">
            <div class="icon"><i data-lucide="file-text" style="width:28px;height:28px;color:var(--accent);"></i></div>
            <h3>Epreuves</h3>
            <p>12 QCM + sujets d'examen reels</p>
        </a>
        <a href="/quiz/exam" class="quick-link">
            <div class="icon"><i data-lucide="award" style="width:28px;height:28px;color:var(--accent);"></i></div>
            <h3>Examen Final</h3>
            <p>60 questions, 30 min, certificat</p>
        </a>
        <a href="/classement" class="quick-link">
            <div class="icon"><i data-lucide="trophy" style="width:28px;height:28px;color:var(--accent);"></i></div>
            <h3>Classement</h3>
            <p>Comparez vos scores</p>
        </a>
    </div>

    <!-- Motivation -->
    @php
    $quotes = [
        ['text'=>'La seule facon de faire du bon travail est d\'aimer ce que vous faites.','author'=>'Steve Jobs'],
        ['text'=>'Le succes n\'est pas final, l\'echec n\'est pas fatal : c\'est le courage de continuer qui compte.','author'=>'Winston Churchill'],
        ['text'=>'Chaque expert a d\'abord ete un debutant.','author'=>'Helen Hayes'],
        ['text'=>'La pratique n\'est pas ce qui rend parfait. C\'est la pratique parfaite qui rend parfait.','author'=>'Vince Lombardi'],
        ['text'=>'Le meilleur moment pour planter un arbre, c\'etait il y a 20 ans. Le deuxieme meilleur moment, c\'est maintenant.','author'=>'Proverbe chinois'],
        ['text'=>'Apprenez les regles comme un professionnel, pour pouvoir les enfreindre comme un artiste.','author'=>'Pablo Picasso'],
        ['text'=>'Un voyage de mille lieues commence toujours par un premier pas.','author'=>'Lao Tseu'],
    ];
    $quote = $quotes[array_rand($quotes)];
    @endphp
    <div class="motivation">
        <div class="quote">"{{ $quote['text'] }}"</div>
        <div class="author">— {{ $quote['author'] }}</div>
    </div>

    @if($canCertificate)
    <div style="text-align:center;margin-bottom:24px;">
        <a href="/certificat" style="color:var(--accent);font-weight:700;font-size:14px;text-decoration:none;">Telecharger mon certificat de reussite &rarr;</a>
    </div>
    @endif

</div>
@endsection
