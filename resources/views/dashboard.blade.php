@extends('layouts.app')

@section('title', 'Dev Learn — Tableau de bord')

@section('styles')
        /* ── Container ── */
        .container {
            max-width: 1060px;
            margin: 0 auto;
            padding: 0;
        }

        /* ── Stats Hero ── */
        .stats-hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 44px;
        }

        .stat-card {
            background: var(--stat-card-bg);
            border-radius: 14px;
            padding: 24px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s, background 0.3s;
            border: 1px solid var(--border-subtle);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }

        .stat-num {
            font-size: 32px;
            font-weight: 800;
            color: var(--accent);
            line-height: 1;
        }

        .stat-lbl {
            font-size: 12px;
            color: var(--text-dim);
            margin-top: 6px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── Learning Path ── */
        .path-section {
            margin-bottom: 44px;
        }

        .path-section .section-title {
            margin-bottom: 20px;
        }

        .learning-path {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            flex-wrap: wrap;
            padding: 20px 0;
        }

        .path-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            position: relative;
        }

        .path-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            color: #fff;
            border: 3px solid transparent;
            transition: transform 0.2s;
            position: relative;
            z-index: 2;
        }

        .path-circle.completed {
            box-shadow: 0 0 16px rgba(76,175,80,0.4);
        }

        .path-circle .checkmark {
            font-size: 22px;
        }

        .path-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .path-arrow {
            width: 48px;
            height: 3px;
            background: var(--path-line);
            position: relative;
            margin: 0 4px;
            margin-bottom: 22px;
            border-radius: 2px;
        }

        .path-arrow::after {
            content: '';
            position: absolute;
            right: -4px;
            top: -4px;
            border: 5px solid transparent;
            border-left-color: var(--path-line);
        }

        .path-arrow.done {
            background: #4caf50;
        }

        .path-arrow.done::after {
            border-left-color: #4caf50;
        }

        /* ── Section Titles ── */
        .section-title {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-dim);
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border-subtle);
            font-weight: 600;
        }

        .section { margin-bottom: 44px; }

        /* ── QCM Cards Grid ── */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 28px;
            transition: transform 0.2s, box-shadow 0.2s, background 0.3s;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            border: 2px solid transparent;
            position: relative;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow);
        }

        /* Card color borders */
        .card-html { border-color: #e44d2633; }
        .card-html:hover { border-color: #e44d26; }
        .card-css { border-color: #2965f133; }
        .card-css:hover { border-color: #2965f1; }
        .card-js { border-color: #f0db4f33; }
        .card-js:hover { border-color: #f0db4f; }
        .card-php { border-color: #8892BF33; }
        .card-php:hover { border-color: #8892BF; }
        .card-sql { border-color: #00BCD433; }
        .card-sql:hover { border-color: #00BCD4; }
        .card-cpp { border-color: #00599C33; }
        .card-cpp:hover { border-color: #00599C; }
        .card-mix { border-color: #896f3d33; }
        .card-mix:hover { border-color: #896f3d; }
        .card-exam { border-color: #ff980033; }
        .card-exam:hover { border-color: #ff9800; }

        .card-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .card-logo {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            flex-shrink: 0;
        }

        .logo-html { background: #e44d26; color: #fff; }
        .logo-css { background: #2965f1; color: #fff; }
        .logo-js { background: #f0db4f; color: #323330; }
        .logo-php { background: #8892BF; color: #fff; }
        .logo-sql { background: #00BCD4; color: #006064; }
        .logo-cpp { background: #00599C; color: #fff; }
        .logo-mix { background: linear-gradient(135deg, #896f3d, #0f3460); color: #fff; }
        .logo-exam { background: linear-gradient(135deg, #ff9800, #f44336); color: #fff; }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-title small {
            display: block;
            font-size: 12px;
            font-weight: normal;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .card-desc {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.6;
            flex-grow: 1;
            margin-bottom: 16px;
        }

        .card-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .meta-tag {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
            background: var(--meta-bg);
            color: var(--meta-text);
            transition: background 0.3s;
        }

        /* ── Score Badges ── */
        .card-score {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 12px;
            border-top: 1px solid var(--border-subtle);
        }

        .score-badge {
            font-size: 13px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
        }

        .score-green { background: #4caf50; color: #fff; }
        .score-blue { background: #2196f3; color: #fff; }
        .score-orange { background: #ff9800; color: #fff; }
        .score-red { background: #f44336; color: #fff; }
        .score-none {
            background: transparent;
            color: var(--text-dim);
            font-weight: 400;
            font-size: 12px;
            padding: 4px 0;
            font-style: italic;
        }

        .score-attempts {
            font-size: 12px;
            color: var(--text-dim);
        }

        /* ── Card Progress Bar ── */
        .card-progress {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .card-progress-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 6px;
            display: flex;
            justify-content: space-between;
        }

        .card-progress-bar {
            background: var(--meta-bg);
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
        }

        .card-progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.4s ease;
        }

        .btn-continue {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-continue:hover { opacity: 0.85; }

        /* ── Menu Button ── */
        .btn-menu {
            background: none;
            border: 2px solid var(--border-subtle);
            border-radius: 10px;
            width: 38px;
            height: 38px;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.2s, background 0.2s;
            color: var(--text);
        }

        .btn-menu:hover {
            border-color: var(--accent);
            background: rgba(233,69,96,0.08);
        }

        /* ── Sidebar ── */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 200;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .sidebar-overlay.open {
            opacity: 1;
            visibility: visible;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            height: 100%;
            background: var(--card-bg);
            z-index: 201;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
            transition: left 0.3s ease;
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-header h3 {
            font-size: 16px;
            color: var(--accent);
        }

        .sidebar-close {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .sidebar-close:hover { color: var(--text); }

        .sidebar-user {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-subtle);
        }

        .sidebar-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 10px;
        }

        .sidebar-user .name {
            font-weight: 700;
            font-size: 16px;
        }

        .sidebar-user .email {
            font-size: 12px;
            color: var(--text-muted);
        }

        .sidebar-nav {
            flex: 1;
            padding: 12px 0;
            overflow-y: auto;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 24px;
            text-decoration: none;
            color: var(--text);
            font-size: 14px;
            transition: background 0.2s;
        }

        .sidebar-nav a:hover {
            background: rgba(233,69,96,0.08);
        }

        .sidebar-nav a .icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .sidebar-nav .separator {
            height: 1px;
            background: var(--border-subtle);
            margin: 8px 24px;
        }

        .sidebar-nav a.danger { color: var(--accent); }

        /* ── Footer ── */
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-subtle);
            color: var(--text-dim);
            font-size: 13px;
        }

        .footer a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover { text-decoration: underline; }

        @media (max-width: 768px) {
            .stats-hero { grid-template-columns: 1fr 1fr; gap: 12px; }
            .cards { grid-template-columns: 1fr; }
            .learning-path { display:grid; grid-template-columns:repeat(3,1fr); gap:12px; padding:16px 0; }
            .path-arrow { display: none; }
            .path-step { flex-direction:column; align-items:center; gap:6px; }
            .path-circle { width:44px; height:44px; font-size:12px; }
            .path-label { font-size:11px; }
            .card { padding: 20px; }
            .card-header { gap: 12px; }
            .card-logo { width: 44px; height: 44px; font-size: 14px; }
        }
        @media (max-width: 480px) {
            .stats-hero { grid-template-columns: 1fr; gap: 10px; margin-bottom: 24px; }
            .stat-card { padding: 16px; }
            .stat-num { font-size: 24px; }
            .stat-lbl { font-size: 10px; }
            .section-title { font-size: 11px; letter-spacing: 1px; }
            .card { padding: 16px; }
            .card-title { font-size: 16px; }
            .card-desc { font-size: 13px; }
            .meta-tag { font-size: 10px; padding: 3px 8px; }
            .footer { font-size: 12px; }
        }

@endsection

@section('content')
<div class="container">

    <!-- ── Stats Hero ── -->
    <div class="stats-hero">
        <div class="stat-card">
            <div class="stat-num">{{ $totalCompleted }}</div>
            <div class="stat-lbl">QCM completes</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $avgBest }}%</div>
            <div class="stat-lbl">Meilleur score moyen</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $totalAttempts }}</div>
            <div class="stat-lbl">Tentatives totales</div>
        </div>
    </div>

    <!-- ── Learning Path ── -->
    <div class="path-section">
        <div class="section-title">Parcours recommande</div>
        <div class="learning-path">
            @foreach($path_steps as $i => $step)
                @php
                    $has_score = isset($userScores[$step['qcm']]);
                    $best = $has_score ? (float)($userScores[$step['qcm']]->best ?? 0) : 0;
                    $passed = $has_score && $best >= 60;
                @endphp
                <div class="path-step">
                    <div class="path-circle {{ $passed ? 'completed' : '' }}" style="background:{{ $step['color'] }}; {{ $passed ? 'border-color:#4caf50' : '' }}">
                        @if($passed)
                            <span class="checkmark">&#10003;</span>
                        @elseif($has_score)
                            {{ round($best) }}%
                        @else
                            {{ $i + 1 }}
                        @endif
                    </div>
                    <span class="path-label">{{ $step['name'] }}</span>
                </div>
                @if($i < count($path_steps) - 1)
                    @php $next_passed = $has_score && $best >= 60; @endphp
                    <div class="path-arrow {{ $next_passed ? 'done' : '' }}"></div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- ── Parcours progressifs ── -->
    <div class="section">
        <div class="section-title">Parcours progressifs — Apprendre pas a pas</div>
        <div class="cards">

            <a href="/quiz/cpp" class="card card-cpp">
                <div class="card-header">
                    <div class="card-logo logo-cpp">C++</div>
                    <div class="card-title">
                        Apprendre C++
                        <small>Parcours progressif</small>
                    </div>
                </div>
                <div class="card-desc">
                    Syntaxe, pointeurs, POO... Decouvrez le C++ depuis zero, un langage puissant et performant.
                </div>
                <div class="card-meta">
                    <span class="meta-tag">50 questions</span>
                    <span class="meta-tag">7 chapitres</span>
                    <span class="meta-tag">Debutant a Intermediaire</span>
                </div>
                @include('partials.progress-bar', ['userProgress' => $userProgress, 'qcmName' => 'qcm-cpp', 'color' => '#00599C', 'slug' => 'cpp'])
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm-cpp'])</div>
            </a>

            <a href="/quiz/html" class="card card-html">
                <div class="card-header">
                    <div class="card-logo logo-html">HTML</div>
                    <div class="card-title">
                        Apprendre HTML
                        <small>Parcours progressif</small>
                    </div>
                </div>
                <div class="card-desc">
                    La base de toute page web : structure, balises, formulaires, semantique et multimedia.
                </div>
                <div class="card-meta">
                    <span class="meta-tag">50 questions</span>
                    <span class="meta-tag">7 chapitres</span>
                    <span class="meta-tag">Debutant</span>
                </div>
                @include('partials.progress-bar', ['userProgress' => $userProgress, 'qcmName' => 'qcm-html', 'color' => '#e44d26', 'slug' => 'html'])
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm-html'])</div>
            </a>

            <a href="/quiz/css" class="card card-css">
                <div class="card-header">
                    <div class="card-logo logo-css">CSS</div>
                    <div class="card-title">
                        Apprendre CSS
                        <small>Parcours progressif</small>
                    </div>
                </div>
                <div class="card-desc">
                    Flexbox, Grid, positionnement, responsive... Maitrisez la mise en page web moderne.
                </div>
                <div class="card-meta">
                    <span class="meta-tag">50 questions</span>
                    <span class="meta-tag">7 chapitres</span>
                    <span class="meta-tag">Debutant a Intermediaire</span>
                </div>
                @include('partials.progress-bar', ['userProgress' => $userProgress, 'qcmName' => 'qcm-css', 'color' => '#2965f1', 'slug' => 'css'])
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm-css'])</div>
            </a>

            <a href="/quiz/js" class="card card-js">
                <div class="card-header">
                    <div class="card-logo logo-js">JS</div>
                    <div class="card-title">
                        Apprendre JavaScript
                        <small>Parcours progressif</small>
                    </div>
                </div>
                <div class="card-desc">
                    Des variables au DOM, decouvrez JavaScript depuis zero. Chaque chapitre commence par une mini-lecon.
                </div>
                <div class="card-meta">
                    <span class="meta-tag">50 questions</span>
                    <span class="meta-tag">7 chapitres</span>
                    <span class="meta-tag">Debutant a Intermediaire</span>
                </div>
                @include('partials.progress-bar', ['userProgress' => $userProgress, 'qcmName' => 'qcm-js', 'color' => '#f0db4f', 'slug' => 'js'])
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm-js'])</div>
            </a>

            <a href="/quiz/sql" class="card card-sql">
                <div class="card-header">
                    <div class="card-logo logo-sql">SQL</div>
                    <div class="card-title">
                        Apprendre SQL
                        <small>Parcours progressif</small>
                    </div>
                </div>
                <div class="card-desc">
                    SELECT, JOIN, INSERT... Apprenez les requetes pas a pas, du simple SELECT au CREATE TABLE.
                </div>
                <div class="card-meta">
                    <span class="meta-tag">50 questions</span>
                    <span class="meta-tag">7 chapitres</span>
                    <span class="meta-tag">Debutant a Intermediaire</span>
                </div>
                @include('partials.progress-bar', ['userProgress' => $userProgress, 'qcmName' => 'qcm-sql', 'color' => '#00BCD4', 'slug' => 'sql'])
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm-sql'])</div>
            </a>

            <a href="/quiz/php" class="card card-php">
                <div class="card-header">
                    <div class="card-logo logo-php">PHP</div>
                    <div class="card-title">
                        Apprendre PHP
                        <small>Parcours progressif</small>
                    </div>
                </div>
                <div class="card-desc">
                    De la syntaxe de base a MySQL avec PDO. Ideal pour comprendre le backend de votre application CRUD.
                </div>
                <div class="card-meta">
                    <span class="meta-tag">50 questions</span>
                    <span class="meta-tag">7 chapitres</span>
                    <span class="meta-tag">Intermediaire</span>
                </div>
                @include('partials.progress-bar', ['userProgress' => $userProgress, 'qcmName' => 'qcm-php', 'color' => '#8892BF', 'slug' => 'php'])
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm-php'])</div>
            </a>

        </div>
    </div>

    <!-- ── QCM classiques ── -->
    <div class="section">
        <div class="section-title">QCM classiques — Tester ses connaissances</div>
        <div class="cards">

            <a href="/quiz/1" class="card card-mix">
                <div class="card-header">
                    <div class="card-logo logo-mix">Mix</div>
                    <div class="card-title">
                        QCM General — Serie 1
                        <small>C++, HTML, CSS, JS, PHP, SQL</small>
                    </div>
                </div>
                <div class="card-desc">
                    36 questions melangeant les 6 technologies. Testez vos connaissances globales en developpement.
                </div>
                <div class="card-meta">
                    <span class="meta-tag">36 questions</span>
                    <span class="meta-tag">6 categories</span>
                    <span class="meta-tag">Intermediaire</span>
                </div>
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm1'])</div>
            </a>

            <a href="/quiz/2" class="card card-mix">
                <div class="card-header">
                    <div class="card-logo logo-mix">Mix</div>
                    <div class="card-title">
                        QCM General — Serie 2
                        <small>C++, HTML, CSS, JS, PHP, SQL</small>
                    </div>
                </div>
                <div class="card-desc">
                    Une deuxieme serie de 36 questions pour approfondir et varier les exercices.
                </div>
                <div class="card-meta">
                    <span class="meta-tag">36 questions</span>
                    <span class="meta-tag">6 categories</span>
                    <span class="meta-tag">Intermediaire</span>
                </div>
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm2'])</div>
            </a>

            <a href="/quiz/3" class="card card-mix">
                <div class="card-header">
                    <div class="card-logo logo-mix">Mix</div>
                    <div class="card-title">
                        QCM Avance — Serie 3
                        <small>C++, HTML, CSS, JS, SQL, PHP</small>
                    </div>
                </div>
                <div class="card-desc">
                    36 questions de niveau intermediaire a avance. Closures, RAII, Shadow DOM, stacking context...
                </div>
                <div class="card-meta">
                    <span class="meta-tag">36 questions</span>
                    <span class="meta-tag">6 categories</span>
                    <span class="meta-tag">Avance</span>
                </div>
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm3'])</div>
            </a>

        </div>
    </div>

    <!-- ── Examen ── -->
    <div class="section">
        <div class="section-title">Examen</div>
        <div class="cards">

            <a href="/quiz/exam" class="card card-exam">
                <div class="card-header">
                    <div class="card-logo logo-exam">EXAM</div>
                    <div class="card-title">
                        Examen Final
                        <small>Toutes technologies</small>
                    </div>
                </div>
                <div class="card-desc">
                    60 questions, toutes technologies, chronometre. Prouvez que vous maitrisez le developpement.
                </div>
                <div class="card-meta">
                    <span class="meta-tag">60 questions</span>
                    <span class="meta-tag">6 technologies</span>
                    <span class="meta-tag">Avance</span>
                    <span class="meta-tag">Chronometre</span>
                </div>
                <div class="card-score">@include('partials.score-badge', ['userScores' => $userScores, 'userProgress' => $userProgress, 'qcmName' => 'qcm-exam'])</div>
            </a>

        </div>
    </div>

    <!-- ── Footer ── -->
    <div class="footer">
        <p>Dev Learn &mdash; Plateforme d'apprentissage</p>
        @if($canCertificate)
            <p style="margin-top:6px"><a href="/certificat">Telecharger mon certificat de reussite</a></p>
        @endif
        <p style="margin-top:6px">
            <a href="/profil">Mon profil</a> &bull;
            <a href="/classement">Classement</a>
        </p>
    </div>

</div>
@endsection
