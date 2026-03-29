@extends('layouts.app')
@section('title', 'Apprendre JavaScript - QCM Progressif')

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
            color: #f0db4f;
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
            background: linear-gradient(90deg, #f0db4f, #323330);
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
            background: #f0db4f;
            color: #323330;
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

        .options li:hover { border-color: #f0db4f; background: rgba(0,100,200,0.08); }
        .options li.selected { border-color: #f0db4f; background: rgba(137,111,61,0.12); }
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
            border-left: 4px solid #f0db4f;
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

        .btn-primary { background: #f0db4f; color: #323330; font-weight: bold; }
        .btn-primary:hover { background: #d4c13a; }
        .btn-primary:disabled { background: #555; color: #999; cursor: not-allowed; }
        .btn-restart { background: var(--bg-input); color: var(--text-main); border: 1px solid var(--border-subtle); }
        .btn-restart:hover { background: #1a4a80; }

        .btn-container { text-align: center; margin-top: 20px; }

        /* Lesson card (pause between chapters) */
        .lesson-card {
            background: linear-gradient(135deg, var(--bg-card), var(--bg-input));
            border: 2px solid #f0db4f33;
            border-radius: 16px;
            padding: 35px;
            margin-bottom: 20px;
        }

        .lesson-card h2 {
            color: #f0db4f;
            margin-bottom: 8px;
            font-size: 22px;
        }

        .lesson-card .chapter-num {
            color: #f0db4f;
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
            border: 1px solid #f0db4f33;
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
            background: #f0db4f15;
            border-left: 3px solid #f0db4f;
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

        .cat-score-card .cat-name { font-size: 12px; font-weight: bold; margin-bottom: 8px; color: #f0db4f; }
        .cat-score-card .cat-pct { font-size: 28px; font-weight: bold; }
        .cat-score-card .cat-detail { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

        /* Start screen */
        .start-screen { overflow-wrap: break-word; text-align: center; padding: 40px 20px; }
        .start-screen p { color: var(--text-muted); margin: 15px 0; line-height: 1.6; }

        .js-logo {
            overflow: hidden;
            font-size: 36px;
            font-weight: bold;
            color: #323330;
            background: #f0db4f;
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
            color: #f0db4f;
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
    <h1>Apprendre JavaScript</h1>
    <p class="subtitle">QCM progressif &bull; 50 questions &bull; 7 chapitres</p>

    <!-- Start screen -->
    <div id="start-screen" class="start-screen">
        <div class="js-logo">JS</div>
        <p>Un parcours d'apprentissage complet pour decouvrir JavaScript depuis zero.<br>
        Chaque chapitre commence par une <strong>mini-lecon</strong>, puis vous testez vos connaissances.</p>

        <div class="roadmap">
            <div class="step"><span class="dot">1</span> Les bases : variables et types de donnees (8 questions)</div>
            <div class="step"><span class="dot">2</span> Les operateurs et comparaisons (7 questions)</div>
            <div class="step"><span class="dot">3</span> Les conditions : if, else, switch (7 questions)</div>
            <div class="step"><span class="dot">4</span> Les boucles : for, while (6 questions)</div>
            <div class="step"><span class="dot">5</span> Les fonctions (7 questions)</div>
            <div class="step"><span class="dot">6</span> Les tableaux (8 questions)</div>
            <div class="step"><span class="dot">7</span> Le DOM : manipuler la page web (7 questions)</div>
        </div>

        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Commencer l'apprentissage</button>
        </div>
        <div id="resume-banner" style="display:none; margin-top:20px; background:var(--bg-card); border:2px solid #f0db4f; border-radius:12px; padding:20px; text-align:center;">
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
        title: "Les bases : variables et types",
        num: 1,
        lesson: `<p>En JavaScript, on stocke des informations dans des <strong>variables</strong>. C'est comme des boites avec une etiquette.</p>

<div class="code-example"><span class="keyword">let</span> prenom = <span class="string">"Ahmed"</span>;      <span class="comment">// une chaine de caracteres (texte)</span>
<span class="keyword">let</span> age = <span class="number">25</span>;               <span class="comment">// un nombre</span>
<span class="keyword">let</span> estEtudiant = <span class="keyword">true</span>;    <span class="comment">// un booleen (vrai ou faux)</span></div>

<p>Il y a 3 mots-cles pour declarer une variable :</p>
<p>&bull; <code>let</code> — variable qu'on peut modifier plus tard</p>
<p>&bull; <code>const</code> — constante, sa valeur ne change jamais</p>
<p>&bull; <code>var</code> — ancienne facon, a eviter aujourd'hui</p>

<div class="code-example"><span class="keyword">let</span> score = <span class="number">0</span>;       <span class="comment">// on peut changer plus tard</span>
score = <span class="number">10</span>;             <span class="comment">// OK !</span>

<span class="keyword">const</span> PI = <span class="number">3.14</span>;     <span class="comment">// ne changera jamais</span>
PI = <span class="number">3</span>;                 <span class="comment">// ERREUR !</span></div>

<p>Les principaux <strong>types de donnees</strong> :</p>
<p>&bull; <code>string</code> (texte) : <code>"Bonjour"</code> ou <code>'Salut'</code></p>
<p>&bull; <code>number</code> (nombre) : <code>42</code>, <code>3.14</code></p>
<p>&bull; <code>boolean</code> (booleen) : <code>true</code> ou <code>false</code></p>
<p>&bull; <code>undefined</code> : variable declaree mais sans valeur</p>
<p>&bull; <code>null</code> : valeur vide volontaire</p>

<div class="tip">Pour connaitre le type d'une valeur, on utilise <code>typeof</code> : <code>typeof "Bonjour"</code> donne <code>"string"</code></div>`
    },
    {
        title: "Operateurs et comparaisons",
        num: 2,
        lesson: `<p>JavaScript dispose d'<strong>operateurs</strong> pour faire des calculs et des comparaisons.</p>

<p><strong>Operateurs mathematiques :</strong></p>
<div class="code-example"><span class="keyword">let</span> a = <span class="number">10</span> + <span class="number">5</span>;    <span class="comment">// 15  (addition)</span>
<span class="keyword">let</span> b = <span class="number">10</span> - <span class="number">3</span>;    <span class="comment">// 7   (soustraction)</span>
<span class="keyword">let</span> c = <span class="number">4</span> * <span class="number">3</span>;     <span class="comment">// 12  (multiplication)</span>
<span class="keyword">let</span> d = <span class="number">10</span> / <span class="number">2</span>;    <span class="comment">// 5   (division)</span>
<span class="keyword">let</span> e = <span class="number">10</span> % <span class="number">3</span>;    <span class="comment">// 1   (reste de la division)</span></div>

<p><strong>Operateurs de comparaison :</strong></p>
<div class="code-example"><span class="number">5</span> == <span class="string">"5"</span>     <span class="comment">// true  (compare la valeur, pas le type)</span>
<span class="number">5</span> === <span class="string">"5"</span>    <span class="comment">// false (compare la valeur ET le type)</span>
<span class="number">5</span> != <span class="number">3</span>       <span class="comment">// true  (different)</span>
<span class="number">5</span> > <span class="number">3</span>        <span class="comment">// true  (plus grand)</span>
<span class="number">5</span> <= <span class="number">5</span>       <span class="comment">// true  (plus petit ou egal)</span></div>

<div class="tip">Utilisez toujours <code>===</code> au lieu de <code>==</code>. Le triple egal verifie aussi le type, ce qui evite les surprises.</div>

<p><strong>Concatenation</strong> : l'operateur <code>+</code> avec du texte colle les chaines :</p>
<div class="code-example"><span class="string">"Bonjour"</span> + <span class="string">" monde"</span>   <span class="comment">// "Bonjour monde"</span>
<span class="string">"Age : "</span> + <span class="number">25</span>            <span class="comment">// "Age : 25"</span>
<span class="string">"5"</span> + <span class="number">3</span>                  <span class="comment">// "53" (attention ! pas 8)</span></div>`
    },
    {
        title: "Les conditions : if, else, switch",
        num: 3,
        lesson: `<p>Les <strong>conditions</strong> permettent d'executer du code seulement si quelque chose est vrai.</p>

<div class="code-example"><span class="keyword">let</span> age = <span class="number">18</span>;

<span class="keyword">if</span> (age >= <span class="number">18</span>) {
    console.log(<span class="string">"Vous etes majeur"</span>);
} <span class="keyword">else</span> {
    console.log(<span class="string">"Vous etes mineur"</span>);
}</div>

<p>On peut enchainer plusieurs conditions avec <code>else if</code> :</p>
<div class="code-example"><span class="keyword">let</span> note = <span class="number">15</span>;

<span class="keyword">if</span> (note >= <span class="number">16</span>) {
    console.log(<span class="string">"Tres bien"</span>);
} <span class="keyword">else if</span> (note >= <span class="number">12</span>) {
    console.log(<span class="string">"Bien"</span>);
} <span class="keyword">else</span> {
    console.log(<span class="string">"Peut mieux faire"</span>);
}</div>

<p>Les <strong>operateurs logiques</strong> combinent les conditions :</p>
<p>&bull; <code>&&</code> (ET) : les deux conditions doivent etre vraies</p>
<p>&bull; <code>||</code> (OU) : au moins une condition doit etre vraie</p>
<p>&bull; <code>!</code> (NON) : inverse une condition</p>

<div class="code-example"><span class="keyword">if</span> (age >= <span class="number">18</span> && age <= <span class="number">65</span>) {
    console.log(<span class="string">"Adulte actif"</span>);
}

<span class="keyword">if</span> (jour === <span class="string">"samedi"</span> || jour === <span class="string">"dimanche"</span>) {
    console.log(<span class="string">"Weekend !"</span>);
}</div>

<div class="tip"><code>console.log()</code> affiche un message dans la console du navigateur (F12 > Console). C'est l'outil principal pour tester son code.</div>`
    },
    {
        title: "Les boucles : for, while",
        num: 4,
        lesson: `<p>Les <strong>boucles</strong> repetent un bloc de code plusieurs fois.</p>

<p><strong>La boucle <code>for</code></strong> : quand on sait combien de fois repeter</p>
<div class="code-example"><span class="comment">// Affiche 0, 1, 2, 3, 4</span>
<span class="keyword">for</span> (<span class="keyword">let</span> i = <span class="number">0</span>; i < <span class="number">5</span>; i++) {
    console.log(i);
}
<span class="comment">//  i = 0    → point de depart</span>
<span class="comment">//  i < 5   → condition pour continuer</span>
<span class="comment">//  i++     → ajoute 1 a chaque tour</span></div>

<p><strong>La boucle <code>while</code></strong> : tant qu'une condition est vraie</p>
<div class="code-example"><span class="keyword">let</span> compteur = <span class="number">0</span>;
<span class="keyword">while</span> (compteur < <span class="number">3</span>) {
    console.log(compteur);  <span class="comment">// 0, 1, 2</span>
    compteur++;
}</div>

<p>Mots-cles utiles dans les boucles :</p>
<p>&bull; <code>break</code> — sort de la boucle immediatement</p>
<p>&bull; <code>continue</code> — passe a l'iteration suivante</p>

<div class="code-example"><span class="keyword">for</span> (<span class="keyword">let</span> i = <span class="number">0</span>; i < <span class="number">10</span>; i++) {
    <span class="keyword">if</span> (i === <span class="number">5</span>) <span class="keyword">break</span>;     <span class="comment">// arrete a 5</span>
    <span class="keyword">if</span> (i % <span class="number">2</span> === <span class="number">0</span>) <span class="keyword">continue</span>; <span class="comment">// saute les pairs</span>
    console.log(i);           <span class="comment">// affiche 1, 3</span>
}</div>

<div class="tip"><code>i++</code> est un raccourci pour <code>i = i + 1</code>. De meme, <code>i--</code> signifie <code>i = i - 1</code>.</div>`
    },
    {
        title: "Les fonctions",
        num: 5,
        lesson: `<p>Une <strong>fonction</strong> est un bloc de code reutilisable. On la definit une fois, puis on l'appelle autant de fois qu'on veut.</p>

<div class="code-example"><span class="comment">// Definir une fonction</span>
<span class="keyword">function</span> saluer(prenom) {
    <span class="keyword">return</span> <span class="string">"Bonjour "</span> + prenom;
}

<span class="comment">// Appeler la fonction</span>
<span class="keyword">let</span> msg = saluer(<span class="string">"Ahmed"</span>);  <span class="comment">// "Bonjour Ahmed"</span>
<span class="keyword">let</span> msg2 = saluer(<span class="string">"Sara"</span>); <span class="comment">// "Bonjour Sara"</span></div>

<p>&bull; <code>prenom</code> est un <strong>parametre</strong> (la variable dans la definition)</p>
<p>&bull; <code>"Ahmed"</code> est un <strong>argument</strong> (la valeur passee a l'appel)</p>
<p>&bull; <code>return</code> renvoie le resultat et arrete la fonction</p>

<p><strong>Fonction flechee</strong> (syntaxe moderne ES6) :</p>
<div class="code-example"><span class="comment">// Version classique</span>
<span class="keyword">function</span> double(x) {
    <span class="keyword">return</span> x * <span class="number">2</span>;
}

<span class="comment">// Version flechee (meme resultat)</span>
<span class="keyword">const</span> double = (x) => x * <span class="number">2</span>;</div>

<div class="tip">Si la fonction ne contient qu'une seule expression, la fonction flechee peut omettre les accolades <code>{}</code> et le <code>return</code>.</div>

<p><strong>Fonction sans return</strong> :</p>
<div class="code-example"><span class="keyword">function</span> direBonjour() {
    console.log(<span class="string">"Bonjour !"</span>);
    <span class="comment">// pas de return → retourne undefined</span>
}</div>`
    },
    {
        title: "Les tableaux",
        num: 6,
        lesson: `<p>Un <strong>tableau</strong> (array) stocke plusieurs valeurs dans une seule variable.</p>

<div class="code-example"><span class="keyword">let</span> fruits = [<span class="string">"pomme"</span>, <span class="string">"banane"</span>, <span class="string">"orange"</span>];

<span class="comment">// Acceder a un element (commence a 0 !)</span>
fruits[<span class="number">0</span>]   <span class="comment">// "pomme"</span>
fruits[<span class="number">1</span>]   <span class="comment">// "banane"</span>
fruits[<span class="number">2</span>]   <span class="comment">// "orange"</span>

<span class="comment">// Nombre d'elements</span>
fruits.length  <span class="comment">// 3</span></div>

<p><strong>Methodes principales :</strong></p>
<div class="code-example"><span class="comment">// Ajouter / Supprimer</span>
fruits.push(<span class="string">"kiwi"</span>);     <span class="comment">// ajoute a la fin</span>
fruits.pop();             <span class="comment">// retire le dernier</span>
fruits.unshift(<span class="string">"mangue"</span>); <span class="comment">// ajoute au debut</span>
fruits.shift();           <span class="comment">// retire le premier</span>

<span class="comment">// Chercher</span>
fruits.indexOf(<span class="string">"banane"</span>);  <span class="comment">// 1 (position)</span>
fruits.includes(<span class="string">"pomme"</span>);  <span class="comment">// true</span></div>

<p><strong>Parcourir un tableau :</strong></p>
<div class="code-example"><span class="keyword">let</span> notes = [<span class="number">15</span>, <span class="number">12</span>, <span class="number">18</span>, <span class="number">9</span>];

<span class="comment">// Avec for classique</span>
<span class="keyword">for</span> (<span class="keyword">let</span> i = <span class="number">0</span>; i < notes.length; i++) {
    console.log(notes[i]);
}

<span class="comment">// Avec forEach (plus simple)</span>
notes.forEach(<span class="keyword">function</span>(note) {
    console.log(note);
});</div>

<div class="tip">Les index commencent toujours a <code>0</code>. Le dernier element est a l'index <code>length - 1</code>.</div>`
    },
    {
        title: "Le DOM : manipuler la page web",
        num: 7,
        lesson: `<p>Le <strong>DOM</strong> (Document Object Model) permet a JavaScript de modifier la page HTML en direct.</p>

<p><strong>Selectionner un element :</strong></p>
<div class="code-example"><span class="comment">// Par son ID</span>
<span class="keyword">let</span> titre = document.getElementById(<span class="string">"titre"</span>);

<span class="comment">// Par un selecteur CSS (le premier trouve)</span>
<span class="keyword">let</span> btn = document.querySelector(<span class="string">".btn"</span>);

<span class="comment">// Tous les elements correspondants</span>
<span class="keyword">let</span> items = document.querySelectorAll(<span class="string">"li"</span>);</div>

<p><strong>Modifier un element :</strong></p>
<div class="code-example"><span class="comment">// Changer le texte</span>
titre.textContent = <span class="string">"Nouveau titre"</span>;

<span class="comment">// Changer le HTML a l'interieur</span>
titre.innerHTML = <span class="string">"Texte en &lt;strong&gt;gras&lt;/strong&gt;"</span>;

<span class="comment">// Changer le style</span>
titre.style.color = <span class="string">"red"</span>;
titre.style.fontSize = <span class="string">"24px"</span>;</div>

<p><strong>Reagir aux actions de l'utilisateur :</strong></p>
<div class="code-example">btn.addEventListener(<span class="string">"click"</span>, <span class="keyword">function</span>() {
    alert(<span class="string">"Vous avez clique !"</span>);
});</div>

<div class="tip"><code>querySelector</code> utilise les memes selecteurs que CSS : <code>#id</code>, <code>.classe</code>, <code>balise</code>, etc.</div>`
    }
];

// ========================
// QUESTIONS (50)
// ========================
const allQuestions = [
    // === CHAPITRE 1 : Variables & Types (8) ===
    {
        chapter: 0,
        question: "Comment declare-t-on une variable qu'on pourra modifier plus tard ?",
        options: ["<code>const nom = \"Ali\"</code>", "<code>let nom = \"Ali\"</code>", "<code>var nom = \"Ali\"</code>", "<code>define nom = \"Ali\"</code>"],
        answer: 1,
        explanation: "<code>let</code> permet de declarer une variable modifiable. <code>const</code> cree une constante (non modifiable). <code>var</code> fonctionne aussi mais est deconseille. <code>define</code> n'existe pas en JavaScript."
    },
    {
        chapter: 0,
        question: "Quel est le type de la valeur <code>\"Bonjour\"</code> ?",
        options: ["<code>number</code>", "<code>text</code>", "<code>string</code>", "<code>char</code>"],
        answer: 2,
        explanation: "En JavaScript, le texte est de type <code>string</code> (chaine de caracteres). Il se place entre guillemets doubles <code>\"\"</code> ou simples <code>''</code>."
    },
    {
        chapter: 0,
        question: "Que retourne <code>typeof 42</code> ?",
        options: ["<code>\"integer\"</code>", "<code>\"number\"</code>", "<code>\"float\"</code>", "<code>\"digit\"</code>"],
        answer: 1,
        explanation: "En JavaScript, tous les nombres (entiers ou decimaux) sont de type <code>\"number\"</code>. Il n'y a pas de distinction entre integer et float."
    },
    {
        chapter: 0,
        question: "Que se passe-t-il si on ecrit <code>const age = 25; age = 30;</code> ?",
        options: [
            "age vaut 30",
            "age reste a 25 sans erreur",
            "Une erreur est levee",
            "age vaut undefined"
        ],
        answer: 2,
        explanation: "<code>const</code> empeche la reassignation. Tenter de modifier une constante provoque une erreur : <code>TypeError: Assignment to constant variable.</code>"
    },
    {
        chapter: 0,
        question: "Quelle est la valeur de <code>x</code> apres ce code ?<div class='code-block'>let x;</div>",
        options: ["<code>0</code>", "<code>null</code>", "<code>\"\"</code>", "<code>undefined</code>"],
        answer: 3,
        explanation: "Une variable declaree avec <code>let</code> sans lui donner de valeur vaut <code>undefined</code> par defaut. C'est JavaScript qui lui attribue cette valeur speciale."
    },
    {
        chapter: 0,
        question: "Quel est le type de <code>true</code> ?",
        options: ["<code>string</code>", "<code>number</code>", "<code>boolean</code>", "<code>binary</code>"],
        answer: 2,
        explanation: "<code>true</code> et <code>false</code> sont les deux valeurs du type <code>boolean</code>. Ce type represente vrai ou faux."
    },
    {
        chapter: 0,
        question: "Quelle ligne est correcte pour stocker un prenom ?",
        options: [
            "<code>let prenom = Sara;</code>",
            "<code>let prenom = \"Sara\";</code>",
            "<code>let \"prenom\" = Sara;</code>",
            "<code>prenom let = \"Sara\";</code>"
        ],
        answer: 1,
        explanation: "Le texte doit etre entre guillemets. Sans guillemets, JavaScript pense que <code>Sara</code> est une variable. Le nom de la variable vient apres <code>let</code>."
    },
    {
        chapter: 0,
        question: "Quelle est la difference entre <code>null</code> et <code>undefined</code> ?",
        options: [
            "Aucune difference",
            "<code>null</code> = vide volontaire, <code>undefined</code> = pas de valeur assignee",
            "<code>null</code> est un nombre",
            "<code>undefined</code> provoque une erreur"
        ],
        answer: 1,
        explanation: "<code>undefined</code> signifie \"aucune valeur n'a ete donnee\". <code>null</code> est une valeur qu'on assigne volontairement pour dire \"vide\". Ex: <code>let data = null;</code>"
    },

    // === CHAPITRE 2 : Operateurs (7) ===
    {
        chapter: 1,
        question: "Que donne <code>10 % 3</code> ?",
        options: ["<code>3.33</code>", "<code>3</code>", "<code>1</code>", "<code>0</code>"],
        answer: 2,
        explanation: "L'operateur <code>%</code> (modulo) donne le <strong>reste</strong> de la division. 10 divise par 3 = 3 avec un reste de <strong>1</strong>."
    },
    {
        chapter: 1,
        question: "Que retourne <code>5 === \"5\"</code> ?",
        options: ["<code>true</code>", "<code>false</code>", "<code>undefined</code>", "Une erreur"],
        answer: 1,
        explanation: "<code>===</code> verifie la valeur ET le type. <code>5</code> est un nombre et <code>\"5\"</code> est une chaine : types differents, donc <code>false</code>."
    },
    {
        chapter: 1,
        question: "Que retourne <code>5 == \"5\"</code> ?",
        options: ["<code>true</code>", "<code>false</code>", "Une erreur", "<code>undefined</code>"],
        answer: 0,
        explanation: "<code>==</code> compare seulement la valeur et convertit les types automatiquement. <code>\"5\"</code> est converti en <code>5</code>, donc c'est egal : <code>true</code>."
    },
    {
        chapter: 1,
        question: "Que donne <code>\"Bon\" + \"jour\"</code> ?",
        options: ["<code>\"Bonjour\"</code>", "<code>NaN</code>", "Une erreur", "<code>\"Bon jour\"</code>"],
        answer: 0,
        explanation: "L'operateur <code>+</code> avec deux chaines les <strong>concatene</strong> (colle). Les deux chaines sont assemblees sans espace."
    },
    {
        chapter: 1,
        question: "Que donne <code>\"5\" + 3</code> ?",
        options: ["<code>8</code>", "<code>\"53\"</code>", "<code>\"8\"</code>", "Une erreur"],
        answer: 1,
        explanation: "Quand <code>+</code> rencontre une chaine, il fait une concatenation. Le nombre <code>3</code> est converti en <code>\"3\"</code> puis colle a <code>\"5\"</code> : resultat <code>\"53\"</code>."
    },
    {
        chapter: 1,
        question: "Que donne <code>\"5\" - 3</code> ?",
        options: ["<code>\"53\"</code>", "<code>2</code>", "<code>\"2\"</code>", "Une erreur"],
        answer: 1,
        explanation: "L'operateur <code>-</code> n'a pas de sens pour les chaines, donc JavaScript convertit <code>\"5\"</code> en nombre. <code>5 - 3 = 2</code> (un nombre)."
    },
    {
        chapter: 1,
        question: "Que signifie <code>!=</code> ?",
        options: ["Egal a", "Different de", "Pas defini", "Non assigne"],
        answer: 1,
        explanation: "<code>!=</code> signifie \"different de\" (non egal). Son equivalent strict est <code>!==</code> qui verifie aussi le type."
    },

    // === CHAPITRE 3 : Conditions (7) ===
    {
        chapter: 2,
        question: "Que va afficher ce code ?<div class='code-block'>let x = 10;\nif (x > 5) {\n    console.log(\"Grand\");\n} else {\n    console.log(\"Petit\");\n}</div>",
        options: ["<code>\"Petit\"</code>", "<code>\"Grand\"</code>", "Les deux", "Rien"],
        answer: 1,
        explanation: "<code>x</code> vaut 10 et 10 > 5 est <code>true</code>, donc le code dans le premier bloc <code>{}</code> s'execute : <code>\"Grand\"</code>."
    },
    {
        chapter: 2,
        question: "Que signifie <code>&&</code> en JavaScript ?",
        options: ["OU logique", "ET logique", "NON logique", "Egal strict"],
        answer: 1,
        explanation: "<code>&&</code> est le ET logique. L'expression est vraie uniquement si les deux cotes sont vrais. Ex: <code>age > 18 && age < 65</code>."
    },
    {
        chapter: 2,
        question: "Que vaut <code>!true</code> ?",
        options: ["<code>true</code>", "<code>false</code>", "<code>undefined</code>", "<code>\"true\"</code>"],
        answer: 1,
        explanation: "<code>!</code> est l'operateur NON : il inverse la valeur. <code>!true</code> donne <code>false</code> et <code>!false</code> donne <code>true</code>."
    },
    {
        chapter: 2,
        question: "Quand le bloc <code>else</code> s'execute-t-il ?",
        options: [
            "Toujours",
            "Quand la condition du <code>if</code> est vraie",
            "Quand la condition du <code>if</code> est fausse",
            "Aleatoirement"
        ],
        answer: 2,
        explanation: "Le bloc <code>else</code> s'execute uniquement quand la condition du <code>if</code> est <code>false</code>. C'est le \"sinon\"."
    },
    {
        chapter: 2,
        question: "Que va afficher ce code ?<div class='code-block'>let note = 15;\nif (note >= 16) {\n    console.log(\"A\");\n} else if (note >= 12) {\n    console.log(\"B\");\n} else {\n    console.log(\"C\");\n}</div>",
        options: ["<code>\"A\"</code>", "<code>\"B\"</code>", "<code>\"C\"</code>", "<code>\"A\"</code> et <code>\"B\"</code>"],
        answer: 1,
        explanation: "15 >= 16 est faux, donc on passe au <code>else if</code>. 15 >= 12 est vrai, donc on affiche <code>\"B\"</code>. Le <code>else</code> est ignore."
    },
    {
        chapter: 2,
        question: "Que retourne <code>true || false</code> ?",
        options: ["<code>false</code>", "<code>true</code>", "<code>undefined</code>", "Une erreur"],
        answer: 1,
        explanation: "<code>||</code> est le OU logique. Il suffit qu'UN seul cote soit vrai pour que le resultat soit <code>true</code>."
    },
    {
        chapter: 2,
        question: "A quoi sert <code>console.log()</code> ?",
        options: [
            "Afficher un message sur la page web",
            "Afficher un message dans la console du navigateur",
            "Creer une variable",
            "Enregistrer dans un fichier"
        ],
        answer: 1,
        explanation: "<code>console.log()</code> affiche dans la console du navigateur (F12 > onglet Console). C'est l'outil principal pour debugger et tester du code."
    },

    // === CHAPITRE 4 : Boucles (6) ===
    {
        chapter: 3,
        question: "Combien de fois cette boucle s'execute-t-elle ?<div class='code-block'>for (let i = 0; i < 3; i++) {\n    console.log(i);\n}</div>",
        options: ["2 fois", "3 fois", "4 fois", "A l'infini"],
        answer: 1,
        explanation: "<code>i</code> commence a 0 et la boucle tourne tant que <code>i < 3</code>. Les valeurs sont 0, 1, 2 : donc <strong>3 fois</strong>."
    },
    {
        chapter: 3,
        question: "Que fait <code>i++</code> ?",
        options: [
            "Multiplie <code>i</code> par 2",
            "Ajoute 1 a <code>i</code>",
            "Cree une copie de <code>i</code>",
            "Compare <code>i</code> avec 1"
        ],
        answer: 1,
        explanation: "<code>i++</code> est un raccourci pour <code>i = i + 1</code>. Ca incremente la variable de 1. De meme, <code>i--</code> retire 1."
    },
    {
        chapter: 3,
        question: "Que fait <code>break</code> dans une boucle ?",
        options: [
            "Passe a l'iteration suivante",
            "Sort immediatement de la boucle",
            "Fait une pause d'1 seconde",
            "Redemarre la boucle"
        ],
        answer: 1,
        explanation: "<code>break</code> arrete la boucle completement, meme s'il restait des iterations. L'execution continue apres la boucle."
    },
    {
        chapter: 3,
        question: "Que fait <code>continue</code> dans une boucle ?",
        options: [
            "Sort de la boucle",
            "Saute le reste du tour actuel et passe au suivant",
            "Relance la boucle depuis le debut",
            "Ne fait rien"
        ],
        answer: 1,
        explanation: "<code>continue</code> saute le reste du code dans l'iteration en cours et passe directement a l'iteration suivante."
    },
    {
        chapter: 3,
        question: "Quand s'arrete une boucle <code>while</code> ?",
        options: [
            "Apres un nombre fixe de tours",
            "Quand sa condition devient fausse",
            "Quand on appuie sur Echap",
            "Apres 1 seconde"
        ],
        answer: 1,
        explanation: "La boucle <code>while</code> verifie sa condition avant chaque tour. Elle s'arrete des que la condition est <code>false</code>."
    },
    {
        chapter: 3,
        question: "Quel est le risque d'une boucle <code>while(true)</code> sans <code>break</code> ?",
        options: [
            "Elle ne s'execute pas",
            "Elle s'execute une seule fois",
            "Elle tourne a l'infini et bloque le navigateur",
            "Elle affiche une erreur"
        ],
        answer: 2,
        explanation: "<code>while(true)</code> ne s'arretera jamais car la condition est toujours vraie. Sans <code>break</code> a l'interieur, c'est une boucle infinie qui gele la page."
    },

    // === CHAPITRE 5 : Fonctions (7) ===
    {
        chapter: 4,
        question: "Que fait ce code ?<div class='code-block'>function addition(a, b) {\n    return a + b;\n}</div>",
        options: [
            "Affiche la somme de a et b",
            "Definit une fonction qui retourne la somme de a et b",
            "Cree deux variables a et b",
            "Appelle la fonction addition"
        ],
        answer: 1,
        explanation: "Ce code <strong>definit</strong> une fonction. Il ne l'execute pas. Pour l'utiliser il faut l'appeler : <code>addition(3, 5)</code> qui retournera <code>8</code>."
    },
    {
        chapter: 4,
        question: "Que retourne <code>addition(3, 5)</code> avec la fonction ci-dessus ?",
        options: ["<code>\"35\"</code>", "<code>8</code>", "<code>undefined</code>", "<code>15</code>"],
        answer: 1,
        explanation: "La fonction recoit <code>a = 3</code> et <code>b = 5</code>, puis retourne <code>3 + 5 = 8</code>. Ici les deux arguments sont des nombres, donc <code>+</code> fait l'addition."
    },
    {
        chapter: 4,
        question: "Que retourne une fonction qui n'a pas de <code>return</code> ?",
        options: ["<code>0</code>", "<code>null</code>", "<code>undefined</code>", "Une erreur"],
        answer: 2,
        explanation: "Si une fonction ne contient pas de <code>return</code>, elle retourne automatiquement <code>undefined</code>."
    },
    {
        chapter: 4,
        question: "Quelle est la syntaxe correcte d'une fonction flechee ?",
        options: [
            "<code>const f = (x) -> x * 2</code>",
            "<code>const f = (x) => x * 2</code>",
            "<code>const f = function => x * 2</code>",
            "<code>const f = x ==> x * 2</code>"
        ],
        answer: 1,
        explanation: "La syntaxe de la fonction flechee est <code>(parametres) => expression</code>. On utilise <code>=></code> (egal + superieur), pas <code>-></code>."
    },
    {
        chapter: 4,
        question: "Que vaut <code>b</code> apres ce code ?<div class='code-block'>function carre(x) {\n    return x * x;\n}\nlet b = carre(4);</div>",
        options: ["<code>4</code>", "<code>8</code>", "<code>16</code>", "<code>undefined</code>"],
        answer: 2,
        explanation: "<code>carre(4)</code> calcule <code>4 * 4 = 16</code> et le retourne avec <code>return</code>. Cette valeur est stockee dans <code>b</code>."
    },
    {
        chapter: 4,
        question: "Qu'est-ce qu'un parametre de fonction ?",
        options: [
            "La valeur retournee par la fonction",
            "Une variable definie dans la declaration de la fonction",
            "Le nom de la fonction",
            "Le nombre de fois que la fonction est appelee"
        ],
        answer: 1,
        explanation: "Un parametre est la variable entre parentheses dans la definition. Dans <code>function saluer(nom)</code>, <code>nom</code> est le parametre. La valeur passee a l'appel est l'argument."
    },
    {
        chapter: 4,
        question: "Que se passe-t-il si on appelle <code>saluer()</code> sans argument alors que la fonction attend un parametre <code>nom</code> ?",
        options: [
            "Une erreur bloque le programme",
            "<code>nom</code> vaut <code>undefined</code>",
            "<code>nom</code> vaut <code>\"\"</code>",
            "<code>nom</code> vaut <code>null</code>"
        ],
        answer: 1,
        explanation: "JavaScript ne genere pas d'erreur. Le parametre manquant prend simplement la valeur <code>undefined</code>."
    },

    // === CHAPITRE 6 : Tableaux (8) ===
    {
        chapter: 5,
        question: "Comment cree-t-on un tableau avec 3 fruits ?",
        options: [
            "<code>let fruits = (\"pomme\", \"banane\", \"orange\")</code>",
            "<code>let fruits = [\"pomme\", \"banane\", \"orange\"]</code>",
            "<code>let fruits = {\"pomme\", \"banane\", \"orange\"}</code>",
            "<code>let fruits = &lt;\"pomme\", \"banane\", \"orange\"&gt;</code>"
        ],
        answer: 1,
        explanation: "Les tableaux se creent avec des <strong>crochets</strong> <code>[]</code>. Les parentheses <code>()</code> sont pour les fonctions, les accolades <code>{}</code> pour les objets."
    },
    {
        chapter: 5,
        question: "Que retourne <code>fruits[0]</code> si <code>fruits = [\"pomme\", \"banane\", \"orange\"]</code> ?",
        options: ["<code>\"banane\"</code>", "<code>\"pomme\"</code>", "<code>\"orange\"</code>", "<code>undefined</code>"],
        answer: 1,
        explanation: "Les index commencent a <strong>0</strong>, pas a 1. L'index 0 correspond au premier element : <code>\"pomme\"</code>."
    },
    {
        chapter: 5,
        question: "Que fait <code>fruits.push(\"kiwi\")</code> ?",
        options: [
            "Ajoute \"kiwi\" au debut du tableau",
            "Ajoute \"kiwi\" a la fin du tableau",
            "Remplace le premier element par \"kiwi\"",
            "Cherche \"kiwi\" dans le tableau"
        ],
        answer: 1,
        explanation: "<code>push()</code> ajoute un element <strong>a la fin</strong> du tableau. Pour ajouter au debut, on utilise <code>unshift()</code>."
    },
    {
        chapter: 5,
        question: "Que retourne <code>[10, 20, 30].length</code> ?",
        options: ["<code>2</code>", "<code>3</code>", "<code>30</code>", "<code>undefined</code>"],
        answer: 1,
        explanation: "<code>length</code> retourne le nombre d'elements du tableau. Il y a 3 elements : 10, 20 et 30."
    },
    {
        chapter: 5,
        question: "Que fait <code>fruits.pop()</code> ?",
        options: [
            "Ajoute un element",
            "Retire et retourne le <strong>dernier</strong> element",
            "Retire et retourne le <strong>premier</strong> element",
            "Vide le tableau"
        ],
        answer: 1,
        explanation: "<code>pop()</code> retire le dernier element et le retourne. <code>shift()</code> fait la meme chose mais pour le premier element."
    },
    {
        chapter: 5,
        question: "Que retourne <code>[5, 10, 15].indexOf(10)</code> ?",
        options: ["<code>10</code>", "<code>0</code>", "<code>1</code>", "<code>2</code>"],
        answer: 2,
        explanation: "<code>indexOf()</code> retourne la <strong>position</strong> (index) de l'element. <code>10</code> est a l'index <code>1</code> (on compte depuis 0)."
    },
    {
        chapter: 5,
        question: "Que retourne <code>[1, 2, 3].includes(5)</code> ?",
        options: ["<code>true</code>", "<code>false</code>", "<code>-1</code>", "<code>undefined</code>"],
        answer: 1,
        explanation: "<code>includes()</code> verifie si l'element existe dans le tableau. <code>5</code> n'y est pas, donc <code>false</code>."
    },
    {
        chapter: 5,
        question: "Comment acceder au dernier element d'un tableau <code>arr</code> ?",
        options: [
            "<code>arr[arr.length]</code>",
            "<code>arr[arr.length - 1]</code>",
            "<code>arr[-1]</code>",
            "<code>arr.last()</code>"
        ],
        answer: 1,
        explanation: "Si le tableau a 3 elements, les index sont 0, 1, 2. Le dernier est donc a <code>length - 1</code>. <code>arr[arr.length]</code> donnerait <code>undefined</code> (hors limites)."
    },

    // === CHAPITRE 7 : DOM (7) ===
    {
        chapter: 6,
        question: "Que signifie DOM ?",
        options: [
            "Data Object Model",
            "Document Object Model",
            "Digital Output Method",
            "Document Oriented Markup"
        ],
        answer: 1,
        explanation: "DOM = <strong>Document Object Model</strong>. C'est la representation de la page HTML sous forme d'objets que JavaScript peut manipuler."
    },
    {
        chapter: 6,
        question: "Quelle methode selectionne un element par son <code>id</code> ?",
        options: [
            "<code>document.getById(\"monId\")</code>",
            "<code>document.getElementById(\"monId\")</code>",
            "<code>document.findId(\"monId\")</code>",
            "<code>document.selectId(\"monId\")</code>"
        ],
        answer: 1,
        explanation: "<code>getElementById</code> selectionne l'unique element ayant l'id specifie. C'est une des methodes les plus utilisees."
    },
    {
        chapter: 6,
        question: "Que fait <code>element.textContent = \"Salut\"</code> ?",
        options: [
            "Ajoute \"Salut\" apres le contenu existant",
            "Remplace tout le texte de l'element par \"Salut\"",
            "Cree un nouvel element",
            "Supprime l'element"
        ],
        answer: 1,
        explanation: "<code>textContent</code> remplace <strong>tout</strong> le contenu texte de l'element. L'ancien texte disparait."
    },
    {
        chapter: 6,
        question: "Comment reagir a un clic sur un bouton en JavaScript ?",
        options: [
            "<code>btn.onClick(function() {})</code>",
            "<code>btn.addEventListener(\"click\", function() {})</code>",
            "<code>btn.click(function() {})</code>",
            "<code>btn.listen(\"click\", function() {})</code>"
        ],
        answer: 1,
        explanation: "<code>addEventListener</code> est la methode standard. Le premier argument est le type d'evenement (<code>\"click\"</code>), le second est la fonction a executer."
    },
    {
        chapter: 6,
        question: "Que selectionne <code>document.querySelector(\".titre\")</code> ?",
        options: [
            "L'element avec l'id \"titre\"",
            "Le premier element avec la classe \"titre\"",
            "Tous les elements avec la classe \"titre\"",
            "La balise &lt;titre&gt;"
        ],
        answer: 1,
        explanation: "<code>querySelector</code> utilise les selecteurs CSS. Le point <code>.</code> designe une classe. Il retourne le <strong>premier</strong> element correspondant."
    },
    {
        chapter: 6,
        question: "Quelle est la difference entre <code>textContent</code> et <code>innerHTML</code> ?",
        options: [
            "Aucune difference",
            "<code>innerHTML</code> interprete le HTML, <code>textContent</code> traite tout comme du texte",
            "<code>textContent</code> est plus lent",
            "<code>innerHTML</code> ne fonctionne qu'avec les div"
        ],
        answer: 1,
        explanation: "<code>innerHTML</code> interprete les balises HTML (ex: <code>&lt;strong&gt;</code> met en gras). <code>textContent</code> affiche tout comme du texte brut, meme les balises."
    },
    {
        chapter: 6,
        question: "Que fait <code>element.style.color = \"red\"</code> ?",
        options: [
            "Change la couleur de fond en rouge",
            "Change la couleur du texte en rouge",
            "Supprime l'element",
            "Ajoute une bordure rouge"
        ],
        answer: 1,
        explanation: "<code>style.color</code> modifie la couleur du <strong>texte</strong>, comme la propriete CSS <code>color</code>. Pour le fond, on utilise <code>style.backgroundColor</code>."
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
                qcm_name: 'qcm-js',
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
        message = 'Excellent ! Vous avez bien assimile les bases de JavaScript.';
        detail = 'Vous etes pret pour la suite : les objets avances, les promesses, async/await et les API.';
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
        detail = 'JavaScript demande de la pratique. Relisez les lecons, essayez le code dans la console (F12), et recommencez.';
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
        advice = `<p style="text-align:center;color:#f0db4f;margin-top:10px">A retravailler en priorite : <strong>${weakest}</strong></p>`;
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
            <button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">QCM General</button>
        </div>
    `;

    // Delete progress (quiz completed)
    fetch('/api/progress', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({ qcm_name: 'qcm-js', chapter_completed: -1, total_chapters: chapters.length })
    });

    // Save score
    fetch('/api/scores', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({
            qcm_name: 'qcm-js',
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

fetch('/api/progress/qcm-js')
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
