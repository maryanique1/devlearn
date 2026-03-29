@extends('layouts.app')
@section('title', 'QCM 2 - Examen Pratique Dev Web')

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
    <h1>QCM Dev Web - Serie 2</h1>
    <p class="subtitle">Examen pratique</p>

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

    <div id="results" class="results"></div>
</div>

<script>
const questions = [
    // === HTML (6) ===
    {
        category: "HTML",
        question: "Quel est le role de la balise <code>&lt;meta charset=\"UTF-8\"&gt;</code> ?",
        options: [
            "Definir la langue de la page",
            "Definir l'encodage des caracteres",
            "Definir le titre de la page",
            "Definir le style de la page"
        ],
        answer: 1,
        explanation: "<code>charset=\"UTF-8\"</code> indique au navigateur quel encodage utiliser pour afficher correctement les caracteres (accents, symboles, etc.)."
    },
    {
        category: "HTML",
        question: "Quelle balise cree un lien hypertexte ?",
        options: ["<code>&lt;link&gt;</code>", "<code>&lt;href&gt;</code>", "<code>&lt;a&gt;</code>", "<code>&lt;url&gt;</code>"],
        answer: 2,
        explanation: "La balise <code>&lt;a href=\"...\"&gt;</code> (ancre) est l'element HTML pour creer des liens hypertextes cliquables."
    },
    {
        category: "HTML",
        question: "Que fait l'attribut <code>placeholder</code> sur un <code>&lt;input&gt;</code> ?",
        options: [
            "Definit la valeur par defaut envoyee au serveur",
            "Affiche un texte indicatif qui disparait a la saisie",
            "Rend le champ obligatoire",
            "Definit le type du champ"
        ],
        answer: 1,
        explanation: "<code>placeholder</code> affiche un texte d'aide grise dans le champ. Il disparait des que l'utilisateur commence a taper. Ce n'est pas une valeur envoyee au serveur."
    },
    {
        category: "HTML",
        question: "Quelle est la difference entre <code>&lt;ol&gt;</code> et <code>&lt;ul&gt;</code> ?",
        options: [
            "<code>&lt;ol&gt;</code> est une liste ordonnee (numerotee), <code>&lt;ul&gt;</code> est non ordonnee (puces)",
            "<code>&lt;ul&gt;</code> est ordonnee, <code>&lt;ol&gt;</code> ne l'est pas",
            "Aucune difference",
            "<code>&lt;ol&gt;</code> n'accepte que du texte"
        ],
        answer: 0,
        explanation: "<code>&lt;ol&gt;</code> (ordered list) affiche une liste numerotee. <code>&lt;ul&gt;</code> (unordered list) affiche une liste a puces."
    },
    {
        category: "HTML",
        question: "Que fait l'attribut <code>target=\"_blank\"</code> sur un lien ?",
        options: [
            "Ouvre le lien dans le meme onglet",
            "Ouvre le lien dans un nouvel onglet",
            "Desactive le lien",
            "Ouvre le lien dans un iframe"
        ],
        answer: 1,
        explanation: "<code>target=\"_blank\"</code> indique au navigateur d'ouvrir le lien dans un nouvel onglet ou une nouvelle fenetre."
    },
    {
        category: "HTML",
        question: "Quelle balise est utilisee pour un retour a la ligne sans creer de paragraphe ?",
        options: ["<code>&lt;br&gt;</code>", "<code>&lt;hr&gt;</code>", "<code>&lt;newline&gt;</code>", "<code>&lt;lb&gt;</code>"],
        answer: 0,
        explanation: "<code>&lt;br&gt;</code> (break) insere un saut de ligne. <code>&lt;hr&gt;</code> cree une ligne horizontale de separation."
    },

    // === CSS (6) ===
    {
        category: "CSS",
        question: "Comment centrer horizontalement un <code>&lt;div&gt;</code> avec une largeur fixe ?",
        options: [
            "<code>text-align: center</code>",
            "<code>margin: 0 auto</code>",
            "<code>float: center</code>",
            "<code>align: center</code>"
        ],
        answer: 1,
        explanation: "<code>margin: 0 auto</code> distribue automatiquement les marges gauche et droite, centrant ainsi un element bloc ayant une largeur definie."
    },
    {
        category: "CSS",
        question: "Quelle propriete controle l'espace entre les lettres d'un texte ?",
        options: ["<code>word-spacing</code>", "<code>text-indent</code>", "<code>letter-spacing</code>", "<code>line-height</code>"],
        answer: 2,
        explanation: "<code>letter-spacing</code> ajuste l'espacement entre chaque caractere. <code>word-spacing</code> ajuste l'espace entre les mots."
    },
    {
        category: "CSS",
        question: "Quel est l'ordre de priorite correct en CSS (du plus faible au plus fort) ?",
        options: [
            "inline > id > classe > element",
            "element > classe > id > inline",
            "classe > element > id > inline",
            "id > classe > element > inline"
        ],
        answer: 1,
        explanation: "La specificite CSS va du plus faible au plus fort : selecteur d'element (1), classe (10), id (100), style inline (1000)."
    },
    {
        category: "CSS",
        question: "Que fait <code>overflow: hidden</code> ?",
        options: [
            "Affiche une barre de defilement",
            "Masque le contenu qui depasse de l'element",
            "Agrandit l'element pour tout afficher",
            "Empeche le redimensionnement"
        ],
        answer: 1,
        explanation: "<code>overflow: hidden</code> coupe et masque tout contenu qui deborde des dimensions de l'element."
    },
    {
        category: "CSS",
        question: "Quelle propriete permet d'arrondir les coins d'un element ?",
        options: ["<code>corner-radius</code>", "<code>border-radius</code>", "<code>edge-radius</code>", "<code>round-corner</code>"],
        answer: 1,
        explanation: "<code>border-radius</code> definit le rayon de courbure des coins. Ex: <code>border-radius: 10px</code> pour des coins arrondis."
    },
    {
        category: "CSS",
        question: "Que fait <code>opacity: 0.5</code> ?",
        options: [
            "L'element est invisible",
            "L'element est semi-transparent (50%)",
            "L'element est completement opaque",
            "L'element est supprime du flux"
        ],
        answer: 1,
        explanation: "<code>opacity</code> va de 0 (invisible) a 1 (opaque). 0.5 rend l'element et ses enfants semi-transparents a 50%."
    },

    // === JavaScript (6) ===
    {
        category: "JavaScript",
        question: "Que retourne ce code ?<div class='code-block'>[1, 2, 3].map(x => x * 2)</div>",
        options: ["<code>[1, 2, 3]</code>", "<code>[2, 4, 6]</code>", "<code>6</code>", "<code>[1, 4, 9]</code>"],
        answer: 1,
        explanation: "<code>map()</code> applique la fonction a chaque element et retourne un nouveau tableau. Chaque valeur est multipliee par 2."
    },
    {
        category: "JavaScript",
        question: "Quelle est la difference entre <code>==</code> et <code>===</code> ?",
        options: [
            "<code>===</code> compare la valeur ET le type, <code>==</code> ne compare que la valeur",
            "Aucune difference",
            "<code>==</code> est plus strict",
            "<code>===</code> ne fonctionne qu'avec les nombres"
        ],
        answer: 0,
        explanation: "<code>==</code> fait une comparaison avec conversion de type (\"5\" == 5 est true). <code>===</code> exige le meme type ET la meme valeur (\"5\" === 5 est false)."
    },
    {
        category: "JavaScript",
        question: "Que fait <code>JSON.parse()</code> ?",
        options: [
            "Convertit un objet en chaine JSON",
            "Convertit une chaine JSON en objet JavaScript",
            "Valide une chaine JSON",
            "Compresse une chaine JSON"
        ],
        answer: 1,
        explanation: "<code>JSON.parse()</code> transforme une chaine JSON en objet JavaScript. L'inverse est <code>JSON.stringify()</code>."
    },
    {
        category: "JavaScript",
        question: "Que retourne ce code ?<div class='code-block'>Boolean(\"\")</div>",
        options: ["<code>true</code>", "<code>false</code>", "<code>undefined</code>", "<code>\"false\"</code>"],
        answer: 1,
        explanation: "Une chaine vide <code>\"\"</code> est une valeur falsy en JavaScript. <code>Boolean(\"\")</code> retourne donc <code>false</code>."
    },
    {
        category: "JavaScript",
        question: "Comment ajouter un element a la fin d'un tableau ?",
        options: [
            "<code>arr.push(element)</code>",
            "<code>arr.add(element)</code>",
            "<code>arr.append(element)</code>",
            "<code>arr.insert(element)</code>"
        ],
        answer: 0,
        explanation: "<code>push()</code> ajoute un ou plusieurs elements a la fin du tableau et retourne la nouvelle longueur."
    },
    {
        category: "JavaScript",
        question: "Que fait <code>setTimeout(fn, 1000)</code> ?",
        options: [
            "Execute fn toutes les secondes",
            "Execute fn une seule fois apres 1 seconde",
            "Attend 1 seconde puis bloque le script",
            "Execute fn immediatement"
        ],
        answer: 1,
        explanation: "<code>setTimeout</code> execute la fonction une seule fois apres le delai specifie (en ms). Pour une execution repetee, on utilise <code>setInterval</code>."
    },

    // === SQL (6) ===
    {
        category: "SQL",
        question: "Quelle requete selectionne les produits dont le prix est entre 10 et 50 ?",
        options: [
            "<code>SELECT * FROM produits WHERE prix BETWEEN 10 AND 50</code>",
            "<code>SELECT * FROM produits WHERE prix IN (10, 50)</code>",
            "<code>SELECT * FROM produits WHERE prix >= 10 OR prix <= 50</code>",
            "<code>SELECT * FROM produits WHERE prix RANGE 10 TO 50</code>"
        ],
        answer: 0,
        explanation: "<code>BETWEEN 10 AND 50</code> selectionne les valeurs comprises entre 10 et 50 inclus. <code>IN</code> verifie l'appartenance a une liste de valeurs precises."
    },
    {
        category: "SQL",
        question: "Que fait <code>ORDER BY nom DESC</code> ?",
        options: [
            "Trie par nom dans l'ordre alphabetique (A-Z)",
            "Trie par nom dans l'ordre inverse (Z-A)",
            "Groupe les resultats par nom",
            "Filtre les resultats par nom"
        ],
        answer: 1,
        explanation: "<code>DESC</code> (descending) trie en ordre decroissant. <code>ASC</code> (ascending, par defaut) trie en ordre croissant."
    },
    {
        category: "SQL",
        question: "Quelle est la difference entre <code>DROP TABLE</code> et <code>TRUNCATE TABLE</code> ?",
        options: [
            "<code>DROP</code> supprime la table entiere, <code>TRUNCATE</code> vide les donnees mais garde la structure",
            "Aucune difference",
            "<code>TRUNCATE</code> supprime la table entiere",
            "<code>DROP</code> ne supprime que les donnees"
        ],
        answer: 0,
        explanation: "<code>DROP TABLE</code> supprime la table et sa structure definitivement. <code>TRUNCATE TABLE</code> vide toutes les lignes mais conserve la structure de la table."
    },
    {
        category: "SQL",
        question: "Que fait la clause <code>LIKE '%dev%'</code> ?",
        options: [
            "Cherche exactement le mot 'dev'",
            "Cherche les valeurs qui contiennent 'dev' n'importe ou",
            "Cherche les valeurs qui commencent par 'dev'",
            "Cherche les valeurs qui se terminent par 'dev'"
        ],
        answer: 1,
        explanation: "Le symbole <code>%</code> remplace n'importe quelle sequence de caracteres. <code>'%dev%'</code> trouve 'dev' n'importe ou dans la chaine."
    },
    {
        category: "SQL",
        question: "Que retourne <code>SELECT DISTINCT ville FROM clients</code> ?",
        options: [
            "Toutes les villes, y compris les doublons",
            "Les villes uniques (sans doublons)",
            "Le nombre de villes differentes",
            "La premiere ville trouvee"
        ],
        answer: 1,
        explanation: "<code>DISTINCT</code> elimine les lignes en double dans le resultat. Chaque ville n'apparaitra qu'une seule fois."
    },
    {
        category: "SQL",
        question: "Quelle fonction retourne la valeur maximale d'une colonne ?",
        options: ["<code>GREATEST()</code>", "<code>TOP()</code>", "<code>MAX()</code>", "<code>HIGHEST()</code>"],
        answer: 2,
        explanation: "<code>MAX()</code> est la fonction d'agregation qui retourne la valeur la plus elevee d'une colonne. Son inverse est <code>MIN()</code>."
    },

    // === PHP (6) ===
    {
        category: "PHP",
        question: "Que fait <code>explode(',', 'a,b,c')</code> en PHP ?",
        options: [
            "Retourne <code>'a,b,c'</code>",
            "Retourne <code>['a', 'b', 'c']</code>",
            "Retourne <code>'abc'</code>",
            "Retourne <code>3</code>"
        ],
        answer: 1,
        explanation: "<code>explode()</code> decoupe une chaine en tableau en utilisant le separateur specifie. L'inverse est <code>implode()</code>."
    },
    {
        category: "PHP",
        question: "Quelle est la difference entre <code>echo</code> et <code>return</code> ?",
        options: [
            "<code>echo</code> affiche du contenu, <code>return</code> renvoie une valeur a l'appelant",
            "Aucune difference",
            "<code>return</code> affiche du contenu",
            "<code>echo</code> arrete le script"
        ],
        answer: 0,
        explanation: "<code>echo</code> envoie du texte vers la sortie (navigateur). <code>return</code> met fin a une fonction et renvoie une valeur au code qui l'a appelee."
    },
    {
        category: "PHP",
        question: "Que fait <code>empty($var)</code> si <code>$var = 0</code> ?",
        options: ["<code>false</code>", "<code>true</code>", "Une erreur", "<code>null</code>"],
        answer: 1,
        explanation: "<code>empty()</code> retourne <code>true</code> pour : <code>\"\"</code>, <code>0</code>, <code>\"0\"</code>, <code>null</code>, <code>false</code>, <code>[]</code> et les variables non definies."
    },
    {
        category: "PHP",
        question: "Comment demarrer une session en PHP ?",
        options: [
            "<code>session_start()</code>",
            "<code>start_session()</code>",
            "<code>$_SESSION = new Session()</code>",
            "<code>session_init()</code>"
        ],
        answer: 0,
        explanation: "<code>session_start()</code> demarre ou reprend une session. Elle doit etre appelee avant tout envoi de contenu HTML."
    },
    {
        category: "PHP",
        question: "Que fait ce code ?<div class='code-block'>$a = \"Hello\";\n$b = &$a;\n$b = \"World\";\necho $a;</div>",
        options: [
            "Affiche <code>Hello</code>",
            "Affiche <code>World</code>",
            "Affiche <code>HelloWorld</code>",
            "Provoque une erreur"
        ],
        answer: 1,
        explanation: "<code>&$a</code> cree une reference : <code>$b</code> pointe vers la meme zone memoire que <code>$a</code>. Modifier <code>$b</code> modifie aussi <code>$a</code>."
    },
    {
        category: "PHP",
        question: "Quelle fonction compte le nombre d'elements dans un tableau ?",
        options: [
            "<code>length($arr)</code>",
            "<code>size($arr)</code>",
            "<code>count($arr)</code>",
            "<code>total($arr)</code>"
        ],
        answer: 2,
        explanation: "<code>count()</code> retourne le nombre d'elements d'un tableau. On peut aussi utiliser <code>sizeof()</code> qui est un alias."
    },
    // === C++ (6) ===
    {
        category: "C++",
        question: "Quel est le resultat de ce code ?<div class='code-block'>int x = 5;\ncout &lt;&lt; x++;</div>",
        options: ["6", "5", "Erreur de compilation", "0"],
        answer: 1,
        explanation: "<code>x++</code> est un post-increment : la valeur actuelle (5) est utilisee par <code>cout</code>, puis x est incremente a 6."
    },
    {
        category: "C++",
        question: "Quelle boucle garantit au moins une execution en C++ ?",
        options: ["<code>for</code>", "<code>while</code>", "<code>do...while</code>", "<code>foreach</code>"],
        answer: 2,
        explanation: "La boucle <code>do...while</code> execute le bloc une premiere fois, puis verifie la condition. Elle garantit au moins une iteration."
    },
    {
        category: "C++",
        question: "Que fait le mot-cle <code>virtual</code> sur une methode de classe ?",
        options: ["Rend la methode privee", "Permet le polymorphisme (redefinition dans les classes filles)", "Empeche l'heritage", "Rend la methode statique"],
        answer: 1,
        explanation: "<code>virtual</code> permet la liaison dynamique : une classe derivee peut redefinir la methode, et la bonne version est appelee selon le type reel de l'objet."
    },
    {
        category: "C++",
        question: "Qu'est-ce que <code>std::vector</code> par rapport a un tableau C ?",
        options: ["Un alias pour les tableaux C", "Un tableau dynamique redimensionnable", "Un tableau fixe plus rapide", "Un type de pointeur"],
        answer: 1,
        explanation: "<code>std::vector</code> est un conteneur de la STL qui gere un tableau dynamique. Il se redimensionne automatiquement avec <code>push_back()</code>, contrairement aux tableaux C."
    },
    {
        category: "C++",
        question: "Que signifie <code>const</code> apres la declaration d'une methode ?<div class='code-block'>int getValue() const;</div>",
        options: ["La methode retourne une constante", "La methode ne modifie pas l'objet", "La methode ne peut pas etre appelee", "La methode est statique"],
        answer: 1,
        explanation: "Le <code>const</code> apres une methode garantit qu'elle ne modifie aucun attribut de l'objet. Elle peut etre appelee sur des objets constants."
    },
    {
        category: "C++",
        question: "Qu'est-ce qu'un constructeur en C++ ?",
        options: ["Une fonction qui detruit un objet", "Une methode speciale appelee a la creation d'un objet, portant le nom de la classe", "Un operateur pour allouer de la memoire", "Une fonction template"],
        answer: 1,
        explanation: "Le constructeur est une methode speciale portant le meme nom que la classe. Il est appele automatiquement lors de la creation d'un objet pour l'initialiser."
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
            <button class="btn btn-restart" onclick="location.href='/quiz/1'" style="margin-left:10px">QCM Serie 1</button>
            <button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">Accueil</button>
        </div>
    `;

    fetch('/api/scores', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify({
            qcm_name: 'qcm2',
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
