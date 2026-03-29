@extends('layouts.app')
@section('title', 'Administration — Dev Learn')

@section('styles')
    h1 { text-align:center; margin-bottom:8px; color:#ff9800; }
    .subtitle { text-align:center; color:var(--muted); margin-bottom:24px; font-size:14px; }
    .message { background:#27ae60; color:#fff; padding:10px 20px; border-radius:8px; text-align:center; margin-bottom:20px; }
    .msg-err { background:#e74c3c; color:#fff; padding:10px 20px; border-radius:8px; text-align:center; margin-bottom:20px; }
    .stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:16px; margin-bottom:30px; }
    .stat-card { background:var(--card); border-radius:14px; padding:24px; text-align:center; border:1px solid var(--border); }
    .stat-num { font-size:32px; font-weight:800; color:var(--accent); }
    .stat-lbl { font-size:12px; color:var(--dim); margin-top:6px; text-transform:uppercase; letter-spacing:1px; }
    .section-title { font-size:13px; text-transform:uppercase; letter-spacing:2px; color:var(--dim); margin-bottom:16px; padding-bottom:8px; border-bottom:1px solid var(--border); font-weight:600; margin-top:30px; }
    table { width:100%; border-collapse:collapse; background:var(--card); border-radius:12px; overflow:hidden; margin-bottom:30px; }
    th { background:var(--accent); color:#fff; padding:12px 14px; text-align:left; font-size:12px; text-transform:uppercase; letter-spacing:1px; }
    td { padding:10px 14px; border-bottom:1px solid var(--border); font-size:13px; }
    tr:last-child td { border-bottom:none; }
    .btn-sm { padding:5px 12px; border:none; border-radius:6px; font-size:12px; cursor:pointer; font-weight:bold; }
    .btn-delete { background:#e74c3c; color:#fff; } .btn-delete:hover { background:#c0392b; }
    .btn-admin { background:#2196f3; color:#fff; } .btn-admin:hover { background:#1976d2; }
    .badge-admin { background:#ff9800; color:#fff; padding:2px 8px; border-radius:10px; font-size:11px; font-weight:bold; }
    .badge-user { background:var(--dim); color:#fff; padding:2px 8px; border-radius:10px; font-size:11px; }
    @media(max-width:768px) { td,th{padding:8px 10px;font-size:12px;} .hide-mobile{display:none;} table{display:block;overflow-x:auto;} .stats{grid-template-columns:1fr 1fr;} h1{font-size:22px !important;} }
    @media(max-width:480px) { .stats{grid-template-columns:1fr;} .stat-card{padding:16px;} .stat-num{font-size:24px;} td,th{padding:6px 8px;font-size:11px;} .btn-sm{padding:4px 8px;font-size:11px;} h1{font-size:20px !important;} .subtitle{font-size:12px;} }
@endsection

@section('content')
    <h1>Panel Administration</h1>
    <p class="subtitle">Gestion des utilisateurs et statistiques</p>

    @if(session('success'))<div class="message">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="msg-err">{{ $errors->first() }}</div>@endif

    <div class="stats">
        <div class="stat-card"><div class="stat-num">{{ $totalUsers }}</div><div class="stat-lbl">Utilisateurs</div></div>
        <div class="stat-card"><div class="stat-num">{{ $totalAttempts }}</div><div class="stat-lbl">Tentatives totales</div></div>
        <div class="stat-card"><div class="stat-num">{{ $avgScore }}%</div><div class="stat-lbl">Score moyen global</div></div>
        <div class="stat-card"><div class="stat-num" style="font-size:18px">{{ $popularName }}</div><div class="stat-lbl">QCM le plus joue</div></div>
    </div>

    <div class="section-title">Utilisateurs</div>
    <table>
        <thead><tr><th>Nom</th><th>Email</th><th>Role</th><th class="hide-mobile">Tentatives</th><th class="hide-mobile">Score moy.</th><th>Actions</th></tr></thead>
        <tbody>
        @foreach($allUsers as $u)
            @php $is_self = (int)$u->id === auth()->id(); @endphp
            <tr>
                <td>{{ $u->nom }}</td>
                <td>{{ $u->email }}</td>
                <td>{!! (int)$u->is_admin ? '<span class="badge-admin">Admin</span>' : '<span class="badge-user">User</span>' !!}</td>
                <td class="hide-mobile">{{ (int)$u->attempts }}</td>
                <td class="hide-mobile">{{ $u->avg_score ? (int)$u->avg_score . '%' : '-' }}</td>
                <td>
                    <form method="POST" action="/admin/users/{{ $u->id }}/toggle-admin" style="display:inline">
                        @csrf
                        <button type="submit" class="btn-sm btn-admin">{{ (int)$u->is_admin ? 'Retirer admin' : 'Rendre admin' }}</button>
                    </form>
                    @if(!$is_self)
                    <form method="POST" action="/admin/users/{{ $u->id }}" style="display:inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-delete">Supprimer</button>
                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="section-title">Statistiques par QCM</div>
    <table>
        <thead><tr><th>QCM</th><th>Tentatives</th><th>Score moyen</th><th>Meilleur score</th></tr></thead>
        <tbody>
        @foreach($qcmStats as $qs)
            <tr>
                <td>{{ $qs->qcm_name }}</td>
                <td>{{ (int)$qs->attempts }}</td>
                <td>{{ (int)$qs->avg_pct }}%</td>
                <td>{{ (int)$qs->best }}%</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
