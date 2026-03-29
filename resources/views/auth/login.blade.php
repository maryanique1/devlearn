<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Dev Learn</title>
    <link rel="icon" type="image/png" href="/images/favicon.png">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #1a293f; color: #eaeff3; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .auth-container { width: 100%; max-width: 420px; padding: 20px; }
        .auth-card { background: #202f45; border-radius: 16px; padding: 40px 30px; box-shadow: 0 8px 30px rgba(0,0,0,0.3); }
        .auth-header { text-align: center; margin-bottom: 30px; }
        .auth-header .logo-icons { display: flex; justify-content: center; gap: 8px; margin-bottom: 16px; }
        .auth-header .mini-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 10px; }
        .auth-header h1 { font-size: 24px; margin-bottom: 4px; color: #eaeff3; }
        .auth-header p { color: #8a95a5; font-size: 14px; }
        .tabs { display: flex; margin-bottom: 25px; border-bottom: 2px solid rgba(64,71,81,0.4); }
        .tab { flex: 1; text-align: center; padding: 12px; color: #8a95a5; font-weight: bold; font-size: 14px; border-bottom: 2px solid transparent; margin-bottom: -2px; text-decoration: none; }
        .tab:hover { color: #eaeff3; }
        .tab.active { color: #896f3d; border-bottom-color: #896f3d; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; color: #8a95a5; margin-bottom: 6px; }
        .form-group input { width: 100%; padding: 12px 14px; border: 2px solid rgba(64,71,81,0.4); border-radius: 8px; background: #152238; color: #eaeff3; font-size: 15px; outline: none; }
        .form-group input:focus { border-color: #896f3d; }
        .btn-submit { width: 100%; padding: 14px; border: none; border-radius: 8px; background: #896f3d; color: #fff; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 5px; }
        .btn-submit:hover { background: #6d5830; }
        .message { padding: 10px 14px; border-radius: 8px; margin-bottom: 18px; font-size: 14px; }
        .message.error { background: rgba(231,76,60,0.1); border: 1px solid #e74c3c; color: #e74c3c; }
        .message.success { background: rgba(39,174,96,0.1); border: 1px solid #27ae60; color: #27ae60; }
        .bg-html { background: #e44d26; color: #fff; } .bg-css { background: #2965f1; color: #fff; } .bg-js { background: #f0db4f; color: #323330; } .bg-php { background: #8892BF; color: #fff; } .bg-sql { background: #00BCD4; color: #006064; }
        @media(max-width:480px) {
            .auth-card { padding: 28px 20px; }
            .auth-header h1 { font-size: 20px; }
            .auth-header .logo-icons { gap: 6px; }
            .auth-header .mini-icon { width: 30px; height: 30px; font-size: 8px; }
            .form-group input { padding: 10px 12px; font-size: 14px; }
            .btn-submit { padding: 12px; font-size: 15px; }
            .tab { padding: 10px; font-size: 13px; }
        }
    </style>
</head>
<body>
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo-icons">
                <div class="mini-icon bg-html">HTML</div>
                <div class="mini-icon bg-css">CSS</div>
                <div class="mini-icon bg-js">JS</div>
                <div class="mini-icon bg-php">PHP</div>
                <div class="mini-icon bg-sql">SQL</div>
            </div>
            <h1>Dev Learn</h1>
            <p>Plateforme d'apprentissage</p>
        </div>
        <div class="tabs">
            <a class="tab {{ $mode === 'login' ? 'active' : '' }}" href="/login">Connexion</a>
            <a class="tab {{ $mode === 'register' ? 'active' : '' }}" href="/register">Inscription</a>
        </div>
        @if($errors->any())<div class="message error">{{ $errors->first() }}</div>@endif
        @if(session('success'))<div class="message success">{{ session('success') }}</div>@endif

        @if($mode === 'login')
        <form method="POST" action="/login">
            @csrf
            <div class="form-group"><label>Email</label><input type="email" name="email" required placeholder="votre@email.com" value="{{ old('email') }}"></div>
            <div class="form-group"><label>Mot de passe</label><input type="password" name="password" required placeholder="Votre mot de passe"></div>
            <button type="submit" class="btn-submit">Se connecter</button>
        </form>
        @else
        <form method="POST" action="/register">
            @csrf
            <div class="form-group"><label>Nom complet</label><input type="text" name="nom" required placeholder="Votre nom" value="{{ old('nom') }}"></div>
            <div class="form-group"><label>Email</label><input type="email" name="email" required placeholder="votre@email.com" value="{{ old('email') }}"></div>
            <div class="form-group"><label>Mot de passe</label><input type="password" name="password" required placeholder="4 caracteres minimum"></div>
            <div class="form-group"><label>Confirmer le mot de passe</label><input type="password" name="password_confirmation" required placeholder="Retapez le mot de passe"></div>
            <button type="submit" class="btn-submit">Creer mon compte</button>
        </form>
        @endif
    </div>
</div>
</body>
</html>
