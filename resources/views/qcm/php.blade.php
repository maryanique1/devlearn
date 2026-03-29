@extends('layouts.app')
@section('title', 'Apprendre PHP - QCM Progressif')

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
            color: #8892BF;
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
            background: linear-gradient(90deg, #8892BF, #4F5B93);
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
            background: #8892BF;
            color: #1a1a2e;
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

        .options li:hover { border-color: #8892BF; background: rgba(0,100,200,0.08); }
        .options li.selected { border-color: #8892BF; background: rgba(137,111,61,0.12); }
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
            border-left: 4px solid #8892BF;
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

        .btn-primary { background: #8892BF; color: #1a1a2e; font-weight: bold; }
        .btn-primary:hover { background: #7a82af; }
        .btn-primary:disabled { background: #555; color: #999; cursor: not-allowed; }
        .btn-restart { background: var(--bg-input); color: var(--text-main); border: 1px solid var(--border-subtle); }
        .btn-restart:hover { background: #1a4a80; }

        .btn-container { text-align: center; margin-top: 20px; }

        /* Lesson card (pause between chapters) */
        .lesson-card {
            background: linear-gradient(135deg, var(--bg-card), var(--bg-input));
            border: 2px solid #8892BF33;
            border-radius: 16px;
            padding: 35px;
            margin-bottom: 20px;
        }

        .lesson-card h2 {
            color: #8892BF;
            margin-bottom: 8px;
            font-size: 22px;
        }

        .lesson-card .chapter-num {
            color: #8892BF;
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
            border: 1px solid #8892BF33;
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
            background: #8892BF15;
            border-left: 3px solid #8892BF;
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

        .cat-score-card .cat-name { font-size: 12px; font-weight: bold; margin-bottom: 8px; color: #8892BF; }
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
            background: #4F5B93;
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
            color: #8892BF;
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
    <h1>Apprendre PHP</h1>
    <p class="subtitle">QCM progressif &bull; 50 questions &bull; 7 chapitres</p>

    <!-- Start screen -->
    <div id="start-screen" class="start-screen">
        <div class="js-logo">PHP</div>
        <p>Un parcours d'apprentissage complet pour decouvrir PHP depuis zero.<br>
        Chaque chapitre commence par une <strong>mini-lecon</strong>, puis vous testez vos connaissances.</p>

        <div class="roadmap">
            <div class="step"><span class="dot">1</span> Les bases : syntaxe et variables (8 questions)</div>
            <div class="step"><span class="dot">2</span> Les operateurs et conditions (7 questions)</div>
            <div class="step"><span class="dot">3</span> Les boucles (6 questions)</div>
            <div class="step"><span class="dot">4</span> Les fonctions (7 questions)</div>
            <div class="step"><span class="dot">5</span> Les tableaux (8 questions)</div>
            <div class="step"><span class="dot">6</span> Les formulaires et superglobales (7 questions)</div>
            <div class="step"><span class="dot">7</span> PHP et MySQL : les bases (7 questions)</div>
        </div>

        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Commencer l'apprentissage</button>
        </div>
        <div id="resume-banner" style="display:none; margin-top:20px; background:var(--bg-card); border:2px solid #8892BF; border-radius:12px; padding:20px; text-align:center;">
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
        title: "Les bases : syntaxe et variables",
        num: 1,
        lesson: `<p>PHP est un langage qui s'execute <strong>cote serveur</strong>. Le navigateur ne voit jamais le code PHP, il recoit uniquement le HTML genere.</p>

<p>Le code PHP se place entre les balises <code>&lt;?php</code> et <code>?&gt;</code> :</p>
<div class="code-example"><span class="keyword">&lt;?php</span>
  <span class="keyword">echo</span> <span class="string">"Bonjour le monde !"</span>;
<span class="keyword">?&gt;</span></div>

<p>Les <strong>variables</strong> commencent toujours par le signe <code>$</code> :</p>
<div class="code-example"><span class="keyword">$prenom</span> = <span class="string">"Ahmed"</span>;      <span class="comment">// une chaine de caracteres (string)</span>
<span class="keyword">$age</span> = <span class="number">25</span>;               <span class="comment">// un entier (int)</span>
<span class="keyword">$taille</span> = <span class="number">1.75</span>;           <span class="comment">// un nombre decimal (float)</span>
<span class="keyword">$estEtudiant</span> = <span class="keyword">true</span>;    <span class="comment">// un booleen (bool)</span></div>

<p>Les principaux <strong>types de donnees</strong> en PHP :</p>
<p>&bull; <code>string</code> (texte) : <code>"Bonjour"</code> ou <code>'Salut'</code></p>
<p>&bull; <code>int</code> (entier) : <code>42</code></p>
<p>&bull; <code>float</code> (decimal) : <code>3.14</code></p>
<p>&bull; <code>bool</code> (booleen) : <code>true</code> ou <code>false</code></p>

<p>Pour afficher du contenu, on utilise <code>echo</code>. La <strong>concatenation</strong> se fait avec le <strong>point</strong> <code>.</code> :</p>
<div class="code-example"><span class="keyword">echo</span> <span class="string">"Bonjour "</span> . <span class="keyword">$prenom</span>;  <span class="comment">// Bonjour Ahmed</span>
<span class="keyword">echo</span> <span class="string">"Age : "</span> . <span class="keyword">$age</span>;       <span class="comment">// Age : 25</span></div>

<p>Les <strong>commentaires</strong> s'ecrivent ainsi :</p>
<div class="code-example"><span class="comment">// Commentaire sur une ligne</span>
<span class="comment">/* Commentaire
   sur plusieurs lignes */</span></div>

<div class="tip">Attention : chaque instruction PHP se termine par un <strong>point-virgule</strong> <code>;</code>. L'oublier provoque une erreur.</div>`
    },
    {
        title: "Operateurs et conditions",
        num: 2,
        lesson: `<p>PHP dispose d'<strong>operateurs</strong> pour faire des calculs, des comparaisons et des conditions.</p>

<p><strong>Operateurs arithmetiques :</strong></p>
<div class="code-example"><span class="keyword">$a</span> = <span class="number">10</span> + <span class="number">5</span>;    <span class="comment">// 15  (addition)</span>
<span class="keyword">$b</span> = <span class="number">10</span> - <span class="number">3</span>;    <span class="comment">// 7   (soustraction)</span>
<span class="keyword">$c</span> = <span class="number">4</span> * <span class="number">3</span>;     <span class="comment">// 12  (multiplication)</span>
<span class="keyword">$d</span> = <span class="number">10</span> / <span class="number">2</span>;    <span class="comment">// 5   (division)</span>
<span class="keyword">$e</span> = <span class="number">10</span> % <span class="number">3</span>;    <span class="comment">// 1   (modulo : reste de la division)</span></div>

<p><strong>Operateurs de comparaison :</strong></p>
<div class="code-example"><span class="number">5</span> == <span class="string">"5"</span>     <span class="comment">// true  (compare la valeur, pas le type)</span>
<span class="number">5</span> === <span class="string">"5"</span>    <span class="comment">// false (compare la valeur ET le type)</span>
<span class="number">5</span> != <span class="number">3</span>       <span class="comment">// true  (different)</span>
<span class="number">5</span> > <span class="number">3</span>        <span class="comment">// true  (plus grand)</span>
<span class="number">5</span> &lt;= <span class="number">5</span>       <span class="comment">// true  (plus petit ou egal)</span></div>

<p><strong>Les conditions</strong> avec <code>if</code>, <code>elseif</code> et <code>else</code> :</p>
<div class="code-example"><span class="keyword">$age</span> = <span class="number">18</span>;

<span class="keyword">if</span> (<span class="keyword">$age</span> >= <span class="number">18</span>) {
    <span class="keyword">echo</span> <span class="string">"Majeur"</span>;
} <span class="keyword">elseif</span> (<span class="keyword">$age</span> >= <span class="number">16</span>) {
    <span class="keyword">echo</span> <span class="string">"Presque majeur"</span>;
} <span class="keyword">else</span> {
    <span class="keyword">echo</span> <span class="string">"Mineur"</span>;
}</div>

<p><strong>L'operateur ternaire</strong> est un raccourci pour if/else :</p>
<div class="code-example"><span class="keyword">$statut</span> = (<span class="keyword">$age</span> >= <span class="number">18</span>) ? <span class="string">"majeur"</span> : <span class="string">"mineur"</span>;</div>

<p><strong>Operateurs logiques :</strong></p>
<p>&bull; <code>&&</code> (ET) : les deux conditions doivent etre vraies</p>
<p>&bull; <code>||</code> (OU) : au moins une doit etre vraie</p>
<p>&bull; <code>!</code> (NON) : inverse une condition</p>

<div class="tip">Utilisez <code>===</code> au lieu de <code>==</code>. Le triple egal verifie aussi le type, ce qui evite les surprises (ex: <code>0 == ""</code> est <code>true</code> en PHP !).</div>`
    },
    {
        title: "Les boucles",
        num: 3,
        lesson: `<p>Les <strong>boucles</strong> repetent un bloc de code plusieurs fois.</p>

<p><strong>La boucle <code>for</code></strong> : quand on sait combien de fois repeter</p>
<div class="code-example"><span class="keyword">for</span> (<span class="keyword">$i</span> = <span class="number">0</span>; <span class="keyword">$i</span> &lt; <span class="number">5</span>; <span class="keyword">$i</span>++) {
    <span class="keyword">echo</span> <span class="keyword">$i</span> . <span class="string">" "</span>;  <span class="comment">// 0 1 2 3 4</span>
}</div>

<p><strong>La boucle <code>while</code></strong> : tant qu'une condition est vraie</p>
<div class="code-example"><span class="keyword">$compteur</span> = <span class="number">0</span>;
<span class="keyword">while</span> (<span class="keyword">$compteur</span> &lt; <span class="number">3</span>) {
    <span class="keyword">echo</span> <span class="keyword">$compteur</span>;  <span class="comment">// 0, 1, 2</span>
    <span class="keyword">$compteur</span>++;
}</div>

<p><strong>La boucle <code>do...while</code></strong> : s'execute au moins une fois</p>
<div class="code-example"><span class="keyword">$x</span> = <span class="number">10</span>;
<span class="keyword">do</span> {
    <span class="keyword">echo</span> <span class="keyword">$x</span>;  <span class="comment">// affiche 10 meme si la condition est fausse</span>
} <span class="keyword">while</span> (<span class="keyword">$x</span> &lt; <span class="number">5</span>);</div>

<p><strong>La boucle <code>foreach</code></strong> : parcourir les tableaux facilement</p>
<div class="code-example"><span class="keyword">$fruits</span> = [<span class="string">"pomme"</span>, <span class="string">"banane"</span>, <span class="string">"orange"</span>];
<span class="keyword">foreach</span> (<span class="keyword">$fruits</span> <span class="keyword">as</span> <span class="keyword">$fruit</span>) {
    <span class="keyword">echo</span> <span class="keyword">$fruit</span> . <span class="string">" "</span>;
}

<span class="comment">// Avec la cle (index)</span>
<span class="keyword">foreach</span> (<span class="keyword">$fruits</span> <span class="keyword">as</span> <span class="keyword">$index</span> => <span class="keyword">$fruit</span>) {
    <span class="keyword">echo</span> <span class="keyword">$index</span> . <span class="string">" : "</span> . <span class="keyword">$fruit</span>;
}</div>

<div class="tip"><code>break</code> sort de la boucle immediatement. <code>continue</code> passe a l'iteration suivante.</div>`
    },
    {
        title: "Les fonctions",
        num: 4,
        lesson: `<p>Une <strong>fonction</strong> est un bloc de code reutilisable. On la definit avec le mot-cle <code>function</code>.</p>

<div class="code-example"><span class="keyword">function</span> saluer(<span class="keyword">$prenom</span>) {
    <span class="keyword">return</span> <span class="string">"Bonjour "</span> . <span class="keyword">$prenom</span>;
}

<span class="keyword">echo</span> saluer(<span class="string">"Ahmed"</span>);  <span class="comment">// Bonjour Ahmed</span></div>

<p>On peut definir des <strong>valeurs par defaut</strong> pour les parametres :</p>
<div class="code-example"><span class="keyword">function</span> saluer(<span class="keyword">$prenom</span> = <span class="string">"inconnu"</span>) {
    <span class="keyword">return</span> <span class="string">"Bonjour "</span> . <span class="keyword">$prenom</span>;
}

<span class="keyword">echo</span> saluer();          <span class="comment">// Bonjour inconnu</span>
<span class="keyword">echo</span> saluer(<span class="string">"Sara"</span>);   <span class="comment">// Bonjour Sara</span></div>

<p>PHP propose des <strong>type hints</strong> pour preciser les types attendus :</p>
<div class="code-example"><span class="keyword">function</span> additionner(<span class="keyword">int</span> <span class="keyword">$a</span>, <span class="keyword">int</span> <span class="keyword">$b</span>): <span class="keyword">int</span> {
    <span class="keyword">return</span> <span class="keyword">$a</span> + <span class="keyword">$b</span>;
}</div>

<p><strong>Fonctions integrees utiles :</strong></p>
<div class="code-example">strlen(<span class="string">"Bonjour"</span>);        <span class="comment">// 7 (longueur de la chaine)</span>
strtolower(<span class="string">"HELLO"</span>);       <span class="comment">// "hello" (en minuscules)</span>
strtoupper(<span class="string">"hello"</span>);       <span class="comment">// "HELLO" (en majuscules)</span>
substr(<span class="string">"Bonjour"</span>, <span class="number">0</span>, <span class="number">3</span>);  <span class="comment">// "Bon" (sous-chaine)</span></div>

<p><strong>Portee des variables :</strong> une variable definie en dehors d'une fonction n'est pas accessible a l'interieur (et inversement). On peut utiliser <code>global</code> ou <code>$GLOBALS</code> pour y acceder :</p>
<div class="code-example"><span class="keyword">$nom</span> = <span class="string">"Ahmed"</span>;

<span class="keyword">function</span> afficher() {
    <span class="keyword">global</span> <span class="keyword">$nom</span>;
    <span class="keyword">echo</span> <span class="keyword">$nom</span>;  <span class="comment">// Ahmed</span>
}</div>

<div class="tip"><code>return</code> renvoie une valeur et arrete la fonction. Sans <code>return</code>, la fonction retourne <code>null</code>.</div>`
    },
    {
        title: "Les tableaux",
        num: 5,
        lesson: `<p>PHP propose deux types de tableaux : les tableaux <strong>indexes</strong> et les tableaux <strong>associatifs</strong>.</p>

<p><strong>Tableau indexe</strong> (numerote automatiquement) :</p>
<div class="code-example"><span class="keyword">$fruits</span> = [<span class="string">"pomme"</span>, <span class="string">"banane"</span>, <span class="string">"orange"</span>];

<span class="keyword">echo</span> <span class="keyword">$fruits</span>[<span class="number">0</span>];   <span class="comment">// pomme</span>
<span class="keyword">echo</span> <span class="keyword">$fruits</span>[<span class="number">1</span>];   <span class="comment">// banane</span>
<span class="keyword">echo</span> count(<span class="keyword">$fruits</span>); <span class="comment">// 3</span></div>

<p><strong>Tableau associatif</strong> (avec des cles nommees) :</p>
<div class="code-example"><span class="keyword">$personne</span> = [
    <span class="string">"nom"</span> => <span class="string">"Ahmed"</span>,
    <span class="string">"age"</span> => <span class="number">25</span>,
    <span class="string">"ville"</span> => <span class="string">"Paris"</span>
];

<span class="keyword">echo</span> <span class="keyword">$personne</span>[<span class="string">"nom"</span>];  <span class="comment">// Ahmed</span></div>

<p><strong>Fonctions utiles pour les tableaux :</strong></p>
<div class="code-example">count(<span class="keyword">$fruits</span>);                    <span class="comment">// 3 (nombre d'elements)</span>
array_push(<span class="keyword">$fruits</span>, <span class="string">"kiwi"</span>);       <span class="comment">// ajoute a la fin</span>
in_array(<span class="string">"banane"</span>, <span class="keyword">$fruits</span>);       <span class="comment">// true (existe ?)</span>
array_merge(<span class="keyword">$tab1</span>, <span class="keyword">$tab2</span>);          <span class="comment">// fusionne deux tableaux</span>
sort(<span class="keyword">$fruits</span>);                       <span class="comment">// trie le tableau</span>
array_key_exists(<span class="string">"nom"</span>, <span class="keyword">$personne</span>); <span class="comment">// true</span></div>

<p><strong>Tableau multidimensionnel :</strong></p>
<div class="code-example"><span class="keyword">$eleves</span> = [
    [<span class="string">"nom"</span> => <span class="string">"Ahmed"</span>, <span class="string">"note"</span> => <span class="number">15</span>],
    [<span class="string">"nom"</span> => <span class="string">"Sara"</span>, <span class="string">"note"</span> => <span class="number">18</span>]
];
<span class="keyword">echo</span> <span class="keyword">$eleves</span>[<span class="number">0</span>][<span class="string">"nom"</span>];  <span class="comment">// Ahmed</span></div>

<div class="tip">Les index commencent toujours a <code>0</code>. Utilisez <code>count()</code> pour connaitre le nombre d'elements.</div>`
    },
    {
        title: "Formulaires et superglobales",
        num: 6,
        lesson: `<p>PHP est souvent utilise pour traiter les <strong>formulaires HTML</strong>. Les donnees arrivent via les <strong>superglobales</strong>.</p>

<p><strong>Les superglobales principales :</strong></p>
<p>&bull; <code>$_GET</code> : donnees envoyees dans l'URL (visible)</p>
<p>&bull; <code>$_POST</code> : donnees envoyees dans le corps de la requete (invisible)</p>
<p>&bull; <code>$_SESSION</code> : donnees stockees cote serveur pour un utilisateur</p>
<p>&bull; <code>$_COOKIE</code> : donnees stockees dans le navigateur</p>
<p>&bull; <code>$_SERVER</code> : informations sur le serveur et la requete</p>

<p><strong>Exemple de formulaire :</strong></p>
<div class="code-example"><span class="comment">&lt;!-- HTML --&gt;</span>
&lt;form action=<span class="string">"traitement.php"</span> method=<span class="string">"post"</span>&gt;
    &lt;input type=<span class="string">"text"</span> name=<span class="string">"prenom"</span>&gt;
    &lt;button type=<span class="string">"submit"</span>&gt;Envoyer&lt;/button&gt;
&lt;/form&gt;

<span class="comment">// traitement.php</span>
<span class="keyword">$prenom</span> = <span class="keyword">$_POST</span>[<span class="string">"prenom"</span>];</div>

<p><strong>Securiser les donnees :</strong></p>
<div class="code-example"><span class="comment">// Verifier si une variable existe</span>
<span class="keyword">if</span> (isset(<span class="keyword">$_POST</span>[<span class="string">"prenom"</span>])) {
    <span class="keyword">$prenom</span> = htmlspecialchars(<span class="keyword">$_POST</span>[<span class="string">"prenom"</span>]);
}

<span class="comment">// isset() : verifie si la variable existe et n'est pas null</span>
<span class="comment">// empty() : verifie si la variable est vide ("", 0, null, false...)</span>
<span class="comment">// htmlspecialchars() : protege contre les injections XSS</span></div>

<p><strong>Les sessions :</strong></p>
<div class="code-example">session_start();  <span class="comment">// obligatoire en debut de script</span>
<span class="keyword">$_SESSION</span>[<span class="string">"user"</span>] = <span class="string">"Ahmed"</span>;  <span class="comment">// stocker</span>
<span class="keyword">echo</span> <span class="keyword">$_SESSION</span>[<span class="string">"user"</span>];       <span class="comment">// lire</span></div>

<div class="tip"><code>htmlspecialchars()</code> convertit les caracteres speciaux en entites HTML. Cela empeche l'injection de code malveillant (attaque XSS).</div>`
    },
    {
        title: "PHP et MySQL : les bases",
        num: 7,
        lesson: `<p><strong>PDO</strong> (PHP Data Objects) est la methode recommandee pour se connecter a une base de donnees MySQL.</p>

<p><strong>Connexion avec PDO :</strong></p>
<div class="code-example"><span class="keyword">try</span> {
    <span class="keyword">$pdo</span> = <span class="keyword">new</span> PDO(
        <span class="string">"mysql:host=localhost;dbname=mabase"</span>,
        <span class="string">"root"</span>,    <span class="comment">// utilisateur</span>
        <span class="string">""</span>         <span class="comment">// mot de passe</span>
    );
    <span class="keyword">$pdo</span>->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} <span class="keyword">catch</span> (PDOException <span class="keyword">$e</span>) {
    <span class="keyword">echo</span> <span class="string">"Erreur : "</span> . <span class="keyword">$e</span>->getMessage();
}</div>

<p><strong>Requetes preparees</strong> (protection contre les injections SQL) :</p>
<div class="code-example"><span class="comment">// SELECT avec prepare/execute</span>
<span class="keyword">$stmt</span> = <span class="keyword">$pdo</span>->prepare(<span class="string">"SELECT * FROM users WHERE id = :id"</span>);
<span class="keyword">$stmt</span>->bindParam(<span class="string">":id"</span>, <span class="keyword">$id</span>);
<span class="keyword">$stmt</span>->execute();
<span class="keyword">$user</span> = <span class="keyword">$stmt</span>->fetch();       <span class="comment">// une seule ligne</span>
<span class="keyword">$users</span> = <span class="keyword">$stmt</span>->fetchAll();    <span class="comment">// toutes les lignes</span></div>

<p><strong>CRUD</strong> = les 4 operations de base :</p>
<p>&bull; <strong>C</strong>reate : <code>INSERT INTO</code></p>
<p>&bull; <strong>R</strong>ead : <code>SELECT</code></p>
<p>&bull; <strong>U</strong>pdate : <code>UPDATE</code></p>
<p>&bull; <strong>D</strong>elete : <code>DELETE</code></p>

<div class="code-example"><span class="comment">// INSERT</span>
<span class="keyword">$stmt</span> = <span class="keyword">$pdo</span>->prepare(<span class="string">"INSERT INTO users (nom, age) VALUES (:nom, :age)"</span>);
<span class="keyword">$stmt</span>->execute([<span class="string">":nom"</span> => <span class="string">"Ahmed"</span>, <span class="string">":age"</span> => <span class="number">25</span>]);

<span class="comment">// UPDATE</span>
<span class="keyword">$stmt</span> = <span class="keyword">$pdo</span>->prepare(<span class="string">"UPDATE users SET age = :age WHERE id = :id"</span>);
<span class="keyword">$stmt</span>->execute([<span class="string">":age"</span> => <span class="number">26</span>, <span class="string">":id"</span> => <span class="number">1</span>]);

<span class="comment">// DELETE</span>
<span class="keyword">$stmt</span> = <span class="keyword">$pdo</span>->prepare(<span class="string">"DELETE FROM users WHERE id = :id"</span>);
<span class="keyword">$stmt</span>->execute([<span class="string">":id"</span> => <span class="number">1</span>]);</div>

<div class="tip">Ne jamais inserer directement les variables dans une requete SQL ! Utilisez toujours <code>prepare()</code> + <code>execute()</code> pour eviter les injections SQL.</div>`
    }
];

// ========================
// QUESTIONS (50)
// ========================
const allQuestions = [
    // === CHAPITRE 1 : Les bases — syntaxe et variables (8) ===
    {
        chapter: 0,
        question: "Quelle est la balise d'ouverture correcte pour ecrire du code PHP ?",
        options: ["<code>&lt;php&gt;</code>", "<code>&lt;?php</code>", "<code>&lt;script php&gt;</code>", "<code>&lt;%php</code>"],
        answer: 1,
        explanation: "La balise d'ouverture standard de PHP est <code>&lt;?php</code>. Le code se termine avec <code>?&gt;</code> (optionnel si le fichier ne contient que du PHP)."
    },
    {
        chapter: 0,
        question: "Comment declare-t-on correctement une variable en PHP ?",
        options: ["<code>prenom = \"Ali\";</code>", "<code>let prenom = \"Ali\";</code>", "<code>$prenom = \"Ali\";</code>", "<code>var prenom = \"Ali\";</code>"],
        answer: 2,
        explanation: "En PHP, toute variable commence par le signe <code>$</code>. Il n'y a pas de mot-cle <code>let</code> ou <code>var</code> comme en JavaScript."
    },
    {
        chapter: 0,
        question: "Quelle instruction affiche du texte en PHP ?",
        options: ["<code>console.log(\"Salut\");</code>", "<code>print_r(\"Salut\");</code>", "<code>echo \"Salut\";</code>", "<code>write(\"Salut\");</code>"],
        answer: 2,
        explanation: "<code>echo</code> est l'instruction la plus courante pour afficher du texte en PHP. <code>print</code> existe aussi mais est moins utilise. <code>console.log</code> est du JavaScript."
    },
    {
        chapter: 0,
        question: "Quel operateur sert a concatener (coller) deux chaines en PHP ?",
        options: ["<code>+</code>", "<code>.</code>", "<code>&</code>", "<code>,</code>"],
        answer: 1,
        explanation: "En PHP, le <strong>point</strong> <code>.</code> est l'operateur de concatenation. Contrairement a JavaScript, <code>+</code> ne sert qu'aux calculs mathematiques en PHP."
    },
    {
        chapter: 0,
        question: "Quel est le type de la valeur <code>3.14</code> en PHP ?",
        options: ["<code>int</code>", "<code>string</code>", "<code>float</code>", "<code>double</code>"],
        answer: 2,
        explanation: "En PHP, les nombres decimaux sont de type <code>float</code>. Bien que PHP utilise aussi le terme <code>double</code> internement, le type officiel est <code>float</code>."
    },
    {
        chapter: 0,
        question: "Quelle syntaxe est correcte pour un commentaire sur une seule ligne en PHP ?",
        options: ["<code>&lt;!-- commentaire --&gt;</code>", "<code>// commentaire</code>", "<code>** commentaire</code>", "<code>## commentaire</code>"],
        answer: 1,
        explanation: "En PHP, les commentaires sur une ligne utilisent <code>//</code>. Pour plusieurs lignes, on utilise <code>/* ... */</code>. La syntaxe <code>&lt;!-- --&gt;</code> est du HTML."
    },
    {
        chapter: 0,
        question: "Quel nom de variable est <strong>invalide</strong> en PHP ?",
        options: ["<code>$mon_nom</code>", "<code>$_age</code>", "<code>$2nombre</code>", "<code>$monNom</code>"],
        answer: 2,
        explanation: "Un nom de variable ne peut pas commencer par un chiffre. <code>$2nombre</code> est invalide. Les noms peuvent contenir des lettres, chiffres et underscores, mais doivent commencer par une lettre ou un underscore."
    },
    {
        chapter: 0,
        question: "Ou s'execute le code PHP ?",
        options: ["Dans le navigateur du client", "Sur le serveur", "Dans la console JavaScript", "Dans le systeme d'exploitation"],
        answer: 1,
        explanation: "PHP est un langage <strong>cote serveur</strong>. Le serveur execute le code PHP et envoie le resultat (HTML) au navigateur. Le client ne voit jamais le code PHP."
    },

    // === CHAPITRE 2 : Les operateurs et conditions (7) ===
    {
        chapter: 1,
        question: "Que donne <code>10 % 3</code> en PHP ?",
        options: ["<code>3.33</code>", "<code>3</code>", "<code>1</code>", "<code>0</code>"],
        answer: 2,
        explanation: "L'operateur <code>%</code> (modulo) donne le <strong>reste</strong> de la division entiere. 10 divise par 3 = 3 avec un reste de <strong>1</strong>."
    },
    {
        chapter: 1,
        question: "Que retourne <code>5 === \"5\"</code> en PHP ?",
        options: ["<code>true</code>", "<code>false</code>", "<code>null</code>", "Une erreur"],
        answer: 1,
        explanation: "<code>===</code> est la comparaison stricte : elle verifie la valeur ET le type. <code>5</code> est un entier et <code>\"5\"</code> est une chaine, donc le resultat est <code>false</code>."
    },
    {
        chapter: 1,
        question: "Quelle est la syntaxe correcte du <code>elseif</code> en PHP ?",
        options: ["<code>else if</code> (avec espace, toujours)", "<code>elseif</code> (en un seul mot)", "<code>elif</code>", "Les deux premieres sont valides"],
        answer: 3,
        explanation: "En PHP, les deux syntaxes sont acceptees : <code>elseif</code> (en un mot) et <code>else if</code> (en deux mots). Les deux fonctionnent de maniere identique."
    },
    {
        chapter: 1,
        question: "Que se passe-t-il si on oublie <code>break</code> dans un <code>switch</code> ?",
        options: [
            "Une erreur est levee",
            "Le programme s'arrete",
            "L'execution continue dans les cas suivants (fall-through)",
            "Rien de special"
        ],
        answer: 2,
        explanation: "Sans <code>break</code>, le code \"tombe\" dans les cas suivants et les execute aussi. C'est le comportement <strong>fall-through</strong>. Il faut presque toujours mettre un <code>break</code>."
    },
    {
        chapter: 1,
        question: "Que vaut <code>$result</code> apres ce code ?<div class='code-block'>$age = 20;\n$result = ($age >= 18) ? \"majeur\" : \"mineur\";</div>",
        options: ["<code>\"mineur\"</code>", "<code>\"majeur\"</code>", "<code>true</code>", "<code>20</code>"],
        answer: 1,
        explanation: "L'operateur ternaire <code>condition ? valeurSiVrai : valeurSiFaux</code>. Ici <code>20 >= 18</code> est vrai, donc <code>$result</code> vaut <code>\"majeur\"</code>."
    },
    {
        chapter: 1,
        question: "Que signifie <code>||</code> en PHP ?",
        options: ["ET logique", "OU logique", "NON logique", "Comparaison stricte"],
        answer: 1,
        explanation: "<code>||</code> est l'operateur OU logique. L'expression est vraie si au moins l'une des deux conditions est vraie."
    },
    {
        chapter: 1,
        question: "Laquelle de ces valeurs est consideree comme <code>false</code> en PHP ?",
        options: ["<code>\"0\"</code>", "<code>1</code>", "<code>\"hello\"</code>", "<code>[1, 2]</code>"],
        answer: 0,
        explanation: "En PHP, la chaine <code>\"0\"</code> est consideree comme <code>false</code> (falsy). Les autres valeurs falsy incluent : <code>0</code>, <code>\"\"</code>, <code>null</code>, <code>false</code> et un tableau vide <code>[]</code>."
    },

    // === CHAPITRE 3 : Les boucles (6) ===
    {
        chapter: 2,
        question: "Quelle est la syntaxe correcte d'une boucle <code>for</code> en PHP ?",
        options: [
            "<code>for ($i = 0; $i < 5; $i++)</code>",
            "<code>for (i = 0; i < 5; i++)</code>",
            "<code>for ($i in range(5))</code>",
            "<code>loop ($i = 0 to 5)</code>"
        ],
        answer: 0,
        explanation: "La syntaxe du <code>for</code> en PHP est : <code>for (initialisation; condition; incrementation)</code>. Les variables doivent avoir le <code>$</code>."
    },
    {
        chapter: 2,
        question: "Quelle est la difference entre <code>while</code> et <code>do...while</code> ?",
        options: [
            "Aucune difference",
            "<code>do...while</code> s'execute au moins une fois, meme si la condition est fausse",
            "<code>while</code> est plus rapide",
            "<code>do...while</code> ne peut pas utiliser <code>break</code>"
        ],
        answer: 1,
        explanation: "<code>do...while</code> execute le code une premiere fois <strong>avant</strong> de verifier la condition. <code>while</code> verifie la condition d'abord, donc peut ne jamais s'executer."
    },
    {
        chapter: 2,
        question: "Que fait cette boucle ?<div class='code-block'>$fruits = [\"pomme\", \"banane\"];\nforeach ($fruits as $index => $fruit) {\n    echo \"$index : $fruit \";\n}</div>",
        options: [
            "Affiche seulement les fruits",
            "Affiche <code>0 : pomme 1 : banane</code>",
            "Provoque une erreur",
            "Affiche seulement les index"
        ],
        answer: 1,
        explanation: "La syntaxe <code>foreach ($tableau as $cle => $valeur)</code> permet de recuperer a la fois l'index et la valeur. Ici on obtient <code>0 : pomme 1 : banane</code>."
    },
    {
        chapter: 2,
        question: "Que fait <code>break</code> dans une boucle PHP ?",
        options: [
            "Passe a l'iteration suivante",
            "Sort immediatement de la boucle",
            "Fait une pause d'1 seconde",
            "Redemarre la boucle"
        ],
        answer: 1,
        explanation: "<code>break</code> arrete la boucle completement et immediatement. L'execution continue apres la boucle."
    },
    {
        chapter: 2,
        question: "Que fait <code>continue</code> dans une boucle PHP ?",
        options: [
            "Sort de la boucle",
            "Saute le reste du tour actuel et passe au suivant",
            "Relance la boucle depuis le debut",
            "Arrete le script"
        ],
        answer: 1,
        explanation: "<code>continue</code> saute le reste du code de l'iteration en cours et passe directement a l'iteration suivante de la boucle."
    },
    {
        chapter: 2,
        question: "Quel est le risque d'une boucle <code>while(true)</code> sans <code>break</code> ?",
        options: [
            "Elle ne s'execute pas",
            "Elle s'execute une seule fois",
            "Elle tourne a l'infini et bloque le serveur",
            "Elle affiche une erreur de syntaxe"
        ],
        answer: 2,
        explanation: "<code>while(true)</code> ne s'arretera jamais car la condition est toujours vraie. Sans <code>break</code>, c'est une boucle infinie qui peut bloquer le serveur ou atteindre le temps d'execution maximal."
    },

    // === CHAPITRE 4 : Les fonctions (7) ===
    {
        chapter: 3,
        question: "Quelle est la syntaxe correcte pour definir une fonction en PHP ?",
        options: [
            "<code>def maFonction() {}</code>",
            "<code>function maFonction() {}</code>",
            "<code>func maFonction() {}</code>",
            "<code>fn maFonction() {}</code>"
        ],
        answer: 1,
        explanation: "En PHP, on utilise le mot-cle <code>function</code> pour declarer une fonction. <code>def</code> est pour Python, <code>func</code> pour Go/Swift."
    },
    {
        chapter: 3,
        question: "Quelle est la difference entre <code>return</code> et <code>echo</code> dans une fonction ?",
        options: [
            "Aucune difference",
            "<code>return</code> renvoie la valeur a l'appelant, <code>echo</code> l'affiche directement",
            "<code>echo</code> est plus rapide",
            "<code>return</code> affiche et renvoie la valeur"
        ],
        answer: 1,
        explanation: "<code>return</code> renvoie la valeur pour qu'elle puisse etre stockee dans une variable. <code>echo</code> affiche directement sans possibilite de recuperer la valeur."
    },
    {
        chapter: 3,
        question: "Que se passe-t-il si on appelle <code>saluer()</code> avec cette fonction ?<div class='code-block'>function saluer($nom = \"inconnu\") {\n    return \"Bonjour \" . $nom;\n}</div>",
        options: [
            "Une erreur est levee",
            "La fonction retourne <code>\"Bonjour \"</code>",
            "La fonction retourne <code>\"Bonjour inconnu\"</code>",
            "La fonction retourne <code>null</code>"
        ],
        answer: 2,
        explanation: "Le parametre <code>$nom</code> a une valeur par defaut <code>\"inconnu\"</code>. Si on appelle la fonction sans argument, cette valeur est utilisee."
    },
    {
        chapter: 3,
        question: "Que retourne <code>strlen(\"Bonjour\")</code> ?",
        options: ["<code>6</code>", "<code>7</code>", "<code>8</code>", "<code>\"Bonjour\"</code>"],
        answer: 1,
        explanation: "<code>strlen()</code> retourne le nombre de caracteres d'une chaine. \"Bonjour\" contient 7 caracteres : B-o-n-j-o-u-r."
    },
    {
        chapter: 3,
        question: "Que retourne <code>strtolower(\"HELLO\")</code> ?",
        options: ["<code>\"HELLO\"</code>", "<code>\"Hello\"</code>", "<code>\"hello\"</code>", "<code>5</code>"],
        answer: 2,
        explanation: "<code>strtolower()</code> convertit toute la chaine en minuscules. <code>strtoupper()</code> fait l'inverse (tout en majuscules)."
    },
    {
        chapter: 3,
        question: "Que se passe-t-il avec ce code ?<div class='code-block'>$x = 10;\nfunction afficher() {\n    echo $x;\n}</div>",
        options: [
            "Affiche <code>10</code>",
            "Affiche <code>null</code> ou provoque un warning car <code>$x</code> n'est pas accessible",
            "Affiche <code>0</code>",
            "Provoque une erreur fatale"
        ],
        answer: 1,
        explanation: "En PHP, les variables ont une <strong>portee locale</strong>. <code>$x</code> definie a l'exterieur n'est pas accessible dans la fonction. Il faut utiliser <code>global $x;</code> ou <code>$GLOBALS['x']</code>."
    },
    {
        chapter: 3,
        question: "A quoi servent les <strong>type hints</strong> en PHP ?",
        options: [
            "A rendre le code plus rapide",
            "A preciser le type attendu des parametres et du retour d'une fonction",
            "A convertir automatiquement les types",
            "A creer des commentaires"
        ],
        answer: 1,
        explanation: "Les type hints permettent de declarer les types attendus : <code>function add(int $a, int $b): int</code>. PHP verifie alors que les bons types sont passes."
    },

    // === CHAPITRE 5 : Les tableaux (8) ===
    {
        chapter: 4,
        question: "Comment cree-t-on un tableau indexe en PHP ?",
        options: [
            "<code>$fruits = (\"pomme\", \"banane\");</code>",
            "<code>$fruits = [\"pomme\", \"banane\"];</code>",
            "<code>$fruits = {\"pomme\", \"banane\"};</code>",
            "<code>$fruits = &lt;\"pomme\", \"banane\"&gt;;</code>"
        ],
        answer: 1,
        explanation: "Les tableaux se creent avec des <strong>crochets</strong> <code>[]</code> (syntaxe courte) ou avec <code>array()</code>. Les crochets sont la syntaxe moderne recommandee."
    },
    {
        chapter: 4,
        question: "Que retourne <code>$fruits[1]</code> si <code>$fruits = [\"pomme\", \"banane\", \"orange\"]</code> ?",
        options: ["<code>\"pomme\"</code>", "<code>\"banane\"</code>", "<code>\"orange\"</code>", "<code>null</code>"],
        answer: 1,
        explanation: "Les index commencent a <strong>0</strong>. L'index 0 est \"pomme\", l'index 1 est <code>\"banane\"</code> et l'index 2 est \"orange\"."
    },
    {
        chapter: 4,
        question: "Comment accede-t-on a la valeur de la cle <code>\"nom\"</code> dans un tableau associatif ?",
        options: [
            "<code>$personne.nom</code>",
            "<code>$personne[\"nom\"]</code>",
            "<code>$personne->nom</code>",
            "<code>$personne{nom}</code>"
        ],
        answer: 1,
        explanation: "En PHP, on accede aux elements d'un tableau associatif avec <code>$tableau[\"cle\"]</code>. La notation avec le point est en JavaScript, et <code>-></code> est pour les objets PHP."
    },
    {
        chapter: 4,
        question: "Que retourne <code>count([10, 20, 30])</code> ?",
        options: ["<code>2</code>", "<code>3</code>", "<code>30</code>", "<code>60</code>"],
        answer: 1,
        explanation: "<code>count()</code> retourne le nombre d'elements du tableau. Il y a 3 elements : 10, 20 et 30."
    },
    {
        chapter: 4,
        question: "Que fait <code>array_push($fruits, \"kiwi\")</code> ?",
        options: [
            "Ajoute \"kiwi\" au debut du tableau",
            "Ajoute \"kiwi\" a la fin du tableau",
            "Remplace le premier element par \"kiwi\"",
            "Cherche \"kiwi\" dans le tableau"
        ],
        answer: 1,
        explanation: "<code>array_push()</code> ajoute un ou plusieurs elements <strong>a la fin</strong> du tableau. On peut aussi ecrire <code>$fruits[] = \"kiwi\";</code>."
    },
    {
        chapter: 4,
        question: "Que retourne <code>in_array(\"banane\", $fruits)</code> si <code>$fruits = [\"pomme\", \"banane\", \"orange\"]</code> ?",
        options: ["<code>1</code>", "<code>false</code>", "<code>true</code>", "<code>\"banane\"</code>"],
        answer: 2,
        explanation: "<code>in_array()</code> verifie si une valeur existe dans le tableau et retourne <code>true</code> ou <code>false</code>. Ici \"banane\" est bien present."
    },
    {
        chapter: 4,
        question: "Que fait <code>array_merge($tab1, $tab2)</code> ?",
        options: [
            "Compare les deux tableaux",
            "Fusionne les deux tableaux en un seul",
            "Supprime les doublons",
            "Trie les deux tableaux"
        ],
        answer: 1,
        explanation: "<code>array_merge()</code> combine les elements des deux tableaux en un seul nouveau tableau. Les elements de <code>$tab2</code> sont ajoutes apres ceux de <code>$tab1</code>."
    },
    {
        chapter: 4,
        question: "Comment parcourir un tableau associatif avec <code>foreach</code> ?",
        options: [
            "<code>foreach ($tab as $val)</code>",
            "<code>foreach ($tab as $cle => $val)</code>",
            "<code>foreach ($cle => $val in $tab)</code>",
            "<code>for ($tab as $cle => $val)</code>"
        ],
        answer: 1,
        explanation: "La syntaxe <code>foreach ($tableau as $cle => $valeur)</code> permet de recuperer a la fois la cle et la valeur. La premiere forme <code>as $val</code> ne donne que les valeurs."
    },

    // === CHAPITRE 6 : Formulaires et superglobales (7) ===
    {
        chapter: 5,
        question: "Quelle est la difference entre <code>GET</code> et <code>POST</code> ?",
        options: [
            "Aucune difference",
            "<code>GET</code> envoie les donnees dans l'URL, <code>POST</code> dans le corps de la requete",
            "<code>POST</code> est plus rapide",
            "<code>GET</code> ne fonctionne pas avec les formulaires"
        ],
        answer: 1,
        explanation: "<code>GET</code> ajoute les donnees a l'URL (visible, limitee en taille). <code>POST</code> les envoie dans le corps de la requete HTTP (invisible, sans limite pratique)."
    },
    {
        chapter: 5,
        question: "Comment recuperer la valeur d'un champ <code>name=\"email\"</code> envoye en POST ?",
        options: [
            "<code>$_GET[\"email\"]</code>",
            "<code>$_POST[\"email\"]</code>",
            "<code>$email</code>",
            "<code>$_REQUEST.email</code>"
        ],
        answer: 1,
        explanation: "Les donnees envoyees via la methode POST sont accessibles dans la superglobale <code>$_POST</code>. Le nom du champ HTML (<code>name=\"email\"</code>) sert de cle."
    },
    {
        chapter: 5,
        question: "Quelle est la difference entre <code>isset()</code> et <code>empty()</code> ?",
        options: [
            "Aucune difference",
            "<code>isset()</code> verifie si la variable existe, <code>empty()</code> verifie si elle est vide",
            "<code>empty()</code> provoque une erreur si la variable n'existe pas",
            "<code>isset()</code> est plus lent"
        ],
        answer: 1,
        explanation: "<code>isset()</code> retourne <code>true</code> si la variable existe et n'est pas <code>null</code>. <code>empty()</code> retourne <code>true</code> si la variable est vide (<code>\"\"</code>, <code>0</code>, <code>null</code>, <code>false</code>, <code>[]</code>)."
    },
    {
        chapter: 5,
        question: "A quoi sert <code>htmlspecialchars()</code> ?",
        options: [
            "A mettre le texte en gras",
            "A convertir les caracteres speciaux en entites HTML pour prevenir les attaques XSS",
            "A supprimer les espaces",
            "A encoder en base64"
        ],
        answer: 1,
        explanation: "<code>htmlspecialchars()</code> convertit les caracteres comme <code>&lt;</code>, <code>&gt;</code>, <code>&amp;</code> en entites HTML. Cela empeche l'injection de code JavaScript malveillant (attaque XSS)."
    },
    {
        chapter: 5,
        question: "Dans un formulaire HTML, a quoi servent les attributs <code>action</code> et <code>method</code> ?",
        options: [
            "<code>action</code> definit le style, <code>method</code> le type de bouton",
            "<code>action</code> indique le fichier PHP de traitement, <code>method</code> la methode d'envoi (GET/POST)",
            "<code>action</code> est le nom du formulaire",
            "<code>method</code> definit le type de champ"
        ],
        answer: 1,
        explanation: "<code>action</code> specifie l'URL du script qui va traiter les donnees. <code>method</code> definit comment les donnees sont envoyees : <code>get</code> ou <code>post</code>."
    },
    {
        chapter: 5,
        question: "Quelle fonction faut-il appeler avant d'utiliser <code>$_SESSION</code> ?",
        options: [
            "<code>session_start()</code>",
            "<code>start_session()</code>",
            "<code>init_session()</code>",
            "Aucune, les sessions fonctionnent automatiquement"
        ],
        answer: 0,
        explanation: "<code>session_start()</code> doit etre appelee au debut du script (avant tout output HTML) pour initialiser ou reprendre une session."
    },
    {
        chapter: 5,
        question: "A quoi sert la superglobale <code>$_SERVER</code> ?",
        options: [
            "A stocker les variables de session",
            "A acceder aux informations sur le serveur et la requete HTTP",
            "A se connecter a une base de donnees",
            "A envoyer des emails"
        ],
        answer: 1,
        explanation: "<code>$_SERVER</code> contient des informations comme l'adresse IP du visiteur (<code>$_SERVER['REMOTE_ADDR']</code>), le script en cours (<code>$_SERVER['PHP_SELF']</code>), la methode HTTP, etc."
    },

    // === CHAPITRE 7 : PHP et MySQL — les bases (7) ===
    {
        chapter: 6,
        question: "Quelle est la syntaxe correcte pour se connecter a MySQL avec PDO ?",
        options: [
            "<code>new PDO(\"mysql:host=localhost;dbname=test\", \"user\", \"pass\")</code>",
            "<code>PDO.connect(\"localhost\", \"test\", \"user\", \"pass\")</code>",
            "<code>mysql_connect(\"localhost\", \"user\", \"pass\")</code>",
            "<code>new Database(\"mysql\", \"localhost\", \"test\")</code>"
        ],
        answer: 0,
        explanation: "La connexion PDO utilise : <code>new PDO(dsn, utilisateur, mot_de_passe)</code>. Le DSN contient le type de base (<code>mysql:</code>), l'hote et le nom de la base."
    },
    {
        chapter: 6,
        question: "Pourquoi utiliser <code>prepare()</code> au lieu de <code>query()</code> ?",
        options: [
            "C'est plus rapide",
            "C'est obligatoire en PHP",
            "<code>prepare()</code> protege contre les injections SQL en separant la requete des donnees",
            "<code>query()</code> ne fonctionne pas avec MySQL"
        ],
        answer: 2,
        explanation: "<code>prepare()</code> envoie la requete et les donnees separement au serveur de base de donnees. Les donnees sont traitees comme des valeurs, jamais comme du code SQL. Cela empeche les injections SQL."
    },
    {
        chapter: 6,
        question: "Quelle est la difference entre <code>fetch()</code> et <code>fetchAll()</code> ?",
        options: [
            "Aucune difference",
            "<code>fetch()</code> retourne une seule ligne, <code>fetchAll()</code> retourne toutes les lignes",
            "<code>fetchAll()</code> est plus lent",
            "<code>fetch()</code> retourne un booleen"
        ],
        answer: 1,
        explanation: "<code>fetch()</code> recupere la prochaine ligne du resultat. <code>fetchAll()</code> recupere toutes les lignes d'un coup dans un tableau."
    },
    {
        chapter: 6,
        question: "A quoi sert <code>bindParam()</code> dans PDO ?",
        options: [
            "A fermer la connexion",
            "A lier une variable PHP a un parametre nomme dans la requete preparee",
            "A selectionner la base de donnees",
            "A compter les resultats"
        ],
        answer: 1,
        explanation: "<code>bindParam()</code> associe une variable PHP a un marqueur (ex: <code>:id</code>) dans la requete preparee. La valeur est envoyee de maniere securisee lors de <code>execute()</code>."
    },
    {
        chapter: 6,
        question: "Comment prevenir les injections SQL en PHP ?",
        options: [
            "En utilisant <code>htmlspecialchars()</code>",
            "En utilisant les requetes preparees avec <code>prepare()</code> et <code>execute()</code>",
            "En verifiant la longueur de l'input",
            "En utilisant <code>mysql_real_escape_string()</code>"
        ],
        answer: 1,
        explanation: "Les <strong>requetes preparees</strong> sont la meilleure protection contre les injections SQL. Elles separent le code SQL des donnees. <code>htmlspecialchars()</code> protege contre le XSS, pas le SQL."
    },
    {
        chapter: 6,
        question: "Pourquoi entoure-t-on la connexion PDO avec <code>try/catch</code> ?",
        options: [
            "C'est obligatoire en PHP",
            "Pour accelerer la connexion",
            "Pour capturer les erreurs de connexion sans planter le script",
            "Pour se connecter plus rapidement"
        ],
        answer: 2,
        explanation: "Le bloc <code>try/catch</code> permet de capturer les exceptions (erreurs). Si la connexion echoue, on peut afficher un message propre au lieu de planter le script avec une erreur fatale."
    },
    {
        chapter: 6,
        question: "Que signifie l'acronyme <strong>CRUD</strong> ?",
        options: [
            "Connect, Read, Update, Delete",
            "Create, Read, Update, Delete",
            "Create, Run, Upload, Download",
            "Copy, Read, Undo, Deploy"
        ],
        answer: 1,
        explanation: "CRUD designe les 4 operations fondamentales sur les donnees : <strong>C</strong>reate (INSERT), <strong>R</strong>ead (SELECT), <strong>U</strong>pdate (UPDATE), <strong>D</strong>elete (DELETE)."
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
        fetch('/api/progress', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
            body: JSON.stringify({
                qcm_name: 'qcm-php',
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
    if (pct >= 80) {
        levelClass = 'level-excellent';
        message = 'Excellent ! Vous avez bien assimile les bases de PHP.';
        detail = 'Vous etes pret pour la suite : la programmation orientee objet, les namespaces, Composer et les frameworks comme Laravel ou Symfony.';
    } else if (pct >= 60) {
        levelClass = 'level-good';
        message = 'Bon travail ! Les bases sont la.';
        detail = 'Relisez les chapitres ou vous avez eu le plus de difficultes, puis recommencez le QCM.';
    } else if (pct >= 40) {
        levelClass = 'level-average';
        message = 'C\'est un debut. Continuez a apprendre !';
        detail = 'Reprenez chaque chapitre un par un. Lisez bien les lecons et les explications des reponses.';
    } else {
        levelClass = 'level-weak';
        message = 'Ne vous decouragez pas, c\'est normal au debut !';
        detail = 'PHP demande de la pratique. Relisez les lecons, testez le code sur votre serveur local (XAMPP), et recommencez.';
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
        advice = `<p style="text-align:center;color:#8892BF;margin-top:10px">A retravailler en priorite : <strong>${weakest}</strong></p>`;
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
            <button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">QCM General</button>
        </div>
    `;

    // Delete progress (quiz completed)
    fetch('/api/progress', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({ qcm_name: 'qcm-php', chapter_completed: -1, total_chapters: chapters.length })
    });

    // Save score
    fetch('/api/scores', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({
            qcm_name: 'qcm-php',
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

fetch('/api/progress/qcm-php')
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
