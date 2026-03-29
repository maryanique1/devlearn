@extends('layouts.app')
@section('title', 'Apprendre HTML - QCM Progressif')

@section('styles')


        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
        }

        .container { overflow-wrap: break-word; max-width: 820px;
            max-width: 820px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            color: #e44d26;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Progress */
        .progress-bar {
            background: var(--bg-card);
            border-radius: 20px;
            height: 12px;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #e44d26, #f16529);
            border-radius: 20px;
            transition: width 0.4s ease;
        }

        .progress-text {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Question card */
        .question-card {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .category-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 15px;
            text-transform: uppercase;
            background: #e44d26;
            color: var(--text-main);
        }

        .question-text {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .question-text code {
            background: rgba(20,81,142,0.08);
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'Consolas', monospace;
            font-size: 15px;
            color: #14518e;
        }

        .code-block {
            background: var(--bg-code);
            border: 1px solid var(--border-subtle);
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            font-family: 'Consolas', monospace;
            font-size: 14px;
            line-height: 1.6;
            overflow-x: auto; max-width: 100%;
            white-space: pre;
            color: var(--text-main);
        }

        /* Options */
        .options { list-style: none; }

        .options li {
            background: var(--bg-input);
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 14px 18px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 15px; color: var(--text-main);
        }

        .options li:hover { border-color: #e44d26; background: rgba(0,100,200,0.08); }
        .options li.selected { border-color: #e44d26; background: rgba(231,76,60,0.15); }
        .options li.correct { border-color: #27ae60; background: rgba(39,174,96,0.15); }
        .options li.wrong { border-color: #e74c3c; background: rgba(231,76,60,0.15); }
        .options li.disabled { cursor: default; opacity: 0.7; }
        .options li.disabled.correct { opacity: 1; }

        /* Explanation */
        .explanation {
            margin-top: 15px;
            padding: 15px;
            border-radius: 8px;
            background: var(--bg-code);
            border-left: 4px solid #e44d26;
            font-size: 14px;
            line-height: 1.8;
            display: none;
        }

        .explanation code {
            background: rgba(20,81,142,0.08);
            padding: 2px 6px;
            border-radius: 4px;
            font-family: 'Consolas', monospace;
            font-size: 13px;
            color: #14518e;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary { background: #e44d26; color: #fff; font-weight: bold; }
        .btn-primary:hover { background: #c9401e; }
        .btn-primary:disabled { background: #555; color: #999; cursor: not-allowed; }
        .btn-restart { background: var(--bg-input); color: var(--text-main); border: 1px solid var(--border-subtle); }
        .btn-restart:hover { background: #1a4a80; }

        .btn-container { text-align: center; margin-top: 20px; }

        /* Lesson card (pause between chapters) */
        .lesson-card {
            background: linear-gradient(135deg, var(--bg-card), var(--bg-input));
            border: 2px solid #e44d2633;
            border-radius: 16px;
            padding: 35px;
            margin-bottom: 20px;
        }

        .lesson-card h2 {
            color: #e44d26;
            margin-bottom: 8px;
            font-size: 22px;
        }

        .lesson-card .chapter-num {
            color: #e44d26;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .lesson-card p {
            color: var(--text-main);
            line-height: 1.8;
            margin: 12px 0;
            font-size: 15px;
        }

        .lesson-card .code-example {
            background: var(--bg-code);
            border: 1px solid #e44d2633;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            font-family: 'Consolas', monospace;
            font-size: 14px;
            line-height: 1.8;
            color: var(--text-main);
            white-space: pre;
            overflow-x: auto; max-width: 100%;
        }

        .lesson-card .code-example .comment { color: #2d8a4e; }
        .lesson-card .code-example .keyword { color: #569cd6; }
        .lesson-card .code-example .string { color: #ce9178; }
        .lesson-card .code-example .number { color: #b5cea8; }

        .lesson-card .tip {
            background: #e44d2615;
            border-left: 3px solid #e44d26;
            padding: 10px 15px;
            border-radius: 0 6px 6px 0;
            margin: 15px 0;
            font-size: 14px;
            color: var(--text-main);
        }

        /* Chapter score summary */
        .chapter-score {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .chapter-score .score-box {
            background: var(--bg-code);
            border-radius: 10px;
            padding: 15px 25px;
            text-align: center;
        }

        .chapter-score .score-box .num {
            font-size: 32px;
            font-weight: bold;
        }

        .chapter-score .score-box .lbl { color: var(--text-muted); 
            font-size: 12px;
        }

        /* Results */
        .results { display: none; }

        .score-circle {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: bold;
        }

        .score-circle .label { font-size: 14px; font-weight: normal; color: var(--text-muted); }

        .level-excellent { background: linear-gradient(135deg, #1a3e2a, #27ae60); color: #27ae60; }
        .level-good { background: linear-gradient(135deg, #1a3e3e, #2980b9); color: #2980b9; }
        .level-average { background: linear-gradient(135deg, #3e3a1a, #f39c12); color: #f39c12; }
        .level-weak { background: linear-gradient(135deg, #3e1a1a, #e74c3c); color: #e74c3c; }

        .level-message { text-align: center; font-size: 22px; font-weight: bold; margin: 15px 0; }
        .level-detail { text-align: center; color: var(--text-muted); margin-bottom: 30px; line-height: 1.6; }

        .cat-scores {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 15px;
            margin: 25px 0;
        }

        .cat-score-card {
            background: var(--bg-card);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .cat-score-card .cat-name { font-size: 12px; font-weight: bold; margin-bottom: 8px; color: #e44d26; }
        .cat-score-card .cat-pct { font-size: 28px; font-weight: bold; }
        .cat-score-card .cat-detail { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

        /* Start screen */
        .start-screen { overflow-wrap: break-word; text-align: center; padding: 40px 20px; }
        .start-screen p { color: var(--text-muted); margin: 15px 0; line-height: 1.6; }

        .js-logo {
            overflow: hidden;
            font-size: 36px;
            font-weight: bold;
            color: #fff;
            background: #e44d26;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin: 0 auto 20px;
        }

        .roadmap {
            text-align: left;
            max-width: 400px;
            margin: 25px auto;
        }

        .roadmap .step {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-subtle);
            font-size: 14px;
        }

        .roadmap .step .dot {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--bg-input);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: bold;
            color: #e44d26;
            flex-shrink: 0;
        }


        .timer {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            font-family: 'Consolas', monospace;
        }
        @media (max-width: 768px) {
            .container { padding: 20px 14px !important; }
            .question-card { padding: 20px !important; }
            .lesson-card { padding: 24px 18px !important; }
            .start-screen { padding: 24px 14px !important; }
            .question-text { font-size: 16px !important; }
            .options li { padding: 12px 14px !important; font-size: 14px !important; }
            .code-block, .code-example { font-size: 12px !important; padding: 12px !important; }
            .btn { padding: 10px 24px !important; font-size: 14px !important; }
            .js-logo, .sql-logo { width: 80px !important; height: 80px !important; font-size: 28px !important; }
            .roadmap .step { font-size: 13px !important; }
            .cat-scores { grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)) !important; }
            .score-circle { width: 140px !important; height: 140px !important; font-size: 36px !important; }
            .chapter-score { gap: 12px !important; }
            .chapter-score .score-box { padding: 12px 18px !important; }
            .chapter-score .score-box .num { font-size: 24px !important; }
        }
        @media (max-width: 480px) {
            .container { padding: 14px 10px !important; }
            .question-card { padding: 16px !important; }
            .lesson-card { padding: 18px 14px !important; }
            .question-text { font-size: 15px !important; }
            .options li { padding: 10px 12px !important; font-size: 13px !important; }
            .code-block, .code-example { font-size: 11px !important; padding: 10px !important; }
            .category-badge { font-size: 10px !important; padding: 3px 10px !important; }
            .progress-text { font-size: 12px !important; }
            .timer { font-size: 16px !important; }
            .level-message { font-size: 18px !important; }
            .level-detail { font-size: 13px !important; }
            .score-circle { width: 120px !important; height: 120px !important; font-size: 30px !important; }
            .cat-scores { grid-template-columns: 1fr 1fr !important; gap: 10px !important; }
            .cat-score-card { padding: 10px !important; }
            .cat-score-card .cat-pct { font-size: 20px !important; }
            h1 { font-size: 24px !important; }
            .subtitle { font-size: 13px !important; }
        }
@endsection

@section('content')
<div class="container">
    <h1>Apprendre HTML</h1>
    <p class="subtitle">QCM progressif &bull; 50 questions &bull; 7 chapitres</p>

    <!-- Start screen -->
    <div id="start-screen" class="start-screen">
        <div class="js-logo">HTML</div>
        <p>Un parcours d'apprentissage complet pour decouvrir HTML depuis zero.<br>
        Chaque chapitre commence par une <strong>mini-lecon</strong>, puis vous testez vos connaissances.</p>

        <div class="roadmap">
            <div class="step"><span class="dot">1</span> Les bases : structure d'une page HTML (8 questions)</div>
            <div class="step"><span class="dot">2</span> Le texte et les titres (7 questions)</div>
            <div class="step"><span class="dot">3</span> Les liens et les images (7 questions)</div>
            <div class="step"><span class="dot">4</span> Les listes et les tableaux (7 questions)</div>
            <div class="step"><span class="dot">5</span> Les formulaires (8 questions)</div>
            <div class="step"><span class="dot">6</span> HTML5 semantique (6 questions)</div>
            <div class="step"><span class="dot">7</span> Multimedia et attributs globaux (7 questions)</div>
        </div>

        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Commencer l'apprentissage</button>
        </div>
        <div id="resume-banner" style="display:none; margin-top:20px; background:var(--bg-card); border:2px solid #e44d26; border-radius:12px; padding:20px; text-align:center;">
            <p style="margin-bottom:12px; font-size:16px;">Vous avez une progression en cours : <strong id="resume-info"></strong></p>
            <button class="btn btn-primary" id="btn-resume">Continuer ou j'en etais</button>
            <button class="btn btn-restart" onclick="startQuiz()" style="margin-left:10px">Recommencer depuis le debut</button>
        </div>
    </div>

    <!-- Quiz area -->
    <div id="quiz-area" style="display:none">
        <div class="progress-text" id="progress-text"></div>
        <div class="progress-bar">
            <div class="progress-fill" id="progress-fill"></div>
        </div>
        <div class="timer" id="timer">00:00</div>

        <div id="content-area"></div>

        <div class="btn-container">
            <button class="btn btn-primary" id="btn-validate" onclick="validateAnswer()" disabled style="display:none">Valider</button>
            <button class="btn btn-primary" id="btn-next" onclick="next()" style="display:none">Suivant</button>
            <button class="btn btn-primary" id="btn-start-chapter" onclick="startChapter()" style="display:none">Commencer les questions</button>
        </div>
    </div>

    <!-- Results -->
    <div id="results" class="results"></div>
</div>

<script>
// ========================
// CHAPTER LESSONS
// ========================
const chapters = [
    {
        title: "Les bases : structure d'une page HTML",
        num: 1,
        lesson: `<p><strong>HTML</strong> signifie <em>HyperText Markup Language</em>. C'est le langage qui structure toutes les pages web. Il utilise des <strong>balises</strong> (tags) pour organiser le contenu.</p>

<p>Une balise s'ecrit entre chevrons. La plupart ont une balise ouvrante et une balise fermante :</p>
<div class="code-example"><span class="keyword">&lt;p&gt;</span>Ceci est un paragraphe.<span class="keyword">&lt;/p&gt;</span></div>

<p>Voici la <strong>structure de base</strong> d'une page HTML :</p>
<div class="code-example"><span class="keyword">&lt;!DOCTYPE html&gt;</span>              <span class="comment">&lt;!-- declare que c'est du HTML5 --&gt;</span>
<span class="keyword">&lt;html</span> <span class="string">lang="fr"</span><span class="keyword">&gt;</span>              <span class="comment">&lt;!-- debut du document --&gt;</span>
<span class="keyword">&lt;head&gt;</span>                          <span class="comment">&lt;!-- metadonnees (invisible) --&gt;</span>
    <span class="keyword">&lt;meta</span> <span class="string">charset="UTF-8"</span><span class="keyword">&gt;</span>      <span class="comment">&lt;!-- encodage des caracteres --&gt;</span>
    <span class="keyword">&lt;title&gt;</span>Ma page<span class="keyword">&lt;/title&gt;</span>      <span class="comment">&lt;!-- titre dans l'onglet --&gt;</span>
<span class="keyword">&lt;/head&gt;</span>
<span class="keyword">&lt;body&gt;</span>                          <span class="comment">&lt;!-- contenu visible --&gt;</span>
    <span class="keyword">&lt;h1&gt;</span>Bonjour !<span class="keyword">&lt;/h1&gt;</span>
    <span class="keyword">&lt;p&gt;</span>Mon premier site.<span class="keyword">&lt;/p&gt;</span>
<span class="keyword">&lt;/body&gt;</span>
<span class="keyword">&lt;/html&gt;</span></div>

<p>&bull; <code>&lt;head&gt;</code> contient les informations pour le navigateur (titre, encodage, liens CSS...)</p>
<p>&bull; <code>&lt;body&gt;</code> contient tout ce qui est visible sur la page</p>
<p>&bull; <code>&lt;meta charset="UTF-8"&gt;</code> permet d'afficher les accents correctement</p>

<p>Les <strong>commentaires</strong> ne sont pas affiches par le navigateur :</p>
<div class="code-example"><span class="comment">&lt;!-- Ceci est un commentaire HTML --&gt;</span></div>

<div class="tip">L'indentation (espaces au debut des lignes) n'est pas obligatoire, mais elle rend le code beaucoup plus lisible. Chaque element enfant est decale d'un niveau.</div>`
    },
    {
        title: "Le texte et les titres",
        num: 2,
        lesson: `<p>HTML propose 6 niveaux de <strong>titres</strong>, de <code>&lt;h1&gt;</code> (le plus grand) a <code>&lt;h6&gt;</code> (le plus petit) :</p>

<div class="code-example"><span class="keyword">&lt;h1&gt;</span>Titre principal<span class="keyword">&lt;/h1&gt;</span>
<span class="keyword">&lt;h2&gt;</span>Sous-titre<span class="keyword">&lt;/h2&gt;</span>
<span class="keyword">&lt;h3&gt;</span>Sous-sous-titre<span class="keyword">&lt;/h3&gt;</span>
<span class="comment">&lt;!-- ... jusqu'a h6 --&gt;</span></div>

<p>Le <strong>paragraphe</strong> se fait avec <code>&lt;p&gt;</code> :</p>
<div class="code-example"><span class="keyword">&lt;p&gt;</span>Ceci est un paragraphe de texte.<span class="keyword">&lt;/p&gt;</span>
<span class="keyword">&lt;p&gt;</span>Et voici un deuxieme paragraphe.<span class="keyword">&lt;/p&gt;</span></div>

<p>Pour mettre en <strong>evidence</strong> du texte :</p>
<p>&bull; <code>&lt;strong&gt;</code> — texte important (affiche en <strong>gras</strong>), a une valeur semantique</p>
<p>&bull; <code>&lt;em&gt;</code> — texte accentue (affiche en <em>italique</em>), a une valeur semantique</p>
<p>&bull; <code>&lt;b&gt;</code> et <code>&lt;i&gt;</code> — gras et italique visuels, sans signification particuliere</p>

<div class="code-example"><span class="keyword">&lt;p&gt;</span>Ce mot est <span class="keyword">&lt;strong&gt;</span>tres important<span class="keyword">&lt;/strong&gt;</span>.<span class="keyword">&lt;/p&gt;</span>
<span class="keyword">&lt;p&gt;</span>Ce mot est en <span class="keyword">&lt;em&gt;</span>italique<span class="keyword">&lt;/em&gt;</span>.<span class="keyword">&lt;/p&gt;</span></div>

<p>Autres balises utiles :</p>
<p>&bull; <code>&lt;br&gt;</code> — saut de ligne (balise auto-fermante, pas de <code>&lt;/br&gt;</code>)</p>
<p>&bull; <code>&lt;hr&gt;</code> — ligne horizontale de separation</p>
<p>&bull; <code>&lt;blockquote&gt;</code> — citation</p>
<p>&bull; <code>&lt;span&gt;</code> — conteneur en ligne (pour styler une partie du texte)</p>

<div class="tip">HTML ignore les espaces et retours a la ligne multiples dans le code source. Pour forcer un saut de ligne, utilisez <code>&lt;br&gt;</code>.</div>`
    },
    {
        title: "Les liens et les images",
        num: 3,
        lesson: `<p>Les <strong>liens hypertextes</strong> permettent de naviguer entre les pages. On utilise la balise <code>&lt;a&gt;</code> :</p>

<div class="code-example"><span class="keyword">&lt;a</span> <span class="string">href="https://example.com"</span><span class="keyword">&gt;</span>Cliquez ici<span class="keyword">&lt;/a&gt;</span>

<span class="comment">&lt;!-- Ouvrir dans un nouvel onglet --&gt;</span>
<span class="keyword">&lt;a</span> <span class="string">href="https://example.com"</span> <span class="string">target="_blank"</span><span class="keyword">&gt;</span>Nouvel onglet<span class="keyword">&lt;/a&gt;</span>

<span class="comment">&lt;!-- Lien relatif (meme site) --&gt;</span>
<span class="keyword">&lt;a</span> <span class="string">href="contact.html"</span><span class="keyword">&gt;</span>Contact<span class="keyword">&lt;/a&gt;</span></div>

<p>&bull; <code>href</code> — l'adresse de destination (URL absolue ou relative)</p>
<p>&bull; <code>target="_blank"</code> — ouvre le lien dans un nouvel onglet</p>
<p>&bull; URL <strong>absolue</strong> : adresse complete (<code>https://...</code>)</p>
<p>&bull; URL <strong>relative</strong> : chemin par rapport a la page actuelle (<code>page2.html</code>)</p>

<p>Les <strong>images</strong> utilisent la balise auto-fermante <code>&lt;img&gt;</code> :</p>
<div class="code-example"><span class="keyword">&lt;img</span> <span class="string">src="photo.jpg"</span> <span class="string">alt="Description de l'image"</span><span class="keyword">&gt;</span>

<span class="comment">&lt;!-- Avec dimensions --&gt;</span>
<span class="keyword">&lt;img</span> <span class="string">src="logo.png"</span> <span class="string">alt="Logo du site"</span> <span class="string">width="200"</span> <span class="string">height="100"</span><span class="keyword">&gt;</span></div>

<p>&bull; <code>src</code> — chemin vers l'image</p>
<p>&bull; <code>alt</code> — texte alternatif (accessibilite, affiche si l'image ne charge pas)</p>

<p>Pour legendes les images, utilisez <code>&lt;figure&gt;</code> et <code>&lt;figcaption&gt;</code> :</p>
<div class="code-example"><span class="keyword">&lt;figure&gt;</span>
    <span class="keyword">&lt;img</span> <span class="string">src="chat.jpg"</span> <span class="string">alt="Un chat roux"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;figcaption&gt;</span>Photo d'un chat roux<span class="keyword">&lt;/figcaption&gt;</span>
<span class="keyword">&lt;/figure&gt;</span></div>

<div class="tip">L'attribut <code>alt</code> est essentiel pour l'accessibilite : les lecteurs d'ecran le lisent a voix haute pour les personnes malvoyantes.</div>`
    },
    {
        title: "Les listes et les tableaux",
        num: 4,
        lesson: `<p>HTML propose deux types de <strong>listes</strong> :</p>
<p>&bull; <code>&lt;ul&gt;</code> — liste <strong>non ordonnee</strong> (puces)</p>
<p>&bull; <code>&lt;ol&gt;</code> — liste <strong>ordonnee</strong> (numerotee)</p>
<p>Chaque element est dans une balise <code>&lt;li&gt;</code> :</p>

<div class="code-example"><span class="keyword">&lt;ul&gt;</span>                          <span class="comment">&lt;!-- liste a puces --&gt;</span>
    <span class="keyword">&lt;li&gt;</span>Pomme<span class="keyword">&lt;/li&gt;</span>
    <span class="keyword">&lt;li&gt;</span>Banane<span class="keyword">&lt;/li&gt;</span>
<span class="keyword">&lt;/ul&gt;</span>

<span class="keyword">&lt;ol&gt;</span>                          <span class="comment">&lt;!-- liste numerotee --&gt;</span>
    <span class="keyword">&lt;li&gt;</span>Premier<span class="keyword">&lt;/li&gt;</span>
    <span class="keyword">&lt;li&gt;</span>Deuxieme<span class="keyword">&lt;/li&gt;</span>
<span class="keyword">&lt;/ol&gt;</span></div>

<p>On peut <strong>imbriquer</strong> des listes (liste dans une liste) :</p>
<div class="code-example"><span class="keyword">&lt;ul&gt;</span>
    <span class="keyword">&lt;li&gt;</span>Fruits
        <span class="keyword">&lt;ul&gt;</span>
            <span class="keyword">&lt;li&gt;</span>Pomme<span class="keyword">&lt;/li&gt;</span>
            <span class="keyword">&lt;li&gt;</span>Banane<span class="keyword">&lt;/li&gt;</span>
        <span class="keyword">&lt;/ul&gt;</span>
    <span class="keyword">&lt;/li&gt;</span>
<span class="keyword">&lt;/ul&gt;</span></div>

<p>Les <strong>tableaux</strong> utilisent plusieurs balises :</p>
<div class="code-example"><span class="keyword">&lt;table&gt;</span>
    <span class="keyword">&lt;caption&gt;</span>Notes des eleves<span class="keyword">&lt;/caption&gt;</span>
    <span class="keyword">&lt;thead&gt;</span>                      <span class="comment">&lt;!-- en-tete --&gt;</span>
        <span class="keyword">&lt;tr&gt;</span>
            <span class="keyword">&lt;th&gt;</span>Nom<span class="keyword">&lt;/th&gt;</span>
            <span class="keyword">&lt;th&gt;</span>Note<span class="keyword">&lt;/th&gt;</span>
        <span class="keyword">&lt;/tr&gt;</span>
    <span class="keyword">&lt;/thead&gt;</span>
    <span class="keyword">&lt;tbody&gt;</span>                      <span class="comment">&lt;!-- corps --&gt;</span>
        <span class="keyword">&lt;tr&gt;</span>
            <span class="keyword">&lt;td&gt;</span>Ahmed<span class="keyword">&lt;/td&gt;</span>
            <span class="keyword">&lt;td&gt;</span><span class="number">16</span><span class="keyword">&lt;/td&gt;</span>
        <span class="keyword">&lt;/tr&gt;</span>
    <span class="keyword">&lt;/tbody&gt;</span>
<span class="keyword">&lt;/table&gt;</span></div>

<p>&bull; <code>&lt;th&gt;</code> — cellule d'en-tete (gras et centree par defaut)</p>
<p>&bull; <code>&lt;td&gt;</code> — cellule de donnees</p>
<p>&bull; <code>colspan="2"</code> — fusionne 2 colonnes</p>

<div class="tip"><code>&lt;caption&gt;</code> doit etre le premier enfant de <code>&lt;table&gt;</code>. Il donne un titre au tableau, utile pour l'accessibilite.</div>`
    },
    {
        title: "Les formulaires",
        num: 5,
        lesson: `<p>Les <strong>formulaires</strong> permettent de recueillir des informations aupres de l'utilisateur.</p>

<div class="code-example"><span class="keyword">&lt;form</span> <span class="string">action="/traitement.php"</span> <span class="string">method="POST"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;label</span> <span class="string">for="nom"</span><span class="keyword">&gt;</span>Votre nom :<span class="keyword">&lt;/label&gt;</span>
    <span class="keyword">&lt;input</span> <span class="string">type="text"</span> <span class="string">id="nom"</span> <span class="string">name="nom"</span> <span class="string">placeholder="Entrez votre nom"</span><span class="keyword">&gt;</span>

    <span class="keyword">&lt;label</span> <span class="string">for="email"</span><span class="keyword">&gt;</span>Email :<span class="keyword">&lt;/label&gt;</span>
    <span class="keyword">&lt;input</span> <span class="string">type="email"</span> <span class="string">id="email"</span> <span class="string">name="email"</span> <span class="string">required</span><span class="keyword">&gt;</span>

    <span class="keyword">&lt;input</span> <span class="string">type="submit"</span> <span class="string">value="Envoyer"</span><span class="keyword">&gt;</span>
<span class="keyword">&lt;/form&gt;</span></div>

<p>&bull; <code>action</code> — l'URL ou les donnees sont envoyees</p>
<p>&bull; <code>method</code> — GET (dans l'URL) ou POST (dans le corps de la requete)</p>
<p>&bull; <code>name</code> — identifie le champ cote serveur (indispensable !)</p>

<p>Les principaux <strong>types d'input</strong> :</p>
<p>&bull; <code>text</code> — champ texte classique</p>
<p>&bull; <code>password</code> — masque la saisie</p>
<p>&bull; <code>email</code> — verifie le format email</p>
<p>&bull; <code>number</code> — accepte uniquement des nombres</p>
<p>&bull; <code>checkbox</code> — case a cocher</p>
<p>&bull; <code>radio</code> — bouton radio (un seul choix dans un groupe)</p>

<div class="code-example"><span class="comment">&lt;!-- Boutons radio : meme name = meme groupe --&gt;</span>
<span class="keyword">&lt;input</span> <span class="string">type="radio"</span> <span class="string">name="genre"</span> <span class="string">value="h"</span><span class="keyword">&gt;</span> Homme
<span class="keyword">&lt;input</span> <span class="string">type="radio"</span> <span class="string">name="genre"</span> <span class="string">value="f"</span><span class="keyword">&gt;</span> Femme</div>

<p>Autres elements de formulaire :</p>
<div class="code-example"><span class="keyword">&lt;textarea</span> <span class="string">name="message"</span> <span class="string">rows="4"</span><span class="keyword">&gt;&lt;/textarea&gt;</span>

<span class="keyword">&lt;select</span> <span class="string">name="pays"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;option</span> <span class="string">value="fr"</span><span class="keyword">&gt;</span>France<span class="keyword">&lt;/option&gt;</span>
    <span class="keyword">&lt;option</span> <span class="string">value="ma"</span><span class="keyword">&gt;</span>Maroc<span class="keyword">&lt;/option&gt;</span>
<span class="keyword">&lt;/select&gt;</span></div>

<div class="tip">L'attribut <code>for</code> du <code>&lt;label&gt;</code> doit correspondre a l'<code>id</code> de l'input. Cela permet de cliquer sur le label pour activer le champ.</div>`
    },
    {
        title: "HTML5 semantique",
        num: 6,
        lesson: `<p>Le <strong>HTML semantique</strong> consiste a utiliser des balises qui decrivent le <em>sens</em> du contenu, pas juste son apparence. C'est important pour :</p>
<p>&bull; L'<strong>accessibilite</strong> (lecteurs d'ecran)</p>
<p>&bull; Le <strong>SEO</strong> (meilleur referencement Google)</p>
<p>&bull; La <strong>lisibilite</strong> du code pour les developpeurs</p>

<div class="code-example"><span class="keyword">&lt;header&gt;</span>           <span class="comment">&lt;!-- en-tete du site / section --&gt;</span>
    <span class="keyword">&lt;nav&gt;</span>             <span class="comment">&lt;!-- barre de navigation --&gt;</span>
        <span class="keyword">&lt;a</span> <span class="string">href="/"</span><span class="keyword">&gt;</span>Accueil<span class="keyword">&lt;/a&gt;</span>
        <span class="keyword">&lt;a</span> <span class="string">href="/blog"</span><span class="keyword">&gt;</span>Blog<span class="keyword">&lt;/a&gt;</span>
    <span class="keyword">&lt;/nav&gt;</span>
<span class="keyword">&lt;/header&gt;</span>

<span class="keyword">&lt;main&gt;</span>              <span class="comment">&lt;!-- contenu principal (unique) --&gt;</span>
    <span class="keyword">&lt;article&gt;</span>        <span class="comment">&lt;!-- contenu autonome --&gt;</span>
        <span class="keyword">&lt;h2&gt;</span>Mon article<span class="keyword">&lt;/h2&gt;</span>
        <span class="keyword">&lt;p&gt;</span>Texte...<span class="keyword">&lt;/p&gt;</span>
    <span class="keyword">&lt;/article&gt;</span>

    <span class="keyword">&lt;section&gt;</span>        <span class="comment">&lt;!-- section thematique --&gt;</span>
        <span class="keyword">&lt;h2&gt;</span>Commentaires<span class="keyword">&lt;/h2&gt;</span>
    <span class="keyword">&lt;/section&gt;</span>

    <span class="keyword">&lt;aside&gt;</span>          <span class="comment">&lt;!-- contenu lateral / complementaire --&gt;</span>
        <span class="keyword">&lt;p&gt;</span>Publicite<span class="keyword">&lt;/p&gt;</span>
    <span class="keyword">&lt;/aside&gt;</span>
<span class="keyword">&lt;/main&gt;</span>

<span class="keyword">&lt;footer&gt;</span>            <span class="comment">&lt;!-- pied de page --&gt;</span>
    <span class="keyword">&lt;p&gt;</span>Copyright 2024<span class="keyword">&lt;/p&gt;</span>
<span class="keyword">&lt;/footer&gt;</span></div>

<p>Avant HTML5, on utilisait <code>&lt;div&gt;</code> pour tout. Maintenant, on prefere les balises semantiques :</p>
<p>&bull; <code>&lt;div&gt;</code> — conteneur generique, <strong>sans signification</strong></p>
<p>&bull; <code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>, <code>&lt;main&gt;</code>... — expliquent le <strong>role</strong> du contenu</p>

<div class="tip"><code>&lt;main&gt;</code> ne doit apparaitre qu'<strong>une seule fois</strong> par page. Il contient le contenu principal, en excluant l'en-tete, le pied de page et les barres laterales.</div>`
    },
    {
        title: "Multimedia et attributs globaux",
        num: 7,
        lesson: `<p>HTML5 permet d'integrer du <strong>son</strong> et de la <strong>video</strong> directement :</p>

<div class="code-example"><span class="keyword">&lt;video</span> <span class="string">controls</span> <span class="string">width="600"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;source</span> <span class="string">src="film.mp4"</span> <span class="string">type="video/mp4"</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;source</span> <span class="string">src="film.webm"</span> <span class="string">type="video/webm"</span><span class="keyword">&gt;</span>
    Votre navigateur ne supporte pas la video.
<span class="keyword">&lt;/video&gt;</span>

<span class="keyword">&lt;audio</span> <span class="string">controls</span><span class="keyword">&gt;</span>
    <span class="keyword">&lt;source</span> <span class="string">src="musique.mp3"</span> <span class="string">type="audio/mpeg"</span><span class="keyword">&gt;</span>
<span class="keyword">&lt;/audio&gt;</span></div>

<p>&bull; <code>controls</code> — affiche les boutons lecture/pause/volume</p>
<p>&bull; <code>autoplay</code> — lance automatiquement (souvent bloque par les navigateurs)</p>
<p>&bull; <code>loop</code> — joue en boucle</p>
<p>&bull; <code>&lt;source&gt;</code> — permet de proposer plusieurs formats</p>

<p>L'<strong>iframe</strong> integre une page externe dans votre page :</p>
<div class="code-example"><span class="keyword">&lt;iframe</span> <span class="string">src="https://www.youtube.com/embed/xxx"</span> <span class="string">width="560"</span> <span class="string">height="315"</span><span class="keyword">&gt;&lt;/iframe&gt;</span></div>

<p>Les <strong>attributs globaux</strong> fonctionnent sur toutes les balises :</p>
<p>&bull; <code>id</code> — identifiant <strong>unique</strong> (une seule fois par page)</p>
<p>&bull; <code>class</code> — nom de classe (peut etre reutilise sur plusieurs elements)</p>
<p>&bull; <code>style</code> — CSS en ligne</p>
<p>&bull; <code>title</code> — info-bulle au survol</p>
<p>&bull; <code>data-*</code> — attributs personnalises pour stocker des donnees</p>

<div class="code-example"><span class="keyword">&lt;div</span> <span class="string">id="menu"</span> <span class="string">class="nav-bar active"</span> <span class="string">data-page="accueil"</span><span class="keyword">&gt;</span>...<span class="keyword">&lt;/div&gt;</span></div>

<p>Pour inclure du <strong>CSS</strong> et du <strong>JavaScript</strong> :</p>
<div class="code-example"><span class="comment">&lt;!-- Dans le &lt;head&gt; : feuille de style --&gt;</span>
<span class="keyword">&lt;link</span> <span class="string">rel="stylesheet"</span> <span class="string">href="style.css"</span><span class="keyword">&gt;</span>

<span class="comment">&lt;!-- Avant &lt;/body&gt; : script JavaScript --&gt;</span>
<span class="keyword">&lt;script</span> <span class="string">src="app.js"</span><span class="keyword">&gt;&lt;/script&gt;</span></div>

<div class="tip">On place le <code>&lt;script&gt;</code> avant <code>&lt;/body&gt;</code> pour que la page se charge d'abord. Sinon le script bloque l'affichage tant qu'il n'est pas telecharge.</div>`
    }
];

// ========================
// QUESTIONS (50)
// ========================
const allQuestions = [
    // === CHAPITRE 1 : Les bases — structure d'une page HTML (8) ===
    {
        chapter: 0,
        question: "Que signifie HTML ?",
        options: ["Hyper Tool Markup Language", "HyperText Markup Language", "Home Text Making Language", "HyperText Machine Language"],
        answer: 1,
        explanation: "HTML signifie <strong>HyperText Markup Language</strong>. C'est le langage de balisage utilise pour structurer le contenu des pages web."
    },
    {
        chapter: 0,
        question: "A quoi sert la declaration <code>&lt;!DOCTYPE html&gt;</code> ?",
        options: ["Elle cree un commentaire", "Elle definit le titre de la page", "Elle indique au navigateur que c'est un document HTML5", "Elle importe une feuille de style"],
        answer: 2,
        explanation: "<code>&lt;!DOCTYPE html&gt;</code> indique au navigateur qu'il doit interpreter le document selon le standard <strong>HTML5</strong>. Sans cette declaration, le navigateur pourrait passer en mode \"quirks\"."
    },
    {
        chapter: 0,
        question: "Quelle est la difference entre <code>&lt;head&gt;</code> et <code>&lt;body&gt;</code> ?",
        options: [
            "<code>&lt;head&gt;</code> est pour le texte, <code>&lt;body&gt;</code> pour les images",
            "<code>&lt;head&gt;</code> contient les metadonnees, <code>&lt;body&gt;</code> le contenu visible",
            "Il n'y a aucune difference",
            "<code>&lt;head&gt;</code> est obligatoire, <code>&lt;body&gt;</code> est optionnel"
        ],
        answer: 1,
        explanation: "<code>&lt;head&gt;</code> contient les informations <strong>invisibles</strong> pour le navigateur (titre, encodage, CSS...). <code>&lt;body&gt;</code> contient tout le contenu <strong>visible</strong> sur la page."
    },
    {
        chapter: 0,
        question: "Comment ecrit-on une balise fermante en HTML ?",
        options: ["<code>&lt;p&gt;</code>", "<code>&lt;/p&gt;</code>", "<code>&lt;p/&gt;</code>", "<code>&lt;end p&gt;</code>"],
        answer: 1,
        explanation: "La balise fermante s'ecrit avec un <strong>slash</strong> avant le nom : <code>&lt;/p&gt;</code>. La balise ouvrante est <code>&lt;p&gt;</code> (sans slash)."
    },
    {
        chapter: 0,
        question: "Ou doit etre placee la balise <code>&lt;title&gt;</code> ?",
        options: ["Dans <code>&lt;body&gt;</code>", "Dans <code>&lt;head&gt;</code>", "Avant <code>&lt;html&gt;</code>", "Apres <code>&lt;/html&gt;</code>"],
        answer: 1,
        explanation: "<code>&lt;title&gt;</code> definit le texte affiche dans l'onglet du navigateur. Elle doit etre placee dans <code>&lt;head&gt;</code>, la section des metadonnees."
    },
    {
        chapter: 0,
        question: "Quelle est la syntaxe correcte d'un commentaire HTML ?",
        options: ["<code>// commentaire</code>", "<code>/* commentaire */</code>", "<code>&lt;!-- commentaire --&gt;</code>", "<code># commentaire</code>"],
        answer: 2,
        explanation: "En HTML, les commentaires s'ecrivent <code>&lt;!-- texte --&gt;</code>. Les autres syntaxes sont utilisees dans d'autres langages (JavaScript, CSS, Python)."
    },
    {
        chapter: 0,
        question: "A quoi sert <code>&lt;meta charset=\"UTF-8\"&gt;</code> ?",
        options: [
            "A definir la couleur du texte",
            "A definir l'encodage des caracteres (accents, symboles)",
            "A ajouter un mot de passe a la page",
            "A activer le mode mobile"
        ],
        answer: 1,
        explanation: "<code>&lt;meta charset=\"UTF-8\"&gt;</code> definit l'<strong>encodage</strong> de la page. UTF-8 permet d'afficher correctement les caracteres speciaux comme les accents (e, a, c...)."
    },
    {
        chapter: 0,
        question: "Qu'est-ce qu'une balise (tag) HTML ?",
        options: [
            "Un fichier image",
            "Un element de code entre chevrons qui structure le contenu",
            "Un langage de programmation",
            "Un outil pour dessiner"
        ],
        answer: 1,
        explanation: "Une balise HTML est un <strong>element entre chevrons</strong> (<code>&lt; &gt;</code>) qui indique au navigateur comment structurer et afficher le contenu. Exemple : <code>&lt;p&gt;</code>, <code>&lt;h1&gt;</code>, <code>&lt;div&gt;</code>."
    },

    // === CHAPITRE 2 : Le texte et les titres (7) ===
    {
        chapter: 1,
        question: "Quelle balise represente le titre le plus grand (principal) ?",
        options: ["<code>&lt;h6&gt;</code>", "<code>&lt;h1&gt;</code>", "<code>&lt;title&gt;</code>", "<code>&lt;header&gt;</code>"],
        answer: 1,
        explanation: "<code>&lt;h1&gt;</code> est le titre de <strong>plus haut niveau</strong> (le plus grand). <code>&lt;h6&gt;</code> est le plus petit. <code>&lt;title&gt;</code> est pour l'onglet du navigateur, pas le contenu de la page."
    },
    {
        chapter: 1,
        question: "Quelle est la difference entre <code>&lt;strong&gt;</code> et <code>&lt;b&gt;</code> ?",
        options: [
            "Aucune difference, ils font la meme chose",
            "<code>&lt;strong&gt;</code> a une valeur semantique (importance), <code>&lt;b&gt;</code> est juste visuel",
            "<code>&lt;b&gt;</code> est plus moderne",
            "<code>&lt;strong&gt;</code> met en italique"
        ],
        answer: 1,
        explanation: "<code>&lt;strong&gt;</code> indique un texte <strong>important</strong> (les lecteurs d'ecran le signalent). <code>&lt;b&gt;</code> met juste en gras visuellement, sans signification particuliere."
    },
    {
        chapter: 1,
        question: "La balise <code>&lt;br&gt;</code> a-t-elle besoin d'une balise fermante ?",
        options: ["Oui : <code>&lt;/br&gt;</code>", "Non, c'est une balise auto-fermante", "Oui : <code>&lt;br/&gt;</code> obligatoirement", "Elle n'existe pas"],
        answer: 1,
        explanation: "<code>&lt;br&gt;</code> est une balise <strong>auto-fermante</strong> (void element). Elle n'a pas de contenu donc pas besoin de <code>&lt;/br&gt;</code>. On peut ecrire <code>&lt;br&gt;</code> ou <code>&lt;br /&gt;</code>."
    },
    {
        chapter: 1,
        question: "A quoi sert la balise <code>&lt;p&gt;</code> ?",
        options: ["Creer un lien", "Definir un paragraphe de texte", "Inserer une image", "Creer un tableau"],
        answer: 1,
        explanation: "<code>&lt;p&gt;</code> definit un <strong>paragraphe</strong>. Le navigateur ajoute automatiquement un espace avant et apres chaque paragraphe."
    },
    {
        chapter: 1,
        question: "Comment le navigateur affiche-t-il le texte dans <code>&lt;em&gt;</code> par defaut ?",
        options: ["En gras", "En italique", "Souligne", "En majuscules"],
        answer: 1,
        explanation: "<code>&lt;em&gt;</code> (emphasis) est affiche en <em>italique</em> par defaut. Il indique un texte avec une <strong>accentuation</strong>, ce qui a aussi un sens pour les lecteurs d'ecran."
    },
    {
        chapter: 1,
        question: "A quoi sert la balise <code>&lt;hr&gt;</code> ?",
        options: ["Creer un lien hypertexte", "Afficher une ligne horizontale de separation", "Inserer un saut de ligne", "Definir un en-tete"],
        answer: 1,
        explanation: "<code>&lt;hr&gt;</code> (horizontal rule) affiche une <strong>ligne horizontale</strong> de separation. C'est une balise auto-fermante, utile pour separer visuellement des sections."
    },
    {
        chapter: 1,
        question: "Combien de niveaux de titres existent en HTML ?",
        options: ["3 (h1 a h3)", "4 (h1 a h4)", "6 (h1 a h6)", "10 (h1 a h10)"],
        answer: 2,
        explanation: "HTML propose <strong>6 niveaux</strong> de titres : <code>&lt;h1&gt;</code> (le plus important) a <code>&lt;h6&gt;</code> (le moins important). Il n'existe pas de <code>&lt;h7&gt;</code>."
    },

    // === CHAPITRE 3 : Les liens et les images (7) ===
    {
        chapter: 2,
        question: "Quelle balise permet de creer un lien hypertexte ?",
        options: ["<code>&lt;link&gt;</code>", "<code>&lt;a&gt;</code>", "<code>&lt;href&gt;</code>", "<code>&lt;url&gt;</code>"],
        answer: 1,
        explanation: "La balise <code>&lt;a&gt;</code> (anchor) cree un lien cliquable. <code>&lt;link&gt;</code> sert a lier des ressources externes (CSS) dans le <code>&lt;head&gt;</code>."
    },
    {
        chapter: 2,
        question: "A quoi sert l'attribut <code>href</code> dans un lien ?",
        options: [
            "Il definit la couleur du lien",
            "Il specifie l'adresse de destination du lien",
            "Il donne un titre au lien",
            "Il ouvre le lien dans un nouvel onglet"
        ],
        answer: 1,
        explanation: "<code>href</code> (HyperText Reference) contient l'<strong>URL de destination</strong>. Sans cet attribut, la balise <code>&lt;a&gt;</code> ne mene nulle part."
    },
    {
        chapter: 2,
        question: "Que fait l'attribut <code>target=\"_blank\"</code> sur un lien ?",
        options: [
            "Il masque le lien",
            "Il ouvre le lien dans un nouvel onglet",
            "Il supprime le lien",
            "Il change la couleur du lien en blanc"
        ],
        answer: 1,
        explanation: "<code>target=\"_blank\"</code> indique au navigateur d'ouvrir la page de destination dans un <strong>nouvel onglet</strong> ou une nouvelle fenetre."
    },
    {
        chapter: 2,
        question: "La balise <code>&lt;img&gt;</code> a-t-elle besoin d'une balise fermante ?",
        options: ["Oui : <code>&lt;/img&gt;</code>", "Non, c'est une balise auto-fermante", "Oui, obligatoirement", "Ca depend du navigateur"],
        answer: 1,
        explanation: "<code>&lt;img&gt;</code> est une balise <strong>auto-fermante</strong>. Elle n'a pas de contenu entre une ouverture et une fermeture. On ecrit simplement <code>&lt;img src=\"...\" alt=\"...\"&gt;</code>."
    },
    {
        chapter: 2,
        question: "A quoi sert l'attribut <code>alt</code> d'une image ?",
        options: [
            "A definir la taille de l'image",
            "A fournir un texte alternatif si l'image ne s'affiche pas (et pour l'accessibilite)",
            "A ajouter un lien a l'image",
            "A changer le format de l'image"
        ],
        answer: 1,
        explanation: "<code>alt</code> fournit un <strong>texte de remplacement</strong>. Il s'affiche quand l'image ne charge pas, et les lecteurs d'ecran le lisent pour les personnes malvoyantes. C'est essentiel pour l'accessibilite."
    },
    {
        chapter: 2,
        question: "Quelle est la difference entre une URL absolue et une URL relative ?",
        options: [
            "Il n'y a aucune difference",
            "L'absolue contient l'adresse complete (https://...), la relative est un chemin local",
            "L'absolue est plus rapide",
            "La relative ne fonctionne pas en HTML"
        ],
        answer: 1,
        explanation: "Une URL <strong>absolue</strong> est l'adresse complete (<code>https://example.com/page.html</code>). Une URL <strong>relative</strong> est un chemin par rapport a la page actuelle (<code>images/photo.jpg</code>)."
    },
    {
        chapter: 2,
        question: "A quoi servent <code>&lt;figure&gt;</code> et <code>&lt;figcaption&gt;</code> ?",
        options: [
            "A creer un formulaire",
            "A associer une image (ou illustration) avec sa legende",
            "A creer un tableau",
            "A inserer une video"
        ],
        answer: 1,
        explanation: "<code>&lt;figure&gt;</code> encadre un contenu autonome (image, graphique...) et <code>&lt;figcaption&gt;</code> y ajoute une <strong>legende</strong>. C'est une bonne pratique semantique."
    },

    // === CHAPITRE 4 : Les listes et les tableaux (7) ===
    {
        chapter: 3,
        question: "Quelle est la difference entre <code>&lt;ul&gt;</code> et <code>&lt;ol&gt;</code> ?",
        options: [
            "<code>&lt;ul&gt;</code> est pour les tableaux, <code>&lt;ol&gt;</code> pour les listes",
            "<code>&lt;ul&gt;</code> = liste a puces (non ordonnee), <code>&lt;ol&gt;</code> = liste numerotee (ordonnee)",
            "Il n'y a aucune difference",
            "<code>&lt;ol&gt;</code> est obsolete"
        ],
        answer: 1,
        explanation: "<code>&lt;ul&gt;</code> (unordered list) affiche des <strong>puces</strong>. <code>&lt;ol&gt;</code> (ordered list) affiche des <strong>numeros</strong>. Les deux contiennent des elements <code>&lt;li&gt;</code>."
    },
    {
        chapter: 3,
        question: "Dans quelle balise doit se trouver un element <code>&lt;li&gt;</code> ?",
        options: [
            "Dans <code>&lt;div&gt;</code>",
            "Dans <code>&lt;ul&gt;</code> ou <code>&lt;ol&gt;</code>",
            "Dans <code>&lt;table&gt;</code>",
            "N'importe ou"
        ],
        answer: 1,
        explanation: "<code>&lt;li&gt;</code> (list item) doit etre un enfant direct de <code>&lt;ul&gt;</code> ou <code>&lt;ol&gt;</code>. Le placer ailleurs est invalide selon le standard HTML."
    },
    {
        chapter: 3,
        question: "Quelle est la difference entre <code>&lt;th&gt;</code> et <code>&lt;td&gt;</code> ?",
        options: [
            "Aucune difference",
            "<code>&lt;th&gt;</code> = cellule d'en-tete (gras/centree), <code>&lt;td&gt;</code> = cellule de donnees",
            "<code>&lt;th&gt;</code> est pour le texte, <code>&lt;td&gt;</code> pour les nombres",
            "<code>&lt;td&gt;</code> n'existe pas"
        ],
        answer: 1,
        explanation: "<code>&lt;th&gt;</code> (table header) est une cellule d'<strong>en-tete</strong>, affichee en gras et centree par defaut. <code>&lt;td&gt;</code> (table data) est une cellule de <strong>donnees</strong> classique."
    },
    {
        chapter: 3,
        question: "A quoi sert l'attribut <code>colspan</code> dans un tableau ?",
        options: [
            "A ajouter une couleur a la cellule",
            "A fusionner une cellule sur plusieurs colonnes",
            "A supprimer une colonne",
            "A trier le tableau"
        ],
        answer: 1,
        explanation: "<code>colspan=\"2\"</code> fait en sorte qu'une cellule s'etende sur <strong>2 colonnes</strong>. De meme, <code>rowspan</code> fusionne sur plusieurs lignes."
    },
    {
        chapter: 3,
        question: "Comment imbrique-t-on une liste dans une autre ?",
        options: [
            "On place un <code>&lt;ul&gt;</code> directement dans un <code>&lt;li&gt;</code>",
            "On place un <code>&lt;ul&gt;</code> apres <code>&lt;/ul&gt;</code>",
            "C'est impossible en HTML",
            "On utilise <code>&lt;sublist&gt;</code>"
        ],
        answer: 0,
        explanation: "Pour imbriquer une liste, on place la nouvelle <code>&lt;ul&gt;</code> (ou <code>&lt;ol&gt;</code>) <strong>a l'interieur</strong> d'un <code>&lt;li&gt;</code> de la liste parente."
    },
    {
        chapter: 3,
        question: "A quoi sert <code>&lt;thead&gt;</code> dans un tableau ?",
        options: [
            "A ajouter un titre au tableau",
            "A grouper les lignes d'en-tete du tableau",
            "A fusionner des cellules",
            "A supprimer l'en-tete"
        ],
        answer: 1,
        explanation: "<code>&lt;thead&gt;</code> regroupe les lignes d'<strong>en-tete</strong> du tableau. Il est utilise avec <code>&lt;tbody&gt;</code> (corps) et <code>&lt;tfoot&gt;</code> (pied) pour structurer le tableau."
    },
    {
        chapter: 3,
        question: "Ou doit etre placee la balise <code>&lt;caption&gt;</code> dans un tableau ?",
        options: [
            "Apres <code>&lt;/table&gt;</code>",
            "Juste apres <code>&lt;table&gt;</code>, comme premier enfant",
            "Dans <code>&lt;thead&gt;</code>",
            "Dans <code>&lt;td&gt;</code>"
        ],
        answer: 1,
        explanation: "<code>&lt;caption&gt;</code> doit etre le <strong>premier enfant</strong> de <code>&lt;table&gt;</code>. Elle donne un titre descriptif au tableau, utile pour l'accessibilite."
    },

    // === CHAPITRE 5 : Les formulaires (8) ===
    {
        chapter: 4,
        question: "A quoi sert l'attribut <code>action</code> d'un formulaire ?",
        options: [
            "A definir le style du formulaire",
            "A specifier l'URL ou les donnees seront envoyees",
            "A valider les champs",
            "A afficher un message d'erreur"
        ],
        answer: 1,
        explanation: "L'attribut <code>action</code> definit l'<strong>URL de destination</strong> ou les donnees du formulaire seront envoyees quand l'utilisateur clique sur \"Envoyer\"."
    },
    {
        chapter: 4,
        question: "Que cree <code>&lt;input type=\"text\"&gt;</code> ?",
        options: [
            "Un bouton",
            "Un champ de saisie de texte sur une ligne",
            "Une zone de texte multiligne",
            "Un paragraphe"
        ],
        answer: 1,
        explanation: "<code>&lt;input type=\"text\"&gt;</code> cree un <strong>champ de saisie</strong> sur une seule ligne. Pour plusieurs lignes, on utilise <code>&lt;textarea&gt;</code>."
    },
    {
        chapter: 4,
        question: "A quoi sert l'attribut <code>for</code> de la balise <code>&lt;label&gt;</code> ?",
        options: [
            "A definir la couleur du label",
            "A lier le label a un input via son id",
            "A rendre le champ obligatoire",
            "A definir la taille du texte"
        ],
        answer: 1,
        explanation: "L'attribut <code>for</code> doit correspondre a l'<code>id</code> de l'input. Cela permet de <strong>cliquer sur le label</strong> pour activer le champ, et ameliore l'accessibilite."
    },
    {
        chapter: 4,
        question: "Quelle est la difference entre <code>&lt;textarea&gt;</code> et <code>&lt;input type=\"text\"&gt;</code> ?",
        options: [
            "Aucune difference",
            "<code>&lt;textarea&gt;</code> permet la saisie multiligne, <code>&lt;input&gt;</code> est sur une seule ligne",
            "<code>&lt;input&gt;</code> est multiligne",
            "<code>&lt;textarea&gt;</code> est pour les mots de passe"
        ],
        answer: 1,
        explanation: "<code>&lt;textarea&gt;</code> cree une zone de texte <strong>multiligne</strong> (redimensionnable). <code>&lt;input type=\"text\"&gt;</code> est un champ sur <strong>une seule ligne</strong>."
    },
    {
        chapter: 4,
        question: "Comment cree-t-on une liste deroulante en HTML ?",
        options: [
            "<code>&lt;input type=\"list\"&gt;</code>",
            "<code>&lt;select&gt;</code> avec des <code>&lt;option&gt;</code>",
            "<code>&lt;dropdown&gt;</code>",
            "<code>&lt;ul type=\"dropdown\"&gt;</code>"
        ],
        answer: 1,
        explanation: "On utilise <code>&lt;select&gt;</code> qui contient des <code>&lt;option&gt;</code> pour chaque choix. Exemple : <code>&lt;select&gt;&lt;option&gt;France&lt;/option&gt;&lt;/select&gt;</code>."
    },
    {
        chapter: 4,
        question: "Que fait l'attribut <code>required</code> sur un champ de formulaire ?",
        options: [
            "Il masque le champ",
            "Il rend le champ obligatoire (le formulaire ne s'enverra pas s'il est vide)",
            "Il desactive le champ",
            "Il ajoute une valeur par defaut"
        ],
        answer: 1,
        explanation: "<code>required</code> empeche l'envoi du formulaire si le champ est <strong>vide</strong>. Le navigateur affiche automatiquement un message d'erreur."
    },
    {
        chapter: 4,
        question: "Pourquoi l'attribut <code>name</code> est-il important dans un formulaire ?",
        options: [
            "Il definit le texte affiche dans le champ",
            "Il identifie la donnee cote serveur lors de l'envoi",
            "Il change la couleur du champ",
            "Il n'est pas necessaire"
        ],
        answer: 1,
        explanation: "L'attribut <code>name</code> est la <strong>cle</strong> utilisee cote serveur pour recuperer la valeur. Sans <code>name</code>, la donnee du champ n'est pas envoyee."
    },
    {
        chapter: 4,
        question: "Comment s'assurer que des boutons radio soient mutuellement exclusifs ?",
        options: [
            "En leur donnant le meme <code>id</code>",
            "En leur donnant le meme attribut <code>name</code>",
            "En utilisant <code>type=\"single\"</code>",
            "C'est automatique, pas besoin de configuration"
        ],
        answer: 1,
        explanation: "Les boutons radio avec le <strong>meme <code>name</code></strong> forment un groupe. Un seul peut etre selectionne a la fois dans ce groupe."
    },

    // === CHAPITRE 6 : HTML5 semantique (6) ===
    {
        chapter: 5,
        question: "Quel est l'interet principal du HTML semantique ?",
        options: [
            "Il rend la page plus rapide",
            "Il ameliore l'accessibilite, le SEO et la lisibilite du code",
            "Il remplace le CSS",
            "Il ajoute des animations"
        ],
        answer: 1,
        explanation: "Le HTML semantique aide les <strong>lecteurs d'ecran</strong> a comprendre la structure, ameliore le <strong>referencement</strong> (SEO) et rend le code plus <strong>lisible</strong> pour les developpeurs."
    },
    {
        chapter: 5,
        question: "A quoi sert la balise <code>&lt;nav&gt;</code> ?",
        options: [
            "A creer un nouveau paragraphe",
            "A definir une zone de navigation (liens de menu)",
            "A inserer une image",
            "A creer un formulaire"
        ],
        answer: 1,
        explanation: "<code>&lt;nav&gt;</code> encadre les <strong>liens de navigation</strong> principaux du site (menu, barre de navigation). Les lecteurs d'ecran peuvent sauter directement a cette section."
    },
    {
        chapter: 5,
        question: "A quoi sert la balise <code>&lt;main&gt;</code> ?",
        options: [
            "A definir l'en-tete du site",
            "A contenir le contenu principal unique de la page",
            "A creer un pied de page",
            "A definir un menu lateral"
        ],
        answer: 1,
        explanation: "<code>&lt;main&gt;</code> contient le <strong>contenu principal</strong> de la page. Il ne doit y en avoir qu'<strong>un seul</strong> par page, excluant les en-tetes, pieds de page et barres laterales."
    },
    {
        chapter: 5,
        question: "Quelle est la difference entre <code>&lt;article&gt;</code> et <code>&lt;section&gt;</code> ?",
        options: [
            "Aucune difference",
            "<code>&lt;article&gt;</code> = contenu autonome (blog post), <code>&lt;section&gt;</code> = regroupement thematique",
            "<code>&lt;section&gt;</code> est obsolete",
            "<code>&lt;article&gt;</code> est pour les images uniquement"
        ],
        answer: 1,
        explanation: "<code>&lt;article&gt;</code> est un contenu <strong>autonome</strong> (un article de blog, un commentaire). <code>&lt;section&gt;</code> regroupe des contenus lies par un <strong>meme theme</strong>."
    },
    {
        chapter: 5,
        question: "A quoi sert la balise <code>&lt;aside&gt;</code> ?",
        options: [
            "A creer un bouton",
            "A definir un contenu lateral ou complementaire",
            "A inserer un lien",
            "A definir le titre de la page"
        ],
        answer: 1,
        explanation: "<code>&lt;aside&gt;</code> contient du contenu <strong>complementaire</strong> au contenu principal : barre laterale, publicites, liens connexes, encadres d'information."
    },
    {
        chapter: 5,
        question: "Pourquoi preferer les balises semantiques a <code>&lt;div&gt;</code> ?",
        options: [
            "<code>&lt;div&gt;</code> ne fonctionne plus en HTML5",
            "Les balises semantiques sont plus rapides",
            "Les balises semantiques donnent du sens au contenu (accessibilite, SEO), <code>&lt;div&gt;</code> est generique",
            "<code>&lt;div&gt;</code> est interdit en HTML5"
        ],
        answer: 2,
        explanation: "<code>&lt;div&gt;</code> est un conteneur <strong>sans signification</strong>. Les balises semantiques (<code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>...) expliquent le <strong>role</strong> du contenu, ce qui aide l'accessibilite et le SEO."
    },

    // === CHAPITRE 7 : Multimedia et attributs globaux (7) ===
    {
        chapter: 6,
        question: "A quoi sert l'attribut <code>controls</code> sur une balise <code>&lt;video&gt;</code> ?",
        options: [
            "A lire la video automatiquement",
            "A afficher les boutons de lecture, pause et volume",
            "A mettre la video en plein ecran",
            "A desactiver le son"
        ],
        answer: 1,
        explanation: "L'attribut <code>controls</code> affiche l'<strong>interface de controle</strong> (lecture, pause, volume, barre de progression). Sans cet attribut, l'utilisateur ne peut pas interagir avec la video."
    },
    {
        chapter: 6,
        question: "Quelle balise permet d'integrer du son dans une page HTML5 ?",
        options: ["<code>&lt;sound&gt;</code>", "<code>&lt;audio&gt;</code>", "<code>&lt;music&gt;</code>", "<code>&lt;mp3&gt;</code>"],
        answer: 1,
        explanation: "<code>&lt;audio&gt;</code> est la balise HTML5 pour integrer du son. On peut y ajouter <code>controls</code>, <code>autoplay</code> et <code>loop</code>."
    },
    {
        chapter: 6,
        question: "A quoi sert la balise <code>&lt;iframe&gt;</code> ?",
        options: [
            "A creer un cadre photo",
            "A integrer une page web externe dans votre page",
            "A inserer une image",
            "A definir un formulaire"
        ],
        answer: 1,
        explanation: "<code>&lt;iframe&gt;</code> permet d'<strong>incorporer</strong> une autre page web dans la votre. C'est couramment utilise pour integrer des videos YouTube, des cartes Google Maps, etc."
    },
    {
        chapter: 6,
        question: "Quelle est la difference entre <code>id</code> et <code>class</code> ?",
        options: [
            "Aucune difference",
            "<code>id</code> est unique sur la page, <code>class</code> peut etre reutilisee sur plusieurs elements",
            "<code>class</code> est unique, <code>id</code> est reutilisable",
            "<code>id</code> est pour le CSS, <code>class</code> pour JavaScript"
        ],
        answer: 1,
        explanation: "<code>id</code> doit etre <strong>unique</strong> sur la page (un seul element). <code>class</code> peut etre utilisee sur <strong>plusieurs elements</strong> pour leur appliquer le meme style."
    },
    {
        chapter: 6,
        question: "Comment lie-t-on une feuille de style CSS externe a une page HTML ?",
        options: [
            "<code>&lt;style src=\"style.css\"&gt;</code>",
            "<code>&lt;link rel=\"stylesheet\" href=\"style.css\"&gt;</code>",
            "<code>&lt;css href=\"style.css\"&gt;</code>",
            "<code>&lt;script src=\"style.css\"&gt;</code>"
        ],
        answer: 1,
        explanation: "<code>&lt;link rel=\"stylesheet\" href=\"style.css\"&gt;</code> lie une feuille de style externe. Elle se place dans le <code>&lt;head&gt;</code>."
    },
    {
        chapter: 6,
        question: "Ou est-il recommande de placer la balise <code>&lt;script&gt;</code> ?",
        options: [
            "Dans <code>&lt;head&gt;</code> uniquement",
            "Juste avant <code>&lt;/body&gt;</code> (fin du body)",
            "Avant <code>&lt;!DOCTYPE html&gt;</code>",
            "Apres <code>&lt;/html&gt;</code>"
        ],
        answer: 1,
        explanation: "On place <code>&lt;script&gt;</code> juste avant <code>&lt;/body&gt;</code> pour que la page <strong>se charge d'abord</strong>. Sinon, le script bloque l'affichage le temps de son telechargement."
    },
    {
        chapter: 6,
        question: "A quoi servent les attributs <code>data-*</code> ?",
        options: [
            "A creer des bases de donnees",
            "A stocker des donnees personnalisees sur un element HTML",
            "A telecharger des fichiers",
            "A definir le type de donnees d'un formulaire"
        ],
        answer: 1,
        explanation: "Les attributs <code>data-*</code> permettent de stocker des <strong>informations personnalisees</strong> sur n'importe quel element HTML. Exemple : <code>data-user-id=\"42\"</code>. On y accede en JavaScript via <code>element.dataset</code>."
    }
];

// ========================
// QUIZ ENGINE
// ========================
let state = 'start';        // start, lesson, question, pause, results
let currentChapter = 0;
let currentQInChapter = 0;
let globalQIndex = 0;
let score = 0;
let chapterScore = 0;
let chapterTotal = 0;
let selectedOption = -1;
let answered = false;
let answers = [];
let chapterQuestions = [];

function getChapterQuestions(chapterIdx) {
    return allQuestions.filter(q => q.chapter === chapterIdx);
}


let timerInterval = null;
let timerSeconds = 0;

function startTimer() {
    timerSeconds = 0;
    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        timerSeconds++;
        const m = String(Math.floor(timerSeconds / 60)).padStart(2, '0');
        const s = String(timerSeconds % 60).padStart(2, '0');
        document.getElementById('timer').textContent = m + ':' + s;
    }, 1000);
}

function stopTimer() {
    clearInterval(timerInterval);
}

function startQuiz(resumeChapter = 0, resumeScore = 0, resumeTotal = 0) {
    currentChapter = resumeChapter;
    globalQIndex = resumeTotal;
    score = resumeScore;
    answers = [];
    document.getElementById('start-screen').style.display = 'none';
    document.getElementById('quiz-area').style.display = 'block';
    document.getElementById('results').style.display = 'none';
    showLesson();
    startTimer();
}

function updateProgress() {
    const total = allQuestions.length;
    document.getElementById('progress-text').textContent = `Question ${globalQIndex} / ${total} — Chapitre ${currentChapter + 1} / ${chapters.length}`;
    document.getElementById('progress-fill').style.width = (globalQIndex / total * 100) + '%';
}

function hideAllButtons() {
    document.getElementById('btn-validate').style.display = 'none';
    document.getElementById('btn-next').style.display = 'none';
    document.getElementById('btn-start-chapter').style.display = 'none';
}

// Show lesson before chapter
function showLesson() {
    state = 'lesson';
    chapterScore = 0;
    chapterQuestions = getChapterQuestions(currentChapter);
    chapterTotal = chapterQuestions.length;
    currentQInChapter = 0;
    updateProgress();

    const ch = chapters[currentChapter];
    document.getElementById('content-area').innerHTML = `
        <div class="lesson-card">
            <div class="chapter-num">Chapitre ${ch.num} sur ${chapters.length}</div>
            <h2>${ch.title}</h2>
            ${ch.lesson}
        </div>`;

    hideAllButtons();
    document.getElementById('btn-start-chapter').style.display = 'inline-block';
}

function startChapter() {
    showQuestion();
}

function showQuestion() {
    state = 'question';
    selectedOption = -1;
    answered = false;
    updateProgress();

    const q = chapterQuestions[currentQInChapter];

    let html = `<div class="question-card">`;
    html += `<span class="category-badge">${chapters[currentChapter].title}</span>`;
    html += `<div class="question-text">${q.question}</div>`;
    html += '<ul class="options">';
    q.options.forEach((opt, i) => {
        html += `<li onclick="selectOption(${i})" id="opt-${i}">${opt}</li>`;
    });
    html += '</ul>';
    html += `<div class="explanation" id="explanation">${q.explanation}</div>`;
    html += '</div>';

    document.getElementById('content-area').innerHTML = html;
    hideAllButtons();
    document.getElementById('btn-validate').style.display = 'inline-block';
    document.getElementById('btn-validate').disabled = true;
}

function selectOption(i) {
    if (answered) return;
    selectedOption = i;
    document.getElementById('btn-validate').disabled = false;
    document.querySelectorAll('.options li').forEach((el, idx) => {
        el.classList.toggle('selected', idx === i);
    });
}

function validateAnswer() {
    if (selectedOption === -1 || answered) return;
    answered = true;

    const q = chapterQuestions[currentQInChapter];
    const correct = q.answer;
    const isCorrect = selectedOption === correct;

    if (isCorrect) { score++; chapterScore++; }
    answers.push({ question: q, chapter: currentChapter, selected: selectedOption, correct: isCorrect });
    globalQIndex++;

    document.querySelectorAll('.options li').forEach((el, idx) => {
        el.classList.add('disabled');
        if (idx === correct) el.classList.add('correct');
        if (idx === selectedOption && !isCorrect) el.classList.add('wrong');
    });

    document.getElementById('explanation').style.display = 'block';
    hideAllButtons();
    document.getElementById('btn-next').style.display = 'inline-block';
}

function next() {
    currentQInChapter++;

    if (currentQInChapter >= chapterTotal) {
        // Chapter done
        if (currentChapter < chapters.length - 1) {
            showPause();
        } else {
            showResults();
        }
    } else {
        showQuestion();
    }
}

// Pause between chapters
function showPause() {
    state = 'pause';
    updateProgress();

    const pct = Math.round(chapterScore / chapterTotal * 100);
    let color = '#e74c3c';
    let emoji = '';
    if (pct >= 80) { color = '#27ae60'; emoji = 'Tres bien !'; }
    else if (pct >= 60) { color = '#2980b9'; emoji = 'Pas mal !'; }
    else if (pct >= 40) { color = '#f39c12'; emoji = 'A revoir.'; }
    else { color = '#e74c3c'; emoji = 'Relisez la lecon.'; }

    const nextCh = chapters[currentChapter + 1];

    document.getElementById('content-area').innerHTML = `
        <div class="lesson-card">
            <div class="chapter-num">Fin du chapitre ${currentChapter + 1}</div>
            <h2>Pause — Bilan du chapitre</h2>

            <div class="chapter-score">
                <div class="score-box">
                    <div class="num" style="color:${color}">${chapterScore}/${chapterTotal}</div>
                    <div class="lbl">Bonnes reponses</div>
                </div>
                <div class="score-box">
                    <div class="num" style="color:${color}">${pct}%</div>
                    <div class="lbl">${emoji}</div>
                </div>
            </div>

            <p style="text-align:center;margin-top:20px">Prochain chapitre : <strong>${nextCh.title}</strong></p>
            <p style="text-align:center;color:#888">Prenez le temps de relire la lecon precedente si besoin avant de continuer.</p>
            <div style="display:flex;justify-content:center;gap:14px;margin-top:28px;flex-wrap:wrap">
                <button class="btn btn-primary" id="btn-continue-chapter">Chapitre suivant</button>
                <button class="btn btn-restart" id="btn-stop-here">Arreter ici pour le moment</button>
            </div>
        </div>`;

    hideAllButtons();

    document.getElementById('btn-continue-chapter').onclick = function() {
        currentChapter++;
        showLesson();
    };

    document.getElementById('btn-stop-here').onclick = function() {
        // Save progress and go back to dashboard
        fetch('/api/progress', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
            body: JSON.stringify({
                qcm_name: 'qcm-html',
                chapter_completed: currentChapter + 1,
                total_chapters: chapters.length,
                score_so_far: score,
                total_so_far: globalQIndex
            })
        }).then(() => {
            window.location.href = '/dashboard';
        });
    };
}

function showResults() {
    stopTimer();
    document.getElementById('quiz-area').style.display = 'none';
    const resultsDiv = document.getElementById('results');
    resultsDiv.style.display = 'block';

    const total = allQuestions.length;
    const pct = Math.round(score / total * 100);

    let levelClass, message, detail;
    if (pct >= 80) {
        levelClass = 'level-excellent';
        message = 'Excellent ! Vous maitrisez les bases de HTML.';
        detail = 'Vous etes pret pour approfondir CSS et JavaScript.';
    } else if (pct >= 60) {
        levelClass = 'level-good';
        message = 'Bon travail ! Les bases sont la.';
        detail = 'Relisez les chapitres ou vous avez eu des difficultes.';
    } else if (pct >= 40) {
        levelClass = 'level-average';
        message = 'C\'est un debut. Continuez !';
        detail = 'Reprenez chaque chapitre un par un.';
    } else {
        levelClass = 'level-weak';
        message = 'Ne vous decouragez pas !';
        detail = 'HTML est le fondement du web. Relisez les lecons et recommencez.';
    }

    // Per-chapter stats
    let catHtml = '<div class="cat-scores">';
    chapters.forEach((ch, idx) => {
        const chAnswers = answers.filter(a => a.chapter === idx);
        const chCorrect = chAnswers.filter(a => a.correct).length;
        const chTotal = chAnswers.length;
        const p = chTotal > 0 ? Math.round(chCorrect / chTotal * 100) : 0;
        let color = '#e74c3c';
        if (p >= 80) color = '#27ae60';
        else if (p >= 60) color = '#2980b9';
        else if (p >= 40) color = '#f39c12';
        catHtml += `
            <div class="cat-score-card">
                <div class="cat-name">Ch.${idx+1} ${ch.title.split(':')[0]}</div>
                <div class="cat-pct" style="color:${color}">${p}%</div>
                <div class="cat-detail">${chCorrect}/${chTotal}</div>
            </div>`;
    });
    catHtml += '</div>';

    // Find weakest
    let weakest = null, weakPct = 101;
    chapters.forEach((ch, idx) => {
        const chAnswers = answers.filter(a => a.chapter === idx);
        const chCorrect = chAnswers.filter(a => a.correct).length;
        const p = chAnswers.length > 0 ? (chCorrect / chAnswers.length * 100) : 0;
        if (p < weakPct) { weakPct = p; weakest = ch.title; }
    });

    let advice = '';
    if (weakPct < 60 && weakest) {
        advice = `<p style="text-align:center;color:#e44d26;margin-top:10px">A retravailler en priorite : <strong>${weakest}</strong></p>`;
    }

    resultsDiv.innerHTML = `
        <div class="score-circle ${levelClass}">
            ${pct}%
            <span class="label">${score}/${total}</span>
        </div>
        <div class="level-message">${message}</div>
        <div class="level-detail">${detail}</div>
        ${catHtml}
        ${advice}
        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Recommencer</button>
            <button class="btn btn-restart" onclick="retryFailed()" style="margin-left:10px">Retravailler mes erreurs</button>
            <button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">Accueil</button>
        </div>
    `;

    // Delete progress (quiz completed)
    fetch('/api/progress', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({ qcm_name: 'qcm-html', chapter_completed: -1, total_chapters: chapters.length })
    });

    // Save score
    fetch('/api/scores', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({
            qcm_name: 'qcm-html',
            score: score,
            total: total,
            percentage: pct,
            duration_seconds: timerSeconds
        })
    });
}

function retryFailed() {
    const failed = answers.filter(a => !a.correct);
    if (failed.length === 0) { alert('Aucune erreur ! Bravo !'); return; }
    allQuestions.length = 0;
    failed.forEach((f, i) => {
        const q = Object.assign({}, f.question);
        q.chapter = 0;
        allQuestions.push(q);
    });
    chapters.length = 0;
    chapters.push({title: 'Revision des erreurs', num: 1, lesson: '<p>Vous allez revoir les <strong>' + failed.length + ' questions</strong> que vous avez ratees. Prenez le temps de bien lire les explications cette fois-ci.</p>'});
    startQuiz();
}

// Check for saved progress on page load
fetch('/api/progress/qcm-html')
    .then(r => r.json())
    .then(data => {
        if (data.found && data.chapter_completed < data.total_chapters) {
            document.getElementById('resume-banner').style.display = 'block';
            document.getElementById('resume-info').textContent = 'Chapitre ' + data.chapter_completed + ' / ' + data.total_chapters + ' complete (' + data.score_so_far + '/' + data.total_so_far + ' bonnes reponses)';
            document.getElementById('btn-resume').onclick = function() {
                startQuiz(data.chapter_completed, data.score_so_far, data.total_so_far);
            };
        }
    });
</script>

@endsection
