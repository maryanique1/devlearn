@extends('layouts.app')
@section('title', 'Apprendre SQL - QCM Progressif')

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
            color: #00BCD4;
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
            background: linear-gradient(90deg, #00BCD4, #006064);
            border-radius: 20px;
            transition: width 0.4s ease;
        }

        .progress-text {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .timer {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            font-family: 'Consolas', monospace;
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
            background: #00BCD4;
            color: #006064;
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

        .options li:hover { border-color: #00BCD4; background: #1a2a3e; }
        .options li.selected { border-color: #00BCD4; background: rgba(137,111,61,0.12); }
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
            border-left: 4px solid #00BCD4;
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

        .btn-primary { background: #00BCD4; color: #006064; font-weight: bold; }
        .btn-primary:hover { background: #00ACC1; }
        .btn-primary:disabled { background: #555; color: #999; cursor: not-allowed; }
        .btn-restart { background: var(--bg-input); color: var(--text-main); border: 1px solid var(--border-subtle); }
        .btn-restart:hover { background: #1a4a80; }

        .btn-container { text-align: center; margin-top: 20px; }

        /* Lesson card (pause between chapters) */
        .lesson-card {
            background: linear-gradient(135deg, var(--bg-card), var(--bg-input));
            border: 2px solid #00BCD433;
            border-radius: 16px;
            padding: 35px;
            margin-bottom: 20px;
        }

        .lesson-card h2 {
            color: #00BCD4;
            margin-bottom: 8px;
            font-size: 22px;
        }

        .lesson-card .chapter-num {
            color: #00BCD4;
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
            border: 1px solid #00BCD433;
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
            background: #00BCD415;
            border-left: 3px solid #00BCD4;
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

        .cat-score-card .cat-name { font-size: 12px; font-weight: bold; margin-bottom: 8px; color: #00BCD4; }
        .cat-score-card .cat-pct { font-size: 28px; font-weight: bold; }
        .cat-score-card .cat-detail { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

        /* Start screen */
        .start-screen { overflow-wrap: break-word; text-align: center; padding: 40px 20px; }
        .start-screen p { color: var(--text-muted); margin: 15px 0; line-height: 1.6; }

        .sql-logo {
            font-size: 36px;
            font-weight: bold;
            color: #006064;
            background: #00BCD4;
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
            color: #00BCD4;
            flex-shrink: 0;
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
    <h1>Apprendre SQL</h1>
    <p class="subtitle">QCM progressif &bull; 50 questions &bull; 7 chapitres</p>

    <!-- Start screen -->
    <div id="start-screen" class="start-screen">
        <div class="sql-logo">SQL</div>
        <p>Un parcours d'apprentissage complet pour decouvrir SQL depuis zero.<br>
        Chaque chapitre commence par une <strong>mini-lecon</strong>, puis vous testez vos connaissances.</p>

        <div class="roadmap">
            <div class="step"><span class="dot">1</span> Introduction et SELECT de base (8 questions)</div>
            <div class="step"><span class="dot">2</span> Filtrer les donnees — WHERE avance (7 questions)</div>
            <div class="step"><span class="dot">3</span> Trier et limiter — ORDER BY, LIMIT (6 questions)</div>
            <div class="step"><span class="dot">4</span> Les fonctions d'agregation (7 questions)</div>
            <div class="step"><span class="dot">5</span> Les jointures — JOIN (8 questions)</div>
            <div class="step"><span class="dot">6</span> Modifier les donnees — INSERT, UPDATE, DELETE (7 questions)</div>
            <div class="step"><span class="dot">7</span> Creer et modifier les tables — CREATE, ALTER (7 questions)</div>
        </div>

        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Commencer l'apprentissage</button>
        </div>
        <div id="resume-banner" style="display:none; margin-top:20px; background:var(--bg-card); border:2px solid #00BCD4; border-radius:12px; padding:20px; text-align:center;">
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
        title: "Introduction et SELECT de base",
        num: 1,
        lesson: `<p><strong>SQL</strong> (Structured Query Language) est le langage utilise pour communiquer avec les <strong>bases de donnees relationnelles</strong>. Une base de donnees stocke des informations de maniere organisee.</p>

<p><strong>Vocabulaire essentiel :</strong></p>
<p>&bull; <strong>Base de donnees</strong> : un ensemble de tables (comme un classeur Excel avec plusieurs feuilles)</p>
<p>&bull; <strong>Table</strong> : un ensemble de lignes et colonnes (comme une feuille Excel)</p>
<p>&bull; <strong>Ligne (row)</strong> : un enregistrement (ex: un etudiant)</p>
<p>&bull; <strong>Colonne (column)</strong> : un champ (ex: le nom, l'age)</p>

<p>La commande la plus utilisee est <code>SELECT</code> :</p>
<div class="code-example"><span class="comment">-- Selectionner toutes les colonnes</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> etudiants;

<span class="comment">-- Selectionner des colonnes specifiques</span>
<span class="keyword">SELECT</span> nom, age <span class="keyword">FROM</span> etudiants;

<span class="comment">-- Filtrer avec WHERE</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> etudiants <span class="keyword">WHERE</span> age = <span class="number">20</span>;

<span class="comment">-- Filtrer du texte (guillemets obligatoires)</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> etudiants <span class="keyword">WHERE</span> ville = <span class="string">'Paris'</span>;</div>

<div class="tip">En SQL, les commentaires commencent par <code>--</code> (deux tirets). Tout ce qui suit sur la ligne est ignore. Les commandes SQL se terminent par un point-virgule <code>;</code></div>`
    },
    {
        title: "Filtrer les donnees : WHERE avance",
        num: 2,
        lesson: `<p>La clause <code>WHERE</code> permet de filtrer les resultats avec de nombreux operateurs.</p>

<p><strong>Operateurs de comparaison :</strong></p>
<div class="code-example"><span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> prix = <span class="number">10</span>;     <span class="comment">-- egal</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> prix != <span class="number">10</span>;    <span class="comment">-- different</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> prix > <span class="number">10</span>;     <span class="comment">-- superieur</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> prix <= <span class="number">50</span>;    <span class="comment">-- inferieur ou egal</span></div>

<p><strong>Combiner les conditions :</strong></p>
<div class="code-example"><span class="comment">-- AND : les deux conditions doivent etre vraies</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> prix > <span class="number">10</span> <span class="keyword">AND</span> prix < <span class="number">50</span>;

<span class="comment">-- OR : au moins une condition vraie</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> categorie = <span class="string">'fruit'</span> <span class="keyword">OR</span> categorie = <span class="string">'legume'</span>;

<span class="comment">-- NOT : inverse la condition</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> <span class="keyword">NOT</span> categorie = <span class="string">'viande'</span>;</div>

<p><strong>Operateurs speciaux :</strong></p>
<div class="code-example"><span class="comment">-- BETWEEN : entre deux valeurs (bornes incluses)</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> prix <span class="keyword">BETWEEN</span> <span class="number">10</span> <span class="keyword">AND</span> <span class="number">50</span>;

<span class="comment">-- IN : parmi une liste de valeurs</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> categorie <span class="keyword">IN</span> (<span class="string">'fruit'</span>, <span class="string">'legume'</span>);

<span class="comment">-- LIKE : recherche de motifs</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> nom <span class="keyword">LIKE</span> <span class="string">'P%'</span>;    <span class="comment">-- commence par P</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> nom <span class="keyword">LIKE</span> <span class="string">'_a%'</span>;   <span class="comment">-- 2e lettre = a</span>

<span class="comment">-- IS NULL / IS NOT NULL</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> produits <span class="keyword">WHERE</span> description <span class="keyword">IS NULL</span>;</div>

<div class="tip"><code>%</code> remplace zero ou plusieurs caracteres. <code>_</code> remplace exactement un seul caractere. On ne peut pas utiliser <code>= NULL</code>, il faut utiliser <code>IS NULL</code>.</div>`
    },
    {
        title: "Trier et limiter : ORDER BY, LIMIT",
        num: 3,
        lesson: `<p><code>ORDER BY</code> permet de trier les resultats, et <code>LIMIT</code> d'en limiter le nombre.</p>

<p><strong>Trier les resultats :</strong></p>
<div class="code-example"><span class="comment">-- Tri croissant (par defaut = ASC)</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> etudiants <span class="keyword">ORDER BY</span> nom;

<span class="comment">-- Tri decroissant</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> etudiants <span class="keyword">ORDER BY</span> age <span class="keyword">DESC</span>;

<span class="comment">-- Tri sur plusieurs colonnes</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> etudiants <span class="keyword">ORDER BY</span> ville <span class="keyword">ASC</span>, age <span class="keyword">DESC</span>;</div>

<p><strong>Limiter les resultats :</strong></p>
<div class="code-example"><span class="comment">-- Les 5 premiers resultats</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> etudiants <span class="keyword">LIMIT</span> <span class="number">5</span>;

<span class="comment">-- Sauter les 10 premiers, puis prendre 5</span>
<span class="keyword">SELECT</span> * <span class="keyword">FROM</span> etudiants <span class="keyword">LIMIT</span> <span class="number">5</span> <span class="keyword">OFFSET</span> <span class="number">10</span>;</div>

<p><strong>Alias avec AS :</strong></p>
<div class="code-example"><span class="comment">-- Renommer une colonne dans le resultat</span>
<span class="keyword">SELECT</span> nom <span class="keyword">AS</span> prenom_etudiant <span class="keyword">FROM</span> etudiants;

<span class="comment">-- Combinaison complete</span>
<span class="keyword">SELECT</span> nom, age
<span class="keyword">FROM</span> etudiants
<span class="keyword">WHERE</span> age >= <span class="number">18</span>
<span class="keyword">ORDER BY</span> age <span class="keyword">DESC</span>
<span class="keyword">LIMIT</span> <span class="number">10</span>;</div>

<div class="tip">L'ordre des clauses est important : <code>SELECT</code> ... <code>FROM</code> ... <code>WHERE</code> ... <code>ORDER BY</code> ... <code>LIMIT</code>. Par defaut, <code>ORDER BY</code> trie en ordre croissant (<code>ASC</code>).</div>`
    },
    {
        title: "Fonctions d'agregation : COUNT, SUM, AVG",
        num: 4,
        lesson: `<p>Les <strong>fonctions d'agregation</strong> effectuent des calculs sur un ensemble de lignes pour renvoyer une seule valeur.</p>

<p><strong>Les fonctions principales :</strong></p>
<div class="code-example"><span class="keyword">SELECT</span> <span class="keyword">COUNT</span>(*) <span class="keyword">FROM</span> etudiants;           <span class="comment">-- nombre total de lignes</span>
<span class="keyword">SELECT</span> <span class="keyword">COUNT</span>(email) <span class="keyword">FROM</span> etudiants;       <span class="comment">-- nombre de lignes ou email n'est pas NULL</span>
<span class="keyword">SELECT</span> <span class="keyword">SUM</span>(prix) <span class="keyword">FROM</span> commandes;          <span class="comment">-- somme des prix</span>
<span class="keyword">SELECT</span> <span class="keyword">AVG</span>(note) <span class="keyword">FROM</span> examens;            <span class="comment">-- moyenne des notes</span>
<span class="keyword">SELECT</span> <span class="keyword">MIN</span>(prix) <span class="keyword">FROM</span> produits;           <span class="comment">-- prix minimum</span>
<span class="keyword">SELECT</span> <span class="keyword">MAX</span>(prix) <span class="keyword">FROM</span> produits;           <span class="comment">-- prix maximum</span></div>

<p><strong>GROUP BY</strong> : regrouper les resultats par categorie</p>
<div class="code-example"><span class="comment">-- Nombre d'etudiants par ville</span>
<span class="keyword">SELECT</span> ville, <span class="keyword">COUNT</span>(*) <span class="keyword">AS</span> total
<span class="keyword">FROM</span> etudiants
<span class="keyword">GROUP BY</span> ville;

<span class="comment">-- Moyenne des notes par matiere</span>
<span class="keyword">SELECT</span> matiere, <span class="keyword">AVG</span>(note) <span class="keyword">AS</span> moyenne
<span class="keyword">FROM</span> examens
<span class="keyword">GROUP BY</span> matiere;</div>

<p><strong>HAVING</strong> : filtrer apres le regroupement</p>
<div class="code-example"><span class="comment">-- Villes avec plus de 5 etudiants</span>
<span class="keyword">SELECT</span> ville, <span class="keyword">COUNT</span>(*) <span class="keyword">AS</span> total
<span class="keyword">FROM</span> etudiants
<span class="keyword">GROUP BY</span> ville
<span class="keyword">HAVING</span> <span class="keyword">COUNT</span>(*) > <span class="number">5</span>;</div>

<div class="tip"><code>WHERE</code> filtre les lignes <strong>avant</strong> le regroupement. <code>HAVING</code> filtre les groupes <strong>apres</strong> le regroupement. On ne peut pas utiliser de fonction d'agregation dans <code>WHERE</code>.</div>`
    },
    {
        title: "Les jointures : JOIN",
        num: 5,
        lesson: `<p>Les <strong>jointures</strong> permettent de combiner des donnees de plusieurs tables liees entre elles.</p>

<p>Imaginons deux tables : <code>etudiants</code> (id, nom, classe_id) et <code>classes</code> (id, nom_classe).</p>

<p><strong>INNER JOIN</strong> : ne garde que les lignes qui ont une correspondance dans les deux tables</p>
<div class="code-example"><span class="keyword">SELECT</span> etudiants.nom, classes.nom_classe
<span class="keyword">FROM</span> etudiants
<span class="keyword">INNER JOIN</span> classes <span class="keyword">ON</span> etudiants.classe_id = classes.id;</div>

<p><strong>LEFT JOIN</strong> : garde toutes les lignes de la table de gauche, meme sans correspondance (les colonnes de droite seront NULL)</p>
<div class="code-example"><span class="keyword">SELECT</span> etudiants.nom, classes.nom_classe
<span class="keyword">FROM</span> etudiants
<span class="keyword">LEFT JOIN</span> classes <span class="keyword">ON</span> etudiants.classe_id = classes.id;
<span class="comment">-- Un etudiant sans classe aura nom_classe = NULL</span></div>

<p><strong>RIGHT JOIN</strong> : garde toutes les lignes de la table de droite</p>
<div class="code-example"><span class="keyword">SELECT</span> etudiants.nom, classes.nom_classe
<span class="keyword">FROM</span> etudiants
<span class="keyword">RIGHT JOIN</span> classes <span class="keyword">ON</span> etudiants.classe_id = classes.id;
<span class="comment">-- Une classe sans etudiant aura nom = NULL</span></div>

<p><strong>Notation table.colonne</strong> : quand deux tables ont une colonne du meme nom, il faut preciser la table : <code>etudiants.id</code> ou <code>classes.id</code>.</p>

<div class="tip">La clause <code>ON</code> indique la condition de liaison entre les tables. C'est generalement la cle primaire d'une table liee a la cle etrangere de l'autre.</div>`
    },
    {
        title: "Modifier les donnees : INSERT, UPDATE, DELETE",
        num: 6,
        lesson: `<p>SQL permet aussi d'<strong>ajouter</strong>, <strong>modifier</strong> et <strong>supprimer</strong> des donnees dans les tables.</p>

<p><strong>INSERT INTO</strong> : ajouter une ligne</p>
<div class="code-example"><span class="comment">-- Inserer en specifiant toutes les colonnes</span>
<span class="keyword">INSERT INTO</span> etudiants <span class="keyword">VALUES</span> (<span class="number">1</span>, <span class="string">'Ahmed'</span>, <span class="number">20</span>, <span class="string">'Paris'</span>);

<span class="comment">-- Inserer en specifiant certaines colonnes</span>
<span class="keyword">INSERT INTO</span> etudiants (nom, age) <span class="keyword">VALUES</span> (<span class="string">'Sara'</span>, <span class="number">22</span>);</div>

<p><strong>UPDATE</strong> : modifier des lignes existantes</p>
<div class="code-example"><span class="comment">-- Modifier l'age d'un etudiant precis</span>
<span class="keyword">UPDATE</span> etudiants <span class="keyword">SET</span> age = <span class="number">21</span> <span class="keyword">WHERE</span> nom = <span class="string">'Ahmed'</span>;

<span class="comment">-- Modifier plusieurs colonnes</span>
<span class="keyword">UPDATE</span> etudiants <span class="keyword">SET</span> age = <span class="number">21</span>, ville = <span class="string">'Lyon'</span> <span class="keyword">WHERE</span> id = <span class="number">1</span>;</div>

<p><strong>DELETE</strong> : supprimer des lignes</p>
<div class="code-example"><span class="comment">-- Supprimer un etudiant precis</span>
<span class="keyword">DELETE FROM</span> etudiants <span class="keyword">WHERE</span> id = <span class="number">1</span>;

<span class="comment">-- ATTENTION : sans WHERE, tout est supprime !</span>
<span class="keyword">DELETE FROM</span> etudiants;  <span class="comment">-- supprime TOUTES les lignes</span></div>

<p><strong>TRUNCATE vs DELETE :</strong></p>
<div class="code-example"><span class="keyword">DELETE FROM</span> etudiants;     <span class="comment">-- supprime ligne par ligne, peut etre annule</span>
<span class="keyword">TRUNCATE TABLE</span> etudiants;  <span class="comment">-- vide la table d'un coup, remet le compteur a zero</span></div>

<div class="tip">ATTENTION : un <code>UPDATE</code> ou <code>DELETE</code> sans clause <code>WHERE</code> modifie ou supprime <strong>toutes</strong> les lignes de la table ! Toujours verifier la clause <code>WHERE</code> avant d'executer.</div>`
    },
    {
        title: "Creer et modifier les tables : CREATE, ALTER",
        num: 7,
        lesson: `<p>Avant de stocker des donnees, il faut <strong>creer la structure</strong> des tables.</p>

<p><strong>CREATE TABLE :</strong></p>
<div class="code-example"><span class="keyword">CREATE TABLE</span> etudiants (
    id <span class="keyword">INT</span> <span class="keyword">PRIMARY KEY</span> <span class="keyword">AUTO_INCREMENT</span>,
    nom <span class="keyword">VARCHAR</span>(<span class="number">100</span>) <span class="keyword">NOT NULL</span>,
    age <span class="keyword">INT</span>,
    email <span class="keyword">VARCHAR</span>(<span class="number">255</span>),
    bio <span class="keyword">TEXT</span>,
    date_inscription <span class="keyword">DATE</span> <span class="keyword">DEFAULT</span> <span class="keyword">CURRENT_DATE</span>,
    moyenne <span class="keyword">FLOAT</span>
);</div>

<p><strong>Types de donnees courants :</strong></p>
<p>&bull; <code>INT</code> : nombre entier</p>
<p>&bull; <code>VARCHAR(n)</code> : texte de longueur maximale n</p>
<p>&bull; <code>TEXT</code> : texte long sans limite pratique</p>
<p>&bull; <code>DATE</code> : date (AAAA-MM-JJ)</p>
<p>&bull; <code>FLOAT</code> : nombre decimal</p>

<p><strong>Contraintes importantes :</strong></p>
<p>&bull; <code>PRIMARY KEY</code> : identifiant unique de chaque ligne</p>
<p>&bull; <code>NOT NULL</code> : la colonne ne peut pas etre vide</p>
<p>&bull; <code>AUTO_INCREMENT</code> : la valeur augmente automatiquement</p>
<p>&bull; <code>DEFAULT</code> : valeur par defaut si non renseignee</p>

<p><strong>ALTER TABLE</strong> : modifier une table existante</p>
<div class="code-example"><span class="comment">-- Ajouter une colonne</span>
<span class="keyword">ALTER TABLE</span> etudiants <span class="keyword">ADD</span> telephone <span class="keyword">VARCHAR</span>(<span class="number">20</span>);

<span class="comment">-- Modifier une colonne</span>
<span class="keyword">ALTER TABLE</span> etudiants <span class="keyword">MODIFY</span> email <span class="keyword">VARCHAR</span>(<span class="number">500</span>);

<span class="comment">-- Supprimer une colonne</span>
<span class="keyword">ALTER TABLE</span> etudiants <span class="keyword">DROP COLUMN</span> bio;</div>

<p><strong>Cle etrangere (FOREIGN KEY)</strong> : lie une colonne a la cle primaire d'une autre table</p>
<div class="code-example"><span class="keyword">CREATE TABLE</span> inscriptions (
    id <span class="keyword">INT</span> <span class="keyword">PRIMARY KEY</span> <span class="keyword">AUTO_INCREMENT</span>,
    etudiant_id <span class="keyword">INT</span>,
    <span class="keyword">FOREIGN KEY</span> (etudiant_id) <span class="keyword">REFERENCES</span> etudiants(id)
);</div>

<div class="tip"><code>DROP TABLE etudiants;</code> supprime completement la table (structure + donnees). <code>TRUNCATE TABLE</code> supprime seulement les donnees mais garde la structure.</div>`
    }
];

// ========================
// QUESTIONS (50)
// ========================
const allQuestions = [
    // === CHAPITRE 1 : Introduction et SELECT de base (8) ===
    {
        chapter: 0,
        question: "Que signifie SQL ?",
        options: ["Structured Question Language", "Structured Query Language", "Simple Query Language", "Standard Query Logic"],
        answer: 1,
        explanation: "SQL signifie <code>Structured Query Language</code>, c'est-a-dire \"langage de requete structuree\". C'est le langage standard pour interagir avec les bases de donnees relationnelles."
    },
    {
        chapter: 0,
        question: "Quelle commande permet de selectionner <strong>toutes les colonnes</strong> d'une table ?",
        options: ["<code>SELECT ALL FROM etudiants;</code>", "<code>SELECT etudiants;</code>", "<code>SELECT * FROM etudiants;</code>", "<code>GET * FROM etudiants;</code>"],
        answer: 2,
        explanation: "<code>SELECT * FROM etudiants;</code> selectionne toutes les colonnes (<code>*</code>) de la table <code>etudiants</code>. L'etoile <code>*</code> est un raccourci pour \"toutes les colonnes\"."
    },
    {
        chapter: 0,
        question: "Quelle requete filtre les etudiants ayant exactement 20 ans ?",
        options: [
            "<code>SELECT * FROM etudiants WHERE age == 20;</code>",
            "<code>SELECT * FROM etudiants WHERE age = 20;</code>",
            "<code>SELECT * FROM etudiants IF age = 20;</code>",
            "<code>SELECT * FROM etudiants WHEN age = 20;</code>"
        ],
        answer: 1,
        explanation: "En SQL, on utilise <code>WHERE</code> pour filtrer et un seul <code>=</code> pour la comparaison (pas <code>==</code> comme en JavaScript). <code>IF</code> et <code>WHEN</code> ne sont pas utilises pour filtrer."
    },
    {
        chapter: 0,
        question: "Comment filtrer les etudiants dont la ville est Paris ?",
        options: [
            "<code>SELECT * FROM etudiants WHERE ville = Paris;</code>",
            "<code>SELECT * FROM etudiants WHERE ville = 'Paris';</code>",
            "<code>SELECT * FROM etudiants WHERE ville == \"Paris\";</code>",
            "<code>SELECT * FROM etudiants WHERE ville IS Paris;</code>"
        ],
        answer: 1,
        explanation: "En SQL, les valeurs textuelles doivent etre entourees de <strong>guillemets simples</strong> : <code>'Paris'</code>. Sans guillemets, SQL pense que <code>Paris</code> est un nom de colonne."
    },
    {
        chapter: 0,
        question: "Comment selectionner uniquement les colonnes <code>nom</code> et <code>age</code> ?",
        options: [
            "<code>SELECT nom AND age FROM etudiants;</code>",
            "<code>SELECT nom, age FROM etudiants;</code>",
            "<code>SELECT (nom, age) FROM etudiants;</code>",
            "<code>SELECT nom + age FROM etudiants;</code>"
        ],
        answer: 1,
        explanation: "On separe les colonnes par des <strong>virgules</strong> : <code>SELECT nom, age FROM etudiants;</code>. <code>AND</code> est reserve aux conditions dans <code>WHERE</code>."
    },
    {
        chapter: 0,
        question: "Quelle est la difference entre une <strong>table</strong> et une <strong>base de donnees</strong> ?",
        options: [
            "Ce sont des synonymes",
            "Une table contient plusieurs bases de donnees",
            "Une base de donnees contient plusieurs tables",
            "Une table est un type de colonne"
        ],
        answer: 2,
        explanation: "Une <strong>base de donnees</strong> est un conteneur qui peut stocker plusieurs <strong>tables</strong>. Chaque table contient des donnees organisees en lignes et colonnes."
    },
    {
        chapter: 0,
        question: "Dans une table SQL, qu'est-ce qu'une <strong>ligne</strong> (row) ?",
        options: [
            "Un type de donnee",
            "Un nom de colonne",
            "Un enregistrement complet (ex: un etudiant)",
            "Une commande SQL"
        ],
        answer: 2,
        explanation: "Une <strong>ligne</strong> (row) represente un enregistrement complet. Par exemple, dans une table <code>etudiants</code>, chaque ligne contient les informations d'un etudiant (nom, age, ville, etc.)."
    },
    {
        chapter: 0,
        question: "Quel symbole commence un commentaire en SQL ?",
        options: ["<code>//</code>", "<code>#</code>", "<code>--</code>", "<code>/* */</code>"],
        answer: 2,
        explanation: "En SQL, les commentaires sur une seule ligne commencent par <code>--</code> (deux tirets). <code>/* */</code> existe aussi pour les commentaires multi-lignes, mais <code>--</code> est le plus courant."
    },

    // === CHAPITRE 2 : Filtrer les donnees — WHERE avance (7) ===
    {
        chapter: 1,
        question: "Quelle requete selectionne les produits dont le prix est superieur a 10 <strong>ET</strong> inferieur a 50 ?",
        options: [
            "<code>SELECT * FROM produits WHERE prix > 10 OR prix < 50;</code>",
            "<code>SELECT * FROM produits WHERE prix > 10 AND prix < 50;</code>",
            "<code>SELECT * FROM produits WHERE prix > 10, prix < 50;</code>",
            "<code>SELECT * FROM produits WHERE prix > 10 + prix < 50;</code>"
        ],
        answer: 1,
        explanation: "<code>AND</code> exige que les deux conditions soient vraies en meme temps. <code>OR</code> donnerait presque tous les produits car l'une ou l'autre condition suffirait."
    },
    {
        chapter: 1,
        question: "Que fait la requete suivante ?<div class='code-block'>SELECT * FROM produits WHERE prix BETWEEN 10 AND 50;</div>",
        options: [
            "Selectionne les produits dont le prix est strictement entre 10 et 50",
            "Selectionne les produits dont le prix est entre 10 et 50, bornes incluses",
            "Selectionne les produits dont le prix est 10 ou 50",
            "Provoque une erreur"
        ],
        answer: 1,
        explanation: "<code>BETWEEN 10 AND 50</code> selectionne les valeurs de 10 a 50 <strong>bornes incluses</strong>. C'est equivalent a <code>prix >= 10 AND prix <= 50</code>."
    },
    {
        chapter: 1,
        question: "Quelle est la forme simplifiee de cette requete ?<div class='code-block'>SELECT * FROM produits\nWHERE categorie = 'fruit'\nOR categorie = 'legume'\nOR categorie = 'viande';</div>",
        options: [
            "<code>WHERE categorie = ('fruit', 'legume', 'viande')</code>",
            "<code>WHERE categorie IN ('fruit', 'legume', 'viande')</code>",
            "<code>WHERE categorie BETWEEN 'fruit' AND 'viande'</code>",
            "<code>WHERE categorie LIKE ('fruit', 'legume', 'viande')</code>"
        ],
        answer: 1,
        explanation: "<code>IN</code> permet de verifier si une valeur fait partie d'une liste. C'est equivalent a plusieurs <code>OR</code> mais beaucoup plus lisible."
    },
    {
        chapter: 1,
        question: "Que selectionne <code>WHERE nom LIKE 'A%'</code> ?",
        options: [
            "Les noms qui contiennent la lettre A",
            "Les noms qui commencent par A",
            "Les noms qui finissent par A",
            "Les noms qui sont exactement 'A%'"
        ],
        answer: 1,
        explanation: "<code>LIKE 'A%'</code> selectionne les noms qui <strong>commencent par A</strong>. Le <code>%</code> remplace zero ou plusieurs caracteres. Pour finir par A : <code>'%A'</code>. Pour contenir A : <code>'%A%'</code>."
    },
    {
        chapter: 1,
        question: "Que represente <code>_</code> (underscore) dans un <code>LIKE</code> ?",
        options: [
            "Zero ou plusieurs caracteres",
            "Exactement un seul caractere",
            "Un espace",
            "N'importe quel chiffre"
        ],
        answer: 1,
        explanation: "Dans <code>LIKE</code>, <code>_</code> remplace <strong>exactement un caractere</strong>. Exemple : <code>'_a%'</code> selectionne les mots dont la deuxieme lettre est 'a' (comme 'Paris', 'Rabat')."
    },
    {
        chapter: 1,
        question: "Comment selectionner les lignes ou la colonne <code>email</code> est vide (NULL) ?",
        options: [
            "<code>WHERE email = NULL</code>",
            "<code>WHERE email IS NULL</code>",
            "<code>WHERE email == NULL</code>",
            "<code>WHERE email LIKE NULL</code>"
        ],
        answer: 1,
        explanation: "En SQL, on ne peut pas comparer avec <code>= NULL</code>. Il faut utiliser <code>IS NULL</code>. De meme, pour les valeurs non nulles : <code>IS NOT NULL</code>."
    },
    {
        chapter: 1,
        question: "Que fait le mot-cle <code>NOT</code> dans une condition <code>WHERE</code> ?",
        options: [
            "Il supprime les lignes",
            "Il inverse la condition",
            "Il trie les resultats",
            "Il regroupe les lignes"
        ],
        answer: 1,
        explanation: "<code>NOT</code> inverse une condition. Exemple : <code>WHERE NOT categorie = 'fruit'</code> selectionne tout sauf les fruits. On peut aussi ecrire <code>NOT IN</code>, <code>NOT LIKE</code>, <code>NOT BETWEEN</code>."
    },

    // === CHAPITRE 3 : Trier et limiter — ORDER BY, LIMIT (6) ===
    {
        chapter: 2,
        question: "Par defaut, <code>ORDER BY</code> trie dans quel ordre ?",
        options: [
            "Decroissant (Z a A, 9 a 0)",
            "Aleatoire",
            "Croissant (A a Z, 0 a 9)",
            "Par date d'insertion"
        ],
        answer: 2,
        explanation: "Par defaut, <code>ORDER BY</code> trie en ordre <strong>croissant</strong> (<code>ASC</code>). Pour trier en ordre decroissant, il faut ajouter <code>DESC</code>."
    },
    {
        chapter: 2,
        question: "Quelle requete affiche les etudiants du plus age au plus jeune ?",
        options: [
            "<code>SELECT * FROM etudiants ORDER BY age ASC;</code>",
            "<code>SELECT * FROM etudiants ORDER BY age DESC;</code>",
            "<code>SELECT * FROM etudiants SORT BY age DESC;</code>",
            "<code>SELECT * FROM etudiants ORDER age DESC;</code>"
        ],
        answer: 1,
        explanation: "<code>ORDER BY age DESC</code> trie par age en ordre <strong>decroissant</strong> (du plus grand au plus petit). <code>DESC</code> signifie \"descending\" (descendant)."
    },
    {
        chapter: 2,
        question: "Comment limiter le resultat aux 3 premieres lignes ?",
        options: [
            "<code>SELECT * FROM etudiants TOP 3;</code>",
            "<code>SELECT * FROM etudiants LIMIT 3;</code>",
            "<code>SELECT * FROM etudiants FIRST 3;</code>",
            "<code>SELECT 3 FROM etudiants;</code>"
        ],
        answer: 1,
        explanation: "<code>LIMIT 3</code> limite le resultat aux 3 premieres lignes retournees. C'est tres utile avec <code>ORDER BY</code> pour obtenir, par exemple, les 3 meilleurs scores."
    },
    {
        chapter: 2,
        question: "Que fait <code>OFFSET 10</code> dans une requete avec <code>LIMIT</code> ?",
        options: [
            "Selectionne 10 lignes",
            "Trie a partir de la ligne 10",
            "Saute les 10 premieres lignes",
            "Ajoute 10 au resultat"
        ],
        answer: 2,
        explanation: "<code>OFFSET 10</code> saute les 10 premieres lignes avant d'appliquer le <code>LIMIT</code>. C'est ideal pour la <strong>pagination</strong> : page 1 = OFFSET 0, page 2 = OFFSET 10, etc."
    },
    {
        chapter: 2,
        question: "Que fait le mot-cle <code>AS</code> dans cette requete ?<div class='code-block'>SELECT nom AS prenom FROM etudiants;</div>",
        options: [
            "Il filtre les resultats",
            "Il renomme la colonne dans le resultat affiche",
            "Il modifie le nom de la colonne dans la table",
            "Il cree une nouvelle colonne dans la table"
        ],
        answer: 1,
        explanation: "<code>AS</code> cree un <strong>alias</strong> : il renomme la colonne uniquement dans le resultat affiche. La table elle-meme n'est pas modifiee. C'est purement cosm\u00e9tique."
    },
    {
        chapter: 2,
        question: "Que fait cette requete ?<div class='code-block'>SELECT * FROM etudiants\nORDER BY ville ASC, age DESC;</div>",
        options: [
            "Trie par ville decroissant puis par age croissant",
            "Trie par ville croissant puis par age decroissant",
            "Trie aleatoirement",
            "Provoque une erreur, on ne peut trier que sur une colonne"
        ],
        answer: 1,
        explanation: "On peut trier sur <strong>plusieurs colonnes</strong>. Ici, les resultats sont d'abord tries par ville (A-Z), puis pour une meme ville, par age (du plus vieux au plus jeune)."
    },

    // === CHAPITRE 4 : Fonctions d'agregation (7) ===
    {
        chapter: 3,
        question: "Quelle est la difference entre <code>COUNT(*)</code> et <code>COUNT(email)</code> ?",
        options: [
            "Aucune difference",
            "<code>COUNT(*)</code> compte toutes les lignes, <code>COUNT(email)</code> ignore les NULL",
            "<code>COUNT(*)</code> est plus lent",
            "<code>COUNT(email)</code> compte les emails en double"
        ],
        answer: 1,
        explanation: "<code>COUNT(*)</code> compte <strong>toutes</strong> les lignes, meme celles avec des valeurs NULL. <code>COUNT(email)</code> compte seulement les lignes ou la colonne <code>email</code> n'est <strong>pas NULL</strong>."
    },
    {
        chapter: 3,
        question: "Quelle fonction calcule la <strong>somme</strong> des valeurs d'une colonne ?",
        options: ["<code>TOTAL()</code>", "<code>ADD()</code>", "<code>SUM()</code>", "<code>COUNT()</code>"],
        answer: 2,
        explanation: "<code>SUM(colonne)</code> calcule la somme de toutes les valeurs d'une colonne numerique. Exemple : <code>SELECT SUM(prix) FROM commandes;</code> donne le total des prix."
    },
    {
        chapter: 3,
        question: "Quelle fonction donne la <strong>moyenne</strong> des valeurs ?",
        options: ["<code>MEAN()</code>", "<code>AVG()</code>", "<code>AVERAGE()</code>", "<code>MOY()</code>"],
        answer: 1,
        explanation: "<code>AVG()</code> (abbreviation de \"average\") calcule la moyenne. Exemple : <code>SELECT AVG(note) FROM examens;</code> donne la note moyenne."
    },
    {
        chapter: 3,
        question: "Comment obtenir le prix le plus bas et le plus haut en une seule requete ?",
        options: [
            "<code>SELECT MINMAX(prix) FROM produits;</code>",
            "<code>SELECT MIN(prix), MAX(prix) FROM produits;</code>",
            "<code>SELECT RANGE(prix) FROM produits;</code>",
            "<code>SELECT LOW(prix), HIGH(prix) FROM produits;</code>"
        ],
        answer: 1,
        explanation: "<code>MIN()</code> retourne la plus petite valeur et <code>MAX()</code> la plus grande. On peut les utiliser dans le meme <code>SELECT</code> en les separant par une virgule."
    },
    {
        chapter: 3,
        question: "A quoi sert <code>GROUP BY</code> ?",
        options: [
            "A trier les resultats",
            "A limiter le nombre de lignes",
            "A regrouper les lignes ayant les memes valeurs pour appliquer une agregation",
            "A joindre deux tables"
        ],
        answer: 2,
        explanation: "<code>GROUP BY</code> regroupe les lignes qui ont les memes valeurs dans une colonne. Cela permet d'appliquer des fonctions d'agregation par groupe. Ex: <code>COUNT(*)</code> par ville."
    },
    {
        chapter: 3,
        question: "Quelle est la difference entre <code>WHERE</code> et <code>HAVING</code> ?",
        options: [
            "Aucune difference",
            "<code>WHERE</code> filtre avant le regroupement, <code>HAVING</code> filtre apres",
            "<code>HAVING</code> filtre avant le regroupement, <code>WHERE</code> filtre apres",
            "<code>HAVING</code> remplace <code>WHERE</code> dans les nouvelles versions de SQL"
        ],
        answer: 1,
        explanation: "<code>WHERE</code> filtre les lignes <strong>avant</strong> le <code>GROUP BY</code>. <code>HAVING</code> filtre les groupes <strong>apres</strong> le regroupement. On utilise <code>HAVING</code> avec les fonctions d'agregation."
    },
    {
        chapter: 3,
        question: "Que retourne cette requete ?<div class='code-block'>SELECT ville, COUNT(*) AS total\nFROM etudiants\nGROUP BY ville;</div>",
        options: [
            "Le nombre total d'etudiants",
            "La liste de toutes les villes",
            "Le nombre d'etudiants par ville",
            "Une erreur car COUNT ne fonctionne pas avec GROUP BY"
        ],
        answer: 2,
        explanation: "Cette requete regroupe les etudiants par ville, puis <code>COUNT(*)</code> compte le nombre d'etudiants dans chaque groupe. Le resultat montre chaque ville avec son total."
    },

    // === CHAPITRE 5 : Les jointures — JOIN (8) ===
    {
        chapter: 4,
        question: "A quoi servent les jointures (<code>JOIN</code>) en SQL ?",
        options: [
            "A fusionner deux bases de donnees",
            "A combiner les donnees de plusieurs tables liees",
            "A dupliquer une table",
            "A trier les resultats"
        ],
        answer: 1,
        explanation: "Les <code>JOIN</code> permettent de <strong>combiner les donnees de plusieurs tables</strong> en utilisant une relation entre elles (generalement une cle etrangere liee a une cle primaire)."
    },
    {
        chapter: 4,
        question: "Que retourne un <code>INNER JOIN</code> ?",
        options: [
            "Toutes les lignes des deux tables",
            "Uniquement les lignes qui ont une correspondance dans les deux tables",
            "Toutes les lignes de la table de gauche",
            "Toutes les lignes de la table de droite"
        ],
        answer: 1,
        explanation: "<code>INNER JOIN</code> ne retourne que les lignes qui ont une <strong>correspondance dans les deux tables</strong>. Si un etudiant n'a pas de classe, il n'apparaitra pas dans le resultat."
    },
    {
        chapter: 4,
        question: "Que se passe-t-il avec un <code>LEFT JOIN</code> quand il n'y a pas de correspondance ?",
        options: [
            "La ligne est ignoree",
            "Une erreur est levee",
            "Les colonnes de la table de droite sont NULL",
            "Les colonnes de la table de gauche sont NULL"
        ],
        answer: 2,
        explanation: "<code>LEFT JOIN</code> garde <strong>toutes les lignes de la table de gauche</strong>. Si une ligne n'a pas de correspondance dans la table de droite, les colonnes de droite seront <code>NULL</code>."
    },
    {
        chapter: 4,
        question: "A quoi sert la clause <code>ON</code> dans un <code>JOIN</code> ?",
        options: [
            "A nommer la table jointe",
            "A definir la condition de liaison entre les deux tables",
            "A trier les resultats de la jointure",
            "A limiter le nombre de lignes jointes"
        ],
        answer: 1,
        explanation: "<code>ON</code> definit la <strong>condition de liaison</strong> entre les tables. Exemple : <code>ON etudiants.classe_id = classes.id</code> indique comment les tables sont reliees."
    },
    {
        chapter: 4,
        question: "Pourquoi utilise-t-on la notation <code>table.colonne</code> ?",
        options: [
            "C'est obligatoire dans toutes les requetes",
            "Pour eviter l'ambiguite quand deux tables ont une colonne du meme nom",
            "Pour accelerer la requete",
            "Pour creer un alias"
        ],
        answer: 1,
        explanation: "Quand deux tables ont une colonne du meme nom (ex: <code>id</code>), il faut preciser la table : <code>etudiants.id</code> ou <code>classes.id</code>. Sinon SQL ne sait pas laquelle choisir."
    },
    {
        chapter: 4,
        question: "Quelle est la difference entre <code>INNER JOIN</code> et <code>LEFT JOIN</code> ?",
        options: [
            "Aucune difference",
            "<code>INNER JOIN</code> est plus rapide",
            "<code>INNER JOIN</code> exclut les lignes sans correspondance, <code>LEFT JOIN</code> les garde",
            "<code>LEFT JOIN</code> trie les resultats a gauche"
        ],
        answer: 2,
        explanation: "<code>INNER JOIN</code> ne garde que les lignes avec correspondance. <code>LEFT JOIN</code> garde <strong>toutes les lignes de gauche</strong>, meme sans correspondance (avec NULL pour les colonnes de droite)."
    },
    {
        chapter: 4,
        question: "Que fait un <code>RIGHT JOIN</code> ?",
        options: [
            "Garde toutes les lignes de la table de gauche",
            "Garde toutes les lignes de la table de droite",
            "Garde toutes les lignes des deux tables",
            "Trie les resultats de droite a gauche"
        ],
        answer: 1,
        explanation: "<code>RIGHT JOIN</code> garde <strong>toutes les lignes de la table de droite</strong>, meme sans correspondance. C'est l'inverse du <code>LEFT JOIN</code>."
    },
    {
        chapter: 4,
        question: "Peut-on joindre plus de deux tables dans une seule requete ?",
        options: [
            "Non, maximum 2 tables",
            "Oui, en enchainant plusieurs JOIN",
            "Oui, mais seulement avec INNER JOIN",
            "Non, il faut faire plusieurs requetes"
        ],
        answer: 1,
        explanation: "On peut enchainer plusieurs <code>JOIN</code> pour combiner autant de tables que necessaire. Exemple : <code>FROM etudiants JOIN classes ON ... JOIN ecoles ON ...</code>"
    },

    // === CHAPITRE 6 : Modifier les donnees — INSERT, UPDATE, DELETE (7) ===
    {
        chapter: 5,
        question: "Quelle est la syntaxe correcte pour inserer une ligne ?",
        options: [
            "<code>INSERT etudiants VALUES ('Ahmed', 20);</code>",
            "<code>INSERT INTO etudiants VALUES ('Ahmed', 20);</code>",
            "<code>ADD INTO etudiants VALUES ('Ahmed', 20);</code>",
            "<code>INSERT INTO etudiants SET ('Ahmed', 20);</code>"
        ],
        answer: 1,
        explanation: "La syntaxe correcte est <code>INSERT INTO table VALUES (...);</code>. Le mot-cle <code>INTO</code> est obligatoire apres <code>INSERT</code>."
    },
    {
        chapter: 5,
        question: "Quelle est la difference entre ces deux INSERT ?<div class='code-block'>INSERT INTO etudiants VALUES (1, 'Sara', 22);\nINSERT INTO etudiants (nom, age) VALUES ('Sara', 22);</div>",
        options: [
            "Aucune difference",
            "Le premier specifie toutes les colonnes, le deuxieme seulement certaines",
            "Le deuxieme provoque une erreur",
            "Le premier est plus rapide"
        ],
        answer: 1,
        explanation: "Le premier INSERT doit fournir une valeur pour <strong>chaque colonne</strong> dans l'ordre. Le deuxieme specifie les colonnes et ne fournit que celles-la (les autres prennent leur valeur par defaut ou NULL)."
    },
    {
        chapter: 5,
        question: "Quelle est la syntaxe correcte pour modifier l'age d'Ahmed a 21 ?",
        options: [
            "<code>MODIFY etudiants SET age = 21 WHERE nom = 'Ahmed';</code>",
            "<code>UPDATE etudiants SET age = 21 WHERE nom = 'Ahmed';</code>",
            "<code>UPDATE etudiants age = 21 WHERE nom = 'Ahmed';</code>",
            "<code>CHANGE etudiants SET age = 21 WHERE nom = 'Ahmed';</code>"
        ],
        answer: 1,
        explanation: "La syntaxe correcte est <code>UPDATE table SET colonne = valeur WHERE condition;</code>. Le mot-cle <code>SET</code> est obligatoire pour indiquer les modifications."
    },
    {
        chapter: 5,
        question: "Quelle est la syntaxe correcte pour supprimer un etudiant ?",
        options: [
            "<code>REMOVE FROM etudiants WHERE id = 1;</code>",
            "<code>DELETE etudiants WHERE id = 1;</code>",
            "<code>DELETE FROM etudiants WHERE id = 1;</code>",
            "<code>DROP FROM etudiants WHERE id = 1;</code>"
        ],
        answer: 2,
        explanation: "La syntaxe correcte est <code>DELETE FROM table WHERE condition;</code>. <code>FROM</code> est obligatoire. <code>DROP</code> est utilise pour supprimer des tables, pas des lignes."
    },
    {
        chapter: 5,
        question: "Que se passe-t-il si on execute <code>UPDATE etudiants SET age = 20;</code> sans <code>WHERE</code> ?",
        options: [
            "Rien, la requete est ignoree",
            "Seule la premiere ligne est modifiee",
            "Une erreur est levee",
            "TOUTES les lignes sont modifiees : tous les ages deviennent 20"
        ],
        answer: 3,
        explanation: "Sans <code>WHERE</code>, l'<code>UPDATE</code> s'applique a <strong>toutes les lignes</strong> de la table ! C'est une erreur tres courante et dangereuse. Toujours verifier la clause <code>WHERE</code>."
    },
    {
        chapter: 5,
        question: "Quelle est la difference entre <code>DELETE FROM etudiants</code> et <code>TRUNCATE TABLE etudiants</code> ?",
        options: [
            "Aucune difference",
            "<code>DELETE</code> supprime ligne par ligne et peut etre annule, <code>TRUNCATE</code> vide tout d'un coup et remet le compteur a zero",
            "<code>TRUNCATE</code> est plus lent",
            "<code>DELETE</code> supprime aussi la structure de la table"
        ],
        answer: 1,
        explanation: "<code>DELETE</code> supprime ligne par ligne et peut etre annule (avec ROLLBACK). <code>TRUNCATE</code> vide la table d'un coup, c'est plus rapide et remet l'<code>AUTO_INCREMENT</code> a zero."
    },
    {
        chapter: 5,
        question: "Avec <code>AUTO_INCREMENT</code>, si on insere 3 lignes puis on en supprime une avec <code>DELETE</code>, quel sera le prochain ID ?",
        options: [
            "3 (reutilise l'ID supprime)",
            "4 (continue la sequence)",
            "1 (recommence a zero)",
            "Ca depend de la ligne supprimee"
        ],
        answer: 1,
        explanation: "Avec <code>DELETE</code>, l'<code>AUTO_INCREMENT</code> ne revient pas en arriere. Apres les ID 1, 2, 3, meme si on supprime l'ID 2, le prochain sera <strong>4</strong>. Seul <code>TRUNCATE</code> remet le compteur a zero."
    },

    // === CHAPITRE 7 : Creer et modifier les tables — CREATE, ALTER (7) ===
    {
        chapter: 6,
        question: "Quelle est la syntaxe de base pour creer une table ?",
        options: [
            "<code>NEW TABLE etudiants (nom VARCHAR(100));</code>",
            "<code>CREATE TABLE etudiants (nom VARCHAR(100));</code>",
            "<code>MAKE TABLE etudiants (nom VARCHAR(100));</code>",
            "<code>ADD TABLE etudiants (nom VARCHAR(100));</code>"
        ],
        answer: 1,
        explanation: "La syntaxe correcte est <code>CREATE TABLE nom_table (colonne type, ...);</code>. On definit chaque colonne avec son nom et son type entre parentheses."
    },
    {
        chapter: 6,
        question: "A quoi sert <code>PRIMARY KEY</code> ?",
        options: [
            "A rendre la colonne obligatoire",
            "A identifier de maniere unique chaque ligne de la table",
            "A trier la table automatiquement",
            "A creer un lien avec une autre table"
        ],
        answer: 1,
        explanation: "<code>PRIMARY KEY</code> definit la colonne qui <strong>identifie de maniere unique</strong> chaque ligne. Chaque valeur doit etre unique et non nulle. C'est generalement la colonne <code>id</code>."
    },
    {
        chapter: 6,
        question: "Quelle est la difference entre <code>VARCHAR(100)</code> et <code>TEXT</code> ?",
        options: [
            "Aucune difference",
            "<code>VARCHAR</code> a une longueur maximale definie, <code>TEXT</code> stocke du texte long sans limite pratique",
            "<code>TEXT</code> ne stocke que des chiffres",
            "<code>VARCHAR</code> est plus lent que <code>TEXT</code>"
        ],
        answer: 1,
        explanation: "<code>VARCHAR(100)</code> stocke du texte de <strong>100 caracteres maximum</strong>. <code>TEXT</code> stocke du texte long sans limite pratique. On utilise <code>VARCHAR</code> pour les champs courts (noms, emails) et <code>TEXT</code> pour les longs textes (descriptions, articles)."
    },
    {
        chapter: 6,
        question: "Que fait la contrainte <code>NOT NULL</code> ?",
        options: [
            "Elle met la valeur a zero",
            "Elle interdit les valeurs vides (NULL) dans cette colonne",
            "Elle supprime les valeurs NULL existantes",
            "Elle cree une valeur par defaut"
        ],
        answer: 1,
        explanation: "<code>NOT NULL</code> oblige a fournir une valeur pour cette colonne lors de l'insertion. Si on essaie d'inserer une ligne sans cette valeur, SQL levera une <strong>erreur</strong>."
    },
    {
        chapter: 6,
        question: "Que fait <code>AUTO_INCREMENT</code> sur une colonne ?",
        options: [
            "Elle double la valeur a chaque insertion",
            "Elle genere automatiquement un numero unique croissant a chaque insertion",
            "Elle incremente la valeur de toutes les lignes",
            "Elle ajoute 1 a la valeur inseree"
        ],
        answer: 1,
        explanation: "<code>AUTO_INCREMENT</code> genere automatiquement un <strong>numero unique</strong> pour chaque nouvelle ligne : 1, 2, 3, etc. On l'utilise generalement sur la colonne <code>id</code> (cle primaire)."
    },
    {
        chapter: 6,
        question: "Comment ajouter une colonne <code>telephone</code> a une table existante ?",
        options: [
            "<code>ADD COLUMN telephone VARCHAR(20) TO etudiants;</code>",
            "<code>ALTER TABLE etudiants ADD telephone VARCHAR(20);</code>",
            "<code>UPDATE TABLE etudiants ADD telephone VARCHAR(20);</code>",
            "<code>MODIFY TABLE etudiants ADD telephone VARCHAR(20);</code>"
        ],
        answer: 1,
        explanation: "<code>ALTER TABLE</code> permet de modifier la structure d'une table existante. <code>ADD</code> ajoute une nouvelle colonne. On peut aussi utiliser <code>MODIFY</code> pour changer le type ou <code>DROP COLUMN</code> pour supprimer."
    },
    {
        chapter: 6,
        question: "Quelle est la difference entre <code>DROP TABLE</code> et <code>TRUNCATE TABLE</code> ?",
        options: [
            "Aucune difference",
            "<code>DROP TABLE</code> supprime la table completement (structure + donnees), <code>TRUNCATE</code> vide les donnees mais garde la structure",
            "<code>TRUNCATE</code> supprime la table completement",
            "<code>DROP TABLE</code> ne supprime que les donnees"
        ],
        answer: 1,
        explanation: "<code>DROP TABLE</code> supprime <strong>completement</strong> la table (structure et donnees). <code>TRUNCATE TABLE</code> vide les donnees mais <strong>garde la structure</strong> (colonnes, types, contraintes) pour reutiliser la table."
    }
];

// ========================
// TIMER
// ========================
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

// ========================
// ENGINE
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
                qcm_name: 'qcm-sql',
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
    if (pct >= 80) { levelClass = 'level-excellent'; message = 'Excellent !'; detail = 'Vous maitrisez les bases de SQL.'; }
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
    if (weakPct < 60 && weakest) advice = `<p style="text-align:center;color:#00BCD4;margin-top:10px">A retravailler en priorite : <strong>${weakest}</strong></p>`;
    resultsDiv.innerHTML = `
        <div class="score-circle ${levelClass}">${pct}%<span class="label">${score}/${total}</span></div>
        <div class="level-message">${message}</div>
        <div class="level-detail">${detail}</div>
        ${catHtml}${advice}
        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Recommencer</button>
            <button class="btn btn-restart" onclick="retryFailed()" style="margin-left:10px">Retravailler mes erreurs</button>
            <button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">Accueil</button>
            <button class="btn btn-restart" onclick="location.href='/quiz/1'" style="margin-left:10px">Autres QCM</button>
        </div>`;

    // Delete progress (quiz completed)
    fetch('/api/progress', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({ qcm_name: 'qcm-sql', chapter_completed: -1, total_chapters: chapters.length })
    });

    fetch('/api/scores', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({
            qcm_name: 'qcm-sql',
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
    failed.forEach((f) => {
        const q = Object.assign({}, f.question);
        q.chapter = 0;
        allQuestions.push(q);
    });
    chapters.length = 0;
    chapters.push({title: 'Revision des erreurs', num: 1, lesson: '<p>Vous allez revoir les <strong>' + failed.length + ' questions</strong> que vous avez ratees.</p>'});
    startQuiz();
}

fetch('/api/progress/qcm-sql')
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
