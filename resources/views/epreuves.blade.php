@extends('layouts.app')
@section('title', 'Epreuves — Dev Learn')

@section('styles')
    .container { max-width:1060px; margin:0 auto; }
    h1 { text-align:center; margin-bottom:6px; color:var(--accent); font-size:26px; }
    .subtitle { text-align:center; color:var(--muted); font-size:14px; margin-bottom:32px; }
    .section-title { font-size:13px; text-transform:uppercase; letter-spacing:2px; color:var(--dim); margin-bottom:16px; padding-bottom:8px; border-bottom:1px solid var(--border); font-weight:600; }
    .section { margin-bottom:40px; }
    .cards { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:16px; }
    .card { background:var(--card); border-radius:14px; padding:22px; text-decoration:none; color:inherit; display:flex; flex-direction:column; border:2px solid transparent; transition:transform .2s, box-shadow .2s; }
    .card:hover { transform:translateY(-3px); box-shadow:0 12px 30px rgba(0,0,0,0.3); }
    .card-mix { border-color:rgba(137,111,61,0.2); } .card-mix:hover { border-color:#896f3d; }
    .card-exam { border-color:rgba(255,152,0,0.2); } .card-exam:hover { border-color:#ff9800; }
    .card-header { display:flex; align-items:center; gap:14px; margin-bottom:12px; }
    .card-logo { width:48px; height:48px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-weight:bold; font-size:15px; flex-shrink:0; }
    .logo-mix { background:linear-gradient(135deg, #896f3d, #0f3460); color:#fff; }
    .logo-exam { background:linear-gradient(135deg, #ff9800, #f44336); color:#fff; }
    .card-title { font-size:16px; font-weight:bold; }
    .card-title small { display:block; font-size:11px; font-weight:normal; color:var(--muted); margin-top:2px; }
    .card-meta { display:flex; gap:6px; flex-wrap:wrap; margin-bottom:12px; }
    .meta-tag { font-size:10px; padding:3px 8px; border-radius:20px; background:var(--input); color:var(--muted); }
    .card-score { display:flex; align-items:center; gap:10px; padding-top:10px; border-top:1px solid var(--border); }
    .score-badge { font-size:13px; font-weight:700; padding:4px 12px; border-radius:20px; display:inline-block; }
    .score-green { background:#4caf50; color:#fff; } .score-blue { background:#2196f3; color:#fff; } .score-orange { background:#ff9800; color:#fff; } .score-red { background:#f44336; color:#fff; }
    .score-none { background:transparent; color:var(--dim); font-weight:400; font-size:12px; padding:4px 0; font-style:italic; }
    .score-attempts { font-size:12px; color:var(--dim); }
    @media (max-width:768px) { .cards { grid-template-columns:1fr; } }
    @media (max-width:480px) { .card { padding:16px; } .card-title { font-size:14px; } h1 { font-size:22px !important; } }
@endsection

@section('content')
    <h1>Epreuves & QCM</h1>
    <p class="subtitle">Testez vos connaissances avec des sujets d'examen reels</p>

    <!-- QCM Classiques -->
    <div class="section">
        <div class="section-title">QCM Classiques</div>
        <div class="cards">
            @php
            $qcms = [
                ['slug'=>'1','name'=>'QCM General — Serie 1','sub'=>'C++, HTML, CSS, JS, PHP, SQL','q'=>36,'lvl'=>'Intermediaire','qcm'=>'qcm1'],
                ['slug'=>'2','name'=>'QCM General — Serie 2','sub'=>'C++, HTML, CSS, JS, PHP, SQL','q'=>36,'lvl'=>'Intermediaire','qcm'=>'qcm2'],
                ['slug'=>'3','name'=>'QCM Avance — Serie 3','sub'=>'C++, HTML, CSS, JS, SQL, PHP','q'=>36,'lvl'=>'Avance','qcm'=>'qcm3'],
                ['slug'=>'11','name'=>'QCM Dev Web — Serie 4','sub'=>'HTML, CSS, JS, PHP, MySQL','q'=>40,'lvl'=>'Debutant','qcm'=>'qcm11'],
                ['slug'=>'12','name'=>'QCM Dev Web — Serie 5','sub'=>'HTML, CSS, JS, PHP, MySQL','q'=>40,'lvl'=>'Intermediaire','qcm'=>'qcm12'],
            ];
            @endphp
            @foreach($qcms as $qcm)
            <a href="/quiz/{{ $qcm['slug'] }}" class="card card-mix">
                <div class="card-header">
                    <div class="card-logo logo-mix">Mix</div>
                    <div class="card-title">{{ $qcm['name'] }}<small>{{ $qcm['sub'] }}</small></div>
                </div>
                <div class="card-meta">
                    <span class="meta-tag">{{ $qcm['q'] }} questions</span>
                    <span class="meta-tag">{{ $qcm['lvl'] }}</span>
                </div>
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => $qcm['qcm']])</div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Sujets d'examen -->
    <div class="section">
        <div class="section-title">Sujets d'examen</div>
        <div class="cards">
            @php
            $exams = [
                ['slug'=>'4','name'=>'Controle Techno Web','sub'=>'HTML, CSS, JS, PHP, MySQL','q'=>20,'lvl'=>'Intermediaire','qcm'=>'qcm4'],
                ['slug'=>'5','name'=>'EPP — Licence Blanc','sub'=>'PHP, HTML, CSS, SQL','q'=>40,'lvl'=>'Intermediaire','qcm'=>'qcm5'],
                ['slug'=>'6','name'=>'Examen National SIL 2025','sub'=>'HTML, CSS, PHP, MySQL','q'=>25,'lvl'=>'Avance','qcm'=>'qcm6'],
                ['slug'=>'7','name'=>'Examen National SIL 2023','sub'=>'HTML, CSS, JS, PHP, MySQL','q'=>40,'lvl'=>'Avance','qcm'=>'qcm7'],
                ['slug'=>'8','name'=>'Epreuve Pratique 2025','sub'=>'HTML, CSS','q'=>40,'lvl'=>'Intermediaire','qcm'=>'qcm8'],
                ['slug'=>'9','name'=>'QCM Pratique SIL','sub'=>'MySQL, HTML, CSS, JS, PHP','q'=>40,'lvl'=>'Intermediaire','qcm'=>'qcm9'],
                ['slug'=>'10','name'=>'QCM Pratique Licence','sub'=>'MySQL, HTML, CSS, JS, PHP','q'=>40,'lvl'=>'Avance','qcm'=>'qcm10'],
            ];
            @endphp
            @foreach($exams as $ex)
            <a href="/quiz/{{ $ex['slug'] }}" class="card card-mix">
                <div class="card-header">
                    <div class="card-logo logo-mix">Mix</div>
                    <div class="card-title">{{ $ex['name'] }}<small>{{ $ex['sub'] }}</small></div>
                </div>
                <div class="card-meta">
                    <span class="meta-tag">{{ $ex['q'] }} questions</span>
                    <span class="meta-tag">{{ $ex['lvl'] }}</span>
                </div>
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => $ex['qcm']])</div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Examen Final -->
    <div class="section">
        <div class="section-title">Examen Final</div>
        <div class="cards">
            <a href="/quiz/exam" class="card card-exam">
                <div class="card-header">
                    <div class="card-logo logo-exam">EXAM</div>
                    <div class="card-title">Examen Final<small>60 questions &bull; 30 min &bull; Chronometre</small></div>
                </div>
                <div class="card-meta">
                    <span class="meta-tag">60 questions</span>
                    <span class="meta-tag">6 technologies</span>
                    <span class="meta-tag">Avance</span>
                </div>
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm-exam'])</div>
            </a>
        </div>
    </div>
@endsection
