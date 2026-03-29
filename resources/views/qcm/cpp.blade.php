@extends('layouts.app')
@section('title', 'Apprendre C++ - QCM Progressif')

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
            color: #00599C;
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
            background: linear-gradient(90deg, #00599C, #004482);
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
            background: #00599C;
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

        .options li:hover { border-color: #00599C; background: rgba(0,100,200,0.08); }
        .options li.selected { border-color: #00599C; background: rgba(137,111,61,0.12); }
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
            border-left: 4px solid #00599C;
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

        .btn-primary { background: #00599C; color: #fff; font-weight: bold; }
        .btn-primary:hover { background: #004482; }
        .btn-primary:disabled { background: #555; color: #999; cursor: not-allowed; }
        .btn-restart { background: var(--bg-input); color: var(--text-main); border: 1px solid var(--border-subtle); }
        .btn-restart:hover { background: #1a4a80; }

        .btn-container { text-align: center; margin-top: 20px; }

        /* Lesson card (pause between chapters) */
        .lesson-card {
            background: linear-gradient(135deg, var(--bg-card), var(--bg-input));
            border: 2px solid #00599C33;
            border-radius: 16px;
            padding: 35px;
            margin-bottom: 20px;
        }

        .lesson-card h2 {
            color: #00599C;
            margin-bottom: 8px;
            font-size: 22px;
        }

        .lesson-card .chapter-num {
            color: #00599C;
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
            border: 1px solid #00599C33;
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
            background: #00599C15;
            border-left: 3px solid #00599C;
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

        .cat-score-card .cat-name { font-size: 12px; font-weight: bold; margin-bottom: 8px; color: #00599C; }
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
            background: #004482;
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
            color: #00599C;
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
    <h1>Apprendre C++</h1>
    <p class="subtitle">QCM progressif &bull; 50 questions &bull; 7 chapitres</p>

    <!-- Start screen -->
    <div id="start-screen" class="start-screen">
        <div class="js-logo">C++</div>
        <p>Un parcours d'apprentissage complet pour decouvrir C++ depuis zero.<br>
        Chaque chapitre commence par une <strong>mini-lecon</strong>, puis vous testez vos connaissances.</p>

        <div class="roadmap">
            <div class="step"><span class="dot">1</span> Les bases : syntaxe et variables (8 questions)</div>
            <div class="step"><span class="dot">2</span> Les operateurs et conditions (7 questions)</div>
            <div class="step"><span class="dot">3</span> Les boucles (6 questions)</div>
            <div class="step"><span class="dot">4</span> Les fonctions (7 questions)</div>
            <div class="step"><span class="dot">5</span> Les tableaux et les pointeurs (8 questions)</div>
            <div class="step"><span class="dot">6</span> Les chaines et les structures (7 questions)</div>
            <div class="step"><span class="dot">7</span> Introduction a la POO (7 questions)</div>
        </div>

        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Commencer l'apprentissage</button>
        </div>
        <div id="resume-banner" style="display:none; margin-top:20px; background:var(--bg-card); border:2px solid #00599C; border-radius:12px; padding:20px; text-align:center;">
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
        lesson: `<p>C++ est un langage <strong>compile</strong>. Le code source est transforme en un fichier executable par un compilateur (g++, clang++, MSVC).</p>

<p>Un programme C++ commence toujours par la fonction <code>main()</code> et utilise <code>#include</code> pour importer des bibliotheques :</p>
<div class="code-example"><span class="keyword">#include</span> <span class="string">&lt;iostream&gt;</span>
<span class="keyword">using namespace</span> std;

<span class="keyword">int</span> main() {
    cout &lt;&lt; <span class="string">"Bonjour le monde !"</span> &lt;&lt; endl;
    <span class="keyword">return</span> <span class="number">0</span>;
}</div>

<p>Les <strong>variables</strong> doivent etre declarees avec leur type :</p>
<div class="code-example"><span class="keyword">int</span> age = <span class="number">25</span>;              <span class="comment">// entier</span>
<span class="keyword">float</span> taille = <span class="number">1.75f</span>;       <span class="comment">// decimal simple precision</span>
<span class="keyword">double</span> pi = <span class="number">3.14159</span>;       <span class="comment">// decimal double precision</span>
<span class="keyword">char</span> lettre = <span class="string">'A'</span>;          <span class="comment">// un seul caractere</span>
<span class="keyword">bool</span> estVrai = <span class="keyword">true</span>;       <span class="comment">// booleen</span>
<span class="keyword">string</span> prenom = <span class="string">"Ahmed"</span>;   <span class="comment">// chaine de caracteres</span></div>

<p>Les principaux <strong>types de donnees</strong> en C++ :</p>
<p>&bull; <code>int</code> (entier) : <code>42</code></p>
<p>&bull; <code>float</code> (decimal 32 bits) : <code>3.14f</code></p>
<p>&bull; <code>double</code> (decimal 64 bits) : <code>3.14159</code></p>
<p>&bull; <code>char</code> (caractere) : <code>'A'</code></p>
<p>&bull; <code>bool</code> (booleen) : <code>true</code> ou <code>false</code></p>
<p>&bull; <code>string</code> (chaine) : <code>"Bonjour"</code></p>

<p>Pour afficher, on utilise <code>cout</code>. Pour lire une saisie, on utilise <code>cin</code> :</p>
<div class="code-example">cout &lt;&lt; <span class="string">"Entrez votre age : "</span>;
cin &gt;&gt; age;
cout &lt;&lt; <span class="string">"Vous avez "</span> &lt;&lt; age &lt;&lt; <span class="string">" ans"</span> &lt;&lt; endl;</div>

<p>Les <strong>commentaires</strong> s'ecrivent ainsi :</p>
<div class="code-example"><span class="comment">// Commentaire sur une ligne</span>
<span class="comment">/* Commentaire
   sur plusieurs lignes */</span></div>

<div class="tip">Chaque instruction se termine par un <strong>point-virgule</strong> <code>;</code>. La fonction <code>main()</code> retourne <code>0</code> pour indiquer que le programme s'est termine correctement.</div>`
    },
    {
        title: "Operateurs et conditions",
        num: 2,
        lesson: `<p>C++ dispose d'<strong>operateurs</strong> pour faire des calculs, des comparaisons et des conditions.</p>

<p><strong>Operateurs arithmetiques :</strong></p>
<div class="code-example"><span class="keyword">int</span> a = <span class="number">10</span> + <span class="number">5</span>;    <span class="comment">// 15  (addition)</span>
<span class="keyword">int</span> b = <span class="number">10</span> - <span class="number">3</span>;    <span class="comment">// 7   (soustraction)</span>
<span class="keyword">int</span> c = <span class="number">4</span> * <span class="number">3</span>;     <span class="comment">// 12  (multiplication)</span>
<span class="keyword">int</span> d = <span class="number">10</span> / <span class="number">3</span>;    <span class="comment">// 3   (division entiere !)</span>
<span class="keyword">int</span> e = <span class="number">10</span> % <span class="number">3</span>;    <span class="comment">// 1   (modulo)</span></div>

<p><strong>Operateurs de comparaison :</strong></p>
<div class="code-example"><span class="number">5</span> == <span class="number">5</span>     <span class="comment">// true  (egal)</span>
<span class="number">5</span> != <span class="number">3</span>     <span class="comment">// true  (different)</span>
<span class="number">5</span> > <span class="number">3</span>      <span class="comment">// true  (plus grand)</span>
<span class="number">5</span> &lt;= <span class="number">5</span>     <span class="comment">// true  (plus petit ou egal)</span></div>

<p><strong>Les conditions</strong> avec <code>if</code>, <code>else if</code> et <code>else</code> :</p>
<div class="code-example"><span class="keyword">int</span> age = <span class="number">18</span>;

<span class="keyword">if</span> (age >= <span class="number">18</span>) {
    cout &lt;&lt; <span class="string">"Majeur"</span>;
} <span class="keyword">else if</span> (age >= <span class="number">16</span>) {
    cout &lt;&lt; <span class="string">"Presque majeur"</span>;
} <span class="keyword">else</span> {
    cout &lt;&lt; <span class="string">"Mineur"</span>;
}</div>

<p><strong>Le switch :</strong></p>
<div class="code-example"><span class="keyword">int</span> choix = <span class="number">2</span>;
<span class="keyword">switch</span> (choix) {
    <span class="keyword">case</span> <span class="number">1</span>: cout &lt;&lt; <span class="string">"Un"</span>; <span class="keyword">break</span>;
    <span class="keyword">case</span> <span class="number">2</span>: cout &lt;&lt; <span class="string">"Deux"</span>; <span class="keyword">break</span>;
    <span class="keyword">default</span>: cout &lt;&lt; <span class="string">"Autre"</span>;
}</div>

<p><strong>L'operateur ternaire</strong> est un raccourci pour if/else :</p>
<div class="code-example"><span class="keyword">string</span> statut = (age >= <span class="number">18</span>) ? <span class="string">"majeur"</span> : <span class="string">"mineur"</span>;</div>

<p><strong>Operateurs logiques :</strong></p>
<p>&bull; <code>&&</code> (ET) : les deux conditions doivent etre vraies</p>
<p>&bull; <code>||</code> (OU) : au moins une doit etre vraie</p>
<p>&bull; <code>!</code> (NON) : inverse une condition</p>

<div class="tip">Attention : en C++, la division entre deux <code>int</code> donne un <code>int</code> (partie entiere). <code>10 / 3</code> donne <code>3</code>, pas <code>3.33</code>. Utilisez <code>double</code> pour un resultat decimal.</div>`
    },
    {
        title: "Les boucles",
        num: 3,
        lesson: `<p>Les <strong>boucles</strong> repetent un bloc de code plusieurs fois.</p>

<p><strong>La boucle <code>for</code></strong> : quand on sait combien de fois repeter</p>
<div class="code-example"><span class="keyword">for</span> (<span class="keyword">int</span> i = <span class="number">0</span>; i &lt; <span class="number">5</span>; i++) {
    cout &lt;&lt; i &lt;&lt; <span class="string">" "</span>;  <span class="comment">// 0 1 2 3 4</span>
}</div>

<p><strong>La boucle <code>while</code></strong> : tant qu'une condition est vraie</p>
<div class="code-example"><span class="keyword">int</span> compteur = <span class="number">0</span>;
<span class="keyword">while</span> (compteur &lt; <span class="number">3</span>) {
    cout &lt;&lt; compteur;  <span class="comment">// 0, 1, 2</span>
    compteur++;
}</div>

<p><strong>La boucle <code>do...while</code></strong> : s'execute au moins une fois</p>
<div class="code-example"><span class="keyword">int</span> x = <span class="number">10</span>;
<span class="keyword">do</span> {
    cout &lt;&lt; x;  <span class="comment">// affiche 10 meme si la condition est fausse</span>
} <span class="keyword">while</span> (x &lt; <span class="number">5</span>);</div>

<p><strong>La boucle range-based for</strong> (C++11) : parcourir un conteneur facilement</p>
<div class="code-example"><span class="keyword">vector</span>&lt;<span class="keyword">string</span>&gt; fruits = {<span class="string">"pomme"</span>, <span class="string">"banane"</span>, <span class="string">"orange"</span>};
<span class="keyword">for</span> (<span class="keyword">const string</span>&amp; fruit : fruits) {
    cout &lt;&lt; fruit &lt;&lt; <span class="string">" "</span>;
}</div>

<div class="tip"><code>break</code> sort de la boucle immediatement. <code>continue</code> passe a l'iteration suivante. La boucle range-based for est plus lisible et moins sujette aux erreurs que la boucle for classique avec index.</div>`
    },
    {
        title: "Les fonctions",
        num: 4,
        lesson: `<p>Une <strong>fonction</strong> est un bloc de code reutilisable. En C++, on doit specifier le type de retour.</p>

<div class="code-example"><span class="keyword">string</span> saluer(<span class="keyword">string</span> prenom) {
    <span class="keyword">return</span> <span class="string">"Bonjour "</span> + prenom;
}

cout &lt;&lt; saluer(<span class="string">"Ahmed"</span>);  <span class="comment">// Bonjour Ahmed</span></div>

<p><strong>Passage par valeur</strong> vs <strong>passage par reference</strong> :</p>
<div class="code-example"><span class="comment">// Par valeur : copie de la variable</span>
<span class="keyword">void</span> doubler(<span class="keyword">int</span> x) {
    x = x * <span class="number">2</span>;  <span class="comment">// ne modifie PAS l'original</span>
}

<span class="comment">// Par reference : modifie l'original</span>
<span class="keyword">void</span> doubler(<span class="keyword">int</span>&amp; x) {
    x = x * <span class="number">2</span>;  <span class="comment">// modifie l'original</span>
}</div>

<p>On peut definir des <strong>valeurs par defaut</strong> pour les parametres :</p>
<div class="code-example"><span class="keyword">string</span> saluer(<span class="keyword">string</span> prenom = <span class="string">"inconnu"</span>) {
    <span class="keyword">return</span> <span class="string">"Bonjour "</span> + prenom;
}

cout &lt;&lt; saluer();          <span class="comment">// Bonjour inconnu</span>
cout &lt;&lt; saluer(<span class="string">"Sara"</span>);   <span class="comment">// Bonjour Sara</span></div>

<p><strong>La surcharge de fonctions</strong> (function overloading) : plusieurs fonctions avec le meme nom mais des parametres differents :</p>
<div class="code-example"><span class="keyword">int</span> additionner(<span class="keyword">int</span> a, <span class="keyword">int</span> b) { <span class="keyword">return</span> a + b; }
<span class="keyword">double</span> additionner(<span class="keyword">double</span> a, <span class="keyword">double</span> b) { <span class="keyword">return</span> a + b; }

cout &lt;&lt; additionner(<span class="number">3</span>, <span class="number">4</span>);       <span class="comment">// appelle la version int : 7</span>
cout &lt;&lt; additionner(<span class="number">3.5</span>, <span class="number">2.1</span>);   <span class="comment">// appelle la version double : 5.6</span></div>

<div class="tip">En C++, une fonction doit etre <strong>declaree avant</strong> d'etre appelee. On peut utiliser un <strong>prototype</strong> (declaration sans corps) en haut du fichier, puis definir la fonction plus bas.</div>`
    },
    {
        title: "Les tableaux et les pointeurs",
        num: 5,
        lesson: `<p>C++ propose plusieurs facons de gerer des collections de donnees et la memoire.</p>

<p><strong>Tableau C-style</strong> (taille fixe) :</p>
<div class="code-example"><span class="keyword">int</span> notes[<span class="number">5</span>] = {<span class="number">10</span>, <span class="number">15</span>, <span class="number">12</span>, <span class="number">18</span>, <span class="number">14</span>};
cout &lt;&lt; notes[<span class="number">0</span>];  <span class="comment">// 10</span>
cout &lt;&lt; notes[<span class="number">2</span>];  <span class="comment">// 12</span></div>

<p><strong>std::vector</strong> (tableau dynamique, recommande) :</p>
<div class="code-example"><span class="keyword">#include</span> <span class="string">&lt;vector&gt;</span>

<span class="keyword">vector</span>&lt;<span class="keyword">int</span>&gt; nombres = {<span class="number">1</span>, <span class="number">2</span>, <span class="number">3</span>};
nombres.push_back(<span class="number">4</span>);       <span class="comment">// ajoute 4 a la fin</span>
cout &lt;&lt; nombres.size();     <span class="comment">// 4</span>
cout &lt;&lt; nombres[<span class="number">0</span>];         <span class="comment">// 1</span></div>

<p><strong>Les pointeurs</strong> stockent l'adresse memoire d'une variable :</p>
<div class="code-example"><span class="keyword">int</span> age = <span class="number">25</span>;
<span class="keyword">int</span>* ptr = &amp;age;    <span class="comment">// ptr pointe vers age</span>
cout &lt;&lt; ptr;         <span class="comment">// adresse memoire (ex: 0x7fff...)</span>
cout &lt;&lt; *ptr;        <span class="comment">// 25 (dereferencement)</span>
*ptr = <span class="number">30</span>;           <span class="comment">// age vaut maintenant 30</span></div>

<p><strong>Les references</strong> sont des alias pour une variable existante :</p>
<div class="code-example"><span class="keyword">int</span> a = <span class="number">10</span>;
<span class="keyword">int</span>&amp; ref = a;   <span class="comment">// ref est un alias de a</span>
ref = <span class="number">20</span>;        <span class="comment">// a vaut maintenant 20</span></div>

<p><strong>Allocation dynamique</strong> avec <code>new</code> et <code>delete</code> :</p>
<div class="code-example"><span class="keyword">int</span>* p = <span class="keyword">new int</span>(<span class="number">42</span>);   <span class="comment">// alloue un int sur le tas</span>
cout &lt;&lt; *p;                <span class="comment">// 42</span>
<span class="keyword">delete</span> p;                 <span class="comment">// libere la memoire</span>
p = <span class="keyword">nullptr</span>;              <span class="comment">// bonne pratique</span></div>

<div class="tip"><code>nullptr</code> (C++11) remplace <code>NULL</code>. Utilisez <code>vector</code> plutot que les tableaux C-style quand c'est possible. N'oubliez jamais de <code>delete</code> ce que vous avez alloue avec <code>new</code>.</div>`
    },
    {
        title: "Les chaines et les structures",
        num: 6,
        lesson: `<p>C++ offre le type <code>std::string</code> pour manipuler du texte facilement.</p>

<p><strong>std::string</strong> et ses methodes :</p>
<div class="code-example"><span class="keyword">#include</span> <span class="string">&lt;string&gt;</span>

<span class="keyword">string</span> nom = <span class="string">"Ahmed"</span>;
cout &lt;&lt; nom.length();           <span class="comment">// 5</span>
cout &lt;&lt; nom.substr(<span class="number">0</span>, <span class="number">3</span>);      <span class="comment">// "Ahm"</span>
cout &lt;&lt; nom.find(<span class="string">"me"</span>);         <span class="comment">// 2 (position)</span>
nom += <span class="string">" Ali"</span>;                 <span class="comment">// "Ahmed Ali" (concatenation)</span>
cout &lt;&lt; nom.empty();            <span class="comment">// false</span></div>

<p><strong>Comparaison de chaines :</strong></p>
<div class="code-example"><span class="keyword">string</span> a = <span class="string">"hello"</span>;
<span class="keyword">string</span> b = <span class="string">"hello"</span>;
<span class="keyword">if</span> (a == b) cout &lt;&lt; <span class="string">"Egales"</span>;   <span class="comment">// fonctionne directement !</span></div>

<p><strong>Les structures (struct)</strong> regroupent des variables :</p>
<div class="code-example"><span class="keyword">struct</span> Personne {
    <span class="keyword">string</span> nom;
    <span class="keyword">int</span> age;
    <span class="keyword">float</span> taille;
};

Personne p1;
p1.nom = <span class="string">"Ahmed"</span>;
p1.age = <span class="number">25</span>;
p1.taille = <span class="number">1.75f</span>;</div>

<p><strong>Les enumerations (enum)</strong> definissent un ensemble de constantes :</p>
<div class="code-example"><span class="keyword">enum</span> Couleur { ROUGE, VERT, BLEU };
Couleur c = VERT;  <span class="comment">// c vaut 1</span>

<span class="comment">// enum class (C++11, recommande)</span>
<span class="keyword">enum class</span> Direction { HAUT, BAS, GAUCHE, DROITE };
Direction d = Direction::HAUT;</div>

<p><strong>typedef et using</strong> creent des alias de type :</p>
<div class="code-example"><span class="keyword">typedef</span> <span class="keyword">unsigned int</span> uint;
<span class="keyword">using</span> uint = <span class="keyword">unsigned int</span>;  <span class="comment">// equivalent moderne (C++11)</span></div>

<div class="tip">Preferez <code>std::string</code> aux chaines C (<code>char*</code>). Preferez <code>enum class</code> a <code>enum</code> classique pour eviter les conflits de noms.</div>`
    },
    {
        title: "Introduction a la POO",
        num: 7,
        lesson: `<p>La <strong>Programmation Orientee Objet</strong> (POO) est au coeur de C++. Une <strong>classe</strong> est un modele pour creer des objets.</p>

<p><strong>Declaration d'une classe :</strong></p>
<div class="code-example"><span class="keyword">class</span> Personne {
<span class="keyword">private</span>:
    <span class="keyword">string</span> nom;
    <span class="keyword">int</span> age;

<span class="keyword">public</span>:
    <span class="comment">// Constructeur</span>
    Personne(<span class="keyword">string</span> n, <span class="keyword">int</span> a) : nom(n), age(a) {}

    <span class="comment">// Destructeur</span>
    ~Personne() {}

    <span class="comment">// Methode</span>
    <span class="keyword">void</span> sePresenter() {
        cout &lt;&lt; <span class="string">"Je suis "</span> &lt;&lt; nom &lt;&lt; <span class="string">", "</span> &lt;&lt; age &lt;&lt; <span class="string">" ans"</span>;
    }

    <span class="keyword">string</span> getNom() { <span class="keyword">return</span> nom; }
};</div>

<p><strong>Creation et utilisation d'un objet :</strong></p>
<div class="code-example">Personne p1(<span class="string">"Ahmed"</span>, <span class="number">25</span>);
p1.sePresenter();  <span class="comment">// Je suis Ahmed, 25 ans</span>
cout &lt;&lt; p1.getNom();  <span class="comment">// Ahmed</span></div>

<p><strong>Niveaux d'acces :</strong></p>
<p>&bull; <code>public</code> : accessible de partout</p>
<p>&bull; <code>private</code> : accessible uniquement dans la classe</p>
<p>&bull; <code>protected</code> : accessible dans la classe et ses classes filles</p>

<p><strong>Le pointeur <code>this</code></strong> pointe vers l'objet courant :</p>
<div class="code-example"><span class="keyword">void</span> setAge(<span class="keyword">int</span> age) {
    <span class="keyword">this</span>->age = age;  <span class="comment">// distingue le parametre du membre</span>
}</div>

<p><strong>L'heritage</strong> permet de creer une classe a partir d'une autre :</p>
<div class="code-example"><span class="keyword">class</span> Etudiant : <span class="keyword">public</span> Personne {
<span class="keyword">private</span>:
    <span class="keyword">string</span> universite;
<span class="keyword">public</span>:
    Etudiant(<span class="keyword">string</span> n, <span class="keyword">int</span> a, <span class="keyword">string</span> u)
        : Personne(n, a), universite(u) {}
};</div>

<div class="tip">En C++, les membres d'une classe sont <code>private</code> par defaut, tandis que les membres d'une <code>struct</code> sont <code>public</code> par defaut. Utilisez des getters/setters pour acceder aux membres prives.</div>`
    }
];

// ========================
// QUESTIONS (50)
// ========================
const allQuestions = [
    // === CHAPITRE 1 : Les bases — syntaxe et variables (8) ===
    {
        chapter: 0,
        question: "Quelle directive permet d'inclure une bibliotheque en C++ ?",
        options: ["<code>import iostream</code>", "<code>#include &lt;iostream&gt;</code>", "<code>using iostream;</code>", "<code>require iostream</code>"],
        answer: 1,
        explanation: "En C++, on utilise <code>#include</code> suivi du nom de la bibliotheque entre chevrons <code>&lt;&gt;</code> pour les bibliotheques standard. C'est une directive du preprocesseur."
    },
    {
        chapter: 0,
        question: "Quelle est la fonction obligatoire dans tout programme C++ ?",
        options: ["<code>start()</code>", "<code>run()</code>", "<code>main()</code>", "<code>init()</code>"],
        answer: 2,
        explanation: "Tout programme C++ doit contenir une fonction <code>main()</code>. C'est le point d'entree du programme. Elle retourne generalement <code>0</code> pour indiquer un succes."
    },
    {
        chapter: 0,
        question: "Comment affiche-t-on du texte en C++ ?",
        options: ["<code>print(\"Salut\");</code>", "<code>echo \"Salut\";</code>", "<code>cout &lt;&lt; \"Salut\";</code>", "<code>printf \"Salut\";</code>"],
        answer: 2,
        explanation: "<code>cout</code> (character output) est l'objet de sortie standard en C++. On utilise l'operateur <code>&lt;&lt;</code> pour lui envoyer des donnees a afficher."
    },
    {
        chapter: 0,
        question: "Quel type utilise-t-on pour stocker un nombre decimal avec une haute precision en C++ ?",
        options: ["<code>int</code>", "<code>float</code>", "<code>double</code>", "<code>char</code>"],
        answer: 2,
        explanation: "<code>double</code> stocke un nombre decimal sur 64 bits (environ 15 chiffres significatifs), tandis que <code>float</code> n'en offre que 32 bits (environ 7 chiffres). <code>double</code> est le choix par defaut pour les decimaux."
    },
    {
        chapter: 0,
        question: "Quelle est la bonne declaration d'une variable de type caractere en C++ ?",
        options: ["<code>char lettre = \"A\";</code>", "<code>char lettre = 'A';</code>", "<code>string lettre = 'A';</code>", "<code>character lettre = 'A';</code>"],
        answer: 1,
        explanation: "Un <code>char</code> stocke un seul caractere et utilise des <strong>guillemets simples</strong> <code>'A'</code>. Les guillemets doubles <code>\"A\"</code> definissent une chaine (string), pas un caractere."
    },
    {
        chapter: 0,
        question: "Que fait l'operateur <code>&gt;&gt;</code> avec <code>cin</code> ?",
        options: ["Il affiche une valeur", "Il lit une valeur saisie par l'utilisateur", "Il compare deux valeurs", "Il decale les bits a droite"],
        answer: 1,
        explanation: "<code>cin &gt;&gt; variable</code> lit une valeur depuis l'entree standard (clavier) et la stocke dans la variable. <code>&gt;&gt;</code> est l'operateur d'extraction."
    },
    {
        chapter: 0,
        question: "Que signifie <code>using namespace std;</code> ?",
        options: [
            "On importe la bibliotheque standard",
            "On peut utiliser <code>cout</code>, <code>cin</code>, <code>string</code>, etc. sans prefixe <code>std::</code>",
            "On cree un nouvel espace de noms",
            "On active le mode standard du compilateur"
        ],
        answer: 1,
        explanation: "<code>using namespace std;</code> permet d'ecrire <code>cout</code> au lieu de <code>std::cout</code>, <code>string</code> au lieu de <code>std::string</code>, etc. Cela evite de repeter le prefixe <code>std::</code>."
    },
    {
        chapter: 0,
        question: "Quel est le type de retour habituel de la fonction <code>main()</code> en C++ ?",
        options: ["<code>void</code>", "<code>string</code>", "<code>int</code>", "<code>bool</code>"],
        answer: 2,
        explanation: "La fonction <code>main()</code> retourne un <code>int</code>. Par convention, <code>return 0;</code> signifie que le programme s'est execute sans erreur. Une valeur differente de 0 indique une erreur."
    },

    // === CHAPITRE 2 : Les operateurs et conditions (7) ===
    {
        chapter: 1,
        question: "Que donne <code>10 / 3</code> en C++ si les deux operandes sont des <code>int</code> ?",
        options: ["<code>3.33</code>", "<code>3</code>", "<code>4</code>", "<code>3.0</code>"],
        answer: 1,
        explanation: "En C++, la division entre deux <code>int</code> est une <strong>division entiere</strong> : le resultat est tronque. <code>10 / 3</code> donne <code>3</code>, pas <code>3.33</code>. Pour un resultat decimal, il faut utiliser <code>double</code> ou <code>float</code>."
    },
    {
        chapter: 1,
        question: "Que donne <code>10 % 3</code> en C++ ?",
        options: ["<code>3.33</code>", "<code>3</code>", "<code>1</code>", "<code>0</code>"],
        answer: 2,
        explanation: "L'operateur <code>%</code> (modulo) donne le <strong>reste</strong> de la division entiere. 10 divise par 3 = 3 avec un reste de <strong>1</strong>."
    },
    {
        chapter: 1,
        question: "Quelle est la bonne syntaxe du <code>else if</code> en C++ ?",
        options: ["<code>elseif (condition)</code>", "<code>else if (condition)</code>", "<code>elif (condition)</code>", "<code>otherwise (condition)</code>"],
        answer: 1,
        explanation: "En C++, on ecrit <code>else if</code> en deux mots separes. Contrairement a PHP qui accepte <code>elseif</code>, C++ n'accepte que <code>else if</code>."
    },
    {
        chapter: 1,
        question: "Que se passe-t-il si on oublie <code>break</code> dans un <code>switch</code> en C++ ?",
        options: [
            "Une erreur de compilation",
            "Le programme s'arrete",
            "L'execution continue dans les cas suivants (fall-through)",
            "Le switch est ignore"
        ],
        answer: 2,
        explanation: "Sans <code>break</code>, le code \"tombe\" dans les cas suivants et les execute aussi. C'est le comportement <strong>fall-through</strong>. Il faut presque toujours mettre un <code>break</code> dans chaque <code>case</code>."
    },
    {
        chapter: 1,
        question: "Que vaut <code>result</code> apres ce code ?<div class='code-block'>int age = 20;\nstring result = (age >= 18) ? \"majeur\" : \"mineur\";</div>",
        options: ["<code>\"mineur\"</code>", "<code>\"majeur\"</code>", "<code>true</code>", "<code>20</code>"],
        answer: 1,
        explanation: "L'operateur ternaire <code>condition ? valeurSiVrai : valeurSiFaux</code>. Ici <code>20 >= 18</code> est vrai, donc <code>result</code> vaut <code>\"majeur\"</code>."
    },
    {
        chapter: 1,
        question: "Que signifie l'operateur <code>&&</code> en C++ ?",
        options: ["OU logique", "ET logique", "NON logique", "Adresse memoire"],
        answer: 1,
        explanation: "<code>&&</code> est l'operateur ET logique. L'expression est vraie uniquement si les <strong>deux</strong> conditions sont vraies. Ne pas confondre avec <code>&</code> (un seul) qui est l'operateur d'adresse ou le ET binaire."
    },
    {
        chapter: 1,
        question: "Que vaut <code>!true</code> en C++ ?",
        options: ["<code>true</code>", "<code>false</code>", "<code>1</code>", "<code>null</code>"],
        answer: 1,
        explanation: "L'operateur <code>!</code> (NON logique) inverse la valeur booleenne. <code>!true</code> donne <code>false</code>, et <code>!false</code> donne <code>true</code>."
    },

    // === CHAPITRE 3 : Les boucles (6) ===
    {
        chapter: 2,
        question: "Quelle est la syntaxe correcte d'une boucle <code>for</code> en C++ ?",
        options: [
            "<code>for (int i = 0; i < 5; i++)</code>",
            "<code>for (i = 0; i < 5; i++)</code>",
            "<code>for (int i in range(5))</code>",
            "<code>loop (int i = 0 to 5)</code>"
        ],
        answer: 0,
        explanation: "La syntaxe du <code>for</code> en C++ est : <code>for (initialisation; condition; incrementation)</code>. On declare generalement la variable d'iteration avec son type directement dans la boucle."
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
        question: "Que fait cette boucle range-based for ?<div class='code-block'>vector&lt;int&gt; v = {10, 20, 30};\nfor (int x : v) {\n    cout &lt;&lt; x &lt;&lt; \" \";\n}</div>",
        options: [
            "Affiche <code>0 1 2</code>",
            "Affiche <code>10 20 30</code>",
            "Provoque une erreur",
            "Affiche <code>v[0] v[1] v[2]</code>"
        ],
        answer: 1,
        explanation: "La boucle range-based for parcourt chaque element du vecteur. <code>x</code> prend successivement les valeurs <code>10</code>, <code>20</code>, <code>30</code>. C'est la syntaxe moderne de C++11."
    },
    {
        chapter: 2,
        question: "Que fait <code>break</code> dans une boucle C++ ?",
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
        question: "Que fait <code>continue</code> dans une boucle C++ ?",
        options: [
            "Sort de la boucle",
            "Saute le reste du tour actuel et passe au suivant",
            "Relance la boucle depuis le debut",
            "Arrete le programme"
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
            "Elle tourne a l'infini et bloque le programme",
            "Elle affiche une erreur de syntaxe"
        ],
        answer: 2,
        explanation: "<code>while(true)</code> ne s'arretera jamais car la condition est toujours vraie. Sans <code>break</code>, c'est une boucle infinie qui bloquera le programme ou consommera toutes les ressources."
    },

    // === CHAPITRE 4 : Les fonctions (7) ===
    {
        chapter: 3,
        question: "Quelle est la syntaxe correcte pour definir une fonction qui retourne un entier en C++ ?",
        options: [
            "<code>def maFonction() {}</code>",
            "<code>function maFonction(): int {}</code>",
            "<code>int maFonction() {}</code>",
            "<code>fn maFonction() -> int {}</code>"
        ],
        answer: 2,
        explanation: "En C++, on ecrit le <strong>type de retour</strong> avant le nom de la fonction : <code>int maFonction() { ... }</code>. <code>def</code> est pour Python, <code>fn</code> pour Rust."
    },
    {
        chapter: 3,
        question: "Quelle est la difference entre le passage par valeur et par reference ?",
        options: [
            "Aucune difference",
            "Le passage par reference (<code>&</code>) modifie l'original, le passage par valeur travaille sur une copie",
            "Le passage par valeur est plus lent",
            "Le passage par reference cree une copie"
        ],
        answer: 1,
        explanation: "Le passage par valeur copie la variable : les modifications ne sont pas repercutees. Le passage par reference (<code>int&amp; x</code>) transmet l'adresse : les modifications affectent l'original."
    },
    {
        chapter: 3,
        question: "Que se passe-t-il si on appelle <code>saluer()</code> avec cette fonction ?<div class='code-block'>string saluer(string nom = \"inconnu\") {\n    return \"Bonjour \" + nom;\n}</div>",
        options: [
            "Une erreur de compilation",
            "La fonction retourne <code>\"Bonjour \"</code>",
            "La fonction retourne <code>\"Bonjour inconnu\"</code>",
            "La fonction retourne <code>\"\"</code>"
        ],
        answer: 2,
        explanation: "Le parametre <code>nom</code> a une valeur par defaut <code>\"inconnu\"</code>. Si on appelle la fonction sans argument, cette valeur est utilisee automatiquement."
    },
    {
        chapter: 3,
        question: "Qu'est-ce que la <strong>surcharge de fonctions</strong> (function overloading) en C++ ?",
        options: [
            "Appeler une fonction trop de fois",
            "Definir plusieurs fonctions avec le meme nom mais des parametres differents",
            "Remplacer une fonction par une autre",
            "Une erreur de compilation"
        ],
        answer: 1,
        explanation: "La surcharge permet d'avoir plusieurs fonctions avec le <strong>meme nom</strong> mais des <strong>signatures differentes</strong> (nombre ou types de parametres). Le compilateur choisit la bonne version automatiquement."
    },
    {
        chapter: 3,
        question: "Que signifie le type de retour <code>void</code> ?",
        options: [
            "La fonction retourne <code>0</code>",
            "La fonction retourne <code>null</code>",
            "La fonction ne retourne aucune valeur",
            "La fonction retourne une chaine vide"
        ],
        answer: 2,
        explanation: "<code>void</code> signifie que la fonction ne retourne rien. On ne peut pas utiliser <code>return valeur;</code> dans une fonction <code>void</code> (mais <code>return;</code> seul est autorise pour sortir de la fonction)."
    },
    {
        chapter: 3,
        question: "Pourquoi utilise-t-on un prototype de fonction en C++ ?",
        options: [
            "Pour accelerer la compilation",
            "Pour declarer une fonction avant sa definition, permettant de l'appeler avant qu'elle soit definie",
            "Pour rendre la fonction privee",
            "C'est obligatoire pour toutes les fonctions"
        ],
        answer: 1,
        explanation: "Un prototype (ex: <code>int add(int a, int b);</code>) informe le compilateur de l'existence de la fonction. Cela permet d'appeler la fonction dans <code>main()</code> meme si sa definition complete est ecrite plus bas dans le fichier."
    },
    {
        chapter: 3,
        question: "Que se passe-t-il avec ce code ?<div class='code-block'>void doubler(int x) {\n    x = x * 2;\n}\nint n = 5;\ndoubler(n);\ncout &lt;&lt; n;</div>",
        options: [
            "Affiche <code>10</code>",
            "Affiche <code>5</code>",
            "Affiche <code>0</code>",
            "Provoque une erreur"
        ],
        answer: 1,
        explanation: "La fonction recoit <code>x</code> <strong>par valeur</strong> (copie). La modification de <code>x</code> dans la fonction n'affecte pas <code>n</code>. Pour modifier l'original, il faudrait passer par reference : <code>void doubler(int&amp; x)</code>."
    },

    // === CHAPITRE 5 : Les tableaux et les pointeurs (8) ===
    {
        chapter: 4,
        question: "Comment declare-t-on un tableau de 5 entiers en C++ ?",
        options: [
            "<code>int notes[5];</code>",
            "<code>int[] notes = new int[5];</code>",
            "<code>array notes[5];</code>",
            "<code>int notes = {5};</code>"
        ],
        answer: 0,
        explanation: "En C++, un tableau C-style se declare avec <code>type nom[taille];</code>. La syntaxe <code>int notes[5];</code> cree un tableau de 5 entiers. Les index vont de 0 a 4."
    },
    {
        chapter: 4,
        question: "Quel conteneur est recommande pour un tableau dynamique en C++ ?",
        options: ["<code>int[]</code>", "<code>std::array</code>", "<code>std::vector</code>", "<code>std::list</code>"],
        answer: 2,
        explanation: "<code>std::vector</code> est le conteneur dynamique recommande. Il gere automatiquement sa taille, permet d'ajouter/supprimer des elements et offre un acces rapide par index."
    },
    {
        chapter: 4,
        question: "Que fait <code>push_back(4)</code> sur un <code>vector</code> ?",
        options: [
            "Ajoute 4 au debut du vecteur",
            "Ajoute 4 a la fin du vecteur",
            "Remplace le premier element par 4",
            "Supprime l'element a l'index 4"
        ],
        answer: 1,
        explanation: "<code>push_back()</code> ajoute un element <strong>a la fin</strong> du vecteur. C'est l'equivalent de <code>append()</code> en Python ou <code>push()</code> en JavaScript."
    },
    {
        chapter: 4,
        question: "Que fait l'operateur <code>&</code> devant une variable en C++ ?",
        options: [
            "Il multiplie la variable par 2",
            "Il retourne l'adresse memoire de la variable",
            "Il cree une copie de la variable",
            "Il supprime la variable"
        ],
        answer: 1,
        explanation: "L'operateur <code>&</code> (adresse-de) retourne l'adresse memoire d'une variable. Par exemple, <code>&age</code> donne l'adresse ou <code>age</code> est stockee en memoire."
    },
    {
        chapter: 4,
        question: "Que fait l'operateur <code>*</code> devant un pointeur ?",
        options: [
            "Il multiplie le pointeur",
            "Il dereference le pointeur (accede a la valeur pointee)",
            "Il supprime le pointeur",
            "Il affiche l'adresse"
        ],
        answer: 1,
        explanation: "L'operateur <code>*</code> (dereferencement) accede a la <strong>valeur</strong> stockee a l'adresse contenue dans le pointeur. Si <code>ptr</code> pointe vers <code>age</code>, alors <code>*ptr</code> donne la valeur de <code>age</code>."
    },
    {
        chapter: 4,
        question: "Que se passe-t-il si on fait <code>new int(42)</code> sans jamais appeler <code>delete</code> ?",
        options: [
            "Rien de special",
            "Le programme plante immediatement",
            "Il y a une fuite memoire (memory leak)",
            "La valeur est automatiquement liberee"
        ],
        answer: 2,
        explanation: "<code>new</code> alloue de la memoire sur le <strong>tas</strong> (heap). Sans <code>delete</code>, cette memoire n'est jamais liberee : c'est une <strong>fuite memoire</strong>. Au fil du temps, cela peut epuiser la memoire disponible."
    },
    {
        chapter: 4,
        question: "Quelle est la valeur recommandee pour un pointeur qui ne pointe vers rien en C++ moderne ?",
        options: ["<code>NULL</code>", "<code>0</code>", "<code>nullptr</code>", "<code>void</code>"],
        answer: 2,
        explanation: "<code>nullptr</code> (C++11) est la valeur recommandee pour un pointeur nul. Contrairement a <code>NULL</code> (qui est juste <code>0</code>), <code>nullptr</code> a un type specifique et evite les ambiguites."
    },
    {
        chapter: 4,
        question: "Que vaut <code>*ptr</code> apres ce code ?<div class='code-block'>int a = 10;\nint* ptr = &amp;a;\na = 20;</div>",
        options: ["<code>10</code>", "<code>20</code>", "L'adresse de <code>a</code>", "Une erreur"],
        answer: 1,
        explanation: "<code>ptr</code> pointe vers <code>a</code>. Quand on modifie <code>a</code> a <code>20</code>, le pointeur pointe toujours vers le meme emplacement. Donc <code>*ptr</code> donne la valeur actuelle de <code>a</code>, soit <code>20</code>."
    },

    // === CHAPITRE 6 : Les chaines et les structures (7) ===
    {
        chapter: 5,
        question: "Comment obtenir la longueur d'un <code>std::string</code> en C++ ?",
        options: [
            "<code>strlen(str)</code>",
            "<code>str.length()</code> ou <code>str.size()</code>",
            "<code>str.len</code>",
            "<code>count(str)</code>"
        ],
        answer: 1,
        explanation: "Les methodes <code>length()</code> et <code>size()</code> retournent toutes les deux le nombre de caracteres d'un <code>std::string</code>. Elles sont equivalentes."
    },
    {
        chapter: 5,
        question: "Comment concatene-t-on deux <code>string</code> en C++ ?",
        options: [
            "Avec le point <code>.</code>",
            "Avec <code>concat()</code>",
            "Avec l'operateur <code>+</code> ou <code>+=</code>",
            "Avec <code>strcat()</code>"
        ],
        answer: 2,
        explanation: "En C++, on concatene des <code>std::string</code> avec <code>+</code> ou <code>+=</code>. Par exemple : <code>string nom = prenom + \" \" + famille;</code>. Le point est la concatenation en PHP, pas en C++."
    },
    {
        chapter: 5,
        question: "Que retourne <code>str.find(\"abc\")</code> si la sous-chaine n'est pas trouvee ?",
        options: [
            "<code>-1</code>",
            "<code>0</code>",
            "<code>string::npos</code>",
            "<code>false</code>"
        ],
        answer: 2,
        explanation: "<code>find()</code> retourne <code>string::npos</code> (une constante tres grande) si la sous-chaine n'est pas trouvee. On teste avec <code>if (str.find(\"abc\") != string::npos)</code>."
    },
    {
        chapter: 5,
        question: "Comment accede-t-on au membre <code>nom</code> d'une structure <code>Personne p1</code> ?",
        options: [
            "<code>p1->nom</code>",
            "<code>p1.nom</code>",
            "<code>p1[\"nom\"]</code>",
            "<code>Personne.nom</code>"
        ],
        answer: 1,
        explanation: "On accede aux membres d'une structure avec le <strong>point</strong> <code>.</code> : <code>p1.nom</code>. L'operateur <code>-></code> est utilise avec les pointeurs vers des structures."
    },
    {
        chapter: 5,
        question: "Quelle est la difference entre <code>enum</code> et <code>enum class</code> ?",
        options: [
            "Aucune difference",
            "<code>enum class</code> est plus recent et evite les conflits de noms grace a la portee",
            "<code>enum</code> est plus rapide",
            "<code>enum class</code> ne fonctionne qu'avec des chaines"
        ],
        answer: 1,
        explanation: "<code>enum class</code> (C++11) cree une enumeration a portee : il faut ecrire <code>Direction::HAUT</code> au lieu de juste <code>HAUT</code>. Cela evite les conflits si deux enums ont des valeurs de meme nom."
    },
    {
        chapter: 5,
        question: "Que fait <code>str.substr(2, 4)</code> sur la chaine <code>\"Bonjour\"</code> ?",
        options: [
            "Retourne <code>\"nj\"</code>",
            "Retourne <code>\"njou\"</code>",
            "Retourne <code>\"Bonj\"</code>",
            "Retourne <code>\"jour\"</code>"
        ],
        answer: 1,
        explanation: "<code>substr(position, longueur)</code> extrait une sous-chaine. A partir de la position 2 (le 'n'), on prend 4 caracteres : <code>\"njou\"</code>."
    },
    {
        chapter: 5,
        question: "A quoi sert le mot-cle <code>typedef</code> en C++ ?",
        options: [
            "A definir un nouveau type de donnees",
            "A creer un alias pour un type existant",
            "A declarer une variable",
            "A convertir un type en un autre"
        ],
        answer: 1,
        explanation: "<code>typedef</code> cree un <strong>alias</strong> (un nouveau nom) pour un type existant. Par exemple <code>typedef unsigned int uint;</code> permet d'ecrire <code>uint</code> au lieu de <code>unsigned int</code>. En C++11, on prefere <code>using</code>."
    },

    // === CHAPITRE 7 : Introduction a la POO (7) ===
    {
        chapter: 6,
        question: "Quelle est la difference entre une <code>struct</code> et une <code>class</code> en C++ ?",
        options: [
            "Aucune difference",
            "Les membres d'une <code>struct</code> sont <code>public</code> par defaut, ceux d'une <code>class</code> sont <code>private</code> par defaut",
            "On ne peut pas mettre de methodes dans une <code>struct</code>",
            "<code>struct</code> est plus rapide"
        ],
        answer: 1,
        explanation: "La seule difference technique est la visibilite par defaut : <code>public</code> pour <code>struct</code>, <code>private</code> pour <code>class</code>. Les deux peuvent avoir des methodes, des constructeurs, de l'heritage, etc."
    },
    {
        chapter: 6,
        question: "A quoi sert un <strong>constructeur</strong> en C++ ?",
        options: [
            "A detruire un objet",
            "A initialiser un objet lors de sa creation",
            "A copier un objet",
            "A afficher les informations de l'objet"
        ],
        answer: 1,
        explanation: "Le constructeur est une methode speciale appelee automatiquement lors de la creation d'un objet. Il porte le meme nom que la classe et n'a pas de type de retour. Il sert a initialiser les membres."
    },
    {
        chapter: 6,
        question: "Quel est le role du <strong>destructeur</strong> en C++ ?",
        options: [
            "Il cree un nouvel objet",
            "Il est appele automatiquement quand l'objet est detruit pour liberer les ressources",
            "Il supprime la classe",
            "Il reinitialise l'objet"
        ],
        answer: 1,
        explanation: "Le destructeur (<code>~NomClasse()</code>) est appele automatiquement quand un objet sort de sa portee ou est supprime. Il sert a liberer la memoire allouee dynamiquement ou fermer des fichiers."
    },
    {
        chapter: 6,
        question: "Que signifie <code>private</code> dans une classe C++ ?",
        options: [
            "Les membres sont accessibles de partout",
            "Les membres sont accessibles uniquement dans la classe elle-meme",
            "Les membres sont accessibles dans la classe et ses classes filles",
            "Les membres sont en lecture seule"
        ],
        answer: 1,
        explanation: "<code>private</code> restreint l'acces aux membres : seules les methodes de la <strong>meme classe</strong> peuvent y acceder. C'est le niveau d'acces par defaut dans une <code>class</code>."
    },
    {
        chapter: 6,
        question: "A quoi sert le pointeur <code>this</code> en C++ ?",
        options: [
            "A creer un nouvel objet",
            "A pointer vers l'objet courant (celui qui appelle la methode)",
            "A acceder a la classe parente",
            "A detruire l'objet"
        ],
        answer: 1,
        explanation: "<code>this</code> est un pointeur implicite vers l'objet sur lequel la methode est appelee. Il est souvent utilise pour lever l'ambiguite quand un parametre a le meme nom qu'un membre : <code>this->age = age;</code>."
    },
    {
        chapter: 6,
        question: "Que fait cette declaration ?<div class='code-block'>class Etudiant : public Personne {\n    // ...\n};</div>",
        options: [
            "Elle cree un alias pour Personne",
            "Elle cree une classe Etudiant qui herite de Personne",
            "Elle remplace la classe Personne",
            "Elle fusionne deux classes"
        ],
        answer: 1,
        explanation: "La syntaxe <code>class Fille : public Mere</code> cree un <strong>heritage</strong>. <code>Etudiant</code> herite de tous les membres publics et proteges de <code>Personne</code>. C'est la base du polymorphisme en C++."
    },
    {
        chapter: 6,
        question: "Que fait la liste d'initialisation dans ce constructeur ?<div class='code-block'>Personne(string n, int a) : nom(n), age(a) {}</div>",
        options: [
            "Elle declare de nouvelles variables",
            "Elle initialise directement les membres <code>nom</code> et <code>age</code> avant le corps du constructeur",
            "Elle appelle deux fonctions",
            "Elle cree deux objets"
        ],
        answer: 1,
        explanation: "La liste d'initialisation (<code>: nom(n), age(a)</code>) initialise les membres <strong>avant</strong> l'execution du corps du constructeur. C'est plus efficace que l'assignation dans le corps et c'est obligatoire pour les membres <code>const</code> et les references."
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
                qcm_name: 'qcm-cpp',
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
        message = 'Excellent ! Vous avez bien assimile les bases de C++.';
        detail = 'Vous etes pret pour la suite : les templates, la STL avancee, les smart pointers et la programmation generique.';
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
        detail = 'C++ est un langage exigeant. Relisez les lecons, pratiquez avec un compilateur en ligne, et recommencez.';
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
        advice = `<p style="text-align:center;color:#00599C;margin-top:10px">A retravailler en priorite : <strong>${weakest}</strong></p>`;
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
        body: JSON.stringify({ qcm_name: 'qcm-cpp', chapter_completed: -1, total_chapters: chapters.length })
    });

    // Save score
    fetch('/api/scores', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({
            qcm_name: 'qcm-cpp',
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

fetch('/api/progress/qcm-cpp')
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
