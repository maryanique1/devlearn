@extends('layouts.app')
@section('title', 'Apprendre CSS - QCM Progressif')

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
            color: #2965f1;
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
            background: linear-gradient(90deg, #2965f1, #1B3F8B);
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
            background: #2965f1;
            color: #ffffff;
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

        .options li:hover { border-color: #2965f1; background: rgba(0,100,200,0.08); }
        .options li.selected { border-color: #2965f1; background: rgba(137,111,61,0.12); }
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
            border-left: 4px solid #2965f1;
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

        .btn-primary { background: #2965f1; color: #ffffff; font-weight: bold; }
        .btn-primary:hover { background: #1B3F8B; }
        .btn-primary:disabled { background: #555; color: #999; cursor: not-allowed; }
        .btn-restart { background: var(--bg-input); color: var(--text-main); border: 1px solid var(--border-subtle); }
        .btn-restart:hover { background: #1a4a80; }

        .btn-container { text-align: center; margin-top: 20px; }

        /* Lesson card (pause between chapters) */
        .lesson-card {
            background: linear-gradient(135deg, var(--bg-card), var(--bg-input));
            border: 2px solid #2965f133;
            border-radius: 16px;
            padding: 35px;
            margin-bottom: 20px;
        }

        .lesson-card h2 {
            color: #2965f1;
            margin-bottom: 8px;
            font-size: 22px;
        }

        .lesson-card .chapter-num {
            color: #2965f1;
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
            border: 1px solid #2965f133;
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
            background: #2965f115;
            border-left: 3px solid #2965f1;
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

        .cat-score-card .cat-name { font-size: 12px; font-weight: bold; margin-bottom: 8px; color: #2965f1; }
        .cat-score-card .cat-pct { font-size: 28px; font-weight: bold; }
        .cat-score-card .cat-detail { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

        /* Start screen */
        .start-screen { overflow-wrap: break-word; text-align: center; padding: 40px 20px; }
        .start-screen p { color: var(--text-muted); margin: 15px 0; line-height: 1.6; }

        .js-logo {
            overflow: hidden;
            font-size: 36px;
            font-weight: bold;
            color: #ffffff;
            background: #2965f1;
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
            color: #2965f1;
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
    <h1>Apprendre CSS</h1>
    <p class="subtitle">QCM progressif &bull; 50 questions &bull; 7 chapitres</p>

    <!-- Start screen -->
    <div id="start-screen" class="start-screen">
        <div class="js-logo">CSS</div>
        <p>Un parcours d'apprentissage complet pour decouvrir CSS depuis zero.<br>
        Chaque chapitre commence par une <strong>mini-lecon</strong>, puis vous testez vos connaissances.</p>

        <div class="roadmap">
            <div class="step"><span class="dot">1</span> Les bases : selecteurs et proprietes (8 questions)</div>
            <div class="step"><span class="dot">2</span> Le modele de boite — Box Model (7 questions)</div>
            <div class="step"><span class="dot">3</span> Flexbox (8 questions)</div>
            <div class="step"><span class="dot">4</span> CSS Grid (7 questions)</div>
            <div class="step"><span class="dot">5</span> Positionnement (6 questions)</div>
            <div class="step"><span class="dot">6</span> Responsive design (7 questions)</div>
            <div class="step"><span class="dot">7</span> Transitions et animations (7 questions)</div>
        </div>

        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Commencer l'apprentissage</button>
        </div>
        <div id="resume-banner" style="display:none; margin-top:20px; background:var(--bg-card); border:2px solid #2965f1; border-radius:12px; padding:20px; text-align:center;">
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
        title: "Les bases : selecteurs et proprietes",
        num: 1,
        lesson: `<p><strong>CSS</strong> (Cascading Style Sheets) est le langage qui met en forme les pages HTML. Il controle les couleurs, les polices, les espacements et la mise en page.</p>

<p><strong>3 facons d'ajouter du CSS :</strong></p>
<p>&bull; <strong>En ligne (inline)</strong> : directement dans la balise HTML</p>
<div class="code-example"><span class="keyword">&lt;p</span> <span class="string">style="color: red;"</span><span class="keyword">&gt;</span>Texte rouge<span class="keyword">&lt;/p&gt;</span></div>

<p>&bull; <strong>Balise &lt;style&gt;</strong> : dans le &lt;head&gt; du document</p>
<div class="code-example"><span class="keyword">&lt;style&gt;</span>
  <span class="keyword">p</span> { <span class="keyword">color</span>: <span class="string">red</span>; }
<span class="keyword">&lt;/style&gt;</span></div>

<p>&bull; <strong>Fichier externe</strong> (recommande) : un fichier .css separe</p>
<div class="code-example"><span class="keyword">&lt;link</span> <span class="string">rel="stylesheet"</span> <span class="string">href="style.css"</span><span class="keyword">&gt;</span></div>

<p><strong>Les selecteurs de base :</strong></p>
<div class="code-example"><span class="keyword">p</span> { }           <span class="comment">/* selecteur d'element — tous les &lt;p&gt; */</span>
<span class="keyword">.intro</span> { }       <span class="comment">/* selecteur de classe — class="intro" */</span>
<span class="keyword">#titre</span> { }       <span class="comment">/* selecteur d'id — id="titre" */</span></div>

<p><strong>Proprietes courantes :</strong></p>
<div class="code-example"><span class="keyword">color</span>: <span class="string">blue</span>;              <span class="comment">/* couleur du texte */</span>
<span class="keyword">background-color</span>: <span class="string">#f0f0f0</span>; <span class="comment">/* couleur de fond */</span>
<span class="keyword">font-size</span>: <span class="number">16px</span>;           <span class="comment">/* taille du texte */</span>
<span class="keyword">font-family</span>: <span class="string">Arial, sans-serif</span>; <span class="comment">/* police */</span></div>

<p><strong>Unites courantes :</strong></p>
<p>&bull; <code>px</code> — pixels, taille fixe</p>
<p>&bull; <code>em</code> — relative a la taille de police du parent</p>
<p>&bull; <code>rem</code> — relative a la taille de police de la racine (html)</p>
<p>&bull; <code>%</code> — pourcentage relatif au parent</p>

<div class="tip">La <strong>specificite</strong> determine quel style s'applique en cas de conflit : inline &gt; #id &gt; .classe &gt; element. Plus le selecteur est precis, plus il a de priorite.</div>`
    },
    {
        title: "Le modele de boite — Box Model",
        num: 2,
        lesson: `<p>En CSS, chaque element est une <strong>boite rectangulaire</strong> composee de 4 couches, de l'interieur vers l'exterieur :</p>

<p>&bull; <strong>content</strong> — le contenu (texte, image...)</p>
<p>&bull; <strong>padding</strong> — l'espace interieur (entre le contenu et la bordure)</p>
<p>&bull; <strong>border</strong> — la bordure visible</p>
<p>&bull; <strong>margin</strong> — l'espace exterieur (entre la boite et les autres elements)</p>

<div class="code-example"><span class="keyword">.boite</span> {
  <span class="keyword">width</span>: <span class="number">200px</span>;
  <span class="keyword">padding</span>: <span class="number">20px</span>;
  <span class="keyword">border</span>: <span class="number">2px</span> <span class="string">solid</span> <span class="string">black</span>;
  <span class="keyword">margin</span>: <span class="number">10px</span>;
}</div>

<p>Par defaut, <code>width</code> ne compte que le contenu. Le <code>padding</code> et la <code>border</code> s'ajoutent a la largeur totale. Pour changer ce comportement :</p>

<div class="code-example"><span class="keyword">*</span> {
  <span class="keyword">box-sizing</span>: <span class="string">border-box</span>; <span class="comment">/* width inclut padding + border */</span>
}</div>

<p><strong>La propriete display :</strong></p>
<p>&bull; <code>block</code> — prend toute la largeur, retour a la ligne (div, p, h1...)</p>
<p>&bull; <code>inline</code> — ne prend que la largeur du contenu, pas de retour a la ligne (span, a, strong...)</p>
<p>&bull; <code>inline-block</code> — comme inline mais accepte width/height</p>

<div class="code-example"><span class="keyword">.carte</span> {
  <span class="keyword">display</span>: <span class="string">inline-block</span>;
  <span class="keyword">width</span>: <span class="number">200px</span>;
  <span class="keyword">height</span>: <span class="number">150px</span>;
}</div>

<p><strong>Centrer un element block :</strong></p>
<div class="code-example"><span class="keyword">.centre</span> {
  <span class="keyword">width</span>: <span class="number">600px</span>;
  <span class="keyword">margin</span>: <span class="number">0</span> <span class="string">auto</span>; <span class="comment">/* auto sur les cotes = centre */</span>
}</div>

<div class="tip">La propriete <code>overflow</code> controle ce qui depasse de la boite : <code>visible</code> (defaut), <code>hidden</code> (cache), <code>scroll</code> (barre de defilement), <code>auto</code>.</div>`
    },
    {
        title: "Flexbox",
        num: 3,
        lesson: `<p><strong>Flexbox</strong> est un mode de mise en page qui permet d'aligner et distribuer des elements facilement dans un conteneur.</p>

<div class="code-example"><span class="keyword">.conteneur</span> {
  <span class="keyword">display</span>: <span class="string">flex</span>; <span class="comment">/* active Flexbox */</span>
}</div>

<p><strong>Proprietes du conteneur :</strong></p>
<div class="code-example"><span class="keyword">.conteneur</span> {
  <span class="keyword">display</span>: <span class="string">flex</span>;
  <span class="keyword">flex-direction</span>: <span class="string">row</span>;          <span class="comment">/* row (defaut) | column */</span>
  <span class="keyword">justify-content</span>: <span class="string">center</span>;      <span class="comment">/* axe principal */</span>
  <span class="keyword">align-items</span>: <span class="string">center</span>;          <span class="comment">/* axe secondaire */</span>
  <span class="keyword">flex-wrap</span>: <span class="string">wrap</span>;              <span class="comment">/* retour a la ligne */</span>
  <span class="keyword">gap</span>: <span class="number">10px</span>;                    <span class="comment">/* espace entre elements */</span>
}</div>

<p><strong>Valeurs de justify-content :</strong></p>
<p>&bull; <code>flex-start</code> — elements au debut (defaut)</p>
<p>&bull; <code>center</code> — elements au centre</p>
<p>&bull; <code>flex-end</code> — elements a la fin</p>
<p>&bull; <code>space-between</code> — espace egal entre les elements</p>
<p>&bull; <code>space-around</code> — espace egal autour de chaque element</p>

<p><strong>Proprietes des enfants (flex items) :</strong></p>
<div class="code-example"><span class="keyword">.item</span> {
  <span class="keyword">flex-grow</span>: <span class="number">1</span>;    <span class="comment">/* prend l'espace disponible */</span>
  <span class="keyword">flex-shrink</span>: <span class="number">0</span>;  <span class="comment">/* ne retrecit pas */</span>
  <span class="keyword">flex-basis</span>: <span class="number">200px</span>; <span class="comment">/* taille de base */</span>
  <span class="keyword">order</span>: <span class="number">2</span>;         <span class="comment">/* change l'ordre d'affichage */</span>
}</div>

<div class="tip">Pour centrer un element horizontalement ET verticalement dans son parent : <code>display: flex; justify-content: center; align-items: center;</code></div>`
    },
    {
        title: "CSS Grid",
        num: 4,
        lesson: `<p><strong>CSS Grid</strong> est un systeme de mise en page en deux dimensions (lignes et colonnes).</p>

<div class="code-example"><span class="keyword">.grille</span> {
  <span class="keyword">display</span>: <span class="string">grid</span>;
  <span class="keyword">grid-template-columns</span>: <span class="number">200px</span> <span class="number">200px</span> <span class="number">200px</span>; <span class="comment">/* 3 colonnes */</span>
  <span class="keyword">grid-template-rows</span>: <span class="number">100px</span> <span class="number">100px</span>;        <span class="comment">/* 2 lignes */</span>
  <span class="keyword">gap</span>: <span class="number">10px</span>;                                <span class="comment">/* espace entre cellules */</span>
}</div>

<p><strong>L'unite fr</strong> (fraction) repartit l'espace disponible :</p>
<div class="code-example"><span class="keyword">.grille</span> {
  <span class="keyword">grid-template-columns</span>: <span class="number">1fr</span> <span class="number">2fr</span> <span class="number">1fr</span>; <span class="comment">/* 3 colonnes, celle du milieu 2x plus large */</span>
}</div>

<p><strong>La fonction repeat()</strong> simplifie les repetitions :</p>
<div class="code-example"><span class="keyword">grid-template-columns</span>: <span class="keyword">repeat</span>(<span class="number">3</span>, <span class="number">1fr</span>); <span class="comment">/* = 1fr 1fr 1fr */</span></div>

<p><strong>Faire qu'un element occupe plusieurs cellules :</strong></p>
<div class="code-example"><span class="keyword">.large</span> {
  <span class="keyword">grid-column</span>: <span class="string">span 2</span>; <span class="comment">/* occupe 2 colonnes */</span>
  <span class="keyword">grid-row</span>: <span class="string">span 2</span>;    <span class="comment">/* occupe 2 lignes */</span>
}</div>

<p><strong>Les zones nommees (grid-template-areas) :</strong></p>
<div class="code-example"><span class="keyword">.page</span> {
  <span class="keyword">display</span>: <span class="string">grid</span>;
  <span class="keyword">grid-template-areas</span>:
    <span class="string">"header header"</span>
    <span class="string">"sidebar main"</span>
    <span class="string">"footer footer"</span>;
}
<span class="keyword">.entete</span> { <span class="keyword">grid-area</span>: <span class="string">header</span>; }
<span class="keyword">.menu</span>   { <span class="keyword">grid-area</span>: <span class="string">sidebar</span>; }
<span class="keyword">.contenu</span>{ <span class="keyword">grid-area</span>: <span class="string">main</span>; }</div>

<div class="tip"><strong>Grid vs Flexbox :</strong> Flexbox est ideal pour les mises en page a une dimension (ligne OU colonne). Grid est ideal pour les mises en page a deux dimensions (lignes ET colonnes).</div>`
    },
    {
        title: "Positionnement",
        num: 5,
        lesson: `<p>La propriete <code>position</code> controle comment un element est place dans la page.</p>

<p><strong>Les 5 valeurs de position :</strong></p>
<p>&bull; <code>static</code> — positionnement normal (par defaut)</p>
<p>&bull; <code>relative</code> — decale par rapport a sa position normale</p>
<p>&bull; <code>absolute</code> — positionne par rapport a son ancetre positionne le plus proche</p>
<p>&bull; <code>fixed</code> — positionne par rapport a la fenetre du navigateur</p>
<p>&bull; <code>sticky</code> — bascule entre relative et fixed selon le defilement</p>

<div class="code-example"><span class="keyword">.decale</span> {
  <span class="keyword">position</span>: <span class="string">relative</span>;
  <span class="keyword">top</span>: <span class="number">10px</span>;   <span class="comment">/* decale de 10px vers le bas */</span>
  <span class="keyword">left</span>: <span class="number">20px</span>;  <span class="comment">/* decale de 20px vers la droite */</span>
}</div>

<p><strong>Position absolute + parent relative :</strong></p>
<div class="code-example"><span class="keyword">.parent</span> {
  <span class="keyword">position</span>: <span class="string">relative</span>; <span class="comment">/* sert de reference */</span>
}
<span class="keyword">.enfant</span> {
  <span class="keyword">position</span>: <span class="string">absolute</span>;
  <span class="keyword">top</span>: <span class="number">0</span>;
  <span class="keyword">right</span>: <span class="number">0</span>; <span class="comment">/* coin superieur droit du parent */</span>
}</div>

<p><strong>Position fixed</strong> (barre de navigation fixe) :</p>
<div class="code-example"><span class="keyword">.navbar</span> {
  <span class="keyword">position</span>: <span class="string">fixed</span>;
  <span class="keyword">top</span>: <span class="number">0</span>;
  <span class="keyword">width</span>: <span class="number">100%</span>;
  <span class="keyword">z-index</span>: <span class="number">1000</span>; <span class="comment">/* passe devant les autres elements */</span>
}</div>

<div class="tip"><code>z-index</code> controle l'ordre d'empilement des elements positionnes. Un z-index plus eleve place l'element devant. Il ne fonctionne que sur les elements avec une position autre que static.</div>`
    },
    {
        title: "Responsive design",
        num: 6,
        lesson: `<p>Le <strong>responsive design</strong> adapte l'affichage a toutes les tailles d'ecran (mobile, tablette, desktop).</p>

<p><strong>La balise meta viewport</strong> (obligatoire dans le &lt;head&gt;) :</p>
<div class="code-example"><span class="keyword">&lt;meta</span> <span class="string">name="viewport"</span> <span class="string">content="width=device-width, initial-scale=1.0"</span><span class="keyword">&gt;</span></div>

<p><strong>Les media queries</strong> appliquent du CSS selon la taille de l'ecran :</p>
<div class="code-example"><span class="comment">/* Approche mobile-first : styles de base pour mobile */</span>
<span class="keyword">.conteneur</span> {
  <span class="keyword">width</span>: <span class="number">100%</span>;
}

<span class="comment">/* A partir de 768px (tablette) */</span>
<span class="keyword">@media</span> (<span class="keyword">min-width</span>: <span class="number">768px</span>) {
  <span class="keyword">.conteneur</span> {
    <span class="keyword">width</span>: <span class="number">750px</span>;
  }
}

<span class="comment">/* A partir de 1024px (desktop) */</span>
<span class="keyword">@media</span> (<span class="keyword">min-width</span>: <span class="number">1024px</span>) {
  <span class="keyword">.conteneur</span> {
    <span class="keyword">width</span>: <span class="number">960px</span>;
  }
}</div>

<p><strong>Unites responsive :</strong></p>
<p>&bull; <code>%</code> — relatif au parent</p>
<p>&bull; <code>vw</code> — 1% de la largeur de la fenetre</p>
<p>&bull; <code>vh</code> — 1% de la hauteur de la fenetre</p>
<p>&bull; <code>rem</code> — relatif a la taille de police racine</p>

<p><strong>Images responsives :</strong></p>
<div class="code-example"><span class="keyword">img</span> {
  <span class="keyword">max-width</span>: <span class="number">100%</span>;  <span class="comment">/* ne depasse jamais son conteneur */</span>
  <span class="keyword">height</span>: <span class="string">auto</span>;     <span class="comment">/* garde les proportions */</span>
}</div>

<div class="tip"><strong>Mobile-first</strong> signifie ecrire d'abord les styles pour mobile, puis ajouter des regles avec <code>min-width</code> pour les ecrans plus grands. C'est l'approche recommandee.</div>`
    },
    {
        title: "Transitions et animations",
        num: 7,
        lesson: `<p>Les <strong>transitions</strong> animent le passage d'un etat CSS a un autre (par exemple au survol).</p>

<div class="code-example"><span class="keyword">.bouton</span> {
  <span class="keyword">background</span>: <span class="string">blue</span>;
  <span class="keyword">transition</span>: <span class="string">background</span> <span class="number">0.3s</span> <span class="string">ease</span>; <span class="comment">/* propriete duree courbe */</span>
}
<span class="keyword">.bouton:hover</span> {
  <span class="keyword">background</span>: <span class="string">darkblue</span>; <span class="comment">/* transition animee en 0.3s */</span>
}</div>

<p><strong>La propriete transform</strong> modifie un element visuellement :</p>
<div class="code-example"><span class="keyword">.element</span> {
  <span class="keyword">transform</span>: <span class="keyword">translate</span>(<span class="number">50px</span>, <span class="number">20px</span>); <span class="comment">/* deplace */</span>
  <span class="keyword">transform</span>: <span class="keyword">rotate</span>(<span class="number">45deg</span>);          <span class="comment">/* tourne */</span>
  <span class="keyword">transform</span>: <span class="keyword">scale</span>(<span class="number">1.5</span>);             <span class="comment">/* agrandit 1.5x */</span>
}</div>

<p><strong>Les animations avec @keyframes</strong> permettent des animations complexes :</p>
<div class="code-example"><span class="keyword">@keyframes</span> apparition {
  <span class="keyword">from</span> {
    <span class="keyword">opacity</span>: <span class="number">0</span>;
    <span class="keyword">transform</span>: <span class="keyword">translateY</span>(<span class="number">20px</span>);
  }
  <span class="keyword">to</span> {
    <span class="keyword">opacity</span>: <span class="number">1</span>;
    <span class="keyword">transform</span>: <span class="keyword">translateY</span>(<span class="number">0</span>);
  }
}

<span class="keyword">.anime</span> {
  <span class="keyword">animation</span>: <span class="string">apparition</span> <span class="number">0.5s</span> <span class="string">ease</span> <span class="string">forwards</span>;
}</div>

<p><strong>Opacity, visibility et display :</strong></p>
<p>&bull; <code>opacity: 0</code> — invisible mais prend toujours de la place, cliquable</p>
<p>&bull; <code>visibility: hidden</code> — invisible, prend de la place, non cliquable</p>
<p>&bull; <code>display: none</code> — completement retire du flux, ne prend aucune place</p>

<div class="tip"><code>transition</code> anime le changement entre deux etats. <code>animation</code> avec <code>@keyframes</code> permet des animations multi-etapes et en boucle.</div>`
    }
];

// ========================
// ALL QUESTIONS (50)
// ========================
const allQuestions = [
    // === CHAPTER 1: Les bases (8 questions) ===
    {
        chapter: 0,
        question: "Que signifie l'acronyme <strong>CSS</strong> ?",
        options: [
            "Computer Style Sheets",
            "Cascading Style Sheets",
            "Creative Style System",
            "Colorful Style Sheets"
        ],
        answer: 1,
        explanation: "CSS signifie <strong>Cascading Style Sheets</strong> (feuilles de style en cascade). Le mot « cascading » fait reference au systeme de priorite des regles CSS."
    },
    {
        chapter: 0,
        question: "Quelle balise HTML permet de lier un fichier CSS externe ?",
        options: [
            "<code>&lt;css href=\"style.css\"&gt;</code>",
            "<code>&lt;style src=\"style.css\"&gt;</code>",
            "<code>&lt;link rel=\"stylesheet\" href=\"style.css\"&gt;</code>",
            "<code>&lt;script href=\"style.css\"&gt;</code>"
        ],
        answer: 2,
        explanation: "On utilise <code>&lt;link rel=\"stylesheet\" href=\"style.css\"&gt;</code> dans le <code>&lt;head&gt;</code> pour lier un fichier CSS externe. C'est la methode recommandee."
    },
    {
        chapter: 0,
        question: "Comment selectionne-t-on un element avec la classe <code>intro</code> en CSS ?",
        options: [
            "<code>#intro { }</code>",
            "<code>.intro { }</code>",
            "<code>intro { }</code>",
            "<code>*intro { }</code>"
        ],
        answer: 1,
        explanation: "Le selecteur de classe utilise un <strong>point</strong> : <code>.intro</code>. Le <code>#</code> est reserve aux identifiants (id)."
    },
    {
        chapter: 0,
        question: "Comment selectionne-t-on l'element avec l'id <code>titre</code> en CSS ?",
        options: [
            "<code>.titre { }</code>",
            "<code>titre { }</code>",
            "<code>@titre { }</code>",
            "<code>#titre { }</code>"
        ],
        answer: 3,
        explanation: "Le selecteur d'id utilise le signe <code>#</code> : <code>#titre</code>. Un id doit etre unique dans la page."
    },
    {
        chapter: 0,
        question: "Quelle propriete CSS change la <strong>couleur du texte</strong> ?",
        options: [
            "<code>text-color</code>",
            "<code>font-color</code>",
            "<code>color</code>",
            "<code>foreground-color</code>"
        ],
        answer: 2,
        explanation: "La propriete <code>color</code> change la couleur du texte. Pour la couleur de fond, on utilise <code>background-color</code>."
    },
    {
        chapter: 0,
        question: "Quelle unite CSS est relative a la taille de police de l'element racine (<code>&lt;html&gt;</code>) ?",
        options: [
            "<code>px</code>",
            "<code>em</code>",
            "<code>rem</code>",
            "<code>%</code>"
        ],
        answer: 2,
        explanation: "<code>rem</code> signifie « root em ». Il est relatif a la taille de police de l'element <code>&lt;html&gt;</code>. Contrairement a <code>em</code> qui est relatif au parent, <code>rem</code> est toujours previsible."
    },
    {
        chapter: 0,
        question: "Quelle est la difference principale entre une <strong>classe</strong> et un <strong>id</strong> en CSS ?",
        options: [
            "Une classe commence par # et un id par .",
            "Un id peut etre utilise sur plusieurs elements, pas une classe",
            "Une classe peut etre utilisee sur plusieurs elements, un id doit etre unique",
            "Il n'y a aucune difference"
        ],
        answer: 2,
        explanation: "Une <strong>classe</strong> (<code>.maClasse</code>) peut etre appliquee a plusieurs elements. Un <strong>id</strong> (<code>#monId</code>) doit etre unique dans la page."
    },
    {
        chapter: 0,
        question: "Quel selecteur a la <strong>plus haute specificite</strong> ?",
        options: [
            "Un selecteur d'element (<code>p</code>)",
            "Un selecteur de classe (<code>.intro</code>)",
            "Un selecteur d'id (<code>#titre</code>)",
            "Ils ont tous la meme specificite"
        ],
        answer: 2,
        explanation: "L'ordre de specificite est : style inline &gt; id (<code>#</code>) &gt; classe (<code>.</code>) &gt; element. Le selecteur d'id est donc le plus specifique parmi les trois proposes."
    },

    // === CHAPTER 2: Box Model (7 questions) ===
    {
        chapter: 1,
        question: "Dans le modele de boite CSS, quel est l'ordre des couches <strong>de l'interieur vers l'exterieur</strong> ?",
        options: [
            "margin, border, padding, content",
            "content, padding, border, margin",
            "content, border, padding, margin",
            "padding, content, border, margin"
        ],
        answer: 1,
        explanation: "De l'interieur vers l'exterieur : <strong>content</strong> (contenu) → <strong>padding</strong> (marge interieure) → <strong>border</strong> (bordure) → <strong>margin</strong> (marge exterieure)."
    },
    {
        chapter: 1,
        question: "Quelle est la difference entre <code>padding</code> et <code>margin</code> ?",
        options: [
            "Il n'y a aucune difference",
            "padding est l'espace a l'interieur de la bordure, margin est l'espace a l'exterieur",
            "margin est l'espace a l'interieur de la bordure, padding est l'espace a l'exterieur",
            "padding est pour le texte, margin est pour les images"
        ],
        answer: 1,
        explanation: "<code>padding</code> est l'espace <strong>entre le contenu et la bordure</strong> (interieur). <code>margin</code> est l'espace <strong>entre la bordure et les elements voisins</strong> (exterieur)."
    },
    {
        chapter: 1,
        question: "Que fait <code>box-sizing: border-box</code> ?",
        options: [
            "Il ajoute une bordure automatique",
            "Il inclut le padding et la border dans la largeur (width) definie",
            "Il supprime les marges",
            "Il centre l'element"
        ],
        answer: 1,
        explanation: "Avec <code>box-sizing: border-box</code>, la <code>width</code> inclut le padding et la border. Si vous definissez <code>width: 200px</code>, l'element fera exactement 200px de large, padding et bordure compris."
    },
    {
        chapter: 1,
        question: "Quelle est la difference entre <code>display: block</code> et <code>display: inline</code> ?",
        options: [
            "block prend toute la largeur et fait un retour a la ligne, inline ne prend que la largeur du contenu",
            "inline prend toute la largeur, block ne prend que la largeur du contenu",
            "Il n'y a aucune difference",
            "block est pour le texte, inline est pour les images"
        ],
        answer: 0,
        explanation: "Un element <code>block</code> prend toute la largeur disponible et force un retour a la ligne. Un element <code>inline</code> ne prend que la largeur de son contenu et ne fait pas de retour a la ligne."
    },
    {
        chapter: 1,
        question: "Quel est l'avantage de <code>display: inline-block</code> par rapport a <code>inline</code> ?",
        options: [
            "Il prend toute la largeur",
            "Il accepte les proprietes width et height",
            "Il masque l'element",
            "Il supprime les marges"
        ],
        answer: 1,
        explanation: "<code>inline-block</code> se comporte comme <code>inline</code> (pas de retour a la ligne) mais accepte <code>width</code>, <code>height</code>, ainsi que le <code>padding</code> et le <code>margin</code> vertical."
    },
    {
        chapter: 1,
        question: "Que fait <code>overflow: hidden</code> sur un element ?",
        options: [
            "Il affiche une barre de defilement",
            "Il masque tout le contenu qui depasse de la boite",
            "Il agrandit la boite pour tout afficher",
            "Il rend l'element invisible"
        ],
        answer: 1,
        explanation: "<code>overflow: hidden</code> cache tout le contenu qui depasse des dimensions de l'element. Le contenu est toujours la mais il n'est pas visible."
    },
    {
        chapter: 1,
        question: "Comment centrer horizontalement un element <code>block</code> de largeur fixe ?",
        options: [
            "<code>text-align: center</code>",
            "<code>margin: 0 auto</code>",
            "<code>padding: auto</code>",
            "<code>align: center</code>"
        ],
        answer: 1,
        explanation: "<code>margin: 0 auto</code> repartit automatiquement les marges gauche et droite, ce qui centre l'element. L'element doit avoir une largeur definie."
    },

    // === CHAPTER 3: Flexbox (8 questions) ===
    {
        chapter: 2,
        question: "Quelle propriete CSS active Flexbox sur un conteneur ?",
        options: [
            "<code>flex: 1</code>",
            "<code>display: flexbox</code>",
            "<code>display: flex</code>",
            "<code>position: flex</code>"
        ],
        answer: 2,
        explanation: "On active Flexbox avec <code>display: flex</code> sur l'element parent (le conteneur). Tous ses enfants directs deviennent alors des « flex items »."
    },
    {
        chapter: 2,
        question: "Quelle est la valeur par defaut de <code>flex-direction</code> ?",
        options: [
            "<code>column</code>",
            "<code>row</code>",
            "<code>row-reverse</code>",
            "<code>horizontal</code>"
        ],
        answer: 1,
        explanation: "Par defaut, <code>flex-direction</code> vaut <code>row</code>, ce qui aligne les elements horizontalement de gauche a droite."
    },
    {
        chapter: 2,
        question: "Quelle propriete et valeur centre les elements sur l'<strong>axe principal</strong> en Flexbox ?",
        options: [
            "<code>align-items: center</code>",
            "<code>text-align: center</code>",
            "<code>justify-content: center</code>",
            "<code>flex-align: center</code>"
        ],
        answer: 2,
        explanation: "<code>justify-content</code> gere l'alignement sur l'axe principal (horizontal par defaut). <code>align-items</code> gere l'axe secondaire (vertical par defaut)."
    },
    {
        chapter: 2,
        question: "Quelle propriete Flexbox centre les elements sur l'<strong>axe secondaire</strong> (vertical par defaut) ?",
        options: [
            "<code>justify-content: center</code>",
            "<code>align-items: center</code>",
            "<code>vertical-align: center</code>",
            "<code>flex-center: vertical</code>"
        ],
        answer: 1,
        explanation: "<code>align-items</code> controle l'alignement sur l'axe secondaire. En <code>flex-direction: row</code>, l'axe secondaire est vertical."
    },
    {
        chapter: 2,
        question: "Que fait <code>justify-content: space-between</code> ?",
        options: [
            "Centre tous les elements",
            "Met un espace egal entre les elements, le premier et le dernier collent aux bords",
            "Met un espace egal autour de chaque element",
            "Empile les elements les uns sur les autres"
        ],
        answer: 1,
        explanation: "<code>space-between</code> distribue l'espace de facon egale <strong>entre</strong> les elements. Le premier element touche le debut et le dernier touche la fin du conteneur."
    },
    {
        chapter: 2,
        question: "Que fait <code>flex-wrap: wrap</code> ?",
        options: [
            "Les elements restent sur une seule ligne et retrecissent",
            "Les elements passent a la ligne suivante quand il n'y a plus de place",
            "Les elements disparaissent quand il n'y a plus de place",
            "Les elements se superposent"
        ],
        answer: 1,
        explanation: "<code>flex-wrap: wrap</code> permet aux elements de passer a la ligne suivante lorsque le conteneur est trop etroit. Par defaut (<code>nowrap</code>), tout reste sur une seule ligne."
    },
    {
        chapter: 2,
        question: "Quelle propriete Flexbox definit l'espace entre les elements sans utiliser de margin ?",
        options: [
            "<code>space</code>",
            "<code>gutter</code>",
            "<code>gap</code>",
            "<code>spacing</code>"
        ],
        answer: 2,
        explanation: "La propriete <code>gap</code> definit l'espace entre les elements flex (et aussi grid). Elle est plus pratique que d'utiliser des marges sur chaque element."
    },
    {
        chapter: 2,
        question: "Comment centrer un element <strong>horizontalement et verticalement</strong> avec Flexbox ?",
        options: [
            "<code>display: flex; margin: auto;</code>",
            "<code>display: flex; justify-content: center; align-items: center;</code>",
            "<code>display: flex; text-align: center; vertical-align: middle;</code>",
            "<code>display: flex; flex-center: both;</code>"
        ],
        answer: 1,
        explanation: "La combinaison <code>justify-content: center</code> (axe principal) et <code>align-items: center</code> (axe secondaire) centre l'element dans les deux directions."
    },

    // === CHAPTER 4: CSS Grid (7 questions) ===
    {
        chapter: 3,
        question: "Quelle propriete CSS active le mode Grid sur un conteneur ?",
        options: [
            "<code>display: grid-layout</code>",
            "<code>display: grid</code>",
            "<code>grid: on</code>",
            "<code>layout: grid</code>"
        ],
        answer: 1,
        explanation: "On active CSS Grid avec <code>display: grid</code> sur le conteneur. Ses enfants directs deviennent des « grid items »."
    },
    {
        chapter: 3,
        question: "Quelle propriete definit les colonnes d'une grille ?",
        options: [
            "<code>grid-columns</code>",
            "<code>columns</code>",
            "<code>grid-template-columns</code>",
            "<code>grid-col</code>"
        ],
        answer: 2,
        explanation: "<code>grid-template-columns</code> definit le nombre et la taille des colonnes. Par exemple : <code>grid-template-columns: 200px 1fr 200px;</code> cree 3 colonnes."
    },
    {
        chapter: 3,
        question: "Que represente l'unite <code>fr</code> en CSS Grid ?",
        options: [
            "Un nombre fixe de pixels",
            "Une fraction de l'espace disponible dans la grille",
            "Un pourcentage de la fenetre",
            "La taille de la police"
        ],
        answer: 1,
        explanation: "<code>fr</code> signifie « fraction ». <code>1fr</code> represente une part de l'espace disponible. <code>1fr 2fr</code> signifie que la deuxieme colonne sera deux fois plus large que la premiere."
    },
    {
        chapter: 3,
        question: "Que fait <code>grid-template-columns: repeat(3, 1fr)</code> ?",
        options: [
            "Cree 1 colonne de 3fr",
            "Cree 3 colonnes de taille egale",
            "Repete la grille 3 fois",
            "Cree 3 lignes de taille egale"
        ],
        answer: 1,
        explanation: "<code>repeat(3, 1fr)</code> est equivalent a <code>1fr 1fr 1fr</code>. Cela cree 3 colonnes de taille egale qui se partagent l'espace disponible."
    },
    {
        chapter: 3,
        question: "Quelle propriete ajoute de l'espace entre les cellules d'une grille ?",
        options: [
            "<code>margin</code>",
            "<code>spacing</code>",
            "<code>gap</code>",
            "<code>grid-space</code>"
        ],
        answer: 2,
        explanation: "<code>gap</code> (ou <code>grid-gap</code> en ancien) definit l'espace entre les lignes et les colonnes de la grille."
    },
    {
        chapter: 3,
        question: "Comment faire qu'un element occupe <strong>2 colonnes</strong> dans une grille ?",
        options: [
            "<code>grid-column: 2</code>",
            "<code>grid-column: span 2</code>",
            "<code>column-span: 2</code>",
            "<code>grid-width: 2fr</code>"
        ],
        answer: 1,
        explanation: "<code>grid-column: span 2</code> fait qu'un element s'etend sur 2 colonnes. De meme, <code>grid-row: span 2</code> s'etend sur 2 lignes."
    },
    {
        chapter: 3,
        question: "Quand est-il preferable d'utiliser <strong>CSS Grid</strong> plutot que <strong>Flexbox</strong> ?",
        options: [
            "Pour aligner des elements sur une seule ligne",
            "Pour une mise en page a deux dimensions (lignes ET colonnes)",
            "Pour centrer un seul element",
            "Grid et Flexbox font exactement la meme chose"
        ],
        answer: 1,
        explanation: "<strong>CSS Grid</strong> est ideal pour les mises en page a <strong>deux dimensions</strong> (lignes et colonnes simultanement). <strong>Flexbox</strong> est ideal pour les mises en page a <strong>une dimension</strong> (ligne OU colonne)."
    },

    // === CHAPTER 5: Positionnement (6 questions) ===
    {
        chapter: 4,
        question: "Quelle est la valeur par defaut de la propriete <code>position</code> en CSS ?",
        options: [
            "<code>relative</code>",
            "<code>absolute</code>",
            "<code>fixed</code>",
            "<code>static</code>"
        ],
        answer: 3,
        explanation: "Par defaut, tous les elements ont <code>position: static</code>. Ils suivent le flux normal du document."
    },
    {
        chapter: 4,
        question: "Quelle est la difference entre <code>position: relative</code> et <code>position: absolute</code> ?",
        options: [
            "Il n'y a aucune difference",
            "relative decale l'element par rapport a sa position normale, absolute le positionne par rapport a son ancetre positionne",
            "absolute decale l'element par rapport a sa position normale, relative le retire du flux",
            "relative est pour les textes, absolute est pour les images"
        ],
        answer: 1,
        explanation: "<code>relative</code> decale l'element par rapport a sa position d'origine (il garde sa place dans le flux). <code>absolute</code> retire l'element du flux et le positionne par rapport a son ancetre positionne le plus proche."
    },
    {
        chapter: 4,
        question: "Pour qu'un enfant en <code>position: absolute</code> se positionne par rapport a son parent, que faut-il ajouter au parent ?",
        options: [
            "<code>position: static</code>",
            "<code>position: relative</code>",
            "<code>display: block</code>",
            "<code>overflow: hidden</code>"
        ],
        answer: 1,
        explanation: "Un element <code>absolute</code> se positionne par rapport a son plus proche ancetre qui a une <code>position</code> differente de <code>static</code>. Le plus courant est d'ajouter <code>position: relative</code> au parent."
    },
    {
        chapter: 4,
        question: "Que se passe-t-il avec un element en <code>position: fixed</code> quand on fait defiler la page ?",
        options: [
            "Il defile avec le reste de la page",
            "Il reste fixe a sa position dans la fenetre du navigateur",
            "Il disparait",
            "Il revient en haut de la page"
        ],
        answer: 1,
        explanation: "Un element <code>fixed</code> est positionne par rapport a la <strong>fenetre du navigateur</strong>. Il reste toujours visible au meme endroit, meme quand on fait defiler la page."
    },
    {
        chapter: 4,
        question: "A quoi sert la propriete <code>z-index</code> ?",
        options: [
            "A definir la taille d'un element",
            "A controler l'ordre d'empilement des elements positionnes",
            "A creer un zoom sur un element",
            "A definir la position horizontale"
        ],
        answer: 1,
        explanation: "<code>z-index</code> controle quel element passe devant ou derriere un autre. Un z-index plus eleve place l'element au premier plan. Il ne fonctionne que sur les elements avec une position autre que <code>static</code>."
    },
    {
        chapter: 4,
        question: "Comment se comporte un element en <code>position: sticky</code> ?",
        options: [
            "Il est toujours fixe en haut de la page",
            "Il se comporte comme relative puis devient fixe quand on atteint un seuil de defilement",
            "Il est invisible jusqu'au defilement",
            "Il se comporte exactement comme absolute"
        ],
        answer: 1,
        explanation: "<code>sticky</code> combine <code>relative</code> et <code>fixed</code>. L'element se comporte normalement puis « colle » a une position definie (ex: <code>top: 0</code>) quand on fait defiler la page."
    },

    // === CHAPTER 6: Responsive design (7 questions) ===
    {
        chapter: 5,
        question: "A quoi sert la balise <code>&lt;meta name=\"viewport\"&gt;</code> ?",
        options: [
            "A definir la couleur de la page",
            "A adapter l'affichage a la largeur de l'ecran de l'appareil",
            "A ajouter un moteur de recherche",
            "A optimiser le referencement"
        ],
        answer: 1,
        explanation: "La balise viewport indique au navigateur d'utiliser la largeur reelle de l'ecran. Sans elle, les mobiles affichent la page comme sur un ecran de bureau en miniature."
    },
    {
        chapter: 5,
        question: "Quelle est la syntaxe correcte d'une media query CSS ?",
        options: [
            "<code>@screen (min-width: 768px) { }</code>",
            "<code>@media (min-width: 768px) { }</code>",
            "<code>@responsive (768px) { }</code>",
            "<code>@query screen (768px) { }</code>"
        ],
        answer: 1,
        explanation: "La syntaxe correcte est <code>@media (condition) { regles CSS }</code>. On peut utiliser <code>min-width</code>, <code>max-width</code>, et d'autres conditions."
    },
    {
        chapter: 5,
        question: "Dans l'approche <strong>mobile-first</strong>, quelle condition utilise-t-on dans les media queries ?",
        options: [
            "<code>max-width</code>",
            "<code>min-width</code>",
            "<code>device-width</code>",
            "<code>screen-size</code>"
        ],
        answer: 1,
        explanation: "En <strong>mobile-first</strong>, on ecrit d'abord les styles pour mobile, puis on utilise <code>min-width</code> pour ajouter des styles pour les ecrans plus grands."
    },
    {
        chapter: 5,
        question: "Que fait <code>@media (max-width: 768px) { ... }</code> ?",
        options: [
            "Applique les styles uniquement si l'ecran fait plus de 768px",
            "Applique les styles uniquement si l'ecran fait 768px ou moins",
            "Applique les styles a tous les ecrans",
            "Masque le contenu en dessous de 768px"
        ],
        answer: 1,
        explanation: "<code>max-width: 768px</code> signifie « si la largeur est inferieure ou egale a 768px ». Les regles a l'interieur ne s'appliquent qu'aux petits ecrans."
    },
    {
        chapter: 5,
        question: "Que representent les unites <code>vw</code> et <code>vh</code> ?",
        options: [
            "Des pourcentages de l'element parent",
            "Des pixels",
            "1% de la largeur (vw) et 1% de la hauteur (vh) de la fenetre du navigateur",
            "Des multiples de la taille de police"
        ],
        answer: 2,
        explanation: "<code>vw</code> = viewport width, <code>vh</code> = viewport height. <code>50vw</code> represente la moitie de la largeur de la fenetre. <code>100vh</code> represente toute la hauteur."
    },
    {
        chapter: 5,
        question: "Quelle technique rend une image responsive pour qu'elle ne depasse jamais son conteneur ?",
        options: [
            "<code>width: 100%</code> uniquement",
            "<code>max-width: 100%; height: auto;</code>",
            "<code>display: responsive</code>",
            "<code>overflow: hidden</code>"
        ],
        answer: 1,
        explanation: "<code>max-width: 100%</code> empeche l'image de depasser la largeur de son conteneur. <code>height: auto</code> preserve les proportions."
    },
    {
        chapter: 5,
        question: "Quel breakpoint est generalement utilise pour cibler les <strong>tablettes</strong> ?",
        options: [
            "480px",
            "768px",
            "1440px",
            "320px"
        ],
        answer: 1,
        explanation: "<code>768px</code> est le breakpoint classique pour les tablettes. Les valeurs courantes sont : 480px (mobile), 768px (tablette), 1024px (desktop)."
    },

    // === CHAPTER 7: Transitions et animations (7 questions) ===
    {
        chapter: 6,
        question: "Quelle est la syntaxe correcte de la propriete <code>transition</code> ?",
        options: [
            "<code>transition: duree propriete;</code>",
            "<code>transition: propriete duree timing-function;</code>",
            "<code>transition: animation 1s;</code>",
            "<code>transition: ease 2s color;</code>"
        ],
        answer: 1,
        explanation: "La syntaxe est : <code>transition: propriete duree [timing-function] [delay];</code>. Exemple : <code>transition: background 0.3s ease;</code>."
    },
    {
        chapter: 6,
        question: "Quel pseudo-selecteur CSS declenche un style au <strong>survol</strong> de la souris ?",
        options: [
            "<code>:click</code>",
            "<code>:hover</code>",
            "<code>:mouseover</code>",
            "<code>:focus</code>"
        ],
        answer: 1,
        explanation: "<code>:hover</code> s'active quand l'utilisateur survole un element avec la souris. C'est le pseudo-selecteur le plus courant pour les interactions."
    },
    {
        chapter: 6,
        question: "Que fait <code>transform: rotate(45deg)</code> ?",
        options: [
            "Deplace l'element de 45 pixels",
            "Agrandit l'element de 45%",
            "Fait tourner l'element de 45 degres",
            "Rend l'element transparent a 45%"
        ],
        answer: 2,
        explanation: "<code>rotate(45deg)</code> fait pivoter l'element de 45 degres dans le sens des aiguilles d'une montre. On peut utiliser des valeurs negatives pour tourner dans l'autre sens."
    },
    {
        chapter: 6,
        question: "Quelle est la syntaxe correcte pour definir une animation avec <code>@keyframes</code> ?",
        options: [
            "<code>@keyframes nom { from { } to { } }</code>",
            "<code>@animation nom { start { } end { } }</code>",
            "<code>@frames nom { 0% { } 100% { } }</code>",
            "<code>@animate { from { } to { } }</code>"
        ],
        answer: 0,
        explanation: "La syntaxe est <code>@keyframes nomAnimation { from { ... } to { ... } }</code>. On peut aussi utiliser des pourcentages : <code>0%</code>, <code>50%</code>, <code>100%</code>."
    },
    {
        chapter: 6,
        question: "Quelle propriete CSS definit la duree d'une animation ?",
        options: [
            "<code>animation-time</code>",
            "<code>animation-speed</code>",
            "<code>animation-duration</code>",
            "<code>animation-length</code>"
        ],
        answer: 2,
        explanation: "<code>animation-duration</code> definit la duree d'un cycle de l'animation. Exemple : <code>animation-duration: 2s;</code> pour une animation de 2 secondes."
    },
    {
        chapter: 6,
        question: "Quelle est la difference entre <code>opacity: 0</code>, <code>visibility: hidden</code> et <code>display: none</code> ?",
        options: [
            "Ils font tous exactement la meme chose",
            "opacity: 0 rend invisible mais garde la place et reste cliquable, visibility: hidden garde la place mais pas cliquable, display: none retire du flux",
            "display: none garde la place, opacity: 0 ne garde pas la place",
            "visibility: hidden retire l'element du flux"
        ],
        answer: 1,
        explanation: "<code>opacity: 0</code> : invisible, garde sa place, reste cliquable. <code>visibility: hidden</code> : invisible, garde sa place, non cliquable. <code>display: none</code> : completement retire, ne prend aucune place."
    },
    {
        chapter: 6,
        question: "Que fait <code>transform: translate(50px, 20px)</code> ?",
        options: [
            "Agrandit l'element de 50px par 20px",
            "Fait tourner l'element",
            "Deplace l'element de 50px a droite et 20px vers le bas",
            "Change l'opacite de l'element"
        ],
        answer: 2,
        explanation: "<code>translate(x, y)</code> deplace visuellement un element. <code>translate(50px, 20px)</code> le decale de 50px vers la droite et 20px vers le bas, sans affecter le flux."
    }
];

// ========================
// QUIZ ENGINE
// ========================
let state = 'start';
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

function startChapter() { showQuestion(); }

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
        if (currentChapter < chapters.length - 1) { showPause(); }
        else { showResults(); }
    } else { showQuestion(); }
}

function showPause() {
    state = 'pause';
    updateProgress();
    const pct = Math.round(chapterScore / chapterTotal * 100);
    let color = '#e74c3c', emoji = 'Relisez la lecon.';
    if (pct >= 80) { color = '#27ae60'; emoji = 'Tres bien !'; }
    else if (pct >= 60) { color = '#2980b9'; emoji = 'Pas mal !'; }
    else if (pct >= 40) { color = '#f39c12'; emoji = 'A revoir.'; }
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
        fetch('/api/progress', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
            body: JSON.stringify({
                qcm_name: 'qcm-css',
                chapter_completed: currentChapter + 1,
                total_chapters: chapters.length,
                score_so_far: score,
                total_so_far: globalQIndex
            })
        }).then(() => { window.location.href = '/dashboard'; });
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
    if (pct >= 80) { levelClass = 'level-excellent'; message = 'Excellent !'; detail = 'Vous maitrisez les bases de CSS.'; }
    else if (pct >= 60) { levelClass = 'level-good'; message = 'Bon travail !'; detail = 'Relisez les chapitres difficiles.'; }
    else if (pct >= 40) { levelClass = 'level-average'; message = 'C\'est un debut.'; detail = 'Reprenez chaque chapitre.'; }
    else { levelClass = 'level-weak'; message = 'Ne vous decouragez pas !'; detail = 'Recommencez depuis le debut.'; }
    let catHtml = '<div class="cat-scores">';
    chapters.forEach((ch, idx) => {
        const chAnswers = answers.filter(a => a.chapter === idx);
        const chCorrect = chAnswers.filter(a => a.correct).length;
        const chTotal = chAnswers.length;
        const p = chTotal > 0 ? Math.round(chCorrect / chTotal * 100) : 0;
        let c = '#e74c3c';
        if (p >= 80) c = '#27ae60'; else if (p >= 60) c = '#2980b9'; else if (p >= 40) c = '#f39c12';
        catHtml += `<div class="cat-score-card"><div class="cat-name">Ch.${idx+1} ${ch.title.split(':')[0]}</div><div class="cat-pct" style="color:${c}">${p}%</div><div class="cat-detail">${chCorrect}/${chTotal}</div></div>`;
    });
    catHtml += '</div>';
    let weakest = null, weakPct = 101;
    chapters.forEach((ch, idx) => {
        const chAnswers = answers.filter(a => a.chapter === idx);
        const chCorrect = chAnswers.filter(a => a.correct).length;
        const p = chAnswers.length > 0 ? (chCorrect / chAnswers.length * 100) : 0;
        if (p < weakPct) { weakPct = p; weakest = ch.title; }
    });
    let advice = '';
    if (weakPct < 60 && weakest) advice = `<p style="text-align:center;color:#2965f1;margin-top:10px">A retravailler en priorite : <strong>${weakest}</strong></p>`;
    resultsDiv.innerHTML = `
        <div class="score-circle ${levelClass}">${pct}%<span class="label">${score}/${total}</span></div>
        <div class="level-message">${message}</div>
        <div class="level-detail">${detail}</div>
        ${catHtml}${advice}
        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Recommencer</button>
            <button class="btn btn-restart" onclick="retryFailed()" style="margin-left:10px">Retravailler mes erreurs</button>
            <button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">Accueil</button>
        </div>`;

    // Delete progress (quiz completed)
    fetch('/api/progress', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({ qcm_name: 'qcm-css', chapter_completed: -1, total_chapters: chapters.length })
    });

    // Save score
    fetch('/api/scores', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({
            qcm_name: 'qcm-css',
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

fetch('/api/progress/qcm-css')
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
