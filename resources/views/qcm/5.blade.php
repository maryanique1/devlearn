@extends('layouts.app')
@section('title', 'QCM - Pratique Professionnelle')

@section('styles')
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: var(--bg-main); color: var(--text-main); min-height: 100vh; }
        .container { overflow-wrap: break-word; max-width: 800px; margin: 0 auto; padding: 30px 20px; }
        h1 { text-align: center; margin-bottom: 10px; color: #896f3d; }
        .subtitle { text-align: center; margin-bottom: 30px; }
        .progress-bar { background: var(--bg-card); border-radius: 20px; height: 12px; margin-bottom: 25px; overflow: hidden; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, #896f3d, #1a293f); border-radius: 20px; transition: width 0.4s ease; }
        .progress-text { text-align: center; font-size: 14px; margin-bottom: 15px; }
        .timer { text-align: center; font-size: 20px; font-weight: bold; margin-bottom: 15px; font-family: 'Consolas', monospace; }
        .question-card { background: var(--bg-card); border-radius: 12px; padding: 30px; margin-bottom: 20px; }
        .category-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; margin-bottom: 15px; text-transform: uppercase; }
        .cat-html { background: #e44d26; }
        .cat-css { background: #264de4; }
        .cat-javascript { background: #f0db4f; color: #333; }
        .cat-sql { background: #00758f; }
        .cat-php { background: #777bb4; }
        .cat-mysql { background: #00758f; }
        .question-text { font-size: 18px; line-height: 1.6; margin-bottom: 20px; }
        .question-text code { background: rgba(20,81,142,0.08); padding: 2px 8px; border-radius: 4px; font-family: 'Consolas', monospace; font-size: 15px; color: #14518e; }
        .code-block { background: var(--bg-code); border: 1px solid var(--border-subtle); border-radius: 8px; padding: 15px; margin: 15px 0; font-family: 'Consolas', monospace; font-size: 14px; line-height: 1.6; overflow-x: auto; max-width: 100%; white-space: pre; color: var(--text-main); }
        .options { list-style: none; }
        .options li { background: var(--bg-input); border: 2px solid transparent; border-radius: 8px; padding: 14px 18px; margin-bottom: 10px; cursor: pointer; transition: all 0.2s; font-size: 15px; color: var(--text-main); }
        .options li:hover { border-color: #896f3d; background: rgba(0,100,200,0.08); }
        .options li.selected { border-color: #896f3d; background: rgba(137,111,61,0.12); }
        .options li.correct { border-color: #27ae60; background: rgba(39,174,96,0.15); }
        .options li.wrong { border-color: #e74c3c; background: rgba(231,76,60,0.15); }
        .options li.disabled { cursor: default; opacity: 0.7; }
        .options li.disabled.correct { opacity: 1; }
        .explanation { margin-top: 15px; padding: 15px; border-radius: 8px; background: var(--bg-code); border-left: 4px solid #896f3d; font-size: 14px; line-height: 1.6; display: none; }
        .btn { display: inline-block; padding: 12px 30px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: background 0.2s; }
        .btn-primary { background: #896f3d; color: var(--text-main); }
        .btn-primary:hover { background: #6d5830; }
        .btn-primary:disabled { background: #555; cursor: not-allowed; }
        .btn-restart { background: var(--bg-input); color: var(--text-main); }
        .btn-restart:hover { background: #1a4a80; }
        .btn-container { text-align: center; margin-top: 20px; }
        .results { display: none; }
        .score-circle { width: 180px; height: 180px; border-radius: 50%; margin: 20px auto; display: flex; flex-direction: column; align-items: center; justify-content: center; font-size: 48px; font-weight: bold; }
        .score-circle .label { font-size: 14px; font-weight: normal; }
        .level-excellent { background: linear-gradient(135deg, #1a3e2a, #27ae60); color: #27ae60; }
        .level-good { background: linear-gradient(135deg, #1a3e3e, #2980b9); color: #2980b9; }
        .level-average { background: linear-gradient(135deg, #3e3a1a, #f39c12); color: #f39c12; }
        .level-weak { background: linear-gradient(135deg, #3e1a1a, #e74c3c); color: #e74c3c; }
        .level-message { text-align: center; font-size: 22px; font-weight: bold; margin: 15px 0; }
        .level-detail { text-align: center; margin-bottom: 30px; line-height: 1.6; }
        .cat-scores { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 15px; margin: 25px 0; }
        .cat-score-card { background: var(--bg-card); border-radius: 10px; padding: 15px; text-align: center; }
        .cat-score-card .cat-name { font-size: 13px; font-weight: bold; text-transform: uppercase; margin-bottom: 8px; }
        .cat-score-card .cat-pct { font-size: 28px; font-weight: bold; }
        .cat-score-card .cat-detail { font-size: 12px; margin-top: 4px; }
        .start-screen { overflow-wrap: break-word; text-align: center; padding: 40px 20px; }
        .start-screen p { margin: 15px 0; line-height: 1.6; }
        .tech-tags { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; margin: 20px 0; }
        .tech-tags span { padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: bold; }
        @media (max-width: 768px) {
            .container { padding: 20px 14px !important; } .question-card { padding: 20px !important; } .start-screen { padding: 24px 14px !important; } .question-text { font-size: 16px !important; } .options li { padding: 12px 14px !important; font-size: 14px !important; } .code-block { font-size: 12px !important; padding: 12px !important; } .btn { padding: 10px 24px !important; font-size: 14px !important; } .cat-scores { grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)) !important; } .score-circle { width: 140px !important; height: 140px !important; font-size: 36px !important; }
        }
        @media (max-width: 480px) {
            .container { padding: 14px 10px !important; } .question-card { padding: 16px !important; } .question-text { font-size: 15px !important; } .options li { padding: 10px 12px !important; font-size: 13px !important; } .code-block { font-size: 11px !important; padding: 10px !important; } .category-badge { font-size: 10px !important; padding: 3px 10px !important; } .progress-text { font-size: 12px !important; } .timer { font-size: 16px !important; } .level-message { font-size: 18px !important; } .level-detail { font-size: 13px !important; } .score-circle { width: 120px !important; height: 120px !important; font-size: 30px !important; } .cat-scores { grid-template-columns: 1fr 1fr !important; gap: 10px !important; } .cat-score-card { padding: 10px !important; } .cat-score-card .cat-pct { font-size: 20px !important; } h1 { font-size: 24px !important; } .subtitle { font-size: 13px !important; }
        }
@endsection

@section('content')
<div class="container">
    <h1>QCM Pratique Professionnelle</h1>
    <p class="subtitle">Examen Blanc de Licence</p>

    <div id="start-screen" class="start-screen">
        <p>Epreuve de pratique professionnelle couvrant :</p>
        <div class="tech-tags">
            <span class="category-badge cat-php">PHP</span>
            <span class="category-badge cat-html">HTML</span>
            <span class="category-badge cat-css">CSS</span>
            <span class="category-badge cat-sql">SQL</span>
        </div>
        <p>40 questions &bull; Duree 45 min &bull; Resultat detaille a la fin</p>
        <div class="btn-container" style="margin-top:30px">
            <button class="btn btn-primary" onclick="startQuiz()">Commencer le QCM</button>
        </div>
    </div>

    <div id="quiz-area" style="display:none">
        <div class="progress-text" id="progress-text"></div>
        <div class="progress-bar"><div class="progress-fill" id="progress-fill"></div></div>
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
    {category:"PHP",question:"Quelle est la bonne facon de demarrer un bloc PHP ?",options:["<code>&lt;php&gt;</code>","<code>&lt;?php</code>","<code>&lt;%</code>","<code>&lt;?</code>"],answer:1,explanation:"<code>&lt;?php</code> est la balise d'ouverture standard et recommandee pour demarrer un bloc PHP."},
    {category:"PHP",question:"En PHP, quelle fonction affiche du texte tout en permettant le HTML ?",options:["<code>print_r()</code>","<code>printf()</code>","<code>echo</code>","<code>display()</code>"],answer:2,explanation:"<code>echo</code> affiche du texte brut ou du HTML. <code>print_r()</code> est plutot utilise pour afficher des tableaux."},
    {category:"PHP",question:"Comment declarer une variable en PHP ?",options:["<code>$variable = 5;</code>","<code>variable = 5;</code>","<code>var variable = 5;</code>","<code>let variable = 5;</code>"],answer:0,explanation:"En PHP, les variables commencent toujours par le signe <code>$</code> suivi du nom de la variable."},
    {category:"PHP",question:"Que fait <code>isset($_POST['nom'])</code> ?",options:["Verifie si le champ 'nom' existe et n'est pas null","Supprime la variable 'nom'","Affiche la valeur de 'nom'","Convertit 'nom' en chaine"],answer:0,explanation:"<code>isset()</code> verifie qu'une variable existe et n'est pas <code>NULL</code>."},
    {category:"PHP",question:"Comment inclure un fichier PHP de facon a provoquer une erreur fatale s'il est manquant ?",options:["<code>include('fichier.php');</code>","<code>require('fichier.php');</code>","<code>import('fichier.php');</code>","<code>include_once('fichier.php');</code>"],answer:1,explanation:"<code>require()</code> provoque une erreur fatale si le fichier est introuvable, contrairement a <code>include()</code> qui emet un simple avertissement."},
    {category:"PHP",question:"Quelle superglobale contient les donnees d'un formulaire envoye en POST ?",options:["<code>$_GET</code>","<code>$_REQUEST</code>","<code>$_POST</code>","<code>$_SERVER</code>"],answer:2,explanation:"<code>$_POST</code> contient les donnees envoyees via la methode HTTP POST d'un formulaire."},
    {category:"PHP",question:"Quelle fonction PHP permet de supprimer une variable ?",options:["<code>delete($var);</code>","<code>remove($var);</code>","<code>unset($var);</code>","<code>free($var);</code>"],answer:2,explanation:"<code>unset()</code> detruit une variable et libere la memoire associee."},
    {category:"PHP",question:"Comment definir une constante en PHP ?",options:["<code>const MA_CONSTANTE = 10;</code>","<code>define('MA_CONSTANTE', 10);</code>","<code>$MA_CONSTANTE = 10;</code>","a et b sont correctes"],answer:3,explanation:"En PHP, on peut definir une constante avec <code>const</code> ou <code>define()</code>. Les deux sont valides."},
    {category:"PHP",question:"Quelle fonction retourne la longueur d'une chaine ?",options:["<code>count($chaine)</code>","<code>str_len($chaine)</code>","<code>strlen($chaine)</code>","<code>size($chaine)</code>"],answer:2,explanation:"<code>strlen()</code> retourne le nombre de caracteres d'une chaine. <code>count()</code> est pour les tableaux."},
    {category:"PHP",question:"En PHP, que signifie <code>===</code> ?",options:["Affectation","Egalite en valeur seulement","Egalite en valeur et en type","Different"],answer:2,explanation:"L'operateur <code>===</code> compare a la fois la valeur ET le type. <code>==</code> compare uniquement la valeur."},
    {category:"HTML",question:"Quelle balise HTML5 est utilisee pour le contenu principal unique d'une page ?",options:["<code>&lt;main&gt;</code>","<code>&lt;section&gt;</code>","<code>&lt;div&gt;</code>","<code>&lt;article&gt;</code>"],answer:0,explanation:"<code>&lt;main&gt;</code> represente le contenu principal et unique de la page."},
    {category:"CSS",question:"Comment appliquer un style CSS directement a un element ?",options:["<code>&lt;style&gt;</code>","<code>class=\"ma_classe\"</code>","<code>id=\"mon_id\"</code>","<code>style=\"color:red;\"</code>"],answer:3,explanation:"L'attribut <code>style</code> applique du CSS inline directement sur l'element HTML."},
    {category:"CSS",question:"En Bootstrap, quelle classe cree un conteneur responsive avec marges laterales ?",options:["<code>.container-fluid</code>","<code>.container</code>","<code>.row</code>","<code>.col</code>"],answer:1,explanation:"<code>.container</code> cree un conteneur centre avec des marges laterales automatiques."},
    {category:"HTML",question:"Quelle balise lie une feuille de style externe ?",options:["<code>&lt;css href=\"style.css\"&gt;</code>","<code>&lt;link rel=\"stylesheet\" href=\"style.css\"&gt;</code>","<code>&lt;style src=\"style.css\"&gt;</code>","<code>&lt;script src=\"style.css\"&gt;</code>"],answer:1,explanation:"<code>&lt;link rel=\"stylesheet\" href=\"...\"&gt;</code> est la balise standard pour inclure une feuille CSS externe."},
    {category:"CSS",question:"Quelle propriete CSS definit la largeur d'un element ?",options:["<code>width</code>","<code>size</code>","<code>max-width</code>","<code>dimension</code>"],answer:0,explanation:"<code>width</code> definit la largeur d'un element."},
    {category:"HTML",question:"Quel attribut HTML rend un champ de formulaire obligatoire ?",options:["<code>required</code>","<code>mandatory</code>","<code>validate</code>","<code>obligatory</code>"],answer:0,explanation:"L'attribut <code>required</code> empeche l'envoi du formulaire si le champ est vide."},
    {category:"HTML",question:"En HTML, comment creer une liste deroulante ?",options:["<code>&lt;select&gt;</code> avec <code>&lt;option&gt;</code>","<code>&lt;dropdown&gt;</code>","<code>&lt;list&gt;</code>","<code>&lt;input type=\"dropdown\"&gt;</code>"],answer:0,explanation:"On utilise <code>&lt;select&gt;</code> comme conteneur et <code>&lt;option&gt;</code> pour chaque choix."},
    {category:"HTML",question:"Quelle balise affiche une image ?",options:["<code>&lt;img src=\"image.jpg\"&gt;</code>","<code>&lt;image src=\"image.jpg\"&gt;</code>","<code>&lt;picture src=\"image.jpg\"&gt;</code>","<code>&lt;src img=\"image.jpg\"&gt;</code>"],answer:0,explanation:"<code>&lt;img&gt;</code> est la balise standard pour inserer une image avec l'attribut <code>src</code>."},
    {category:"CSS",question:"En CSS, quelle unite est relative a la taille de police du parent ?",options:["<code>px</code>","<code>pt</code>","<code>em</code>","<code>cm</code>"],answer:2,explanation:"<code>em</code> est relatif a la taille de police de l'element parent. <code>rem</code> est relatif a la racine."},
    {category:"CSS",question:"Quelle classe Bootstrap aligne le texte a droite ?",options:["<code>.text-right</code>","<code>.align-right</code>","<code>.text-end</code>","<code>.float-right</code>"],answer:2,explanation:"En Bootstrap 5, <code>.text-end</code> remplace <code>.text-right</code> pour le support RTL."},
    {category:"SQL",question:"Quelle commande SQL selectionne des donnees ?",options:["<code>SELECT</code>","<code>EXTRACT</code>","<code>GET</code>","<code>RETRIEVE</code>"],answer:0,explanation:"<code>SELECT</code> est la commande fondamentale pour lire des donnees en SQL."},
    {category:"SQL",question:"En MySQL, quelle instruction ajoute une ligne ?",options:["<code>ADD INTO</code>","<code>INSERT INTO</code>","<code>CREATE ROW</code>","<code>NEW ROW</code>"],answer:1,explanation:"<code>INSERT INTO table (colonnes) VALUES (valeurs)</code> ajoute une nouvelle ligne."},
    {category:"SQL",question:"Quel type SQL stocke une date (annee, mois, jour) ?",options:["<code>DATETIME</code>","<code>DATE</code>","<code>TIMESTAMP</code>","<code>TIME</code>"],answer:1,explanation:"<code>DATE</code> stocke uniquement la date (AAAA-MM-JJ). <code>DATETIME</code> inclut aussi l'heure."},
    {category:"SQL",question:"Comment lier deux tables en SQL ?",options:["<code>JOIN</code>","<code>LINK</code>","<code>CONNECT</code>","<code>ASSOCIATE</code>"],answer:0,explanation:"<code>JOIN</code> permet de combiner les lignes de deux tables selon une condition de liaison."},
    {category:"SQL",question:"Quelle clause filtre les resultats apres un <code>GROUP BY</code> ?",options:["<code>WHERE</code>","<code>HAVING</code>","<code>FILTER</code>","<code>CONDITION</code>"],answer:1,explanation:"<code>HAVING</code> filtre les groupes apres <code>GROUP BY</code>. <code>WHERE</code> filtre avant le regroupement."},
    {category:"PHP",question:"Que fait <code>PDO::prepare()</code> en PHP ?",options:["Execute immediatement une requete","Prepare une requete SQL pour eviter les injections","Connecte a la base de donnees","Ferme la connexion"],answer:1,explanation:"<code>PDO::prepare()</code> prepare une requete SQL parametree, protégeant contre les injections SQL."},
    {category:"PHP",question:"Quelle fonction PHP execute une requete preparee avec PDO ?",options:["<code>$stmt-&gt;run()</code>","<code>$stmt-&gt;execute()</code>","<code>$stmt-&gt;query()</code>","<code>$stmt-&gt;fetch()</code>"],answer:1,explanation:"<code>$stmt-&gt;execute()</code> execute la requete preparee. <code>fetch()</code> recupere les resultats."},
    {category:"SQL",question:"En SQL, que signifie <code>PRIMARY KEY</code> ?",options:["Cle etrangere","Index unique identifiant chaque ligne","Cle de tri","Cle de jointure"],answer:1,explanation:"La <code>PRIMARY KEY</code> est un index unique identifiant chaque enregistrement dans une table."},
    {category:"SQL",question:"Quelle commande supprime une table entiere ?",options:["<code>DELETE TABLE</code>","<code>DROP TABLE</code>","<code>REMOVE TABLE</code>","<code>TRUNCATE TABLE</code>"],answer:1,explanation:"<code>DROP TABLE</code> supprime completement la table. <code>TRUNCATE</code> vide les donnees mais garde la structure."},
    {category:"PHP",question:"Quelle fonction PDO recupere une ligne sous forme de tableau associatif ?",options:["<code>fetch(PDO::FETCH_OBJ)</code>","<code>fetch(PDO::FETCH_ASSOC)</code>","<code>fetchAll()</code>","<code>fetchColumn()</code>"],answer:1,explanation:"<code>fetch(PDO::FETCH_ASSOC)</code> retourne la ligne avec les noms de colonnes comme cles."},
    {category:"PHP",question:"Comment proteger une sortie HTML contre les failles XSS ?",options:["<code>addslashes()</code>","<code>htmlspecialchars($texte, ENT_QUOTES, 'UTF-8')</code>","<code>strip_tags()</code>","<code>mysql_real_escape_string()</code>"],answer:1,explanation:"<code>htmlspecialchars()</code> convertit les caracteres speciaux HTML en entites, empechant l'execution de code malveillant."},
    {category:"PHP",question:"Quelle methode est la plus sure pour eviter les injections SQL ?",options:["<code>addslashes()</code>","Requetes preparees (PDO ou MySQLi)","<code>htmlspecialchars()</code>","<code>trim()</code>"],answer:1,explanation:"Les requetes preparees separent le code SQL des donnees, rendant l'injection impossible."},
    {category:"PHP",question:"Comment demarrer une session PHP ?",options:["<code>session_start()</code>","<code>start_session()</code>","<code>$_SESSION-&gt;start()</code>","<code>session_open()</code>"],answer:0,explanation:"<code>session_start()</code> doit etre appelee au debut du script, avant tout output HTML."},
    {category:"PHP",question:"Comment supprimer une variable de session specifique ?",options:["<code>unset($_SESSION['nom'])</code>","<code>session_destroy()</code>","<code>delete_session('nom')</code>","<code>$_SESSION['nom'] = null</code>"],answer:0,explanation:"<code>unset($_SESSION['nom'])</code> supprime uniquement cette variable. <code>session_destroy()</code> detruit toute la session."},
    {category:"PHP",question:"Quelle fonction cree un cookie valable 1 heure ?",options:["<code>setcookie('nom', 'valeur', time()+3600)</code>","<code>cookie('nom', 'valeur', 3600)</code>","<code>$_COOKIE['nom'] = 'valeur'</code>","<code>create_cookie('nom', 'valeur', 3600)</code>"],answer:0,explanation:"<code>setcookie()</code> avec <code>time()+3600</code> cree un cookie expirant dans 1 heure."},
    {category:"PHP",question:"Comment recuperer des donnees JSON envoyees en AJAX en PHP ?",options:["<code>$_POST</code>","<code>file_get_contents('php://input')</code>","<code>$_GET</code>","<code>$_REQUEST</code>"],answer:1,explanation:"<code>file_get_contents('php://input')</code> lit le corps brut de la requete, necessaire pour le JSON en AJAX."},
    {category:"PHP",question:"Quelle fonction PHP lit tout un fichier texte en une chaine ?",options:["<code>fread()</code>","<code>file_get_contents()</code>","<code>read_file()</code>","<code>fopen()</code>"],answer:1,explanation:"<code>file_get_contents()</code> lit tout le contenu d'un fichier et le retourne comme chaine."},
    {category:"PHP",question:"Comment rediriger l'utilisateur vers une autre page sans HTML ?",options:["<code>header('Location: page.php'); exit();</code>","<code>redirect('page.php');</code>","<code>echo '&lt;meta http-equiv=\"refresh\"&gt;';</code>","<code>goto('page.php');</code>"],answer:0,explanation:"<code>header('Location: ...')</code> envoie un en-tete HTTP de redirection. <code>exit()</code> arrete l'execution."},
    {category:"PHP",question:"Quelle superglobale contient les informations sur le serveur et la requete ?",options:["<code>$_ENV</code>","<code>$_SESSION</code>","<code>$_SERVER</code>","<code>$_FILES</code>"],answer:2,explanation:"<code>$_SERVER</code> contient les en-tetes, chemins et informations du serveur web."},
    {category:"PHP",question:"Quelle est la bonne facon de verifier si un fichier a ete uploade ?",options:["<code>isset($_FILES['mon_fichier'])</code>","<code>file_exists($_FILES['mon_fichier'])</code>","<code>is_uploaded_file($_FILES['mon_fichier']['tmp_name'])</code>","<code>upload_check($_FILES['mon_fichier'])</code>"],answer:2,explanation:"<code>is_uploaded_file()</code> verifie qu'un fichier a bien ete envoye via HTTP POST, important pour la securite."}
];

let currentQuestion = 0, score = 0, selectedOption = -1, answered = false, shuffledQuestions = [], answers = [];
let timerInterval = null, timerSeconds = 0;

function startTimer() { timerSeconds = 0; clearInterval(timerInterval); timerInterval = setInterval(() => { timerSeconds++; const m = String(Math.floor(timerSeconds/60)).padStart(2,'0'); const s = String(timerSeconds%60).padStart(2,'0'); document.getElementById('timer').textContent = m+':'+s; }, 1000); }
function stopTimer() { clearInterval(timerInterval); }
function shuffle(arr) { const a=[...arr]; for(let i=a.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));[a[i],a[j]]=[a[j],a[i]];} return a; }

function startQuiz() {
    shuffledQuestions = shuffle(questions); currentQuestion = 0; score = 0; answers = [];
    document.getElementById('start-screen').style.display = 'none';
    document.getElementById('quiz-area').style.display = 'block';
    document.getElementById('results').style.display = 'none';
    showQuestion(); startTimer();
}

function showQuestion() {
    selectedOption = -1; answered = false;
    const q = shuffledQuestions[currentQuestion], total = shuffledQuestions.length;
    document.getElementById('progress-text').textContent = `Question ${currentQuestion+1} / ${total}`;
    document.getElementById('progress-fill').style.width = ((currentQuestion+1)/total*100)+'%';
    document.getElementById('btn-validate').style.display = 'inline-block';
    document.getElementById('btn-validate').disabled = true;
    document.getElementById('btn-next').style.display = 'none';
    const catClass = 'cat-'+q.category.toLowerCase();
    let html = `<span class="category-badge ${catClass}">${q.category}</span>`;
    html += `<div class="question-text">${q.question}</div><ul class="options">`;
    q.options.forEach((opt,i) => { html += `<li onclick="selectOption(${i})" id="opt-${i}">${opt}</li>`; });
    html += `</ul><div class="explanation" id="explanation">${q.explanation}</div>`;
    document.getElementById('question-card').innerHTML = html;
}

function selectOption(i) { if(answered) return; selectedOption=i; document.getElementById('btn-validate').disabled=false; document.querySelectorAll('.options li').forEach((el,idx)=>{el.classList.toggle('selected',idx===i);}); }

function validateAnswer() {
    if(selectedOption===-1||answered) return; answered=true;
    const q=shuffledQuestions[currentQuestion], correct=q.answer, isCorrect=selectedOption===correct;
    if(isCorrect) score++; answers.push({question:q,selected:selectedOption,correct:isCorrect});
    document.querySelectorAll('.options li').forEach((el,idx)=>{el.classList.add('disabled');if(idx===correct)el.classList.add('correct');if(idx===selectedOption&&!isCorrect)el.classList.add('wrong');});
    document.getElementById('explanation').style.display='block';
    document.getElementById('btn-validate').style.display='none';
    if(currentQuestion<shuffledQuestions.length-1){document.getElementById('btn-next').style.display='inline-block';}else{setTimeout(showResults,800);}
}

function nextQuestion() { currentQuestion++; showQuestion(); }

function showResults() {
    stopTimer(); document.getElementById('quiz-area').style.display='none';
    const resultsDiv=document.getElementById('results'); resultsDiv.style.display='block';
    const total=shuffledQuestions.length, pct=Math.round(score/total*100);
    let level,levelClass,message,detail;
    if(pct>=80){level='Excellent';levelClass='level-excellent';message='Excellent ! Vous maitrisez bien le developpement web.';detail='Vous avez une solide base dans les technologies web.';}
    else if(pct>=60){level='Bien';levelClass='level-good';message='Bon niveau ! Quelques points a approfondir.';detail='Revoyez les questions manquees pour combler vos lacunes.';}
    else if(pct>=40){level='Moyen';levelClass='level-average';message='Niveau moyen. Il y a du travail a faire.';detail='Concentrez-vous sur les categories ou vous avez le plus de difficultes.';}
    else{level='A renforcer';levelClass='level-weak';message='Niveau debutant. Ne vous decouragez pas !';detail='Reprenez les bases de chaque technologie.';}

    const cats=['PHP','HTML','CSS','SQL'];
    const catStats={}; cats.forEach(c=>catStats[c]={total:0,correct:0});
    answers.forEach(a=>{catStats[a.question.category].total++;if(a.correct)catStats[a.question.category].correct++;});

    let catHtml='<div class="cat-scores">';
    cats.forEach(c=>{const s=catStats[c];const p=s.total>0?Math.round(s.correct/s.total*100):0;let color='#e74c3c';if(p>=80)color='#27ae60';else if(p>=60)color='#2980b9';else if(p>=40)color='#f39c12';const cc='cat-'+c.toLowerCase();catHtml+=`<div class="cat-score-card"><div class="cat-name"><span class="category-badge ${cc}">${c}</span></div><div class="cat-pct" style="color:${color}">${p}%</div><div class="cat-detail">${s.correct}/${s.total} correct${s.correct>1?'s':''}</div></div>`;});
    catHtml+='</div>';

    let weakest=null,weakPct=101;
    cats.forEach(c=>{const s=catStats[c];const p=s.total>0?(s.correct/s.total*100):0;if(p<weakPct){weakPct=p;weakest=c;}});
    let advice='';if(weakPct<60&&weakest){advice=`<p style="text-align:center;color:#896f3d;margin-top:10px">Point faible : <strong>${weakest}</strong> — concentrez vos revisions sur cette technologie.</p>`;}

    resultsDiv.innerHTML=`<div class="score-circle ${levelClass}">${pct}%<span class="label">${score}/${total}</span></div><div class="level-message">${message}</div><div class="level-detail">${detail}</div>${catHtml}${advice}<div class="btn-container" style="margin-top:30px"><button class="btn btn-primary" onclick="startQuiz()">Recommencer</button><button class="btn btn-restart" onclick="retryFailed()" style="margin-left:10px">Retravailler mes erreurs</button><button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">Accueil</button></div>`;

    fetch('/api/scores',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content},body:JSON.stringify({qcm_name:'qcm5',score:score,total:total,percentage:pct,duration_seconds:timerSeconds})});
}

function retryFailed() {
    const failed=answers.filter(a=>!a.correct);if(failed.length===0){alert('Aucune erreur ! Bravo !');return;}
    shuffledQuestions=failed.map(f=>Object.assign({},f.question));currentQuestion=0;score=0;answers=[];
    document.getElementById('start-screen').style.display='none';document.getElementById('quiz-area').style.display='block';document.getElementById('results').style.display='none';showQuestion();startTimer();
}
</script>
@endsection
