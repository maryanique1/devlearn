@extends('layouts.app')
@section('title', 'Classement — Dev Learn')

@section('styles')
    .container { max-width:900px; margin:0 auto; }
    h1 { text-align:center; margin-bottom:8px; color:var(--accent); }
    .subtitle { text-align:center; color:var(--muted); margin-bottom:24px; font-size:14px; }
    .tabs { display:flex; flex-wrap:wrap; gap:8px; justify-content:center; margin-bottom:24px; }
    .tab { padding:6px 14px; border-radius:20px; font-size:12px; font-weight:bold; text-decoration:none; color:#fff; opacity:0.6; transition:all 0.2s; }
    .tab:hover, .tab.active { opacity:1; transform:scale(1.05); }
    .rank-banner { background:var(--card); border:2px solid var(--accent); border-radius:12px; padding:18px; text-align:center; margin-bottom:24px; font-size:18px; }
    .rank-banner strong { color:var(--accent); font-size:24px; }
    table { width:100%; border-collapse:collapse; background:var(--card); border-radius:12px; overflow:hidden; }
    th { background:var(--accent); color:#fff; padding:12px 16px; text-align:left; font-size:13px; text-transform:uppercase; letter-spacing:1px; }
    td { padding:12px 16px; border-bottom:1px solid var(--border); font-size:14px; }
    tr:last-child td { border-bottom:none; }
    tr.me { background:rgba(233,69,96,0.1); } tr.me td { font-weight:bold; }
    tr.gold td:first-child { border-left:4px solid #FFD700; }
    tr.silver td:first-child { border-left:4px solid #C0C0C0; }
    tr.bronze td:first-child { border-left:4px solid #CD7F32; }
    .score-val { font-weight:bold; }
    .score-green { color:#4caf50; } .score-blue { color:#2196f3; } .score-orange { color:#ff9800; } .score-red { color:#f44336; }
    .empty { text-align:center; padding:40px; color:var(--muted); }
    @media(max-width:768px) { .tab{font-size:11px;padding:5px 10px;} td,th{padding:8px 10px;font-size:13px;} .hide-mobile{display:none;} table{display:block;overflow-x:auto;} .rank-banner{font-size:15px;padding:14px;} h1{font-size:24px !important;} }
    @media(max-width:480px) { .tabs{gap:4px;} .tab{font-size:10px;padding:4px 8px;} td,th{padding:6px 8px;font-size:12px;} .rank-banner{font-size:14px;} .rank-banner strong{font-size:20px;} h1{font-size:20px !important;} .subtitle{font-size:12px;} }
@endsection

@section('content')
    <h1>Classement</h1>
    <p class="subtitle">{{ $qcmFilter === 'global' ? 'Moyenne des meilleurs scores par QCM' : 'Meilleur score sur ' . $qcmFilter }}</p>

    <div class="tabs">
        @foreach($tabs as $t)
            <a href="?qcm={{ $t['key'] }}" class="tab {{ $qcmFilter === $t['key'] ? 'active' : '' }}" style="background:{{ $t['color'] }}">{{ $t['label'] }}</a>
        @endforeach
    </div>

    @if($myRank > 0)
        <div class="rank-banner">Votre rang : <strong>#{{ $myRank }}</strong> / {{ $totalUsers }} participants</div>
    @elseif(count($rankings) > 0)
        <div class="rank-banner" style="border-color:var(--muted)">Vous n'avez pas encore de score pour ce QCM</div>
    @endif

    @if(count($rankings) > 0)
    <table>
        <thead><tr><th>Rang</th><th>Nom</th><th>Score</th><th class="hide-mobile">Tentatives</th></tr></thead>
        <tbody>
        @foreach($rankings as $i => $r)
            @php
                $rank = $i + 1;
                $is_me = (int)$r->id === auth()->id();
                $pct = (int)$r->avg_score;
                if ($pct >= 80) $cls = 'score-green';
                elseif ($pct >= 60) $cls = 'score-blue';
                elseif ($pct >= 40) $cls = 'score-orange';
                else $cls = 'score-red';
                $row_cls = $is_me ? 'me' : '';
                if ($rank === 1) $row_cls .= ' gold';
                elseif ($rank === 2) $row_cls .= ' silver';
                elseif ($rank === 3) $row_cls .= ' bronze';
            @endphp
            <tr class="{{ trim($row_cls) }}">
                <td>#{{ $rank }}</td>
                <td>{{ $r->nom }}{{ $is_me ? ' (vous)' : '' }}</td>
                <td><span class="score-val {{ $cls }}">{{ $pct }}%</span></td>
                <td class="hide-mobile">{{ (int)$r->total_attempts }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <div class="empty">Aucun score enregistre pour ce QCM.</div>
    @endif
@endsection
