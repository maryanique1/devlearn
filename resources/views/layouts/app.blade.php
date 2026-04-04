@php
    $authUser = auth()->user();
    $theme = $authUser->theme ?? 'dark';
    $userName = $authUser->nom ?? $authUser->name ?? '';
    $canCert = \App\Models\Score::where('user_id', $authUser->id ?? 0)->where('qcm_name','qcm-exam')->max('percentage') >= 80;
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dev Learn')</title>
    <link rel="icon" type="image/png" href="/images/favicon.png">
    <style>
        :root {
            --bg:#1a293f; --card:#202f45; --text:#eaeff3; --muted:#8a95a5; --dim:#606b7a;
            --border:rgba(64,71,81,0.4); --accent:#896f3d; --input:#202f45; --code:#152238;
            --topbar-bg:#1a293f; --topbar-shadow:none;
            /* Dashboard aliases */
            --card-bg:#202f45; --stat-card-bg:#202f45; --card-shadow:0 12px 30px rgba(0,0,0,0.3);
            --meta-bg:#152238; --meta-text:#8a95a5; --path-line:#404751; --text-dim:#606b7a;
            /* QCM aliases */
            --bg-main:#1a293f; --bg-card:#202f45; --bg-input:#202f45; --bg-code:#152238;
            --text-main:#eaeff3; --text-muted:#8a95a5; --border-subtle:rgba(64,71,81,0.4);
        }
        * { box-sizing:border-box; margin:0; padding:0; }
        html, body { overflow-x:hidden; width:100%; }
        body { font-family:'Segoe UI',Arial,sans-serif; background:var(--bg); color:var(--text); min-height:100vh; transition:background .3s,color .3s; }
        .main-content { overflow-x:hidden; word-wrap:break-word; overflow-wrap:break-word; }

        /* ── Topbar ── */
        .topbar {
            display:flex; align-items:center; justify-content:space-between;
            padding:14px 28px; background:var(--topbar-bg); box-shadow:var(--topbar-shadow); border-bottom:1px solid var(--border);
            position:sticky; top:0; z-index:100; margin-left:280px; transition:margin-left .3s;
        }
        .topbar-title { font-size:20px; font-weight:700; letter-spacing:-0.5px; }
        .topbar-title span { color:var(--accent); }
        .topbar-right { display:flex; align-items:center; gap:18px; }
        .topbar-user { font-size:14px; color:var(--muted); }
        .topbar-user strong { color:var(--text); font-weight:600; }
        .btn-menu {
            background:none; border:2px solid var(--border); border-radius:10px;
            width:38px; height:38px; cursor:pointer; font-size:20px;
            display:flex; align-items:center; justify-content:center; color:var(--text); transition:border-color .2s;
        }
        .btn-menu:hover { border-color:var(--accent); background:rgba(233,69,96,0.08); }

        /* ── Sidebar ── */
        .sidebar-overlay { position:fixed; inset:0; background:rgba(0,0,0,0.6); z-index:200; opacity:0; visibility:hidden; transition:opacity .3s, visibility .3s; }
        .sidebar-overlay.open { opacity:1; visibility:visible; }
        .sidebar {
            position:fixed; top:0; left:0; width:280px; height:100%;
            background:var(--card); z-index:201; display:flex; flex-direction:column;
            box-shadow:4px 0 20px rgba(0,0,0,0.3); transition:transform .3s ease;
        }
        .sidebar-header { padding:20px 24px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; }
        .sidebar-header h3 { font-size:16px; color:var(--accent); }
        .sidebar-close { background:none; border:none; color:var(--muted); font-size:24px; cursor:pointer; padding:0; line-height:1; display:none; }
        .sidebar-close:hover { color:var(--text); }
        .sidebar-user { padding:20px 24px; border-bottom:1px solid var(--border); }
        .sidebar-avatar {
            width:50px; height:50px; border-radius:50%; background:var(--accent);
            display:flex; align-items:center; justify-content:center; font-size:20px; font-weight:bold; color:#fff; margin-bottom:10px;
        }
        .sidebar-user .name { font-weight:700; font-size:16px; }
        .sidebar-nav { flex:1; padding:12px 0; overflow-y:auto; }
        .sidebar-nav a { display:flex; align-items:center; gap:14px; padding:12px 24px; text-decoration:none; color:var(--text); font-size:14px; transition:background .2s; }
        .sidebar-nav a:hover { background:rgba(233,69,96,0.08); }
        .sidebar-nav a.active { background:rgba(233,69,96,0.12); border-right:3px solid var(--accent); }
        .sidebar-nav a .icon { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
        .sidebar-nav .separator { height:1px; background:var(--border); margin:8px 24px; }
        .sidebar-nav a.danger { color:var(--accent); }

        /* ── Main content ── */
        .main-content { margin-left:280px; padding:36px 20px 40px; max-width:1200px; transition:margin-left .3s; }

        /* ── Responsive ── */
        @media (max-width:768px) {
            .sidebar { width:75vw; max-width:300px; transform:translateX(-100%); }
            .sidebar.open { transform:translateX(0); }
            .sidebar-close { display:flex !important; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; background:rgba(255,255,255,0.1); font-size:20px; }
            .topbar { margin-left:0; padding:12px 16px; }
            .topbar-title { font-size:17px; }
            .main-content { margin-left:0; padding:20px 14px; }
            .btn-menu { display:flex !important; }
            .sidebar-nav a { padding:12px 20px; font-size:14px; }
            .sidebar-user { padding:16px 20px; }
            .sidebar-avatar { width:44px; height:44px; font-size:18px; }
            .sidebar-user .name { font-size:15px; }
            .sidebar-header { padding:16px 20px; }
        }
        @media (max-width:480px) {
            .topbar { padding:10px 12px; }
            .topbar-title { font-size:15px; }
            .topbar-user { font-size:12px; }
            .topbar-right { gap:10px; }
            .main-content { padding:14px 10px; }
            .sidebar { width:80vw; max-width:280px; }
            .sidebar-nav a { padding:11px 18px; font-size:13px; gap:12px; }
            .sidebar-nav a .icon { width:28px; height:28px; }
            .sidebar-nav a .icon svg { width:18px; height:18px; }
        }
        @media (min-width:769px) {
            .btn-menu { display:none !important; }
        }

        .sidebar-nav a .icon { background:none !important; }
        .sidebar-nav a .icon svg { width:20px; height:20px; }

        /* Fix boutons resultats sur mobile */
        .btn-container { display:flex; flex-wrap:wrap; justify-content:center; gap:10px; margin-top:20px; }
        .btn-container .btn { margin-left:0 !important; }

        @yield('styles')
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
    @yield('head')
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <div style="display:flex;align-items:center;gap:14px">
        <button class="btn-menu" id="menuToggle" title="Menu">&#9776;</button>
        <div class="topbar-title">Dev <span>Learn</span></div>
    </div>
    <div class="topbar-right">
        <span class="topbar-user">Bonjour, <strong>{{ $userName }}</strong></span>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3>Menu</h3>
        <button class="sidebar-close" id="sidebarClose">&times;</button>
    </div>
    <div class="sidebar-user">
        @if($authUser->avatar ?? false)
            <img src="/storage/{{ $authUser->avatar }}" alt="avatar" style="width:50px;height:50px;border-radius:50%;object-fit:cover;margin-bottom:10px;">
        @else
            <div class="sidebar-avatar">{{ strtoupper(mb_substr($userName, 0, 1)) }}</div>
        @endif
        <div class="name">{{ $userName }}</div>
    </div>
    <nav class="sidebar-nav">
        <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}"><span class="icon"><i data-lucide="layout-dashboard"></i></span> Tableau de bord</a>
        <a href="/profil" class="{{ request()->is('profil') ? 'active' : '' }}"><span class="icon"><i data-lucide="user"></i></span> Mon profil</a>
        <a href="/classement" class="{{ request()->is('classement') ? 'active' : '' }}"><span class="icon"><i data-lucide="trophy"></i></span> Classement</a>
        @if($canCert)
        <a href="/certificat" class="{{ request()->is('certificat') ? 'active' : '' }}"><span class="icon"><i data-lucide="award"></i></span> Mon certificat</a>
        @endif
        <div class="separator"></div>
        @if($authUser->is_admin ?? false)
        <a href="/admin" class="{{ request()->is('admin*') ? 'active' : '' }}"><span class="icon"><i data-lucide="shield"></i></span> Administration</a>
        <div class="separator"></div>
        @endif
        <a href="#" class="danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="icon"><i data-lucide="log-out"></i></span> Deconnexion</a>
        <form id="logout-form" action="/logout" method="POST" style="display:none">@csrf</form>
    </nav>
</div>

<!-- Main content -->
<div class="main-content">
    @yield('content')
</div>

<script>
lucide.createIcons();

// Sidebar toggle (mobile)
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');
document.getElementById('menuToggle').addEventListener('click', () => {
    sidebar.classList.add('open');
    overlay.classList.add('open');
});
function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('open');
}
document.getElementById('sidebarClose').addEventListener('click', closeSidebar);
overlay.addEventListener('click', closeSidebar);
</script>
@yield('scripts')
</body>
</html>
