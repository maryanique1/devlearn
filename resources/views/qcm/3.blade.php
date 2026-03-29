@extends('layouts.app')
@section('title', 'QCM Avance — Serie 3')

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

        .options li:hover { border-color: #896f3d; background: rgba(0,100,200,0.08); }
        .options li.selected { border-color: #896f3d; background: rgba(137,111,61,0.12); }
        .options li.correct { border-color: #27ae60; background: rgba(39,174,96,0.15); }
        .options li.wrong { border-color: #e74c3c; background: rgba(231,76,60,0.15); }
        .options li.disabled { cursor: default; opacity: 0.7; }
        .options li.disabled.correct { opacity: 1; }

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

        .btn-primary { background: #896f3d; color: #fff; }
        .btn-primary:hover { background: #6d5830; }
        .btn-primary:disabled { background: #555; cursor: not-allowed; }
        .btn-restart { background: var(--bg-input); color: var(--text-main); border: 1px solid var(--border-subtle); }
        .btn-restart:hover { background: #1a4a80; }

        .btn-container { text-align: center; margin-top: 20px; }

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

        .cat-score-card .cat-name { font-size: 13px; font-weight: bold; text-transform: uppercase; margin-bottom: 8px; }
        .cat-score-card .cat-pct { font-size: 28px; font-weight: bold; }
        .cat-score-card .cat-detail { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

        .start-screen { overflow-wrap: break-word; text-align: center; padding: 40px 20px; }
        .start-screen p { color: var(--text-muted); margin: 15px 0; line-height: 1.6; }

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
    <h1>QCM Avance — Serie 3</h1>
    <p class="subtitle">Niveau intermediaire a avance</p>

    <div id="start-screen" class="start-screen">
        <p>Testez vos connaissances avancees sur les 6 technologies :</p>
        <div class="tech-tags">
            <span class="category-badge cat-c++">C++</span>
            <span class="category-badge cat-html">HTML</span>
            <span class="category-badge cat-css">CSS</span>
            <span class="category-badge cat-javascript">JavaScript</span>
            <span class="category-badge cat-sql">SQL</span>
            <span class="category-badge cat-php">PHP</span>
        </div>
        <p>36 questions &bull; Intermediaire a Avance &bull; Resultat detaille a la fin</p>
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
    // === C++ (6) ===
    {
        category: "C++",
        question: "Quel est le resultat de ce code ?<div class='code-block'>int a = 5;\nint b = a++;\ncout &lt;&lt; b;</div>",
        options: ["6", "5", "4", "Erreur de compilation"],
        answer: 1,
        explanation: "<code>a++</code> est un post-increment : il retourne la valeur actuelle de <code>a</code> (5) puis l'incremente. Donc <code>b</code> recoit 5."
    },
    {
        category: "C++",
        question: "Que se passe-t-il si on utilise <code>delete</code> au lieu de <code>delete[]</code> sur un tableau alloue avec <code>new[]</code> ?",
        options: ["Seul le premier element est libere", "Comportement indefini (undefined behavior)", "Le programme plante immediatement", "Aucune difference, les deux fonctionnent"],
        answer: 1,
        explanation: "Utiliser <code>delete</code> au lieu de <code>delete[]</code> sur un tableau est un <strong>undefined behavior</strong>. Seul le destructeur du premier element est appele, la memoire peut ne pas etre correctement liberee."
    },
    {
        category: "C++",
        question: "Que fait <code>std::move()</code> en C++ ?",
        options: ["Deplace physiquement un objet en memoire", "Convertit en rvalue reference pour activer la semantique de deplacement", "Copie un objet dans un autre emplacement", "Supprime l'objet original apres copie"],
        answer: 1,
        explanation: "<code>std::move()</code> est un cast vers une rvalue reference (<code>T&&</code>). Il ne deplace rien lui-meme, mais permet d'appeler le constructeur de deplacement au lieu de la copie, evitant des allocations couteuses."
    },
    {
        category: "C++",
        question: "Quelle est la difference entre <code>const int*</code> et <code>int* const</code> ?",
        options: ["Aucune difference", "<code>const int*</code> = pointeur vers int constant ; <code>int* const</code> = pointeur constant vers int", "<code>const int*</code> = pointeur constant ; <code>int* const</code> = int constant", "Les deux empechent toute modification"],
        answer: 1,
        explanation: "<code>const int* p</code> : on ne peut pas modifier la valeur pointee via <code>p</code>. <code>int* const p</code> : on ne peut pas modifier l'adresse stockee dans <code>p</code>, mais on peut modifier la valeur pointee."
    },
    {
        category: "C++",
        question: "Pourquoi un destructeur doit-il etre <code>virtual</code> dans une classe de base polymorphe ?",
        options: ["Pour empecher la creation d'objets", "Pour que le destructeur de la classe derivee soit appele lors d'un <code>delete</code> via pointeur de base", "Pour rendre la classe abstraite", "Pour optimiser la liberation memoire"],
        answer: 1,
        explanation: "Sans destructeur <code>virtual</code>, un <code>delete basePtr</code> n'appelle que le destructeur de la classe de base, causant une fuite de memoire si la classe derivee alloue des ressources."
    },
    {
        category: "C++",
        question: "Qu'est-ce que le principe RAII en C++ ?",
        options: ["Un pattern de conception pour les interfaces graphiques", "L'acquisition de ressources se fait a l'initialisation, la liberation dans le destructeur", "Un algorithme de tri optimise", "Une methode de gestion des exceptions"],
        answer: 1,
        explanation: "<strong>RAII</strong> (Resource Acquisition Is Initialization) lie la duree de vie d'une ressource a celle d'un objet. Le constructeur acquiert, le destructeur libere. C'est le fondement des smart pointers (<code>unique_ptr</code>, <code>shared_ptr</code>)."
    },
    // === HTML (6) ===
    {
        category: "HTML",
        question: "Quelle est la difference entre <code>&lt;script defer&gt;</code> et <code>&lt;script async&gt;</code> ?",
        options: ["Aucune difference", "<code>defer</code> execute apres le parsing dans l'ordre ; <code>async</code> execute des le telechargement termine", "<code>async</code> bloque le parsing, pas <code>defer</code>", "<code>defer</code> ne fonctionne que sur les modules"],
        answer: 1,
        explanation: "<code>defer</code> telecharge en parallele et execute apres le parsing complet, en respectant l'ordre des scripts. <code>async</code> telecharge en parallele et execute immediatement quand pret, sans garantie d'ordre."
    },
    {
        category: "HTML",
        question: "A quoi sert l'attribut <code>srcset</code> sur une balise <code>&lt;img&gt;</code> ?",
        options: ["Definir une image de remplacement en cas d'erreur", "Fournir plusieurs sources d'images pour le responsive", "Animer l'image entre plusieurs sources", "Charger l'image en lazy loading"],
        answer: 1,
        explanation: "<code>srcset</code> permet au navigateur de choisir la meilleure image selon la largeur du viewport ou la densite de pixels (<code>1x</code>, <code>2x</code>). Combine avec <code>sizes</code>, c'est essentiel pour le responsive."
    },
    {
        category: "HTML",
        question: "Qu'est-ce que le Shadow DOM ?",
        options: ["Un DOM cache utilise par le navigateur pour le rendu", "Un arbre DOM encapsule avec des styles isoles, base des Web Components", "Le DOM apres execution du JavaScript", "Un DOM virtuel utilise par React"],
        answer: 1,
        explanation: "Le <strong>Shadow DOM</strong> permet d'attacher un arbre DOM encapsule a un element. Les styles a l'interieur n'affectent pas le document principal et vice-versa. C'est la base des Web Components."
    },
    {
        category: "HTML",
        question: "Que permettent les attributs <code>data-*</code> en HTML ?",
        options: ["Envoyer des donnees au serveur automatiquement", "Stocker des donnees personnalisees accessibles via <code>element.dataset</code> en JS", "Definir des variables CSS", "Creer des liens vers des bases de donnees"],
        answer: 1,
        explanation: "Les attributs <code>data-*</code> stockent des donnees personnalisees dans le HTML. En JS : <code>element.dataset.nomAttribut</code>. Exemple : <code>data-user-id=\"42\"</code> donne <code>el.dataset.userId</code>."
    },
    {
        category: "HTML",
        question: "Quelle est la difference entre <code>&lt;article&gt;</code> et <code>&lt;section&gt;</code> ?",
        options: ["Aucune difference semantique", "<code>&lt;article&gt;</code> est un contenu autonome ; <code>&lt;section&gt;</code> est un regroupement thematique", "<code>&lt;section&gt;</code> est pour le texte, <code>&lt;article&gt;</code> pour les images", "<code>&lt;article&gt;</code> ne peut pas contenir de <code>&lt;section&gt;</code>"],
        answer: 1,
        explanation: "<code>&lt;article&gt;</code> represente un contenu independant redistribuable (article de blog, commentaire). <code>&lt;section&gt;</code> est un regroupement thematique generique au sein d'un document."
    },
    {
        category: "HTML",
        question: "Que fait <code>contenteditable=\"true\"</code> sur un element ?",
        options: ["Rend l'element draggable", "Permet a l'utilisateur de modifier le contenu directement dans le navigateur", "Active l'autocompletion", "Empeche la selection du texte"],
        answer: 1,
        explanation: "<code>contenteditable</code> rend n'importe quel element HTML editable par l'utilisateur. Combine avec l'API Input Events, il permet de creer des editeurs de texte riches."
    },
    // === CSS (6) ===
    {
        category: "CSS",
        question: "Pourquoi <code>z-index</code> ne fonctionne-t-il pas sur un element ?",
        options: ["L'element n'a pas de <code>display: block</code>", "L'element a <code>position: static</code> (valeur par defaut)", "L'element n'a pas de <code>width</code> defini", "L'element est dans un flexbox"],
        answer: 1,
        explanation: "<code>z-index</code> ne fonctionne que sur les elements positionnes (<code>relative</code>, <code>absolute</code>, <code>fixed</code>, <code>sticky</code>). Un element en <code>position: static</code> ignore <code>z-index</code>."
    },
    {
        category: "CSS",
        question: "Quelle est la difference entre <code>:nth-child(2n)</code> et <code>:nth-of-type(2n)</code> ?",
        options: ["Aucune difference", "<code>:nth-child</code> compte tous les enfants ; <code>:nth-of-type</code> ne compte que le meme type de balise", "<code>:nth-of-type</code> est plus rapide", "<code>:nth-child</code> ne fonctionne qu'avec les <code>&lt;li&gt;</code>"],
        answer: 1,
        explanation: "<code>:nth-child(2n)</code> selectionne chaque 2e enfant parmi <strong>tous</strong> les freres. <code>:nth-of-type(2n)</code> selectionne chaque 2e enfant du <strong>meme type de balise</strong>. Crucial quand le parent contient des elements mixtes."
    },
    {
        category: "CSS",
        question: "Que fait <code>clamp(1rem, 2.5vw, 3rem)</code> ?",
        options: ["Fixe la valeur a exactement 2.5vw", "Definit une valeur responsive entre un minimum (1rem) et un maximum (3rem)", "Cree une animation entre les trois valeurs", "Applique les trois valeurs selon le breakpoint"],
        answer: 1,
        explanation: "<code>clamp(min, preferred, max)</code> retourne la valeur preferee (2.5vw) tant qu'elle reste entre min (1rem) et max (3rem). Ideal pour la typographie responsive sans media queries."
    },
    {
        category: "CSS",
        question: "Quel est l'ordre de specificite CSS (du plus fort au plus faible) ?",
        options: ["Element > Classe > ID > Inline", "Inline > ID > Classe/Attribut > Element", "ID > Inline > Classe > Element", "Classe > ID > Element > Inline"],
        answer: 1,
        explanation: "L'ordre : <strong>inline</strong> (1000) > <strong>ID</strong> (100) > <strong>classe/attribut/pseudo-classe</strong> (10) > <strong>element/pseudo-element</strong> (1). <code>!important</code> surpasse tout."
    },
    {
        category: "CSS",
        question: "Qu'est-ce qu'un stacking context en CSS ?",
        options: ["L'ordre de chargement des fichiers CSS", "Un contexte d'empilement ou les <code>z-index</code> ne sont compares qu'entre elements du meme contexte", "La facon dont les blocs sont empiles verticalement", "Un bug de rendu navigateur"],
        answer: 1,
        explanation: "Un <strong>stacking context</strong> est cree par certaines proprietes (<code>position</code> + <code>z-index</code>, <code>opacity &lt; 1</code>, <code>transform</code>). Les <code>z-index</code> ne sont compares qu'au sein du meme contexte."
    },
    {
        category: "CSS",
        question: "Que fait la propriete <code>will-change</code> ?",
        options: ["Detecte les changements dans le DOM", "Indique au navigateur qu'une propriete va changer pour optimiser le rendu", "Force le recalcul du layout", "Empeche les transitions sur un element"],
        answer: 1,
        explanation: "<code>will-change: transform</code> informe le navigateur qu'un element sera anime, lui permettant de creer un layer GPU a l'avance. A utiliser avec parcimonie car cela consomme de la memoire."
    },
    // === JavaScript (6) ===
    {
        category: "JavaScript",
        question: "Quel est le resultat de <code>typeof null</code> ?",
        options: ["<code>\"null\"</code>", "<code>\"undefined\"</code>", "<code>\"object\"</code>", "<code>\"boolean\"</code>"],
        answer: 2,
        explanation: "<code>typeof null</code> retourne <code>\"object\"</code>. C'est un bug historique de JavaScript datant de sa premiere implementation, jamais corrige pour des raisons de retrocompatibilite."
    },
    {
        category: "JavaScript",
        question: "Que retourne <code>Promise.allSettled()</code> ?",
        options: ["La premiere promesse resolue", "Un tableau des resultats de toutes les promesses, resolues ou rejetees", "La premiere promesse terminee", "Une erreur si une promesse est rejetee"],
        answer: 1,
        explanation: "<code>Promise.allSettled()</code> attend que toutes les promesses soient terminees et retourne un tableau d'objets <code>{status, value/reason}</code>. Contrairement a <code>Promise.all()</code>, elle ne rejette jamais."
    },
    {
        category: "JavaScript",
        question: "Qu'est-ce que la delegation d'evenements ?",
        options: ["Passer un evenement d'un parent a un enfant", "Attacher un ecouteur sur un parent et utiliser le bubbling pour gerer les enfants", "Creer un evenement personnalise", "Empecher la propagation des evenements"],
        answer: 1,
        explanation: "La delegation exploite le <strong>bubbling</strong> : un seul listener au parent, puis <code>event.target</code> identifie l'enfant clique. Plus performant que d'attacher un listener a chaque enfant, surtout pour les listes dynamiques."
    },
    {
        category: "JavaScript",
        question: "Qu'est-ce qu'une closure en JavaScript ?",
        options: ["Une fonction qui se ferme apres execution", "Une fonction qui capture et conserve l'acces aux variables de sa portee englobante", "Un bloc <code>try...catch</code>", "Une methode pour fermer une connexion"],
        answer: 1,
        explanation: "Une <strong>closure</strong> est une fonction qui \"se souvient\" des variables de la portee dans laquelle elle a ete creee, meme apres que cette portee a fini. Fondamental pour les callbacks, modules et l'encapsulation."
    },
    {
        category: "JavaScript",
        question: "Que fait <code>Object.freeze()</code> ?",
        options: ["Supprime toutes les proprietes", "Empeche l'ajout, la suppression et la modification des proprietes (gel superficiel)", "Rend l'objet immutable en profondeur", "Convertit l'objet en constante"],
        answer: 1,
        explanation: "<code>Object.freeze()</code> rend un objet immutable au premier niveau. C'est un <strong>shallow freeze</strong> : les objets imbriques restent modifiables. Pour un deep freeze, il faut une fonction recursive."
    },
    {
        category: "JavaScript",
        question: "Quel est le resultat de ce code ?<div class='code-block'>console.log(1 + '2' + 3);</div>",
        options: ["<code>6</code>", "<code>\"123\"</code>", "<code>\"33\"</code>", "<code>NaN</code>"],
        answer: 1,
        explanation: "<code>1 + '2'</code> donne <code>\"12\"</code> (coercion en string). Puis <code>\"12\" + 3</code> donne <code>\"123\"</code>. La presence d'un string declenche la concatenation pour les operations suivantes."
    },
    // === SQL (6) ===
    {
        category: "SQL",
        question: "Quelle est la difference entre <code>WHERE</code> et <code>HAVING</code> ?",
        options: ["Aucune, ce sont des alias", "<code>WHERE</code> filtre avant le <code>GROUP BY</code> ; <code>HAVING</code> filtre apres le regroupement", "<code>HAVING</code> est plus rapide", "<code>WHERE</code> ne fonctionne qu'avec les nombres"],
        answer: 1,
        explanation: "<code>WHERE</code> filtre les lignes <strong>avant</strong> le regroupement. <code>HAVING</code> filtre les groupes <strong>apres</strong> le <code>GROUP BY</code>. On utilise <code>HAVING</code> avec les fonctions d'agregation (<code>COUNT</code>, <code>SUM</code>, etc.)."
    },
    {
        category: "SQL",
        question: "Qu'est-ce qu'une auto-jointure (self-join) ?",
        options: ["Une jointure automatique faite par le SGBD", "Une table jointe avec elle-meme en utilisant des alias", "Une jointure entre deux tables de meme structure", "Une jointure sans condition ON"],
        answer: 1,
        explanation: "Un self-join joint une table avec elle-meme via des alias. Exemple classique : <code>SELECT e.nom, m.nom AS manager FROM employes e JOIN employes m ON e.manager_id = m.id</code>."
    },
    {
        category: "SQL",
        question: "Que retourne <code>COALESCE(NULL, NULL, 'defaut', 'autre')</code> ?",
        options: ["<code>NULL</code>", "<code>'defaut'</code>", "<code>'autre'</code>", "Erreur"],
        answer: 1,
        explanation: "<code>COALESCE()</code> retourne la premiere valeur non-NULL de la liste. Les deux premiers sont NULL, donc elle retourne <code>'defaut'</code>."
    },
    {
        category: "SQL",
        question: "Qu'est-ce qu'une sous-requete correlee ?",
        options: ["Une sous-requete qui s'execute une seule fois", "Une sous-requete qui reference la requete externe et s'execute pour chaque ligne", "Une sous-requete dans le <code>FROM</code>", "Une sous-requete qui retourne plusieurs colonnes"],
        answer: 1,
        explanation: "Une sous-requete correlee reference la requete parente et est re-executee pour <strong>chaque ligne</strong>. Exemple : <code>WHERE prix > (SELECT AVG(prix) FROM produits WHERE categorie = p.categorie)</code>."
    },
    {
        category: "SQL",
        question: "Que fait un <code>INDEX</code> en SQL ?",
        options: ["Trie definitivement les donnees", "Cree une structure pour accelerer les recherches sur des colonnes specifiques", "Empeche les doublons", "Compte les lignes"],
        answer: 1,
        explanation: "Un <code>INDEX</code> cree une structure (generalement B-tree) qui accelere les <code>SELECT</code>/<code>WHERE</code>. Contrepartie : les <code>INSERT</code>/<code>UPDATE</code> sont plus lents car l'index doit etre mis a jour."
    },
    {
        category: "SQL",
        question: "Quelle est la difference entre <code>INNER JOIN</code> et <code>LEFT JOIN</code> ?",
        options: ["Aucune difference", "<code>INNER JOIN</code> ne retourne que les correspondances ; <code>LEFT JOIN</code> garde toutes les lignes de gauche", "<code>LEFT JOIN</code> est plus rapide", "<code>INNER JOIN</code> retourne plus de lignes"],
        answer: 1,
        explanation: "<code>INNER JOIN</code> ne retourne que les lignes ayant une correspondance dans les deux tables. <code>LEFT JOIN</code> garde toutes les lignes de gauche, avec <code>NULL</code> pour les colonnes de droite sans correspondance."
    },
    // === PHP (6) ===
    {
        category: "PHP",
        question: "Que fait le mot-cle <code>yield</code> en PHP ?",
        options: ["Arrete le script", "Cree une fonction generateur qui produit des valeurs paresseusement", "Retourne plusieurs valeurs d'un coup", "Lance une exception"],
        answer: 1,
        explanation: "<code>yield</code> transforme une fonction en <strong>generateur</strong>. Elle produit les valeurs une par une a chaque iteration, au lieu de retourner un tableau complet. Ideal pour les gros volumes de donnees."
    },
    {
        category: "PHP",
        question: "Que fait l'operateur <code>??</code> (null coalescing) en PHP ?",
        options: ["Compare deux valeurs", "Retourne l'operande gauche s'il n'est pas null, sinon le droit", "Verifie si une variable est vide", "Convertit en null"],
        answer: 1,
        explanation: "<code>$a ?? $b</code> equivaut a <code>isset($a) ? $a : $b</code>. Il ne declenche pas de notice si la variable n'existe pas, contrairement a l'operateur ternaire classique."
    },
    {
        category: "PHP",
        question: "Difference entre <code>array_map()</code> et <code>array_walk()</code> ?",
        options: ["Aucune difference", "<code>array_map</code> retourne un nouveau tableau ; <code>array_walk</code> modifie en place", "<code>array_walk</code> est plus rapide", "<code>array_map</code> ne fonctionne qu'avec les nombres"],
        answer: 1,
        explanation: "<code>array_map($fn, $arr)</code> retourne un <strong>nouveau tableau</strong>. <code>array_walk(&$arr, $fn)</code> modifie le <strong>tableau original</strong> en place (passage par reference)."
    },
    {
        category: "PHP",
        question: "Qu'est-ce qu'un <code>trait</code> en PHP ?",
        options: ["Un type de variable", "Un mecanisme de reutilisation de code, comme un mixin", "Une classe abstraite", "Un type d'interface"],
        answer: 1,
        explanation: "Un <code>trait</code> permet de reutiliser des methodes dans plusieurs classes sans heritage multiple. On l'inclut avec <code>use MonTrait;</code>. C'est similaire aux mixins dans d'autres langages."
    },
    {
        category: "PHP",
        question: "Que fait <code>PDO::FETCH_ASSOC</code> ?",
        options: ["Retourne les resultats comme objets", "Retourne un tableau associatif avec les noms de colonnes comme cles", "Retourne un tableau indexe numeriquement", "Retourne uniquement la premiere colonne"],
        answer: 1,
        explanation: "<code>FETCH_ASSOC</code> retourne chaque ligne comme tableau associatif : <code>['nom' => 'Alice', 'age' => 25]</code>. Contrairement a <code>FETCH_BOTH</code>, il n'inclut pas les index numeriques."
    },
    {
        category: "PHP",
        question: "Quel est le resultat de ce code ?<div class='code-block'>$a = [1, 2, 3];\n$b = $a;\n$b[] = 4;\necho count($a);</div>",
        options: ["4", "3", "Erreur", "0"],
        answer: 1,
        explanation: "En PHP, les tableaux sont copies par <strong>valeur</strong>. <code>$b = $a</code> cree une copie independante. Modifier <code>$b</code> n'affecte pas <code>$a</code>, qui garde ses 3 elements."
    }
];

let currentQuestion = 0;
let score = 0;
let selectedOption = -1;
let answered = false;
let shuffledQuestions = [];
let answers = [];

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

function stopTimer() { clearInterval(timerInterval); }

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
    document.querySelectorAll('.options li').forEach((el, idx) => {
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

    document.querySelectorAll('.options li').forEach((el, idx) => {
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
        message = 'Excellent ! Vous avez un niveau avance solide.';
        detail = 'Vous maitrisez les concepts intermediaires et avances. Pret pour des projets complexes et des frameworks.';
    } else if (pct >= 60) {
        level = 'Bien';
        levelClass = 'level-good';
        message = 'Bon niveau ! Quelques concepts avances a approfondir.';
        detail = 'Les bases sont solides. Travaillez les questions ratees pour atteindre le niveau expert.';
    } else if (pct >= 40) {
        level = 'Moyen';
        levelClass = 'level-average';
        message = 'Niveau intermediaire. Des lacunes sur les concepts avances.';
        detail = 'Revoyez les parcours progressifs avant de retenter ce QCM avance.';
    } else {
        level = 'A renforcer';
        levelClass = 'level-weak';
        message = 'Ce QCM est difficile. Pas de panique !';
        detail = 'Completez d\'abord les parcours progressifs de chaque technologie, puis revenez a ce QCM.';
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

    let weakest = null, weakPct = 101;
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
            qcm_name: 'qcm3',
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
