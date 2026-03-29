<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev Learn — Plateforme d'apprentissage</title>
    <link rel="icon" type="image/png" href="/images/favicon.png">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { overflow-x: hidden; width: 100%; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #1a293f; color: #eaeff3; min-height: 100vh; }
        img, video, svg, table { max-width: 100%; }

        /* --- Navbar --- */
        .navbar { display:flex; align-items:center; justify-content:space-between; padding:20px 48px; position:fixed; top:0; left:0; right:0; z-index:100; background:rgba(26,41,63,0.9); backdrop-filter:blur(16px); border-bottom:1px solid rgba(64,71,81,0.3); }
        .navbar-brand { font-size:22px; font-weight:800; color:#eaeff3; letter-spacing:-0.5px; }
        .navbar-brand span { color:#896f3d; }
        .nav-links { display:flex; gap:12px; align-items:center; }
        .nav-links a { color:#8a95a5; text-decoration:none; font-size:14px; font-weight:500; transition:color .2s; }
        .nav-links a:hover { color:#896f3d; }
        .btn { display:inline-flex; align-items:center; gap:8px; padding:10px 24px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none; cursor:pointer; border:none; transition:all .25s; font-family:inherit; }
        .btn-accent { background:#896f3d; color:#fff; }
        .btn-accent:hover { background:#6d5830; transform:translateY(-2px); box-shadow:0 8px 24px rgba(137,111,61,0.25); }
        .btn-outline { background:transparent; border:1.5px solid rgba(64,71,81,0.5); color:#eaeff3; }
        .btn-outline:hover { border-color:#896f3d; color:#896f3d; }
        .btn-lg { padding:16px 36px; font-size:16px; border-radius:10px; }

        /* --- Hero --- */
        .hero { display:flex; align-items:center; justify-content:center; min-height:100vh; padding:140px 48px 100px; gap:80px; max-width:1200px; margin:0 auto; overflow:hidden; }
        .hero-text { flex:1; max-width:560px; }
        .hero-badge { display:inline-flex; align-items:center; gap:8px; background:rgba(137,111,61,0.1); border:1px solid rgba(137,111,61,0.2); border-radius:50px; padding:8px 18px; font-size:13px; color:#896f3d; font-weight:600; margin-bottom:28px; }
        .hero-text h1 { font-size:48px; font-weight:800; line-height:1.1; margin-bottom:24px; letter-spacing:-1.5px; }
        .hero-text h1 span { color:#896f3d; }
        .hero-sub { font-size:17px; color:#8a95a5; line-height:1.8; margin-bottom:36px; }
        .hero-buttons { display:flex; gap:16px; flex-wrap:wrap; margin-bottom:48px; }
        .hero-metrics { display:flex; gap:40px; padding-top:32px; border-top:1px solid rgba(64,71,81,0.3); }
        .metric-num { font-size:32px; font-weight:800; color:#896f3d; }
        .metric-lbl { font-size:13px; color:#606b7a; margin-top:4px; }
        .hero-visual { flex:1; max-width:500px; }
        .hero-img { width:100%; border-radius:20px; box-shadow:0 30px 80px rgba(0,0,0,0.4); object-fit:cover; }

        /* --- Section commun --- */
        .section { padding:100px 48px; max-width:1200px; margin:0 auto; overflow:hidden; }
        .section-alt { background:#152238; }
        .section-header { text-align:center; margin-bottom:64px; }
        .section-header h2 { font-size:38px; font-weight:800; margin-bottom:14px; letter-spacing:-1px; }
        .section-header h2 span { color:#896f3d; }
        .section-header p { color:#606b7a; font-size:16px; max-width:500px; margin:0 auto; }

        /* --- Steps --- */
        .steps-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:24px; }
        .step-card { background:#202f45; border-radius:16px; padding:36px 28px; border:1px solid rgba(64,71,81,0.2); transition:all .3s; position:relative; overflow:hidden; }
        .step-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:linear-gradient(90deg,#896f3d,transparent); opacity:0; transition:opacity .3s; }
        .step-card:hover { border-color:rgba(137,111,61,0.3); transform:translateY(-4px); }
        .step-card:hover::before { opacity:1; }
        .step-num { font-size:48px; font-weight:800; color:rgba(137,111,61,0.12); margin-bottom:16px; line-height:1; }
        .step-icon { width:44px; height:44px; border-radius:12px; background:rgba(137,111,61,0.1); display:flex; align-items:center; justify-content:center; color:#896f3d; margin-bottom:16px; }
        .step-card h3 { font-size:18px; font-weight:700; margin-bottom:10px; }
        .step-card p { color:#8a95a5; font-size:14px; line-height:1.7; }

        /* --- Technologies --- */
        .techs-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(140px, 1fr)); gap:16px; }
        .tech-card { background:#202f45; border-radius:14px; padding:28px 16px; text-align:center; border:1px solid rgba(64,71,81,0.2); transition:all .3s; }
        .tech-card:hover { border-color:#896f3d; transform:translateY(-4px); box-shadow:0 12px 30px rgba(137,111,61,0.08); }
        .tech-logo { width:52px; height:52px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:15px; margin:0 auto 14px; }
        .tech-card h4 { font-size:15px; font-weight:700; margin-bottom:4px; }
        .tech-card p { font-size:11px; color:#606b7a; }

        /* --- Features --- */
        .features-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:24px; }
        .feat-card { background:#202f45; border-radius:16px; padding:32px; border:1px solid rgba(64,71,81,0.2); display:flex; gap:20px; align-items:flex-start; transition:all .3s; }
        .feat-card:hover { border-color:rgba(137,111,61,0.3); transform:translateY(-2px); }
        .feat-icon { width:48px; height:48px; border-radius:12px; background:rgba(137,111,61,0.1); display:flex; align-items:center; justify-content:center; color:#896f3d; flex-shrink:0; }
        .feat-card h3 { font-size:17px; font-weight:700; margin-bottom:8px; }
        .feat-card p { color:#8a95a5; font-size:14px; line-height:1.7; }

        /* --- CTA --- */
        .cta { text-align:center; padding:120px 48px; position:relative; }
        .cta::before { content:''; position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:500px; height:500px; background:radial-gradient(circle,rgba(137,111,61,0.06) 0%,transparent 70%); pointer-events:none; }
        .cta h2 { font-size:40px; font-weight:800; margin-bottom:16px; letter-spacing:-1px; }
        .cta h2 span { color:#896f3d; }
        .cta p { color:#606b7a; font-size:16px; margin-bottom:36px; }

        /* --- Footer --- */
        .footer { text-align:center; padding:28px; border-top:1px solid rgba(64,71,81,0.3); color:#404751; font-size:13px; }

        /* --- Animations --- */
        .reveal { opacity:0; transform:translateY(30px); transition:opacity .7s ease, transform .7s ease; }
        .reveal.visible { opacity:1; transform:translateY(0); }

        /* --- Responsive --- */
        @media (max-width:900px) {
            .hero { flex-direction:column; padding:130px 24px 60px; gap:40px; text-align:center; }
            .hero-buttons, .hero-metrics { justify-content:center; flex-wrap:wrap; }
            .hero-text h1 { font-size:34px; }
            .hero-visual { max-width:100%; }
            .navbar { padding:16px 20px; }
            .nav-links { display:none; }
            .section { padding:60px 24px; }
            .section-header h2 { font-size:28px; }
            .cta { padding:80px 24px; }
            .cta h2 { font-size:28px; }
        }
        @media (max-width:480px) {
            .navbar { padding:14px 16px; }
            .navbar-brand { font-size:18px; }
            .hero { padding:110px 16px 40px; gap:28px; }
            .hero-text h1 { font-size:26px; letter-spacing:-0.5px; }
            .hero-sub { font-size:14px; margin-bottom:24px; }
            .hero-badge { font-size:11px; padding:6px 14px; }
            .hero-buttons { gap:10px; }
            .btn-lg { padding:14px 24px; font-size:14px; }
            .hero-metrics { gap:24px; padding-top:24px; }
            .metric-num { font-size:24px; }
            .metric-lbl { font-size:11px; }
            .hero-img { border-radius:14px; }
            .section { padding:48px 16px; }
            .section-header { margin-bottom:36px; }
            .section-header h2 { font-size:22px; }
            .section-header p { font-size:14px; }
            .step-card { padding:24px 20px; }
            .step-num { font-size:36px; }
            .step-card h3 { font-size:16px; }
            .step-card p { font-size:13px; }
            .techs-grid { grid-template-columns:repeat(2,1fr); gap:10px; }
            .tech-card { padding:20px 12px; }
            .tech-logo { width:44px; height:44px; font-size:13px; }
            .tech-card h4 { font-size:13px; }
            .feat-card { padding:24px 20px; gap:14px; }
            .feat-card h3 { font-size:15px; }
            .feat-card p { font-size:13px; }
            .feat-icon { width:40px; height:40px; }
            .cta { padding:60px 16px; }
            .cta h2 { font-size:24px; }
            .cta p { font-size:14px; }
            .footer { font-size:11px; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-brand">Dev <span>Learn</span></div>
    <div class="nav-links">
        <a href="/login" class="btn btn-outline" style="padding:10px 20px;"><i data-lucide="log-in" style="width:15px;height:15px;"></i> Connexion</a>
        <a href="/register" class="btn btn-accent" style="padding:10px 20px;"><i data-lucide="arrow-right" style="width:15px;height:15px;"></i> Inscription</a>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-text">
        <div class="hero-badge"><i data-lucide="graduation-cap" style="width:16px;height:16px;"></i> Plateforme d'apprentissage</div>
        <h1>Maitrisez le <span>developpement web</span> en vous testant</h1>
        <p class="hero-sub">Des parcours progressifs avec mini-lecons, un suivi personnalise de votre progression, et un examen final pour prouver vos competences.</p>
        <div class="hero-buttons">
            <a href="/register" class="btn btn-accent btn-lg"><i data-lucide="arrow-right" style="width:18px;height:18px;"></i> Commencer gratuitement</a>
            <a href="/login" class="btn btn-outline btn-lg">J'ai deja un compte</a>
        </div>
        <div class="hero-metrics">
            <div class="metric"><div class="metric-num">310+</div><div class="metric-lbl">Questions</div></div>
            <div class="metric"><div class="metric-num">6</div><div class="metric-lbl">Technologies</div></div>
            <div class="metric"><div class="metric-num">35+</div><div class="metric-lbl">Chapitres</div></div>
        </div>
    </div>
    <div class="hero-visual">
        <img src="/images/hero.jpeg" alt="Chapeau de diplome sur des livres" class="hero-img">
    </div>
</section>

<!-- Comment ca marche -->
<div class="section-alt">
<section class="section" id="methode">
    <div class="section-header reveal">
        <h2>Comment ca <span>marche</span></h2>
        <p>Un parcours structure en 3 etapes simples</p>
    </div>
    <div class="steps-grid">
        <div class="step-card reveal">
            <div class="step-num">01</div>
            <div class="step-icon"><i data-lucide="book-open"></i></div>
            <h3>Apprenez avec des mini-lecons</h3>
            <p>Chaque chapitre debute par une lecon claire avec des exemples de code concrets avant de passer aux questions.</p>
        </div>
        <div class="step-card reveal">
            <div class="step-num">02</div>
            <div class="step-icon"><i data-lucide="check-circle"></i></div>
            <h3>Testez vos connaissances</h3>
            <p>Repondez aux QCM progressifs. Vos scores sont sauvegardes et vous pouvez retravailler vos erreurs.</p>
        </div>
        <div class="step-card reveal">
            <div class="step-num">03</div>
            <div class="step-icon"><i data-lucide="award"></i></div>
            <h3>Validez avec un certificat</h3>
            <p>Passez l'examen final de 60 questions chronometre. Obtenez votre certificat avec 80% ou plus.</p>
        </div>
    </div>
</section>
</div>

<!-- Technologies -->
<section class="section" id="techs">
    <div class="section-header reveal">
        <h2>6 <span>technologies</span>, 6 parcours</h2>
        <p>50 questions par parcours, 7 chapitres progressifs</p>
    </div>
    <div class="techs-grid">
        <div class="tech-card reveal"><div class="tech-logo" style="background:#00599C;color:#fff;">C++</div><h4>C++</h4><p>Syntaxe, pointeurs, POO</p></div>
        <div class="tech-card reveal"><div class="tech-logo" style="background:#e44d26;color:#fff;">HTML</div><h4>HTML</h4><p>Structure, balises, forms</p></div>
        <div class="tech-card reveal"><div class="tech-logo" style="background:#2965f1;color:#fff;">CSS</div><h4>CSS</h4><p>Flexbox, Grid, responsive</p></div>
        <div class="tech-card reveal"><div class="tech-logo" style="background:#f0db4f;color:#323330;">JS</div><h4>JavaScript</h4><p>Variables, DOM, ES6</p></div>
        <div class="tech-card reveal"><div class="tech-logo" style="background:#8892BF;color:#fff;">PHP</div><h4>PHP</h4><p>Syntaxe, PDO, sessions</p></div>
        <div class="tech-card reveal"><div class="tech-logo" style="background:#00BCD4;color:#006064;">SQL</div><h4>SQL</h4><p>SELECT, JOIN, DDL</p></div>
    </div>
</section>

<!-- Fonctionnalites -->
<div class="section-alt">
<section class="section" id="features">
    <div class="section-header reveal">
        <h2>Tout pour <span>reussir</span></h2>
        <p>Des outils concrets pour progresser efficacement</p>
    </div>
    <div class="features-grid">
        <div class="feat-card reveal">
            <div class="feat-icon"><i data-lucide="book-open"></i></div>
            <div><h3>Mini-lecons integrees</h3><p>Chaque chapitre commence par une lecon avec des exemples de code avant les questions.</p></div>
        </div>
        <div class="feat-card reveal">
            <div class="feat-icon"><i data-lucide="bar-chart-3"></i></div>
            <div><h3>Suivi de progression</h3><p>Tableau de bord avec vos scores, votre parcours recommande et vos statistiques detaillees.</p></div>
        </div>
        <div class="feat-card reveal">
            <div class="feat-icon"><i data-lucide="rotate-ccw"></i></div>
            <div><h3>Mode revision</h3><p>Retravaillez uniquement les questions ratees pour cibler vos points faibles.</p></div>
        </div>
        <div class="feat-card reveal">
            <div class="feat-icon"><i data-lucide="timer"></i></div>
            <div><h3>Examen chronometre</h3><p>60 questions, 6 technologies, 30 minutes. Prouvez votre maitrise.</p></div>
        </div>
        <div class="feat-card reveal">
            <div class="feat-icon"><i data-lucide="trophy"></i></div>
            <div><h3>Classement</h3><p>Comparez vos scores avec les autres apprenants par technologie ou globalement.</p></div>
        </div>
        <div class="feat-card reveal">
            <div class="feat-icon"><i data-lucide="award"></i></div>
            <div><h3>Certificat de reussite</h3><p>Obtenez un certificat imprimable apres avoir valide l'examen final.</p></div>
        </div>
    </div>
</section>
</div>

<!-- CTA -->
<section class="cta">
    <h2 class="reveal">Pret a <span>progresser</span> ?</h2>
    <p class="reveal">Creez votre compte gratuitement et commencez votre premier parcours.</p>
    <a href="/register" class="btn btn-accent btn-lg reveal"><i data-lucide="arrow-right" style="width:18px;height:18px;"></i> Creer mon compte</a>
</section>

<!-- Footer -->
<footer class="footer">Dev Learn &mdash; Plateforme d'apprentissage du developpement web</footer>

<script>
lucide.createIcons();

// Scroll reveal
const reveals = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } });
}, { threshold: 0.15 });
reveals.forEach(el => observer.observe(el));
</script>
</body>
</html>
