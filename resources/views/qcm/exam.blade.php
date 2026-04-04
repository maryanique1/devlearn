@extends('layouts.app')
@section('title', 'Examen Final — Dev Learn')

@section('styles')
        * { box-sizing: border-box; margin: 0; padding: 0; }


        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* ── Topbar ── */
            color: #FFD700;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: opacity .2s;
        }
            font-size: 14px;
        }

        /* ── Container ── */
        .container { overflow-wrap: break-word; max-width: 820px;
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }

        /* ── Header ── */
        .header { text-align: center; margin-bottom: 36px; }
        .logo {
            width: 68px; height: 68px;
            background: linear-gradient(135deg, #FFD700, #896f3d);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 18px;
            color: var(--text-main);
            margin-bottom: 16px;
            letter-spacing: 1px;
        }
        .header h1 { font-size: 30px; margin-bottom: 6px; }
        .header .subtitle { color: var(--text-muted); font-size: 15px; }

        /* ── Timer ── */
        .timer-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }
        .timer {
            font-size: 28px;
            font-weight: 700;
            font-variant-numeric: tabular-nums;
            color: #FFD700;
            transition: color .3s;
        }
        .timer.danger { color: #896f3d; animation: pulse 1s infinite; }
        @keyframes pulse { 0%,100%{ opacity:1; } 50%{ opacity:.5; } }

        /* ── Progress ── */
        .progress-wrap { margin-bottom: 24px; }
        .progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 6px;
        }
        .progress-bar-bg {
            height: 6px;
            background: var(--bg-input);
            border-radius: 3px;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #FFD700, #896f3d);
            border-radius: 3px;
            transition: width .4s ease;
            width: 0%;
        }

        /* ── Category badge ── */
        .cat-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }
        .cat-HTML   { background: #e44d26; color: var(--text-main); }
        .cat-CSS    { background: #2965f1; color: var(--text-main); }
        .cat-JavaScript { background: #f0db4f; color: #222; }
        .cat-PHP    { background: #8892BF; color: var(--text-main); }
        .cat-SQL    { background: #00BCD4; color: var(--text-main); }

        /* ── Question card ── */
        .question-card {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            padding: 32px;
            margin-bottom: 20px;
        }
        .question-card h2 {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        /* ── Options ── */
        .options { display: flex; flex-direction: column; gap: 10px; }
        .option-btn {
            display: block;
            width: 100%;
            text-align: left;
            padding: 14px 18px;
            background: var(--bg-input);
            border: 2px solid transparent;
            border-radius: 10px;
            color: var(--text-main);
            font-size: 15px;
            cursor: pointer;
            transition: border-color .2s, background .2s;
            font-family: inherit;
            line-height: 1.5;
        }
        .option-btn:hover { border-color: #FFD700; }
        .option-btn.selected { border-color: #FFD700; background: #FFD70018; }
        .option-btn.correct { border-color: #27ae60; background: #27ae6020; }
        .option-btn.wrong   { border-color: #896f3d; background: #896f3d20; }
        .option-btn:disabled { cursor: default; opacity: .85; }

        /* ── Explanation ── */
        .explanation {
            margin-top: 16px;
            padding: 14px 18px;
            background: var(--bg-code);
            border-left: 3px solid #FFD700;
            border-radius: 8px;
            font-size: 14px;
            line-height: 1.6;
            display: none;
        }

        /* ── Buttons ── */
        .btn-row { text-align: center; margin-top: 20px; }
        .btn {
            display: inline-block;
            padding: 12px 36px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: transform .15s, opacity .2s;
        }
        .btn:active { transform: scale(.97); }
        .btn-primary {
            background: linear-gradient(135deg, #FFD700, #896f3d);
            color: var(--text-main);
        }
        .btn-primary:disabled { opacity: .4; cursor: not-allowed; }
        .btn-secondary {
            background: var(--bg-input);
            color: var(--text-main);
            margin: 6px;
        }

        /* ── Intro screen ── */
        .intro-screen { text-align: center; }
        .intro-screen .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin: 24px 0 32px;
        }
        .info-box {
            background: var(--bg-input);
            border-radius: 12px;
            padding: 16px;
        }
        .info-box .val { font-size: 22px; font-weight: 700; color: #FFD700; }
        .info-box .lbl { font-size: 12px; color: var(--text-muted); margin-top: 4px; }

        /* ── Results ── */
        .results { display: none; text-align: center; }
        .score-circle {
            width: 160px; height: 160px;
            border-radius: 50%;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 20px 0;
            font-weight: 700;
            border: 6px solid #FFD700;
        }
        .score-circle .pct { font-size: 42px; }
        .score-circle .det { font-size: 14px; color: var(--text-muted); }

        .cat-results {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin: 28px 0;
        }
        .cat-card {
            border-radius: 12px;
            padding: 18px 12px;
            text-align: center;
        }
        .cat-card .cat-name { font-weight: 700; font-size: 14px; margin-bottom: 6px; }
        .cat-card .cat-score { font-size: 24px; font-weight: 700; }
        .cat-card .cat-detail { font-size: 12px; margin-top: 4px; opacity: .8; }

        .weakest {
            margin: 16px 0 28px;
            padding: 14px;
            background: var(--bg-input);
            border-radius: 10px;
            font-size: 14px;
        }
        .weakest strong { color: #896f3d; }

        .time-taken {
            font-size: 14px;
            margin-bottom: 24px;
        }

        /* ── Review section ── */
        .review-section { display: none; }
        .review-section .question-card { text-align: left; }

        /* ── Responsive ── */
        @media (max-width: 600px) {
            .container { overflow-wrap: break-word; max-width: 820px; padding: 20px 12px 40px; }
            .question-card { padding: 20px; }
            .header h1 { font-size: 24px; }
            .timer { font-size: 22px; }
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
    <!-- HEADER -->
    <div class="header">
        <div class="logo">EXAM</div>
        <h1>Examen Final</h1>
        <p class="subtitle">60 questions &bull; 6 technologies &bull; Chronom&egrave;tre</p>
    </div>

    <!-- INTRO SCREEN -->
    <div id="introScreen" class="intro-screen">
        <div class="info-grid">
            <div class="info-box"><div class="val">60</div><div class="lbl">Questions</div></div>
            <div class="info-box"><div class="val">6</div><div class="lbl">Technologies</div></div>
            <div class="info-box"><div class="val">30:00</div><div class="lbl">Minutes</div></div>
            <div class="info-box"><div class="val">10</div><div class="lbl">Par cat&eacute;gorie</div></div>
        </div>
        <p style="color:var(--text-muted); font-size:14px; margin-bottom:24px;">
            C++ &bull; HTML &bull; CSS &bull; JavaScript &bull; PHP &bull; SQL<br>
            Les questions sont m&eacute;lang&eacute;es al&eacute;atoirement. Le chronomètre d&eacute;marre d&egrave;s que vous cliquez.
        </p>
        <button class="btn btn-primary" onclick="startExam()">Commencer l'examen</button>
    </div>

    <!-- QUIZ SCREEN -->
    <div id="quizScreen" style="display:none;">
        <div class="timer-bar">
            &#9200; <span id="timer" class="timer">30:00</span>
        </div>
        <div class="progress-wrap">
            <div class="progress-info">
                <span id="progressText">Question 1 / 50</span>
                <span id="progressPct">0%</span>
            </div>
            <div class="progress-bar-bg">
                <div id="progressFill" class="progress-bar-fill"></div>
            </div>
        </div>

        <div class="question-card">
            <span id="catBadge" class="cat-badge"></span>
            <h2 id="questionText"></h2>
            <div id="optionsContainer" class="options"></div>
            <div id="explanation" class="explanation"></div>
        </div>

        <div class="btn-row">
            <button id="validateBtn" class="btn btn-primary" disabled onclick="validateAnswer()">Valider</button>
            <button id="nextBtn" class="btn btn-primary" style="display:none;" onclick="nextQuestion()">Suivante &rarr;</button>
        </div>
    </div>

    <!-- RESULTS SCREEN -->
    <div id="resultsScreen" class="results">
        <h2 style="margin-bottom:8px;">R&eacute;sultats de l'examen</h2>
        <div id="scoreCircle" class="score-circle">
            <span class="pct" id="resPct">0%</span>
            <span class="det" id="resDet">0/50</span>
        </div>
        <div id="timeTaken" class="time-taken"></div>
        <div id="catResults" class="cat-results"></div>
        <div id="weakest" class="weakest"></div>
        <div class="btn-row">
            <button class="btn btn-primary" onclick="restartExam()">Recommencer</button>
            <button class="btn btn-secondary" id="reviewBtn" onclick="showReview()">Retravailler mes erreurs</button>
            <a href="/dashboard" class="btn btn-secondary" style="text-decoration:none;">Accueil</a>
        </div>
    </div>

    <!-- REVIEW SECTION -->
    <div id="reviewSection" class="review-section"></div>
</div>

<script>
// ═══════════════════════════════════════════
// ──── QUESTIONS (60 total, 10 per tech) ────
// ═══════════════════════════════════════════
const questions = [
    // ──── HTML (10) ────
    {
        category: 'HTML',
        question: 'Quel élément HTML5 est le plus approprié pour regrouper le contenu de navigation principal d\'un site ?',
        options: ['<div id="nav">', '<nav>', '<header>', '<aside>'],
        answer: 1,
        explanation: 'L\'élément <nav> est un élément sémantique HTML5 spécifiquement conçu pour les blocs de navigation principale.'
    },
    {
        category: 'HTML',
        question: 'Quel attribut de la balise <form> définit la méthode d\'encodage des données lors de l\'envoi ?',
        options: ['method', 'enctype', 'action', 'encoding'],
        answer: 1,
        explanation: 'L\'attribut enctype spécifie le type d\'encodage des données du formulaire (ex: multipart/form-data pour les fichiers).'
    },
    {
        category: 'HTML',
        question: 'Quel attribut rend un champ de formulaire obligatoire en HTML5 sans JavaScript ?',
        options: ['mandatory', 'validate', 'required', 'necessary'],
        answer: 2,
        explanation: 'L\'attribut required empêche la soumission du formulaire si le champ est vide, avec validation native du navigateur.'
    },
    {
        category: 'HTML',
        question: 'Quel attribut ARIA est utilisé pour fournir un label accessible à un élément qui n\'a pas de texte visible ?',
        options: ['aria-label', 'aria-role', 'aria-description', 'aria-text'],
        answer: 0,
        explanation: 'aria-label fournit un label textuel aux technologies d\'assistance quand aucun texte visible n\'est présent.'
    },
    {
        category: 'HTML',
        question: 'Quelle balise meta permet de contrôler le comportement du viewport sur mobile ?',
        options: ['meta name="mobile"', 'meta name="viewport"', 'meta name="responsive"', 'meta name="device"'],
        answer: 1,
        explanation: 'La balise meta viewport avec content="width=device-width, initial-scale=1.0" contrôle l\'affichage sur les appareils mobiles.'
    },
    {
        category: 'HTML',
        question: 'Quelle est la différence entre les attributs href="#" et href="javascript:void(0)" sur un lien ?',
        options: [
            'Il n\'y a aucune différence',
            'href="#" scroll en haut de la page, javascript:void(0) ne fait rien',
            'href="#" ouvre un nouvel onglet',
            'javascript:void(0) est plus rapide'
        ],
        answer: 1,
        explanation: 'href="#" navigue vers le haut de la page (modifie le hash de l\'URL), tandis que javascript:void(0) empêche toute action par défaut.'
    },
    {
        category: 'HTML',
        question: 'Quel attribut de la balise <table> a été rendu obsolète en HTML5 pour le style ?',
        options: ['border', 'id', 'class', 'role'],
        answer: 0,
        explanation: 'L\'attribut border sur <table> est obsolète en HTML5. Le style des bordures doit être défini en CSS.'
    },
    {
        category: 'HTML',
        question: 'Quel élément HTML5 permet d\'intégrer une vidéo avec des contrôles natifs et un texte de remplacement ?',
        options: [
            '<embed src="video.mp4">',
            '<video src="video.mp4" controls>Navigateur non compatible</video>',
            '<media type="video" src="video.mp4">',
            '<object data="video.mp4">'
        ],
        answer: 1,
        explanation: 'La balise <video> avec l\'attribut controls affiche les contrôles natifs, et le texte entre les balises sert de fallback.'
    },
    {
        category: 'HTML',
        question: 'Quel DOCTYPE est correct pour un document HTML5 ?',
        options: ['<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 5//">', '<!DOCTYPE html>', '<!DOCTYPE HTML5>', '<DOCTYPE html>'],
        answer: 1,
        explanation: '<!DOCTYPE html> est la déclaration simplifiée de HTML5. Les anciennes versions nécessitaient des DTD plus longues.'
    },
    {
        category: 'HTML',
        question: 'Quel type d\'input HTML5 affiche un sélecteur de couleur natif dans le navigateur ?',
        options: ['<input type="palette">', '<input type="color">', '<input type="picker">', '<input type="rgb">'],
        answer: 1,
        explanation: '<input type="color"> affiche un sélecteur de couleur natif et retourne une valeur hexadécimale (#rrggbb).'
    },

    // ──── CSS (10) ────
    {
        category: 'CSS',
        question: 'En Flexbox, quelle propriété permet de centrer les éléments à la fois horizontalement et verticalement en une seule déclaration ?',
        options: ['align-items: center', 'place-items: center (en Grid)', 'justify-content: center + align-items: center', 'flex-center: both'],
        answer: 2,
        explanation: 'En Flexbox, il faut combiner justify-content: center (axe principal) et align-items: center (axe transversal).'
    },
    {
        category: 'CSS',
        question: 'Quelle propriété CSS Grid permet de définir un template avec des zones nommées ?',
        options: ['grid-template-columns', 'grid-template-areas', 'grid-area-names', 'grid-layout'],
        answer: 1,
        explanation: 'grid-template-areas permet de nommer des zones et de créer un layout visuel en assignant des noms aux cellules.'
    },
    {
        category: 'CSS',
        question: 'Quelle est la différence entre position: absolute et position: fixed ?',
        options: [
            'Aucune différence',
            'absolute se positionne par rapport au parent positionné, fixed par rapport au viewport',
            'fixed est relatif au parent, absolute au viewport',
            'absolute nécessite z-index, fixed non'
        ],
        answer: 1,
        explanation: 'position: absolute se positionne par rapport à l\'ancêtre positionné le plus proche, tandis que fixed est toujours relatif au viewport.'
    },
    {
        category: 'CSS',
        question: 'Quel sélecteur a la spécificité la plus élevée ?',
        options: ['div.class p', '#id .class', '.class1.class2.class3', 'div div div div'],
        answer: 1,
        explanation: '#id .class a une spécificité de (1,1,0) qui est supérieure aux autres. Un ID vaut 100, une classe 10, un élément 1.'
    },
    {
        category: 'CSS',
        question: 'Avec box-sizing: border-box, que comprend la width déclarée ?',
        options: [
            'Uniquement le contenu',
            'Le contenu + padding',
            'Le contenu + padding + border',
            'Le contenu + padding + border + margin'
        ],
        answer: 2,
        explanation: 'border-box inclut le contenu, le padding et la bordure dans la largeur déclarée. La marge reste en dehors.'
    },
    {
        category: 'CSS',
        question: 'Quelle media query cible les écrans d\'une largeur maximale de 768px ?',
        options: [
            '@media screen (max: 768px)',
            '@media (max-width: 768px)',
            '@media screen and (width < 768px)',
            '@media only screen and (max-width: 768px)'
        ],
        answer: 3,
        explanation: '@media only screen and (max-width: 768px) est la syntaxe standard la plus complète et compatible pour cibler les écrans jusqu\'à 768px.'
    },
    {
        category: 'CSS',
        question: 'Quelle propriété CSS permet de créer une animation fluide lors du survol d\'un élément ?',
        options: ['animation: hover 0.3s', 'transform: smooth', 'transition: all 0.3s ease', 'hover-effect: 0.3s'],
        answer: 2,
        explanation: 'transition permet d\'animer le changement de propriétés CSS. La syntaxe est: transition: propriété durée timing-function.'
    },
    {
        category: 'CSS',
        question: 'Quel pseudo-classe cible le troisième élément enfant de son parent ?',
        options: [':child(3)', ':nth-child(3)', ':eq(3)', ':index(3)'],
        answer: 1,
        explanation: ':nth-child(3) cible le troisième enfant. On peut aussi utiliser des formules comme :nth-child(2n) pour les éléments pairs.'
    },
    {
        category: 'CSS',
        question: 'Quelle unité CSS est relative à la taille de la police de l\'élément racine (<html>) ?',
        options: ['em', 'rem', 'vw', '%'],
        answer: 1,
        explanation: 'rem (root em) est relatif à la taille de police de l\'élément <html>, contrairement à em qui est relatif au parent.'
    },
    {
        category: 'CSS',
        question: 'Que se passe-t-il quand deux éléments positionnés se chevauchent et ont le même z-index ?',
        options: [
            'Le navigateur affiche une erreur',
            'L\'élément qui apparaît en dernier dans le DOM est affiché au-dessus',
            'L\'élément le plus grand est affiché au-dessus',
            'Ils deviennent transparents'
        ],
        answer: 1,
        explanation: 'À z-index égal, l\'ordre du DOM prévaut : l\'élément qui apparaît en dernier dans le code source est rendu au-dessus.'
    },

    // ──── JavaScript (10) ────
    {
        category: 'JavaScript',
        question: 'Quelle valeur affiche ce code ?\nfunction compteur() { let n = 0; return function() { return ++n; }; }\nconst c = compteur(); console.log(c(), c(), c());',
        options: ['1 1 1', '0 1 2', '1 2 3', 'undefined undefined undefined'],
        answer: 2,
        explanation: 'La closure conserve une référence à la variable n. Chaque appel incrémente la même variable : 1, 2, 3.'
    },
    {
        category: 'JavaScript',
        question: 'Quel code retourne un tableau contenant uniquement les nombres pairs doublés à partir de [1, 2, 3, 4, 5] ?',
        options: [
            '[1,2,3,4,5].filter(n => n % 2 === 0).map(n => n * 2)',
            '[1,2,3,4,5].map(n => n * 2).filter(n => n % 2)',
            '[1,2,3,4,5].reduce((a, n) => n % 2 ? a : a + n * 2, 0)',
            '[1,2,3,4,5].filter(n => n * 2).map(n => n % 2 === 0)'
        ],
        answer: 0,
        explanation: 'filter sélectionne les pairs (2, 4), puis map les double (4, 8). Le chaînage filter→map est le pattern classique.'
    },
    {
        category: 'JavaScript',
        question: 'Quelle méthode du DOM permet de sélectionner tous les éléments ayant la classe "active" ?',
        options: [
            'document.getElementById(".active")',
            'document.querySelector(".active")',
            'document.querySelectorAll(".active")',
            'document.getElementByClass("active")'
        ],
        answer: 2,
        explanation: 'querySelectorAll retourne tous les éléments correspondants (NodeList). querySelector ne retourne que le premier.'
    },
    {
        category: 'JavaScript',
        question: 'Quel est l\'avantage d\'utiliser addEventListener par rapport à onclick ?',
        options: [
            'addEventListener est plus rapide',
            'addEventListener permet d\'attacher plusieurs gestionnaires au même événement',
            'onclick supporte plus d\'événements',
            'Il n\'y a aucune différence'
        ],
        answer: 1,
        explanation: 'addEventListener permet d\'ajouter plusieurs écouteurs sur le même événement, contrairement à onclick qui écrase le précédent.'
    },
    {
        category: 'JavaScript',
        question: 'Que retourne ce code ?\nsetTimeout(() => console.log("A"), 0);\nconsole.log("B");\nPromise.resolve().then(() => console.log("C"));',
        options: ['A B C', 'B A C', 'B C A', 'C B A'],
        answer: 2,
        explanation: '"B" s\'affiche d\'abord (synchrone), puis "C" (microtask/Promise), puis "A" (macrotask/setTimeout). Les Promises ont priorité sur setTimeout.'
    },
    {
        category: 'JavaScript',
        question: 'Quelle syntaxe utilise correctement les template literals pour inclure une expression ?',
        options: [
            '"Bonjour ${nom}"',
            '`Bonjour ${nom}`',
            '\'Bonjour ${nom}\'',
            '`Bonjour #{nom}`'
        ],
        answer: 1,
        explanation: 'Les template literals utilisent les backticks (`) et la syntaxe ${expression} pour l\'interpolation.'
    },
    {
        category: 'JavaScript',
        question: 'Que fait ce code ?\nconst { name: n, age: a = 25 } = { name: "Ali" };',
        options: [
            'Erreur : age n\'existe pas dans l\'objet',
            'n = "Ali", a = undefined',
            'n = "Ali", a = 25',
            'name = "Ali", age = 25'
        ],
        answer: 2,
        explanation: 'Le destructuring renomme name en n et assigne une valeur par défaut de 25 à a car age n\'existe pas dans l\'objet.'
    },
    {
        category: 'JavaScript',
        question: 'Quel est le résultat de [...[1, 2], ...[3, 4]] ?',
        options: ['[[1, 2], [3, 4]]', '[1, 2, 3, 4]', 'Erreur de syntaxe', '[1, 2, [3, 4]]'],
        answer: 1,
        explanation: 'L\'opérateur spread (...) décompose chaque tableau et les fusionne en un seul tableau plat : [1, 2, 3, 4].'
    },
    {
        category: 'JavaScript',
        question: 'Que retourne l\'expression : 5 > 3 ? "oui" : "non" ?',
        options: ['true', '"oui"', '"non"', '5'],
        answer: 1,
        explanation: 'L\'opérateur ternaire évalue la condition (5 > 3 = true) et retourne la première valeur : "oui".'
    },
    {
        category: 'JavaScript',
        question: 'Que retourne typeof null en JavaScript ?',
        options: ['"null"', '"undefined"', '"object"', '"boolean"'],
        answer: 2,
        explanation: 'typeof null retourne "object" — c\'est un bug historique de JavaScript qui persiste pour des raisons de compatibilité.'
    },

    // ──── PHP (10) ────
    {
        category: 'PHP',
        question: 'Quel est le résultat de array_map(fn($n) => $n ** 2, [1, 2, 3, 4]) en PHP ?',
        options: ['[1, 2, 3, 4]', '[1, 4, 9, 16]', '[2, 4, 6, 8]', 'Erreur de syntaxe'],
        answer: 1,
        explanation: 'array_map applique la fonction à chaque élément. fn($n) => $n ** 2 élève au carré : 1, 4, 9, 16.'
    },
    {
        category: 'PHP',
        question: 'Comment accéder à la valeur "Paris" dans ce tableau ?\n$user = ["nom" => "Ali", "ville" => "Paris"];',
        options: ['$user[1]', '$user["ville"]', '$user->ville', '$user.ville'],
        answer: 1,
        explanation: 'En PHP, on accède aux tableaux associatifs avec la syntaxe $array["clé"]. La notation -> est pour les objets.'
    },
    {
        category: 'PHP',
        question: 'Quelle fonction PHP retourne une sous-chaîne à partir d\'une position donnée ?',
        options: ['str_split()', 'substr()', 'str_extract()', 'substring()'],
        answer: 1,
        explanation: 'substr($string, $start, $length) extrait une portion de chaîne. Ex: substr("Bonjour", 3) retourne "jour".'
    },
    {
        category: 'PHP',
        question: 'Quelle méthode PDO permet d\'exécuter une requête préparée avec des paramètres ?',
        options: ['$pdo->query()', '$stmt->execute()', '$pdo->run()', '$stmt->fetch()'],
        answer: 1,
        explanation: 'Après prepare(), on appelle execute() sur le statement avec les paramètres pour exécuter la requête de façon sécurisée.'
    },
    {
        category: 'PHP',
        question: 'Comment détruire toutes les données de session en PHP ?',
        options: [
            'session_destroy() uniquement',
            '$_SESSION = []; session_destroy();',
            'unset(session)',
            'session_end()'
        ],
        answer: 1,
        explanation: 'Il faut d\'abord vider le tableau $_SESSION = [], puis appeler session_destroy() pour supprimer les données côté serveur.'
    },
    {
        category: 'PHP',
        question: 'Quelle fonction PHP permet de lire tout le contenu d\'un fichier en une seule chaîne ?',
        options: ['fread()', 'file_get_contents()', 'readfile()', 'fgets()'],
        answer: 1,
        explanation: 'file_get_contents() lit tout le contenu d\'un fichier et le retourne comme chaîne. C\'est la méthode la plus simple.'
    },
    {
        category: 'PHP',
        question: 'Quelle superglobale PHP contient les données envoyées via une requête POST ?',
        options: ['$_GET', '$_POST', '$_REQUEST', '$_SERVER'],
        answer: 1,
        explanation: '$_POST contient les données du corps de la requête HTTP envoyées avec la méthode POST.'
    },
    {
        category: 'PHP',
        question: 'Quelle est la bonne façon de gérer une exception PDO en PHP ?',
        options: [
            'if ($pdo->error) { ... }',
            'try { ... } catch (PDOException $e) { ... }',
            '$pdo->onError(function() { ... })',
            'catch { PDOException } then { ... }'
        ],
        answer: 1,
        explanation: 'try/catch avec PDOException est le mécanisme standard de gestion des erreurs pour les opérations PDO.'
    },
    {
        category: 'PHP',
        question: 'Que fait cette boucle ?\nforeach ($users as $key => $user) { echo "$key: $user\\n"; }',
        options: [
            'Elle affiche uniquement les valeurs',
            'Elle affiche les clés et les valeurs de chaque élément',
            'Elle modifie le tableau $users',
            'Erreur : foreach ne supporte pas $key => $value'
        ],
        answer: 1,
        explanation: 'foreach avec $key => $value permet d\'itérer sur les clés et les valeurs simultanément.'
    },
    {
        category: 'PHP',
        question: 'Que retourne (int) "42abc" en PHP ?',
        options: ['0', '42', '"42"', 'Erreur de type'],
        answer: 1,
        explanation: 'Le casting (int) convertit la chaîne en entier en lisant les chiffres du début. "42abc" devient 42.'
    },
    {
        category: 'PHP',
        question: 'Quelle est la forme abrégée de : $role = isset($data["role"]) ? $data["role"] : "user"; ?',
        options: [
            '$role = $data["role"] || "user";',
            '$role = $data["role"] ?? "user";',
            '$role = $data["role"] ?: "user";',
            '$role = $data["role"] AND "user";'
        ],
        answer: 1,
        explanation: 'L\'opérateur null coalescent (??) retourne l\'opérande de gauche s\'il existe et n\'est pas null, sinon celui de droite.'
    },

    // ──── SQL (10) ────
    {
        category: 'SQL',
        question: 'Quelle requête SQL retourne les employés avec le nom de leur département, y compris ceux sans département ?',
        options: [
            'SELECT * FROM employes INNER JOIN departements ON employes.dept_id = departements.id',
            'SELECT * FROM employes LEFT JOIN departements ON employes.dept_id = departements.id',
            'SELECT * FROM employes RIGHT JOIN departements ON employes.dept_id = departements.id',
            'SELECT * FROM employes, departements'
        ],
        answer: 1,
        explanation: 'LEFT JOIN retourne tous les employés même sans département correspondant (valeurs NULL pour le département).'
    },
    {
        category: 'SQL',
        question: 'Que retourne cette sous-requête ?\nSELECT nom FROM employes WHERE salaire > (SELECT AVG(salaire) FROM employes);',
        options: [
            'Tous les employés',
            'Les employés dont le salaire dépasse la moyenne',
            'Le salaire moyen',
            'Erreur : sous-requête interdite dans WHERE'
        ],
        answer: 1,
        explanation: 'La sous-requête calcule la moyenne des salaires, puis la requête principale filtre les employés au-dessus de cette moyenne.'
    },
    {
        category: 'SQL',
        question: 'Quelle clause filtre les résultats après un GROUP BY ?',
        options: ['WHERE', 'HAVING', 'FILTER', 'GROUP FILTER'],
        answer: 1,
        explanation: 'HAVING filtre les groupes après l\'agrégation. WHERE filtre les lignes avant le GROUP BY.'
    },
    {
        category: 'SQL',
        question: 'Quelle fonction d\'agrégation retourne le nombre de lignes non NULL d\'une colonne ?',
        options: ['SUM(colonne)', 'COUNT(colonne)', 'TOTAL(colonne)', 'NUM(colonne)'],
        answer: 1,
        explanation: 'COUNT(colonne) compte les valeurs non NULL. COUNT(*) compte toutes les lignes y compris les NULL.'
    },
    {
        category: 'SQL',
        question: 'Quelle est la syntaxe correcte pour mettre à jour le salaire d\'un employé avec l\'id 5 ?',
        options: [
            'MODIFY employes SET salaire = 5000 WHERE id = 5',
            'UPDATE employes SET salaire = 5000 WHERE id = 5',
            'ALTER employes SET salaire = 5000 WHERE id = 5',
            'SET employes.salaire = 5000 WHERE id = 5'
        ],
        answer: 1,
        explanation: 'UPDATE table SET colonne = valeur WHERE condition est la syntaxe standard pour modifier des données.'
    },
    {
        category: 'SQL',
        question: 'Quelle contrainte garantit qu\'une colonne ne peut pas contenir de valeurs en double ?',
        options: ['PRIMARY KEY', 'UNIQUE', 'NOT NULL', 'CHECK'],
        answer: 1,
        explanation: 'UNIQUE empêche les doublons dans une colonne. PRIMARY KEY combine UNIQUE et NOT NULL.'
    },
    {
        category: 'SQL',
        question: 'Quel est l\'effet principal de la création d\'un index sur une colonne ?',
        options: [
            'Il empêche les valeurs NULL',
            'Il accélère les recherches sur cette colonne',
            'Il trie automatiquement les insertions',
            'Il limite le type de données'
        ],
        answer: 1,
        explanation: 'Un index crée une structure de données qui accélère les recherches (SELECT/WHERE) au prix d\'un stockage supplémentaire.'
    },
    {
        category: 'SQL',
        question: 'Que retourne SELECT DISTINCT ville FROM clients; ?',
        options: [
            'Toutes les villes y compris les doublons',
            'Les villes uniques sans doublons',
            'Le nombre de villes distinctes',
            'Erreur : DISTINCT doit être utilisé avec COUNT'
        ],
        answer: 1,
        explanation: 'DISTINCT élimine les lignes en double du résultat et retourne uniquement les valeurs uniques.'
    },
    {
        category: 'SQL',
        question: 'Quelle requête combine les résultats de deux SELECT en éliminant les doublons ?',
        options: ['MERGE', 'UNION', 'UNION ALL', 'COMBINE'],
        answer: 1,
        explanation: 'UNION combine deux requêtes et supprime les doublons. UNION ALL conserve les doublons (plus performant).'
    },
    {
        category: 'SQL',
        question: 'Quelle clause LIKE correspond à tous les noms commençant par "Ma" et finissant par "n" ?',
        options: ["LIKE 'Ma%n'", "LIKE 'Ma_n'", "LIKE '%Ma%n%'", "LIKE 'Ma*n'"],
        answer: 0,
        explanation: "% remplace zéro ou plusieurs caractères. 'Ma%n' correspond à Martin, Marin, Man, etc."
    },
    // ──── C++ (10) ────
    {
        category: 'C++',
        question: 'Quel fichier d\'en-tête faut-il inclure pour utiliser <code>cout</code> et <code>cin</code> ?',
        options: ['<code>&lt;stdio.h&gt;</code>', '<code>&lt;iostream&gt;</code>', '<code>&lt;conio.h&gt;</code>', '<code>&lt;output&gt;</code>'],
        answer: 1,
        explanation: '<code>&lt;iostream&gt;</code> est la bibliothèque standard C++ pour les entrées/sorties console (cout, cin, cerr).'
    },
    {
        category: 'C++',
        question: 'Quelle est la différence entre <code>++i</code> et <code>i++</code> ?',
        options: ['Aucune différence', '++i incrémente après utilisation', '++i incrémente avant utilisation, i++ après', 'i++ est plus rapide'],
        answer: 2,
        explanation: '<code>++i</code> (pré-incrémentation) incrémente d\'abord puis retourne la valeur. <code>i++</code> (post-incrémentation) retourne la valeur puis incrémente.'
    },
    {
        category: 'C++',
        question: 'Qu\'est-ce qu\'une erreur de segmentation (segfault) en C++ ?',
        options: ['Une erreur de syntaxe', 'Un accès à une zone mémoire invalide', 'Une division par zéro', 'Un dépassement de tableau détecté à la compilation'],
        answer: 1,
        explanation: 'Un segfault se produit quand le programme tente d\'accéder à une zone mémoire qui ne lui appartient pas (pointeur nul, tableau hors limites, etc.).'
    },
    {
        category: 'C++',
        question: 'Que fait <code>delete[] tab;</code> en C++ ?',
        options: ['Supprime le premier élément du tableau', 'Libère la mémoire d\'un tableau alloué avec new[]', 'Vide le contenu du tableau sans libérer la mémoire', 'Supprime la variable tab de la portée'],
        answer: 1,
        explanation: '<code>delete[]</code> libère la mémoire d\'un tableau alloué dynamiquement avec <code>new[]</code>. Utiliser <code>delete</code> sans crochets causerait un comportement indéfini.'
    },
    {
        category: 'C++',
        question: 'Qu\'est-ce que la surcharge de fonctions (function overloading) ?',
        options: ['Appeler une fonction plusieurs fois', 'Définir plusieurs fonctions avec le même nom mais des paramètres différents', 'Remplacer une fonction par une autre', 'Créer une fonction récursive'],
        answer: 1,
        explanation: 'La surcharge permet de définir plusieurs fonctions avec le même nom mais des signatures différentes (nombre ou types de paramètres). Le compilateur choisit la bonne version.'
    },
    {
        category: 'C++',
        question: 'Que représente l\'opérateur <code>::</code> en C++ ?',
        options: ['Comparaison', 'Affectation', 'Résolution de portée', 'Héritage'],
        answer: 2,
        explanation: 'L\'opérateur <code>::</code> (scope resolution) permet d\'accéder aux membres d\'une classe, d\'un namespace, ou de définir une méthode en dehors de sa classe.'
    },
    {
        category: 'C++',
        question: 'Que représente <code>nullptr</code> en C++ ?',
        options: ['Un entier valant 0', 'Un pointeur nul typé', 'Une chaîne vide', 'Un booléen faux'],
        answer: 1,
        explanation: '<code>nullptr</code> (C++11) est un littéral de pointeur nul typé. Il remplace <code>NULL</code> (qui est un simple <code>#define 0</code>) pour éviter les ambiguïtés.'
    },
    {
        category: 'C++',
        question: 'Qu\'est-ce qu\'un destructeur en C++ ?',
        options: ['Une fonction qui supprime un fichier', 'Une méthode spéciale appelée quand un objet est détruit, préfixée par ~', 'Un opérateur pour libérer la mémoire', 'Une méthode qui réinitialise les attributs'],
        answer: 1,
        explanation: 'Le destructeur (<code>~NomClasse()</code>) est appelé automatiquement quand un objet sort de sa portée ou est supprimé avec <code>delete</code>. Il sert à libérer les ressources.'
    },
    {
        category: 'C++',
        question: 'Quelle est la différence entre <code>struct</code> et <code>class</code> en C++ ?',
        options: ['struct ne peut pas avoir de méthodes', 'struct est public par défaut, class est private par défaut', 'class ne supporte pas l\'héritage', 'Aucune différence fonctionnelle'],
        answer: 1,
        explanation: 'La seule différence est la visibilité par défaut : <code>struct</code> est public par défaut, <code>class</code> est private par défaut. Les deux supportent méthodes, héritage, etc.'
    },
    {
        category: 'C++',
        question: 'Que fournit <code>#include &lt;vector&gt;</code> ?',
        options: ['Un type pour les coordonnées 2D', 'Un conteneur de tableau dynamique (std::vector)', 'Des fonctions mathématiques vectorielles', 'Un type de pointeur intelligent'],
        answer: 1,
        explanation: '<code>std::vector</code> est un conteneur de la STL qui gère un tableau dynamique redimensionnable automatiquement, contrairement aux tableaux C classiques de taille fixe.'
    }
];

// ═══════════════════════════════════════
// ──── ENGINE ────
// ═══════════════════════════════════════
let shuffled = [];
let current = 0;
let score = 0;
let answers = []; // { selected, correct, wasRight }
let timerInterval = null;
let timeLeft = 1800; // 30 minutes
let startTime = 0;

const catColors = {
    HTML: '#e44d26',
    CSS: '#2965f1',
    JavaScript: '#f0db4f',
    PHP: '#8892BF',
    SQL: '#00BCD4'
};

// Fisher-Yates shuffle
function shuffle(arr) {
    const a = [...arr];
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

function startExam() {
    shuffled = shuffle(questions);
    current = 0;
    score = 0;
    answers = [];
    timeLeft = 1800;
    startTime = Date.now();

    document.getElementById('introScreen').style.display = 'none';
    document.getElementById('quizScreen').style.display = 'block';
    document.getElementById('resultsScreen').style.display = 'none';
    document.getElementById('reviewSection').style.display = 'none';

    startTimer();
    showQuestion();
}

function startTimer() {
    updateTimerDisplay();
    timerInterval = setInterval(() => {
        timeLeft--;
        updateTimerDisplay();
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            autoSubmit();
        }
    }, 1000);
}

function updateTimerDisplay() {
    const m = Math.floor(timeLeft / 60);
    const s = timeLeft % 60;
    const el = document.getElementById('timer');
    el.textContent = `${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
    if (timeLeft < 300) {
        el.classList.add('danger');
    } else {
        el.classList.remove('danger');
    }
}

function showQuestion() {
    const q = shuffled[current];
    const pct = Math.round((current / shuffled.length) * 100);

    document.getElementById('progressText').textContent = `Question ${current + 1} / ${shuffled.length}`;
    document.getElementById('progressPct').textContent = `${pct}%`;
    document.getElementById('progressFill').style.width = `${pct}%`;

    const badge = document.getElementById('catBadge');
    badge.textContent = q.category;
    badge.className = 'cat-badge cat-' + q.category;

    document.getElementById('questionText').textContent = q.question;

    const container = document.getElementById('optionsContainer');
    container.innerHTML = '';
    q.options.forEach((opt, i) => {
        const btn = document.createElement('button');
        btn.className = 'option-btn';
        btn.textContent = opt;
        btn.onclick = () => selectOption(i);
        container.appendChild(btn);
    });

    document.getElementById('explanation').style.display = 'none';
    document.getElementById('explanation').textContent = '';
    document.getElementById('validateBtn').style.display = 'inline-block';
    document.getElementById('validateBtn').disabled = true;
    document.getElementById('nextBtn').style.display = 'none';
}

let selectedOption = -1;

function selectOption(i) {
    selectedOption = i;
    const btns = document.querySelectorAll('.option-btn');
    btns.forEach((btn, idx) => {
        btn.classList.toggle('selected', idx === i);
    });
    document.getElementById('validateBtn').disabled = false;
}

function validateAnswer() {
    const q = shuffled[current];
    const correct = q.answer;
    const wasRight = selectedOption === correct;
    if (wasRight) score++;

    answers.push({ questionIndex: questions.indexOf(q), selected: selectedOption, correct, wasRight });

    const btns = document.querySelectorAll('.option-btn');
    btns.forEach((btn, idx) => {
        btn.disabled = true;
        if (idx === correct) btn.classList.add('correct');
        if (idx === selectedOption && !wasRight) btn.classList.add('wrong');
    });

    const expl = document.getElementById('explanation');
    expl.textContent = q.explanation;
    expl.style.display = 'block';

    document.getElementById('validateBtn').style.display = 'none';
    document.getElementById('nextBtn').style.display = 'inline-block';
    document.getElementById('nextBtn').textContent = current < shuffled.length - 1 ? 'Suivante →' : 'Voir les résultats';
}

function nextQuestion() {
    current++;
    selectedOption = -1;
    if (current >= shuffled.length) {
        finishExam();
    } else {
        showQuestion();
    }
}

function autoSubmit() {
    // Mark remaining unanswered questions as wrong
    for (let i = current; i < shuffled.length; i++) {
        if (!answers[i]) {
            const q = shuffled[i];
            answers.push({ questionIndex: questions.indexOf(q), selected: -1, correct: q.answer, wasRight: false });
        }
    }
    finishExam();
}

function finishExam() {
    clearInterval(timerInterval);
    const elapsed = Math.round((Date.now() - startTime) / 1000);
    const pct = Math.round((score / shuffled.length) * 100);

    document.getElementById('quizScreen').style.display = 'none';
    const res = document.getElementById('resultsScreen');
    res.style.display = 'block';

    document.getElementById('resPct').textContent = pct + '%';
    document.getElementById('resDet').textContent = `${score}/${shuffled.length}`;

    const m = Math.floor(elapsed / 60);
    const s = elapsed % 60;
    document.getElementById('timeTaken').textContent = `Temps utilisé : ${m} min ${s < 10 ? '0' : ''}${s} sec`;

    // Per-category breakdown
    const cats = ['HTML', 'CSS', 'JavaScript', 'PHP', 'SQL', 'C++'];
    const catScores = {};
    cats.forEach(c => { catScores[c] = { correct: 0, total: 0 }; });
    answers.forEach((a, i) => {
        const cat = shuffled[i].category;
        catScores[cat].total++;
        if (a.wasRight) catScores[cat].correct++;
    });

    const catContainer = document.getElementById('catResults');
    catContainer.innerHTML = '';
    let weakest = { name: '', pct: 101 };

    cats.forEach(cat => {
        const cs = catScores[cat];
        const cp = cs.total > 0 ? Math.round((cs.correct / cs.total) * 100) : 0;
        if (cp < weakest.pct) { weakest = { name: cat, pct: cp }; }

        const card = document.createElement('div');
        card.className = 'cat-card';
        const bg = catColors[cat];
        const textColor = cat === 'JavaScript' ? '#222' : '#fff';
        card.style.background = bg;
        card.style.color = textColor;
        card.innerHTML = `
            <div class="cat-name">${cat}</div>
            <div class="cat-score">${cp}%</div>
            <div class="cat-detail">${cs.correct}/${cs.total}</div>
        `;
        catContainer.appendChild(card);
    });

    document.getElementById('weakest').innerHTML = `Point faible : <strong>${weakest.name}</strong> (${weakest.pct}%) — Pensez à réviser cette technologie !`;

    // Save score
    fetch('/api/scores', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            qcm_name: 'qcm-exam',
            score: score,
            total: shuffled.length,
            percentage: pct,
            duration_seconds: elapsed
        })
    }).catch(() => {});
}

function restartExam() {
    document.getElementById('resultsScreen').style.display = 'none';
    document.getElementById('reviewSection').style.display = 'none';
    document.getElementById('introScreen').style.display = 'block';
}

function showReview() {
    const section = document.getElementById('reviewSection');
    section.style.display = 'block';
    section.innerHTML = '<h2 style="margin:28px 0 16px; text-align:center;">Retravailler mes erreurs</h2>';

    const errors = answers.filter(a => !a.wasRight);
    if (errors.length === 0) {
        section.innerHTML += '<p style="text-align:center; color:var(--text-muted);">Aucune erreur — Bravo !</p>';
        return;
    }

    errors.forEach(a => {
        const q = shuffled[answers.indexOf(a)];
        const card = document.createElement('div');
        card.className = 'question-card';
        let optsHtml = '';
        q.options.forEach((opt, i) => {
            let cls = '';
            if (i === q.answer) cls = 'correct';
            else if (i === a.selected) cls = 'wrong';
            optsHtml += `<button class="option-btn ${cls}" disabled>${opt}</button>`;
        });
        card.innerHTML = `
            <span class="cat-badge cat-${q.category}">${q.category}</span>
            <h2>${q.question}</h2>
            <div class="options">${optsHtml}</div>
            <div class="explanation" style="display:block;">${q.explanation}</div>
        `;
        section.appendChild(card);
    });

    section.scrollIntoView({ behavior: 'smooth' });
}
</script>
@endsection
