@extends('layouts.app')
@section('title', 'Parcours — Dev Learn')

@section('styles')
    .container { max-width:1060px; margin:0 auto; }
    h1 { text-align:center; margin-bottom:6px; color:var(--accent); font-size:26px; }
    .subtitle { text-align:center; color:var(--muted); font-size:14px; margin-bottom:32px; }
    .cards { display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:20px; }
    .card { background:var(--card); border-radius:16px; padding:28px; text-decoration:none; color:inherit; display:flex; flex-direction:column; border:2px solid transparent; transition:transform .2s, box-shadow .2s; }
    .card:hover { transform:translateY(-4px); box-shadow:0 12px 30px rgba(0,0,0,0.3); }
    .card-html { border-color:#e44d2633; } .card-html:hover { border-color:#e44d26; }
    .card-css { border-color:#2965f133; } .card-css:hover { border-color:#2965f1; }
    .card-js { border-color:#f0db4f33; } .card-js:hover { border-color:#f0db4f; }
    .card-php { border-color:#8892BF33; } .card-php:hover { border-color:#8892BF; }
    .card-sql { border-color:#00BCD433; } .card-sql:hover { border-color:#00BCD4; }
    .card-cpp { border-color:#00599C33; } .card-cpp:hover { border-color:#00599C; }
    .card-header { display:flex; align-items:center; gap:16px; margin-bottom:14px; }
    .card-logo { width:56px; height:56px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-weight:bold; font-size:18px; flex-shrink:0; }
    .logo-html { background:#e44d26; color:#fff; } .logo-css { background:#2965f1; color:#fff; } .logo-js { background:#f0db4f; color:#323330; } .logo-php { background:#8892BF; color:#fff; } .logo-sql { background:#00BCD4; color:#006064; } .logo-cpp { background:#00599C; color:#fff; }
    .card-title { font-size:18px; font-weight:bold; }
    .card-title small { display:block; font-size:12px; font-weight:normal; color:var(--muted); margin-top:2px; }
    .card-desc { color:var(--muted); font-size:14px; line-height:1.6; flex-grow:1; margin-bottom:14px; }
    .card-meta { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:14px; }
    .meta-tag { font-size:11px; padding:4px 10px; border-radius:20px; background:var(--input); color:var(--muted); }
    .card-score { display:flex; align-items:center; gap:10px; padding-top:12px; border-top:1px solid var(--border); }
    .card-progress { margin-top:10px; margin-bottom:10px; }
    .card-progress-label { font-size:12px; color:var(--muted); margin-bottom:6px; display:flex; justify-content:space-between; }
    .card-progress-bar { background:var(--input); border-radius:10px; height:8px; overflow:hidden; }
    .card-progress-fill { height:100%; border-radius:10px; transition:width .4s ease; }
    .btn-continue { display:inline-block; margin-top:10px; padding:8px 20px; border-radius:8px; font-size:13px; font-weight:700; color:#fff; text-decoration:none; text-align:center; }
    .score-badge { font-size:13px; font-weight:700; padding:4px 12px; border-radius:20px; display:inline-block; }
    .score-green { background:#4caf50; color:#fff; } .score-blue { background:#2196f3; color:#fff; } .score-orange { background:#ff9800; color:#fff; } .score-red { background:#f44336; color:#fff; }
    .score-none { background:transparent; color:var(--dim); font-weight:400; font-size:12px; padding:4px 0; font-style:italic; }
    .score-attempts { font-size:12px; color:var(--dim); }
    @media (max-width:768px) { .cards { grid-template-columns:1fr; } .card { padding:20px; } }
    @media (max-width:480px) { .card-title { font-size:16px; } h1 { font-size:22px !important; } }
@endsection

@section('content')
    <h1>Parcours progressifs</h1>
    <p class="subtitle">Apprenez pas a pas avec des mini-lecons et des QCM par chapitre</p>

    <div class="cards">
        @php
        $courses = [
            ['slug'=>'cpp','cls'=>'cpp','logo'=>'C++','name'=>'Apprendre C++','desc'=>'Syntaxe, pointeurs, POO... Decouvrez le C++ depuis zero.','qcm'=>'qcm-cpp','color'=>'#00599C'],
            ['slug'=>'html','cls'=>'html','logo'=>'HTML','name'=>'Apprendre HTML','desc'=>'Structure, balises, formulaires, semantique et multimedia.','qcm'=>'qcm-html','color'=>'#e44d26'],
            ['slug'=>'css','cls'=>'css','logo'=>'CSS','name'=>'Apprendre CSS','desc'=>'Flexbox, Grid, positionnement, responsive design.','qcm'=>'qcm-css','color'=>'#2965f1'],
            ['slug'=>'js','cls'=>'js','logo'=>'JS','name'=>'Apprendre JavaScript','desc'=>'Des variables au DOM, chaque chapitre commence par une mini-lecon.','qcm'=>'qcm-js','color'=>'#f0db4f'],
            ['slug'=>'sql','cls'=>'sql','logo'=>'SQL','name'=>'Apprendre SQL','desc'=>'SELECT, JOIN, INSERT... Du simple SELECT au CREATE TABLE.','qcm'=>'qcm-sql','color'=>'#00BCD4'],
            ['slug'=>'php','cls'=>'php','logo'=>'PHP','name'=>'Apprendre PHP','desc'=>'De la syntaxe de base a MySQL avec PDO.','qcm'=>'qcm-php','color'=>'#8892BF'],
        ];
        @endphp
        @foreach($courses as $c)
        <a href="/quiz/{{ $c['slug'] }}" class="card card-{{ $c['cls'] }}">
            <div class="card-header">
                <div class="card-logo logo-{{ $c['cls'] }}">{{ $c['logo'] }}</div>
                <div class="card-title">{{ $c['name'] }}<small>Parcours progressif</small></div>
            </div>
            <div class="card-desc">{{ $c['desc'] }}</div>
            <div class="card-meta">
                <span class="meta-tag">50 questions</span>
                <span class="meta-tag">7 chapitres</span>
            </div>
            @include('partials.progress-bar', ['userProgress' => $userProgress, 'qcmName' => $c['qcm'], 'color' => $c['color'], 'slug' => $c['slug']])
            <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => $c['qcm']])</div>
        </a>
        @endforeach
    </div>
@endsection
