@extends('layouts.app')
@section('title', 'QCM - Examen National SIL 2023')

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
        .cat-html { background: #e44d26; } .cat-css { background: #264de4; } .cat-javascript { background: #f0db4f; color: #333; } .cat-sql { background: #00758f; } .cat-php { background: #777bb4; } .cat-mysql { background: #00758f; }
        .question-text { font-size: 18px; line-height: 1.6; margin-bottom: 20px; }
        .question-text code { background: rgba(20,81,142,0.08); padding: 2px 8px; border-radius: 4px; font-family: 'Consolas', monospace; font-size: 15px; color: #14518e; }
        .code-block { background: var(--bg-code); border: 1px solid var(--border-subtle); border-radius: 8px; padding: 15px; margin: 15px 0; font-family: 'Consolas', monospace; font-size: 14px; line-height: 1.6; overflow-x: auto; max-width: 100%; white-space: pre; color: var(--text-main); }
        .options { list-style: none; }
        .options li { background: var(--bg-input); border: 2px solid transparent; border-radius: 8px; padding: 14px 18px; margin-bottom: 10px; cursor: pointer; transition: all 0.2s; font-size: 15px; color: var(--text-main); }
        .options li:hover { border-color: #896f3d; background: rgba(0,100,200,0.08); }
        .options li.selected { border-color: #896f3d; background: rgba(137,111,61,0.12); }
        .options li.correct { border-color: #27ae60; background: rgba(39,174,96,0.15); }
        .options li.wrong { border-color: #e74c3c; background: rgba(231,76,60,0.15); }
        .options li.disabled { cursor: default; opacity: 0.7; } .options li.disabled.correct { opacity: 1; }
        .explanation { margin-top: 15px; padding: 15px; border-radius: 8px; background: var(--bg-code); border-left: 4px solid #896f3d; font-size: 14px; line-height: 1.6; display: none; }
        .btn { display: inline-block; padding: 12px 30px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: background 0.2s; }
        .btn-primary { background: #896f3d; color: var(--text-main); } .btn-primary:hover { background: #6d5830; } .btn-primary:disabled { background: #555; cursor: not-allowed; }
        .btn-restart { background: var(--bg-input); color: var(--text-main); } .btn-restart:hover { background: #1a4a80; }
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
        @media (max-width: 768px) { .container { padding: 20px 14px !important; } .question-card { padding: 20px !important; } .start-screen { padding: 24px 14px !important; } .question-text { font-size: 16px !important; } .options li { padding: 12px 14px !important; font-size: 14px !important; } .btn { padding: 10px 24px !important; font-size: 14px !important; } .cat-scores { grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)) !important; } .score-circle { width: 140px !important; height: 140px !important; font-size: 36px !important; } }
        @media (max-width: 480px) { .container { padding: 14px 10px !important; } .question-card { padding: 16px !important; } .question-text { font-size: 15px !important; } .options li { padding: 10px 12px !important; font-size: 13px !important; } .category-badge { font-size: 10px !important; padding: 3px 10px !important; } .progress-text { font-size: 12px !important; } .timer { font-size: 16px !important; } .level-message { font-size: 18px !important; } .score-circle { width: 120px !important; height: 120px !important; font-size: 30px !important; } .cat-scores { grid-template-columns: 1fr 1fr !important; gap: 10px !important; } .cat-score-card { padding: 10px !important; } .cat-score-card .cat-pct { font-size: 20px !important; } h1 { font-size: 24px !important; } .subtitle { font-size: 13px !important; } }
@endsection

@section('content')
<div class="container">
    <h1>QCM Pratique Professionnelle</h1>
    <p class="subtitle">Examen National de Licence SIL 2023</p>

    <div id="start-screen" class="start-screen">
        <p>Epreuve de pratique professionnelle couvrant :</p>
        <div class="tech-tags">
            <span class="category-badge cat-html">HTML</span>
            <span class="category-badge cat-css">CSS</span>
            <span class="category-badge cat-javascript">JavaScript</span>
            <span class="category-badge cat-php">PHP</span>
            <span class="category-badge cat-mysql">MySQL</span>
        </div>
        <p>40 questions &bull; Duree 45 min &bull; Resultat detaille a la fin</p>
        <div class="btn-container" style="margin-top:30px"><button class="btn btn-primary" onclick="startQuiz()">Commencer le QCM</button></div>
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
    {category:"CSS",question:"En CSS, \"em\" represente :",options:["12 pixels","12 points","4.2 mm","La largeur d'une majuscule M"],answer:3,explanation:"L'unite <code>em</code> est historiquement basee sur la largeur de la lettre M majuscule."},
    {category:"HTML",question:"Comment fusionner les cellules horizontales d'un tableau ?",options:["En supprimant les <code>&lt;tr&gt;</code>","Avec <code>&lt;hr&gt;</code>","En supprimant les <code>&lt;td&gt;</code>","Avec l'attribut <code>colspan</code>"],answer:3,explanation:"L'attribut <code>colspan</code> sur un <code>&lt;td&gt;</code> fusionne plusieurs cellules horizontalement."},
    {category:"CSS",question:"La regle <code>p#ville { ... }</code> s'applique :",options:["Aux <code>&lt;p id=\"ville\"&gt;</code>","Aux <code>&lt;p class=\"ville\"&gt;</code>","Aux <code>&lt;p name=\"ville\"&gt;</code>","Aux paragraphes contenant un span ville"],answer:0,explanation:"Le selecteur <code>#</code> cible un element par son <code>id</code>."},
    {category:"CSS",question:"<code>@font-face</code> en CSS permet :",options:["De modifier l'espacement d'une fonte","D'utiliser une fonte non presente chez l'internaute","De changer le style d'une fonte","De changer la taille d'une fonte"],answer:1,explanation:"<code>@font-face</code> charge des polices personnalisees non installees sur l'ordinateur de l'utilisateur."},
    {category:"HTML",question:"Que fait <code>&lt;input type=\"submit\" value=\"Bonjour\"&gt;</code> ?",options:["Place la valeur dans une variable","Envoie la valeur via un formulaire","Affiche une zone de saisie avec 'Bonjour'","Affiche un bouton 'Bonjour' qui envoie le formulaire"],answer:3,explanation:"<code>type=\"submit\"</code> cree un bouton d'envoi. <code>value</code> definit le texte du bouton."},
    {category:"CSS",question:"Quelle est la facon recommandee pour centrer un bloc horizontalement ?",options:["La balise <code>&lt;center&gt;</code>","<code>position: center;</code>","<code>margin-left: auto; margin-right: auto;</code>","L'attribut <code>align=\"center\"</code>"],answer:2,explanation:"<code>margin: 0 auto;</code> est la methode CSS standard pour centrer un bloc."},
    {category:"CSS",question:"Si z-index vaut 1 pour A et 4 pour B, A et B superposes, alors :",options:["L'ordre de tabulation est B puis A","B apparait integralement","A apparait integralement","L'ordre de tabulation est A puis B"],answer:1,explanation:"Un <code>z-index</code> plus eleve place l'element au-dessus. B (4) apparait au-dessus de A (1)."},
    {category:"HTML",question:"Comment indiquer a un robot de ne pas indexer une page mais de suivre ses liens ?",options:["<code>&lt;meta name=\"spider\" index=\"none\"&gt;</code>","<code>&lt;meta name=\"robots\" index=\"none\"&gt;</code>","<code>&lt;meta name=\"robots\" content=\"noindex,follow\"&gt;</code>","<code>&lt;meta name=\"robots\" content=\"none\"&gt;</code>"],answer:2,explanation:"<code>content=\"noindex,follow\"</code> dit au robot de ne pas indexer mais de suivre les liens."},
    {category:"HTML",question:"Comment inclure une feuille de style dans une page HTML5 ?",options:["<code>&lt;link type=\"text/css\" href=\"f.css\"&gt;</code>","<code>&lt;link rel=\"stylesheet\" src=\"f.css\"&gt;</code>","<code>&lt;link src=\"stylesheet\" value=\"f.css\"&gt;</code>","<code>&lt;link rel=\"stylesheet\" href=\"f.css\"&gt;</code>"],answer:3,explanation:"<code>&lt;link rel=\"stylesheet\" href=\"...\"&gt;</code> est la syntaxe correcte en HTML5."},
    {category:"CSS",question:"Comment declarer une feuille de style interne ?",options:["<code>&lt;link href=\"f.css\"&gt;</code>","<code>&lt;style&gt;</code>","<code>&lt;style src=\"text/css\"&gt;</code>","<code>&lt;style rel=\"stylesheet\"&gt;</code>"],answer:1,explanation:"La balise <code>&lt;style&gt;</code> seule suffit en HTML5 pour les styles internes."},
    {category:"JavaScript",question:"La fonction <code>split()</code> divise une chaine selon :",options:["Une condition logique","Des caracteres specifiques","Un nombre de caracteres precis","Ces trois reponses sont possibles"],answer:1,explanation:"<code>split()</code> divise une chaine selon un separateur specifie."},
    {category:"JavaScript",question:"A quoi sert l'operateur <code>===</code> en JavaScript ?",options:["C'est un comparateur logique","A comparer le type et la valeur","A operer une affectation apres comparaison","N'existe pas en Javascript"],answer:1,explanation:"<code>===</code> est l'egalite stricte : compare le type ET la valeur sans conversion."},
    {category:"JavaScript",question:"A quoi sert l'operateur <code>#=</code> en JavaScript ?",options:["A comparer deux pointeurs","C'est un comparateur logique","A comparer type et valeur","N'existe pas en Javascript"],answer:3,explanation:"L'operateur <code>#=</code> n'existe pas en JavaScript."},
    {category:"JavaScript",question:"Avec quoi creer une instance d'un nouvel objet ?",options:["<code>instance</code>","<code>new</code>","<code>this</code>","<code>add</code>"],answer:1,explanation:"Le mot-cle <code>new</code> cree une nouvelle instance d'un objet."},
    {category:"JavaScript",question:"Comment placer \"test\" dans le champ d'ID \"chp1\" sur form1 ?",options:["<code>document.form1.chp1.text = \"test\";</code>","<code>document.form1.chp1.value = \"test\";</code>","<code>window.form1.chp1.text = \"test\";</code>","<code>window.form1.chp1.value = \"test\";</code>"],answer:1,explanation:"La propriete <code>value</code> definit la valeur d'un champ de formulaire."},
    {category:"JavaScript",question:"Quelle propriete identifie la version du navigateur ?",options:["<code>navigator.version</code>","<code>navigator.platform</code>","<code>navigator.appVersion</code>","<code>navigator.userAgent</code>"],answer:2,explanation:"<code>navigator.appVersion</code> retourne la version du navigateur."},
    {category:"JavaScript",question:"<code>parseInt(\"101 dalmatiens\")</code> renvoie :",options:["18","NaN","101","Une erreur"],answer:2,explanation:"<code>parseInt()</code> extrait le nombre entier au debut de la chaine et s'arrete au premier non-numerique."},
    {category:"JavaScript",question:"Comment changer la couleur de \"chp2\" en bleu sur \"form\" ?",options:["<code>document.form.chp2.color = \"blue\";</code>","<code>window.form.chp2.color = \"blue\";</code>","<code>form.document.chp2.style.color = \"blue\";</code>","<code>document.form.chp2.style.color = \"blue\";</code>"],answer:3,explanation:"On utilise la propriete <code>style</code> suivie de la propriete CSS."},
    {category:"JavaScript",question:"Avec onKeyPress, quelle propriete stocke le code de la touche ?",options:["<code>fromCharCode</code>","<code>event.charCode</code>","<code>event.which</code>","<code>KeyAscii</code>"],answer:2,explanation:"<code>event.which</code> retourne le code de la touche pressee."},
    {category:"JavaScript",question:"Comment definir la largeur de l'image \"img1\" a 120 ?",options:["<code>navigator.getElementById(\"img1\").width=\"120\";</code>","<code>document.getElementById(\"img1\").width=\"120\";</code>","<code>document.getElementById(\"img1\").length=\"120\";</code>","<code>navigator.getElementById(\"img1\").length=\"120\";</code>"],answer:1,explanation:"<code>document.getElementById()</code> selectionne l'element, puis on modifie <code>width</code>."},
    {category:"PHP",question:"Quel tableau contient les variables de session ?",options:["<code>$_POST</code>","<code>$_GET</code>","<code>$_SESSION</code>","<code>$_COOKIE</code>"],answer:2,explanation:"<code>$_SESSION</code> est le tableau superglobal des variables de session."},
    {category:"PHP",question:"Le parametre SMTP = localhost dans php.ini indique :",options:["Que mail() utilisera notre machine pour l'envoi","Que mail() utilisera notre machine pour la reception","Que POST utilisera le SMTP pour recevoir","Que POST utilisera notre machine pour recevoir"],answer:0,explanation:"<code>SMTP = localhost</code> configure PHP pour utiliser le serveur SMTP local pour l'envoi d'emails."},
    {category:"PHP",question:"Comment est appele un destructeur en PHP Objet ?",options:["Avec <code>throw()</code>","<code>unset($instance)</code> ou si <code>$instance = NULL</code>","<code>unset($instance)</code> uniquement","Uniquement quand <code>$instance = NULL</code>"],answer:1,explanation:"Le destructeur est appele quand on fait <code>unset()</code> ou quand l'objet n'est plus reference."},
    {category:"PHP",question:"Comment cacher les messages d'erreurs aux utilisateurs ?",options:["<code>set_error()</code>","throw exception","<code>set_error_handler()</code>","Mettre <code>display_errors</code> sur off"],answer:3,explanation:"<code>display_errors = off</code> dans php.ini empeche l'affichage des erreurs en production."},
    {category:"PHP",question:"Que fait <code>stripslashes()</code> ?",options:["Supprime les guillemets","Supprime les antislashs","Ajoute des caracteres d'echappement","Supprime les slashs"],answer:1,explanation:"<code>stripslashes()</code> supprime les antislashs d'une chaine."},
    {category:"HTML",question:"Comment preciser quel script sera lance par le bouton submit ?",options:["<code>&lt;form action=\"page.php\"&gt;</code>","<code>&lt;form script=\"page.php\"&gt;</code>","<code>&lt;form submit=\"page.php\"&gt;</code>","<code>&lt;form type=\"page.php\"&gt;</code>"],answer:0,explanation:"L'attribut <code>action</code> specifie l'URL du script qui recevra les donnees."},
    {category:"PHP",question:"<code>ereg(\"^a\", \"abcdef\")</code> renvoie :",options:["false","Une erreur","bcdef","true"],answer:3,explanation:"<code>ereg()</code> teste si la chaine correspond au motif. <code>^a</code> = commence par 'a', vrai pour 'abcdef'."},
    {category:"PHP",question:"Quelle est l'utilite de <code>mysqli_real_escape_string()</code> ?",options:["Definir un caractere d'echappement","Securiser les requetes SQL","Retirer les caracteres d'echappement","Formater le resultat"],answer:1,explanation:"<code>mysqli_real_escape_string()</code> echappe les caracteres speciaux pour securiser les requetes SQL."},
    {category:"PHP",question:"La fonction <code>getpageheaders()</code> :",options:["Retourne les donnees de l'en-tete HTML","Retourne les donnees de l'en-tete PHP","Retourne les donnees de l'en-tete HTTP","N'existe pas en PHP"],answer:3,explanation:"<code>getpageheaders()</code> n'existe pas en PHP. Les fonctions existantes sont <code>getallheaders()</code> et <code>headers_list()</code>."},
    {category:"PHP",question:"Quelle est l'utilite de <code>var_dump()</code> en PHP Objet ?",options:["Emettre une exception","Visualiser les attributs d'une classe","Debuguer avec un dump memoire","Surcharger une classe"],answer:1,explanation:"<code>var_dump()</code> affiche les informations structurees d'une variable, incluant les attributs des objets."},
    {category:"MySQL",question:"Quelle propriete active la numerotation automatique ?",options:["<code>AUTO_NUM</code>","<code>AUTO_INCREMENT</code>","<code>INCREMENT</code>","<code>NUM_AUTO</code>"],answer:1,explanation:"<code>AUTO_INCREMENT</code> genere automatiquement un numero unique et croissant."},
    {category:"MySQL",question:"Quelle clause pour effectuer des sous-totaux par produits ?",options:["<code>DISTINCT(LibProd)</code>","<code>GROUP BY LibProd</code>","<code>GROUP(LibProd)</code>","<code>HAVING UNIQUE LibProd</code>"],answer:1,explanation:"<code>GROUP BY</code> regroupe les lignes pour appliquer des fonctions d'agregation."},
    {category:"MySQL",question:"Comment modifier le type de MaTable de InnoDB vers MyISAM ?",options:["Impossible de InnoDB vers MyISAM","<code>ALTER TABLE MaTable ENGINE = ISAM</code>","<code>ALTER TABLE MaTable ENGINE = MYISAM</code>","Impossible apres creation"],answer:2,explanation:"<code>ALTER TABLE ... ENGINE = MYISAM</code> change le moteur de stockage."},
    {category:"MySQL",question:"Un declencheur (trigger) est associe a :",options:["Un champ dans une table","Une procedure","Une table","Une base de donnees"],answer:2,explanation:"Un trigger est associe a une table et se declenche lors d'INSERT, UPDATE ou DELETE."},
    {category:"MySQL",question:"<code>SELECT MOD(14, 3)</code> retourne :",options:["1","2","3","4"],answer:1,explanation:"<code>MOD(14, 3)</code> = reste de 14/3 = 2 (14 = 4x3 + 2)."},
    {category:"MySQL",question:"Comment selectionner les emails qui ne sont pas @suffixe.com ?",options:["<code>WHERE champ1 UNLIKE '*@suffixe.com'</code>","<code>WHERE champ1 NOT LIKE '%@suffixe.com'</code>","<code>WHERE champ1 IS NOT 'suffixe.com'</code>","<code>WHERE champ1 &lt;&gt; '*@suffixe.com'</code>"],answer:1,explanation:"<code>NOT LIKE '%@suffixe.com'</code> exclut les valeurs se terminant par @suffixe.com."},
    {category:"MySQL",question:"Comment afficher les lignes dont Titre commence par \"Un\" ?",options:["<code>WHERE titre LIKE 'Un'</code>","<code>WHERE titre = 'Un'</code>","<code>WHERE Titre = 'Un*'</code>","<code>WHERE Titre LIKE 'Un%'</code>"],answer:3,explanation:"<code>LIKE 'Un%'</code> selectionne les valeurs commencant par 'Un'."},
    {category:"MySQL",question:"Que fait <code>SELECT * FROM MaTable LIMIT 5, 10</code> ?",options:["Renvoie les enregistrements 5 a 10","Renvoie les enregistrements 11 a 15","Renvoie les enregistrements 6 a 15","Renvoie les enregistrements 10 a 14"],answer:2,explanation:"<code>LIMIT 5, 10</code> saute les 5 premiers puis renvoie les 10 suivants (lignes 6 a 15)."},
    {category:"MySQL",question:"Comment concatener 3 chaines en MySQL ?",options:["<code>Ch1 + Ch2 + Ch3</code>","<code>Ch1 &amp; Ch2 &amp; Ch3</code>","<code>Ch1 . Ch2 . Ch3</code>","<code>CONCAT(Ch1, Ch2, Ch3)</code>"],answer:3,explanation:"<code>CONCAT()</code> est la fonction MySQL pour concatener des chaines."},
    {category:"MySQL",question:"Que renvoie <code>SELECT SUBSTRING('bonjour', 3, 2)</code> ?",options:["onj","nj","jo","Une erreur"],answer:1,explanation:"<code>SUBSTRING('bonjour', 3, 2)</code> extrait 2 caracteres a partir de la position 3 (1-indexe) : 'nj'."}
];

let currentQuestion=0,score=0,selectedOption=-1,answered=false,shuffledQuestions=[],answers=[];
let timerInterval=null,timerSeconds=0;
function startTimer(){timerSeconds=0;clearInterval(timerInterval);timerInterval=setInterval(()=>{timerSeconds++;const m=String(Math.floor(timerSeconds/60)).padStart(2,'0');const s=String(timerSeconds%60).padStart(2,'0');document.getElementById('timer').textContent=m+':'+s;},1000);}
function stopTimer(){clearInterval(timerInterval);}
function shuffle(arr){const a=[...arr];for(let i=a.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));[a[i],a[j]]=[a[j],a[i]];}return a;}
function startQuiz(){shuffledQuestions=shuffle(questions);currentQuestion=0;score=0;answers=[];document.getElementById('start-screen').style.display='none';document.getElementById('quiz-area').style.display='block';document.getElementById('results').style.display='none';showQuestion();startTimer();}
function showQuestion(){selectedOption=-1;answered=false;const q=shuffledQuestions[currentQuestion],total=shuffledQuestions.length;document.getElementById('progress-text').textContent=`Question ${currentQuestion+1} / ${total}`;document.getElementById('progress-fill').style.width=((currentQuestion+1)/total*100)+'%';document.getElementById('btn-validate').style.display='inline-block';document.getElementById('btn-validate').disabled=true;document.getElementById('btn-next').style.display='none';const catClass='cat-'+q.category.toLowerCase();let html=`<span class="category-badge ${catClass}">${q.category}</span><div class="question-text">${q.question}</div><ul class="options">`;q.options.forEach((opt,i)=>{html+=`<li onclick="selectOption(${i})" id="opt-${i}">${opt}</li>`;});html+=`</ul><div class="explanation" id="explanation">${q.explanation}</div>`;document.getElementById('question-card').innerHTML=html;}
function selectOption(i){if(answered)return;selectedOption=i;document.getElementById('btn-validate').disabled=false;document.querySelectorAll('.options li').forEach((el,idx)=>{el.classList.toggle('selected',idx===i);});}
function validateAnswer(){if(selectedOption===-1||answered)return;answered=true;const q=shuffledQuestions[currentQuestion],correct=q.answer,isCorrect=selectedOption===correct;if(isCorrect)score++;answers.push({question:q,selected:selectedOption,correct:isCorrect});document.querySelectorAll('.options li').forEach((el,idx)=>{el.classList.add('disabled');if(idx===correct)el.classList.add('correct');if(idx===selectedOption&&!isCorrect)el.classList.add('wrong');});document.getElementById('explanation').style.display='block';document.getElementById('btn-validate').style.display='none';if(currentQuestion<shuffledQuestions.length-1){document.getElementById('btn-next').style.display='inline-block';}else{setTimeout(showResults,800);}}
function nextQuestion(){currentQuestion++;showQuestion();}
function showResults(){stopTimer();document.getElementById('quiz-area').style.display='none';const resultsDiv=document.getElementById('results');resultsDiv.style.display='block';const total=shuffledQuestions.length,pct=Math.round(score/total*100);let level,levelClass,message,detail;if(pct>=80){levelClass='level-excellent';message='Excellent ! Vous maitrisez bien ces technologies.';detail='Solide base dans les technologies web.';}else if(pct>=60){levelClass='level-good';message='Bon niveau ! Quelques points a approfondir.';detail='Revoyez les questions manquees.';}else if(pct>=40){levelClass='level-average';message='Niveau moyen. Il y a du travail.';detail='Concentrez-vous sur vos points faibles.';}else{levelClass='level-weak';message='Niveau debutant. Ne vous decouragez pas !';detail='Reprenez les bases de chaque technologie.';}
const cats=['HTML','CSS','JavaScript','PHP','MySQL'];const catStats={};cats.forEach(c=>catStats[c]={total:0,correct:0});answers.forEach(a=>{catStats[a.question.category].total++;if(a.correct)catStats[a.question.category].correct++;});
let catHtml='<div class="cat-scores">';cats.forEach(c=>{const s=catStats[c];const p=s.total>0?Math.round(s.correct/s.total*100):0;let color='#e74c3c';if(p>=80)color='#27ae60';else if(p>=60)color='#2980b9';else if(p>=40)color='#f39c12';const cc='cat-'+c.toLowerCase();catHtml+=`<div class="cat-score-card"><div class="cat-name"><span class="category-badge ${cc}">${c}</span></div><div class="cat-pct" style="color:${color}">${p}%</div><div class="cat-detail">${s.correct}/${s.total} correct${s.correct>1?'s':''}</div></div>`;});catHtml+='</div>';
let weakest=null,weakPct=101;cats.forEach(c=>{const s=catStats[c];const p=s.total>0?(s.correct/s.total*100):0;if(p<weakPct){weakPct=p;weakest=c;}});let advice='';if(weakPct<60&&weakest){advice=`<p style="text-align:center;color:#896f3d;margin-top:10px">Point faible : <strong>${weakest}</strong></p>`;}
resultsDiv.innerHTML=`<div class="score-circle ${levelClass}">${pct}%<span class="label">${score}/${total}</span></div><div class="level-message">${message}</div><div class="level-detail">${detail}</div>${catHtml}${advice}<div class="btn-container" style="margin-top:30px"><button class="btn btn-primary" onclick="startQuiz()">Recommencer</button><button class="btn btn-restart" onclick="retryFailed()" style="margin-left:10px">Retravailler mes erreurs</button><button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">Accueil</button></div>`;
fetch('/api/scores',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content},body:JSON.stringify({qcm_name:'qcm7',score:score,total:total,percentage:pct,duration_seconds:timerSeconds})});}
function retryFailed(){const failed=answers.filter(a=>!a.correct);if(failed.length===0){alert('Aucune erreur ! Bravo !');return;}shuffledQuestions=failed.map(f=>Object.assign({},f.question));currentQuestion=0;score=0;answers=[];document.getElementById('start-screen').style.display='none';document.getElementById('quiz-area').style.display='block';document.getElementById('results').style.display='none';showQuestion();startTimer();}
</script>
@endsection
