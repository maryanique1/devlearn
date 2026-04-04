@extends('layouts.app')
@section('title', 'Mon Profil — Dev Learn')

@section('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
@endsection

@section('styles')
    .user-card { background:var(--card); border-radius:16px; padding:30px; margin-bottom:24px; display:flex; align-items:center; gap:24px; border:1px solid var(--border); flex-wrap:wrap; }
    .avatar { width:70px; height:70px; border-radius:50%; background:var(--accent); display:flex; align-items:center; justify-content:center; font-size:28px; font-weight:bold; color:#fff; flex-shrink:0; }
    .user-info h2 { font-size:22px; margin-bottom:4px; } .user-info p { font-size:13px; color:var(--muted); }
    .stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:16px; margin-bottom:30px; }
    .stat-card { background:var(--card); border-radius:14px; padding:20px; text-align:center; border:1px solid var(--border); }
    .stat-num { font-size:28px; font-weight:800; color:var(--accent); }
    .stat-lbl { font-size:11px; color:var(--dim); margin-top:4px; text-transform:uppercase; letter-spacing:1px; }
    .forms-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:30px; }
    .form-card { background:var(--card); border-radius:14px; padding:24px; border:1px solid var(--border); }
    .form-card h3 { font-size:15px; margin-bottom:14px; color:var(--accent); }
    .form-card input { width:100%; padding:10px 14px; border-radius:8px; border:1px solid var(--border); background:var(--input); color:var(--text); font-size:14px; margin-bottom:10px; }
    .form-card button { padding:8px 20px; border:none; border-radius:8px; background:var(--accent); color:#fff; font-weight:bold; cursor:pointer; font-size:13px; } .form-card button:hover { opacity:0.85; }
    .section-title { font-size:13px; text-transform:uppercase; letter-spacing:2px; color:var(--dim); margin-bottom:16px; padding-bottom:8px; border-bottom:1px solid var(--border); font-weight:600; margin-top:10px; }
    .chart-container { background:var(--card); border-radius:14px; padding:24px; margin-bottom:30px; border:1px solid var(--border); }
    table { width:100%; border-collapse:collapse; background:var(--card); border-radius:12px; overflow:hidden; }
    th { background:var(--accent); color:#fff; padding:12px 14px; text-align:left; font-size:12px; text-transform:uppercase; letter-spacing:1px; }
    td { padding:10px 14px; border-bottom:1px solid var(--border); font-size:13px; }
    tr:last-child td { border-bottom:none; }
    .score-green { color:#4caf50; font-weight:bold; } .score-blue { color:#2196f3; font-weight:bold; } .score-orange { color:#ff9800; font-weight:bold; } .score-red { color:#f44336; font-weight:bold; }
    .msg-ok { background:#27ae60; color:#fff; padding:10px 20px; border-radius:8px; text-align:center; margin-bottom:20px; }
    .msg-err { background:#e74c3c; color:#fff; padding:10px 20px; border-radius:8px; text-align:center; margin-bottom:20px; }

    /* Radar + Badges row */
    .profil-row { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px; }
    .profil-card { background:var(--card); border-radius:14px; padding:24px; border:1px solid var(--border); }
    .profil-card h3 { font-size:14px; font-weight:700; color:var(--accent); margin-bottom:16px; }
    .badges-grid { display:flex; flex-wrap:wrap; gap:12px; }
    .badge-item { display:flex; align-items:center; gap:10px; background:var(--input); border-radius:10px; padding:10px 14px; font-size:13px; transition:transform .2s; }
    .badge-item:hover { transform:translateY(-2px); }
    .badge-item.locked { opacity:0.35; filter:grayscale(1); }
    .badge-icon { font-size:24px; flex-shrink:0; }
    .badge-name { font-weight:700; font-size:12px; }
    .badge-desc { font-size:10px; color:var(--muted); }
    .empty { text-align:center; padding:30px; color:var(--muted); }
    @media(max-width:768px) { .forms-grid{grid-template-columns:1fr;} .user-card{flex-direction:column;text-align:center;} .hide-mobile{display:none;} .stats{grid-template-columns:1fr 1fr;} table{display:block;overflow-x:auto;} .profil-row{grid-template-columns:1fr;} }
    @media(max-width:480px) { .user-card{padding:20px;} .avatar{width:56px;height:56px;font-size:22px;} .stats{grid-template-columns:1fr;} .stat-card{padding:14px;} .stat-num{font-size:22px;} .form-card{padding:18px;} .form-card h3{font-size:14px;} .section-title{font-size:11px;} h1{font-size:22px !important;} th,td{padding:8px 10px;font-size:12px;} }
@endsection

@section('content')
    <h1 style="text-align:center;margin-bottom:8px;color:var(--accent)">Mon Profil</h1>
    <p style="text-align:center;color:var(--muted);margin-bottom:24px;font-size:14px">Statistiques, progression et parametres</p>

    @if(session('success'))<div class="msg-ok">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="msg-err">{{ $errors->first() }}</div>@endif

    <div class="user-card">
        <div class="avatar-wrapper" style="position:relative;display:inline-block;">
            @if($user->avatar)
                <img src="/storage/{{ $user->avatar }}" alt="avatar" style="width:70px;height:70px;border-radius:50%;object-fit:cover;">
            @else
                <div class="avatar">{{ strtoupper(mb_substr($user->nom ?? $user->name, 0, 1)) }}</div>
            @endif
            <div style="position:absolute;bottom:0;right:0;background:var(--accent);border-radius:50%;width:24px;height:24px;display:flex;align-items:center;justify-content:center;">
                <i data-lucide="camera" style="width:14px;height:14px;color:#fff;"></i>
            </div>
            <input type="file" id="avatar-input" name="avatar" accept="image/*" style="position:absolute;inset:0;width:100%;height:100%;opacity:0;cursor:pointer;z-index:5;">
        </div>
        <form id="avatar-form" method="POST" action="/profil/update-avatar" enctype="multipart/form-data" style="display:none;">
            @csrf
            <input type="file" id="avatar-hidden" name="avatar">
        </form>
        <script>
        document.getElementById('avatar-input').addEventListener('change', function() {
            const dt = new DataTransfer();
            dt.items.add(this.files[0]);
            document.getElementById('avatar-hidden').files = dt.files;
            document.getElementById('avatar-form').submit();
        });
        </script>
        <div class="user-info">
            <h2>{{ $user->nom ?? $user->name }}</h2>
            <p>{{ $user->email }}</p>
            <p>Membre depuis le {{ $user->created_at->format('d/m/Y') }}</p>
            @if($user->bio)
                <p style="margin-top:8px;color:var(--text);font-style:italic;">"{{ $user->bio }}"</p>
            @endif
        </div>
    </div>

    <div class="stats">
        <div class="stat-card"><div class="stat-num">{{ $totalAttempts }}</div><div class="stat-lbl">Tentatives</div></div>
        <div class="stat-card"><div class="stat-num">{{ $avgPct }}%</div><div class="stat-lbl">Score moyen</div></div>
        <div class="stat-card"><div class="stat-num">{{ $bestPct }}%</div><div class="stat-lbl">Meilleur score</div></div>
        <div class="stat-card"><div class="stat-num">{{ $totalTime > 3600 ? round($totalTime/3600,1).'h' : round($totalTime/60).'m' }}</div><div class="stat-lbl">Temps total</div></div>
    </div>

    <!-- Radar + Badges -->
    @php
        $radarLabels = ['C++','HTML','CSS','JS','SQL','PHP'];
        $radarMap = ['C++'=>'qcm-cpp','HTML'=>'qcm-html','CSS'=>'qcm-css','JS'=>'qcm-js','SQL'=>'qcm-sql','PHP'=>'qcm-php'];
        $radarData = [];
        foreach($radarLabels as $l) {
            $qn = $radarMap[$l];
            $radarData[] = isset($bestPerQcm[$qn]) ? (int)$bestPerQcm[$qn] : 0;
        }

        // Badges
        $badges = [
            ['icon'=>'&#127942;','name'=>'Premier QCM','desc'=>'Completer votre premier QCM','unlocked'=>$totalAttempts >= 1],
            ['icon'=>'&#11088;','name'=>'Score parfait','desc'=>'Obtenir 100% sur un QCM','unlocked'=>$bestPct >= 100],
            ['icon'=>'&#128170;','name'=>'Perseverant','desc'=>'10 tentatives ou plus','unlocked'=>$totalAttempts >= 10],
            ['icon'=>'&#127891;','name'=>'Diplome','desc'=>'Valider l\'examen final (80%+)','unlocked'=>isset($bestPerQcm['qcm-exam']) && $bestPerQcm['qcm-exam'] >= 80],
            ['icon'=>'&#128640;','name'=>'Polyvalent','desc'=>'Completer 3 technologies','unlocked'=>count(array_filter($radarData, fn($s) => $s >= 60)) >= 3],
            ['icon'=>'&#129351;','name'=>'Maitre du web','desc'=>'Toutes les 6 technologies validees','unlocked'=>count(array_filter($radarData, fn($s) => $s >= 60)) >= 6],
        ];
    @endphp
    <div class="profil-row">
        <div class="profil-card">
            <h3>Competences par technologie</h3>
            <canvas id="radarChart" height="220"></canvas>
        </div>
        <div class="profil-card">
            <h3>Badges</h3>
            <div class="badges-grid">
                @foreach($badges as $b)
                <div class="badge-item {{ $b['unlocked'] ? '' : 'locked' }}">
                    <div class="badge-icon">{!! $b['icon'] !!}</div>
                    <div>
                        <div class="badge-name">{{ $b['name'] }}</div>
                        <div class="badge-desc">{{ $b['desc'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="section-title">Modifier mon profil</div>
    <div class="forms-grid">
        <div class="form-card">
            <h3><i data-lucide="pen-line" style="width:16px;height:16px;display:inline;vertical-align:middle;margin-right:6px;"></i>Changer le nom</h3>
            <form method="POST" action="/profil/update-name">
                @csrf
                <input type="text" name="nom" value="{{ $user->nom ?? $user->name }}" required maxlength="100">
                <button type="submit">Modifier</button>
            </form>
        </div>
        <div class="form-card">
            <h3><i data-lucide="lock" style="width:16px;height:16px;display:inline;vertical-align:middle;margin-right:6px;"></i>Changer le mot de passe</h3>
            <form method="POST" action="/profil/update-password">
                @csrf
                <input type="password" name="old_password" placeholder="Ancien mot de passe" required>
                <input type="password" name="new_password" placeholder="Nouveau mot de passe (min 4)" required>
                <input type="password" name="new_password_confirmation" placeholder="Confirmer" required>
                <button type="submit">Modifier</button>
            </form>
        </div>
        <div class="form-card" style="grid-column: 1 / -1;">
            <h3><i data-lucide="message-square" style="width:16px;height:16px;display:inline;vertical-align:middle;margin-right:6px;"></i>Ma bio</h3>
            <form method="POST" action="/profil/update-bio">
                @csrf
                <textarea name="bio" rows="3" maxlength="500" placeholder="Parlez de vous en quelques mots..." style="width:100%;padding:10px 14px;border-radius:8px;border:1px solid var(--border);background:var(--input);color:var(--text);font-size:14px;margin-bottom:10px;resize:vertical;font-family:inherit;">{{ $user->bio }}</textarea>
                <button type="submit">Modifier</button>
            </form>
        </div>
    </div>

    @if(count($bestPerQcm) > 0)
    <div class="section-title">Meilleurs scores par QCM</div>
    <div class="chart-container">
        <canvas id="chart" height="250"></canvas>
    </div>
    @endif

    <div class="section-title">Historique des scores</div>
    @if(count($allScores) > 0)
    <table>
        <thead><tr><th>QCM</th><th>Score</th><th>%</th><th class="hide-mobile">Duree</th><th>Date</th></tr></thead>
        <tbody>
        @foreach($allScores as $s)
            @php
                $pct = (int)$s->percentage;
                if ($pct >= 80) $cls = 'score-green';
                elseif ($pct >= 60) $cls = 'score-blue';
                elseif ($pct >= 40) $cls = 'score-orange';
                else $cls = 'score-red';
                $dur = $s->duration_seconds ? sprintf('%d:%02d', floor($s->duration_seconds/60), $s->duration_seconds%60) : '-';
            @endphp
            <tr>
                <td>{{ $s->qcm_name }}</td>
                <td>{{ $s->score }}/{{ $s->total }}</td>
                <td><span class="{{ $cls }}">{{ $pct }}%</span></td>
                <td class="hide-mobile">{{ $dur }}</td>
                <td>{{ $s->completed_at ? $s->completed_at->format('d/m/Y H:i') : '-' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <div class="empty">Aucun score enregistre. Commencez un QCM !</div>
    @endif
@endsection

@section('scripts')
<script>
// Radar chart
new Chart(document.getElementById('radarChart'), {
    type: 'radar',
    data: {
        labels: @json($radarLabels),
        datasets: [{
            label: 'Score %',
            data: @json($radarData),
            backgroundColor: 'rgba(137,111,61,0.15)',
            borderColor: '#896f3d',
            borderWidth: 2,
            pointBackgroundColor: '#896f3d',
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        scales: {
            r: {
                beginAtZero: true, max: 100,
                ticks: { stepSize: 25, color: '#888', backdropColor: 'transparent' },
                grid: { color: 'rgba(128,128,128,0.15)' },
                pointLabels: { color: '#888', font: { size: 12, weight: 'bold' } }
            }
        },
        plugins: { legend: { display: false } }
    }
});
</script>
@if(count($bestPerQcm) > 0)
<script>
const labels = @json(array_keys($bestPerQcm));
const data = @json(array_values($bestPerQcm));
const colorMap = @json($qcmColors);
const colors = labels.map(l => colorMap[l] || '#896f3d');

new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: { labels, datasets: [{ label: 'Meilleur %', data, backgroundColor: colors, borderRadius: 6 }] },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true, max: 100, ticks: { color: '#888' }, grid: { color: 'rgba(128,128,128,0.15)' } },
            x: { ticks: { color: '#888' }, grid: { display: false } }
        },
        plugins: { legend: { display: false } }
    }
});
</script>
@endif
@endsection
