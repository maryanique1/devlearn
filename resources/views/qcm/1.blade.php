@extends('layouts.app')
@section('title', 'QCM - Examen Pratique Dev Web')

@section('styles')
        * { box-sizing: border-box; margin: 0; padding: 0; }


        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
        }


        .container { overflow-wrap: break-word; max-width: 820px;
            max-width: 800px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            color: #896f3d;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Progress bar */
        .progress-bar {
            background: var(--bg-card);
            border-radius: 20px;
            height: 12px;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #896f3d, #1a293f);
            border-radius: 20px;
            transition: width 0.4s ease;
        }

        .progress-text {
            text-align: center;
            font-size: 14px;
            margin-bottom: 15px;
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
        }

        .cat-html { background: #e44d26; }
        .cat-css { background: #264de4; }
        .cat-javascript { background: #f0db4f; color: #333; }
        .cat-sql { background: #00758f; }
        .cat-php { background: #777bb4; }
        .cat-c\+\+ { background: #00599C; }

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

        .options li:hover {
            border-color: #896f3d;
            background: rgba(0,100,200,0.08);
        }

        .options li.selected {
            border-color: #896f3d;
            background: rgba(137,111,61,0.12);
        }

        .options li.correct {
            border-color: #27ae60;
            background: rgba(39,174,96,0.15);
        }

        .options li.wrong {
            border-color: #e74c3c;
            background: rgba(231,76,60,0.15);
        }

        .options li.disabled {
            cursor: default;
            opacity: 0.7;
        }

        .options li.disabled.correct {
            opacity: 1;
        }

        /* Explanation */
        .explanation {
            margin-top: 15px;
            padding: 15px;
            border-radius: 8px;
            background: var(--bg-code);
            border-left: 4px solid #896f3d;
            font-size: 14px;
            line-height: 1.6;
            display: none;
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

        .btn-primary {
            background: #896f3d;
            color: var(--text-main);
        }

        .btn-primary:hover { background: #6d5830; }

        .btn-primary:disabled {
            background: #555;
            cursor: not-allowed;
        }

        .btn-restart {
            background: var(--bg-input);
            color: var(--text-main);
        }

        .btn-restart:hover { background: #1a4a80; }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        /* Results */
        .results {
            display: none;
        }

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

        .score-circle .label {
            font-size: 14px;
            font-weight: normal;
        }

        .level-excellent { background: linear-gradient(135deg, #1a3e2a, #27ae60); color: #27ae60; }
        .level-good { background: linear-gradient(135deg, #1a3e3e, #2980b9); color: #2980b9; }
        .level-average { background: linear-gradient(135deg, #3e3a1a, #f39c12); color: #f39c12; }
        .level-weak { background: linear-gradient(135deg, #3e1a1a, #e74c3c); color: #e74c3c; }

        .level-message {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin: 15px 0;
        }

        .level-detail {
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        /* Category scores */
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

        .cat-score-card .cat-name {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .cat-score-card .cat-pct {
            font-size: 28px;
            font-weight: bold;
        }

        .cat-score-card .cat-detail {
            font-size: 12px;
            margin-top: 4px;
        }

        /* Start screen */
        .start-screen { overflow-wrap: break-word;
            text-align: center;
            padding: 40px 20px;
        }

        .start-screen p {
            margin: 15px 0;
            line-height: 1.6;
        }

        .tech-tags {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .tech-tags span {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
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
    <h1>QCM Dev Web</h1>
    <p class="subtitle">Examen pratique</p>

    <!-- Start screen -->
    <div id="start-screen" class="start-screen">
        <p>Testez vos connaissances sur les 6 technologies du developpement :</p>
        <div class="tech-tags">
            <span class="category-badge cat-html">HTML</span>
            <span class="category-badge cat-css">CSS</span>
            <span class="category-badge cat-javascript">JavaScript</span>
            <span class="category-badge cat-sql">SQL</span>
            <span class="category-badge cat-php">PHP</span>
            <span class="category-badge cat-c++">C++</span>
        </div>
        <p>36 questions &bull; Difficulte mixte &bull; Resultat detaille a la fin</p>
        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Commencer le QCM</button>
        </div>
    </div>

    <!-- Quiz area -->
    <div id="quiz-area" style="display:none">
        <div class="progress-text" id="progress-text"></div>
        <div class="progress-bar">
            <div class="progress-fill" id="progress-fill"></div>
        </div>
        <div class="timer" id="timer">00:00</div>

        <div class="question-card" id="question-card"></div>

        <div class="btn-container">
            <button class="btn btn-primary" id="btn-validate" onclick="validateAnswer()" disabled>Valider</button>
            <button class="btn btn-primary" id="btn-next" onclick="nextQuestion()" style="display:none">Suivant</button>
        </div>
    </div>

    <!-- Results -->
    <div id="results" class="results"></div>
</div>

<script>
const questions = [
    // === HTML (6) ===
    {
        category: "HTML",
        question: "Quelle balise HTML5 est utilisee pour definir une zone de navigation ?",
        options: ["<code>&lt;nav&gt;</code>", "<code>&lt;menu&gt;</code>", "<code>&lt;navigation&gt;</code>", "<code>&lt;header&gt;</code>"],
        answer: 0,
        explanation: "La balise <code>&lt;nav&gt;</code> est l'element semantique HTML5 dedie aux blocs de navigation principaux."
    },
    {
        category: "HTML",
        question: "Quel attribut rend un champ de formulaire obligatoire ?",
        options: ["<code>mandatory</code>", "<code>required</code>", "<code>validate</code>", "<code>necessary</code>"],
        answer: 1,
        explanation: "L'attribut <code>required</code> empeche l'envoi du formulaire si le champ est vide."
    },
    {
        category: "HTML",
        question: "Que produit ce code ?<div class='code-block'>&lt;input type=\"range\" min=\"0\" max=\"100\"&gt;</div>",
        options: ["Un champ texte", "Un curseur (slider)", "Une barre de progression", "Un champ numerique"],
        answer: 1,
        explanation: "<code>type=\"range\"</code> affiche un curseur que l'utilisateur peut faire glisser entre min et max."
    },
    {
        category: "HTML",
        question: "Quelle est la difference entre <code>&lt;div&gt;</code> et <code>&lt;section&gt;</code> ?",
        options: [
            "<code>&lt;section&gt;</code> est semantique, <code>&lt;div&gt;</code> ne l'est pas",
            "Aucune difference",
            "<code>&lt;div&gt;</code> est plus recent",
            "<code>&lt;section&gt;</code> est inline"
        ],
        answer: 0,
        explanation: "<code>&lt;section&gt;</code> represente un regroupement thematique de contenu, alors que <code>&lt;div&gt;</code> est un conteneur generique sans signification semantique."
    },
    {
        category: "HTML",
        question: "Quel element HTML permet d'integrer une video ?",
        options: ["<code>&lt;media&gt;</code>", "<code>&lt;movie&gt;</code>", "<code>&lt;video&gt;</code>", "<code>&lt;embed&gt;</code>"],
        answer: 2,
        explanation: "La balise <code>&lt;video&gt;</code> est l'element standard HTML5 pour integrer des videos avec controles natifs."
    },
    {
        category: "HTML",
        question: "Que fait l'attribut <code>action</code> dans un <code>&lt;form&gt;</code> ?",
        options: [
            "Definit la methode HTTP",
            "Definit l'URL ou les donnees sont envoyees",
            "Definit le type d'encodage",
            "Definit le nom du formulaire"
        ],
        answer: 1,
        explanation: "L'attribut <code>action</code> specifie l'URL du script serveur qui recevra les donnees du formulaire."
    },

    // === CSS (6) ===
    {
        category: "CSS",
        question: "Quelle propriete CSS permet de creer une grille responsive ?",
        options: ["<code>display: flex</code>", "<code>display: grid</code>", "<code>display: table</code>", "<code>display: block</code>"],
        answer: 1,
        explanation: "<code>display: grid</code> active CSS Grid, le systeme de mise en page bidimensionnel ideal pour les layouts responsives."
    },
    {
        category: "CSS",
        question: "Que fait <code>position: sticky</code> ?",
        options: [
            "L'element reste fixe en permanence",
            "L'element est relatif puis devient fixe au scroll",
            "L'element est retire du flux",
            "L'element est centre dans la page"
        ],
        answer: 1,
        explanation: "<code>sticky</code> garde l'element dans le flux normal puis le colle a une position donnee quand on scrolle."
    },
    {
        category: "CSS",
        question: "Quel selecteur cible le 3eme enfant d'un parent ?",
        options: ["<code>:child(3)</code>", "<code>:nth-child(3)</code>", "<code>:eq(3)</code>", "<code>:index(3)</code>"],
        answer: 1,
        explanation: "<code>:nth-child(3)</code> est la pseudo-classe qui selectionne le 3eme enfant d'un element parent."
    },
    {
        category: "CSS",
        question: "Quelle est la valeur par defaut de <code>flex-direction</code> ?",
        options: ["<code>column</code>", "<code>row</code>", "<code>inline</code>", "<code>wrap</code>"],
        answer: 1,
        explanation: "Par defaut, <code>flex-direction</code> vaut <code>row</code>, les elements flex s'alignent horizontalement."
    },
    {
        category: "CSS",
        question: "Que fait <code>box-sizing: border-box</code> ?",
        options: [
            "Le padding et la bordure sont inclus dans la largeur",
            "La marge est incluse dans la largeur",
            "La bordure est supprimee",
            "Le contenu deborde de la boite"
        ],
        answer: 0,
        explanation: "Avec <code>border-box</code>, la largeur totale inclut le padding et la bordure, ce qui simplifie les calculs de layout."
    },
    {
        category: "CSS",
        question: "Quelle unite est relative a la taille de la police du parent ?",
        options: ["<code>rem</code>", "<code>px</code>", "<code>em</code>", "<code>vh</code>"],
        answer: 2,
        explanation: "<code>em</code> est relatif a la taille de police de l'element parent. <code>rem</code> est relatif a la racine (<code>html</code>)."
    },

    // === JavaScript (6) ===
    {
        category: "JavaScript",
        question: "Quel est le resultat de :<div class='code-block'>console.log(typeof null)</div>",
        options: ["<code>\"null\"</code>", "<code>\"undefined\"</code>", "<code>\"object\"</code>", "<code>\"boolean\"</code>"],
        answer: 2,
        explanation: "C'est un bug historique de JavaScript : <code>typeof null</code> retourne <code>\"object\"</code> au lieu de <code>\"null\"</code>."
    },
    {
        category: "JavaScript",
        question: "Que fait <code>Array.filter()</code> ?",
        options: [
            "Transforme chaque element",
            "Retourne les elements qui passent un test",
            "Reduit le tableau a une valeur",
            "Trie le tableau"
        ],
        answer: 1,
        explanation: "<code>filter()</code> cree un nouveau tableau contenant uniquement les elements pour lesquels la fonction de callback retourne <code>true</code>."
    },
    {
        category: "JavaScript",
        question: "Quelle est la difference entre <code>let</code> et <code>var</code> ?",
        options: [
            "<code>let</code> a une portee de bloc, <code>var</code> une portee de fonction",
            "Aucune difference",
            "<code>var</code> est plus recent",
            "<code>let</code> ne peut pas etre reassigne"
        ],
        answer: 0,
        explanation: "<code>let</code> (ES6) est limite au bloc <code>{}</code> ou il est declare, alors que <code>var</code> remonte a la portee de la fonction entiere (hoisting)."
    },
    {
        category: "JavaScript",
        question: "Que retourne ce code ?<div class='code-block'>\"5\" + 3</div>",
        options: ["<code>8</code>", "<code>\"53\"</code>", "<code>NaN</code>", "<code>\"8\"</code>"],
        answer: 1,
        explanation: "L'operateur <code>+</code> avec une chaine fait une concatenation. <code>\"5\" + 3</code> donne la chaine <code>\"53\"</code>."
    },
    {
        category: "JavaScript",
        question: "Quelle methode selectionne un element par son ID dans le DOM ?",
        options: [
            "<code>document.querySelector(\"#id\")</code>",
            "<code>document.getElementById(\"id\")</code>",
            "Les deux sont correctes",
            "<code>document.getElement(\"id\")</code>"
        ],
        answer: 2,
        explanation: "<code>getElementById</code> et <code>querySelector(\"#id\")</code> fonctionnent tous les deux pour selectionner un element par son ID."
    },
    {
        category: "JavaScript",
        question: "Que fait <code>event.preventDefault()</code> ?",
        options: [
            "Arrete la propagation de l'evenement",
            "Empeche le comportement par defaut du navigateur",
            "Supprime l'evenement",
            "Desactive l'element"
        ],
        answer: 1,
        explanation: "<code>preventDefault()</code> empeche l'action par defaut (ex: empecher un lien de naviguer ou un formulaire de s'envoyer)."
    },

    // === SQL (6) ===
    {
        category: "SQL",
        question: "Quelle requete compte le nombre de lignes dans une table <code>users</code> ?",
        options: [
            "<code>SELECT COUNT(*) FROM users</code>",
            "<code>SELECT SUM(*) FROM users</code>",
            "<code>SELECT TOTAL(*) FROM users</code>",
            "<code>SELECT NB(*) FROM users</code>"
        ],
        answer: 0,
        explanation: "<code>COUNT(*)</code> est la fonction d'agregation qui compte le nombre total de lignes."
    },
    {
        category: "SQL",
        question: "Quelle clause est utilisee pour filtrer les resultats d'un <code>GROUP BY</code> ?",
        options: ["<code>WHERE</code>", "<code>HAVING</code>", "<code>FILTER</code>", "<code>LIMIT</code>"],
        answer: 1,
        explanation: "<code>HAVING</code> filtre apres le regroupement, alors que <code>WHERE</code> filtre avant."
    },
    {
        category: "SQL",
        question: "Quelle est la difference entre <code>INNER JOIN</code> et <code>LEFT JOIN</code> ?",
        options: [
            "<code>LEFT JOIN</code> garde toutes les lignes de la table de gauche",
            "Aucune difference",
            "<code>INNER JOIN</code> garde toutes les lignes",
            "<code>LEFT JOIN</code> est plus rapide"
        ],
        answer: 0,
        explanation: "<code>LEFT JOIN</code> retourne toutes les lignes de la table de gauche, avec <code>NULL</code> si pas de correspondance a droite. <code>INNER JOIN</code> ne garde que les correspondances."
    },
    {
        category: "SQL",
        question: "Quelle commande ajoute une colonne <code>email</code> a une table existante ?",
        options: [
            "<code>ALTER TABLE users ADD email VARCHAR(255)</code>",
            "<code>UPDATE TABLE users ADD email VARCHAR(255)</code>",
            "<code>MODIFY TABLE users ADD email VARCHAR(255)</code>",
            "<code>INSERT COLUMN email INTO users</code>"
        ],
        answer: 0,
        explanation: "<code>ALTER TABLE ... ADD</code> est la commande DDL pour ajouter une colonne a une table existante."
    },
    {
        category: "SQL",
        question: "Que fait <code>DELETE FROM produits WHERE prix &lt; 10</code> ?",
        options: [
            "Supprime la table produits",
            "Supprime les produits dont le prix est inferieur a 10",
            "Met le prix a 0",
            "Supprime la colonne prix"
        ],
        answer: 1,
        explanation: "<code>DELETE FROM</code> avec <code>WHERE</code> supprime uniquement les lignes qui correspondent a la condition."
    },
    {
        category: "SQL",
        question: "Quelle contrainte empeche les valeurs en double dans une colonne ?",
        options: ["<code>NOT NULL</code>", "<code>PRIMARY KEY</code>", "<code>UNIQUE</code>", "<code>CHECK</code>"],
        answer: 2,
        explanation: "<code>UNIQUE</code> interdit les doublons. <code>PRIMARY KEY</code> est aussi unique mais il ne peut y en avoir qu'une par table."
    },

    // === PHP (6) ===
    {
        category: "PHP",
        question: "Quelle superglobale contient les donnees envoyees par un formulaire en methode POST ?",
        options: ["<code>$_GET</code>", "<code>$_POST</code>", "<code>$_REQUEST</code>", "<code>$_FORM</code>"],
        answer: 1,
        explanation: "<code>$_POST</code> est le tableau associatif qui contient les donnees envoyees via la methode HTTP POST."
    },
    {
        category: "PHP",
        question: "Que fait <code>mysqli_real_escape_string()</code> ?",
        options: [
            "Chiffre une chaine",
            "Echappe les caracteres speciaux pour eviter les injections SQL",
            "Convertit en majuscules",
            "Supprime les espaces"
        ],
        answer: 1,
        explanation: "Cette fonction echappe les caracteres speciaux d'une chaine pour une utilisation sure dans une requete SQL. Les requetes preparees sont toutefois preferables."
    },
    {
        category: "PHP",
        question: "Que retourne <code>isset($var)</code> si <code>$var = null</code> ?",
        options: ["<code>true</code>", "<code>false</code>", "<code>null</code>", "Une erreur"],
        answer: 1,
        explanation: "<code>isset()</code> retourne <code>false</code> si la variable vaut <code>null</code> ou n'est pas definie."
    },
    {
        category: "PHP",
        question: "Quelle fonction redirige vers une autre page en PHP ?",
        options: [
            "<code>redirect(\"page.php\")</code>",
            "<code>header(\"Location: page.php\")</code>",
            "<code>goto(\"page.php\")</code>",
            "<code>navigate(\"page.php\")</code>"
        ],
        answer: 1,
        explanation: "<code>header(\"Location: ...\")</code> envoie un en-tete HTTP de redirection. Il doit etre appele avant tout echo/HTML."
    },
    {
        category: "PHP",
        question: "Que fait ce code ?<div class='code-block'>$arr = [3, 1, 4, 1, 5];\narray_unique($arr);</div>",
        options: [
            "Trie le tableau",
            "Supprime les doublons",
            "Inverse le tableau",
            "Compte les elements"
        ],
        answer: 1,
        explanation: "<code>array_unique()</code> retourne un nouveau tableau sans les valeurs en double. Ici, le second <code>1</code> est supprime."
    },
    {
        category: "PHP",
        question: "Quelle est la bonne syntaxe pour inclure un fichier obligatoire en PHP ?",
        options: [
            "<code>include 'fichier.php'</code>",
            "<code>require 'fichier.php'</code>",
            "<code>import 'fichier.php'</code>",
            "<code>load 'fichier.php'</code>"
        ],
        answer: 1,
        explanation: "<code>require</code> inclut un fichier et arrete le script en cas d'erreur. <code>include</code> ne produit qu'un avertissement."
    },
    // === C++ (6) ===
    {
        category: "C++",
        question: "Que fait <code>#include &lt;iostream&gt;</code> en C++ ?",
        options: ["Inclut la bibliotheque mathematique", "Inclut la bibliotheque d'entrees/sorties", "Inclut la bibliotheque de fichiers", "Inclut la bibliotheque reseau"],
        answer: 1,
        explanation: "<code>&lt;iostream&gt;</code> est la bibliotheque standard C++ pour les entrees/sorties console : <code>cout</code>, <code>cin</code>, <code>cerr</code>."
    },
    {
        category: "C++",
        question: "Quelle est la bonne signature de la fonction principale en C++ ?",
        options: ["<code>void main()</code>", "<code>int main()</code>", "<code>function main()</code>", "<code>def main():</code>"],
        answer: 1,
        explanation: "En C++, la fonction principale est <code>int main()</code>. Elle retourne un entier (0 = succes). <code>void main()</code> n'est pas conforme au standard."
    },
    {
        category: "C++",
        question: "Que fait <code>cout &lt;&lt; \"Hello\";</code> ?",
        options: ["Lit une entree utilisateur", "Affiche Hello dans la console", "Ecrit Hello dans un fichier", "Compare deux chaines"],
        answer: 1,
        explanation: "<code>cout</code> (character output) envoie du texte vers la sortie standard (console). L'operateur <code>&lt;&lt;</code> est l'operateur d'insertion."
    },
    {
        category: "C++",
        question: "Quelle est la difference entre <code>int* p</code> et <code>int& r</code> ?",
        options: ["Aucune difference", "p est un pointeur, r est une reference", "p est une reference, r est un pointeur", "Les deux sont des pointeurs"],
        answer: 1,
        explanation: "<code>int* p</code> declare un pointeur (adresse memoire). <code>int& r</code> declare une reference (alias direct vers une variable). Un pointeur peut etre <code>nullptr</code>, pas une reference."
    },
    {
        category: "C++",
        question: "Que fait <code>new int[10]</code> en C++ ?",
        options: ["Cree un tableau de 10 elements sur la pile", "Alloue dynamiquement un tableau de 10 entiers sur le tas", "Initialise 10 variables entieres", "Cree une liste chainee de 10 elements"],
        answer: 1,
        explanation: "<code>new int[10]</code> alloue un tableau de 10 entiers sur le tas (heap). La memoire doit etre liberee avec <code>delete[]</code>."
    },
    {
        category: "C++",
        question: "Quel mot-cle est utilise pour definir une classe en C++ ?",
        options: ["<code>struct</code>", "<code>object</code>", "<code>class</code>", "<code>type</code>"],
        answer: 2,
        explanation: "Le mot-cle <code>class</code> definit une classe en C++. <code>struct</code> est similaire mais ses membres sont publics par defaut."
    }
];

let currentQuestion = 0;
let score = 0;
let selectedOption = -1;
let answered = false;
let shuffledQuestions = [];
let answers = [];

// Timer
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

function shuffle(arr) {
    const a = [...arr];
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

function startQuiz() {
    shuffledQuestions = shuffle(questions);
    currentQuestion = 0;
    score = 0;
    answers = [];
    document.getElementById('start-screen').style.display = 'none';
    document.getElementById('quiz-area').style.display = 'block';
    document.getElementById('results').style.display = 'none';
    showQuestion();
    startTimer();
}

function showQuestion() {
    selectedOption = -1;
    answered = false;
    const q = shuffledQuestions[currentQuestion];
    const total = shuffledQuestions.length;

    document.getElementById('progress-text').textContent = `Question ${currentQuestion + 1} / ${total}`;
    document.getElementById('progress-fill').style.width = ((currentQuestion + 1) / total * 100) + '%';

    document.getElementById('btn-validate').style.display = 'inline-block';
    document.getElementById('btn-validate').disabled = true;
    document.getElementById('btn-next').style.display = 'none';

    const catClass = 'cat-' + q.category.toLowerCase();

    let html = `<span class="category-badge ${catClass}">${q.category}</span>`;
    html += `<div class="question-text">${q.question}</div>`;
    html += '<ul class="options">';
    q.options.forEach((opt, i) => {
        html += `<li onclick="selectOption(${i})" id="opt-${i}">${opt}</li>`;
    });
    html += '</ul>';
    html += `<div class="explanation" id="explanation">${q.explanation}</div>`;

    document.getElementById('question-card').innerHTML = html;
}

function selectOption(i) {
    if (answered) return;
    selectedOption = i;
    document.getElementById('btn-validate').disabled = false;
    const opts = document.querySelectorAll('.options li');
    opts.forEach((el, idx) => {
        el.classList.toggle('selected', idx === i);
    });
}

function validateAnswer() {
    if (selectedOption === -1 || answered) return;
    answered = true;

    const q = shuffledQuestions[currentQuestion];
    const correct = q.answer;
    const isCorrect = selectedOption === correct;

    if (isCorrect) score++;
    answers.push({ question: q, selected: selectedOption, correct: isCorrect });

    const opts = document.querySelectorAll('.options li');
    opts.forEach((el, idx) => {
        el.classList.add('disabled');
        if (idx === correct) el.classList.add('correct');
        if (idx === selectedOption && !isCorrect) el.classList.add('wrong');
    });

    document.getElementById('explanation').style.display = 'block';
    document.getElementById('btn-validate').style.display = 'none';

    if (currentQuestion < shuffledQuestions.length - 1) {
        document.getElementById('btn-next').style.display = 'inline-block';
    } else {
        setTimeout(showResults, 800);
    }
}

function nextQuestion() {
    currentQuestion++;
    showQuestion();
}

function showResults() {
    stopTimer();
    document.getElementById('quiz-area').style.display = 'none';
    const resultsDiv = document.getElementById('results');
    resultsDiv.style.display = 'block';

    const total = shuffledQuestions.length;
    const pct = Math.round(score / total * 100);

    let level, levelClass, message, detail;
    if (pct >= 80) {
        level = 'Excellent';
        levelClass = 'level-excellent';
        message = 'Excellent ! Vous maitrisez bien le developpement web.';
        detail = 'Vous avez une solide base dans les technologies web. Continuez a pratiquer pour atteindre un niveau expert.';
    } else if (pct >= 60) {
        level = 'Bien';
        levelClass = 'level-good';
        message = 'Bon niveau ! Quelques points a approfondir.';
        detail = 'Vous avez de bonnes bases. Revoyez les questions manquees pour combler vos lacunes.';
    } else if (pct >= 40) {
        level = 'Moyen';
        levelClass = 'level-average';
        message = 'Niveau moyen. Il y a du travail a faire.';
        detail = 'Les fondamentaux ne sont pas encore solides. Concentrez-vous sur les categories ou vous avez le plus de difficultes.';
    } else {
        level = 'A renforcer';
        levelClass = 'level-weak';
        message = 'Niveau debutant. Ne vous decouragez pas !';
        detail = 'Il faut reprendre les bases de chaque technologie. Pratiquez regulierement avec des exercices simples.';
    }

    // Category breakdown
    const cats = ['HTML', 'CSS', 'JavaScript', 'SQL', 'PHP', 'C++'];
    const catStats = {};
    cats.forEach(c => catStats[c] = { total: 0, correct: 0 });
    answers.forEach(a => {
        catStats[a.question.category].total++;
        if (a.correct) catStats[a.question.category].correct++;
    });

    let catHtml = '<div class="cat-scores">';
    cats.forEach(c => {
        const s = catStats[c];
        const p = s.total > 0 ? Math.round(s.correct / s.total * 100) : 0;
        let color = '#e74c3c';
        if (p >= 80) color = '#27ae60';
        else if (p >= 60) color = '#2980b9';
        else if (p >= 40) color = '#f39c12';
        const catClass = 'cat-' + c.toLowerCase();
        catHtml += `
            <div class="cat-score-card">
                <div class="cat-name"><span class="category-badge ${catClass}">${c}</span></div>
                <div class="cat-pct" style="color:${color}">${p}%</div>
                <div class="cat-detail">${s.correct}/${s.total} correct${s.correct > 1 ? 's' : ''}</div>
            </div>`;
    });
    catHtml += '</div>';

    // Weakest category advice
    let weakest = null;
    let weakPct = 101;
    cats.forEach(c => {
        const s = catStats[c];
        const p = s.total > 0 ? (s.correct / s.total * 100) : 0;
        if (p < weakPct) { weakPct = p; weakest = c; }
    });

    let advice = '';
    if (weakPct < 60 && weakest) {
        advice = `<p style="text-align:center;color:#896f3d;margin-top:10px">Point faible : <strong>${weakest}</strong> — concentrez vos revisions sur cette technologie.</p>`;
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

    fetch('/api/scores', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({
            qcm_name: 'qcm1',
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
    shuffledQuestions = failed.map(f => Object.assign({}, f.question));
    currentQuestion = 0;
    score = 0;
    answers = [];
    document.getElementById('start-screen').style.display = 'none';
    document.getElementById('quiz-area').style.display = 'block';
    document.getElementById('results').style.display = 'none';
    showQuestion();
    startTimer();
}
</script>

@endsection
