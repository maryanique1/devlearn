@extends('layouts.app')
@section('title', 'QCM - Technologie Web')

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
    <h1>QCM Technologie Web</h1>
    <p class="subtitle">Ecole Superieure Sainte Felicite — Controle</p>

    <div id="start-screen" class="start-screen">
        <p>Testez vos connaissances sur les technologies du developpement web :</p>
        <div class="tech-tags">
            <span class="category-badge cat-html">HTML</span>
            <span class="category-badge cat-css">CSS</span>
            <span class="category-badge cat-javascript">JavaScript</span>
            <span class="category-badge cat-php">PHP</span>
            <span class="category-badge cat-mysql">MySQL</span>
        </div>
        <p>20 questions &bull; Difficulte mixte &bull; Resultat detaille a la fin</p>
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
    {category:"HTML",question:"Quelle balise HTML5 est utilisee pour representer un contenu autonome comme un article ou un post ?",options:["<code>&lt;section&gt;</code>","<code>&lt;article&gt;</code>","<code>&lt;div&gt;</code>","<code>&lt;content&gt;</code>"],answer:1,explanation:"La balise <code>&lt;article&gt;</code> represente un contenu autonome et independant, comme un article de blog ou un post."},
    {category:"HTML",question:"Quelle balise permet d'integrer un contenu externe comme une carte ou une video ?",options:["<code>&lt;embed&gt;</code>","<code>&lt;frame&gt;</code>","<code>&lt;iframe&gt;</code>","<code>&lt;object&gt;</code>"],answer:2,explanation:"La balise <code>&lt;iframe&gt;</code> (inline frame) permet d'integrer une page web externe dans la page courante."},
    {category:"HTML",question:"Quel attribut HTML ameliore l'accessibilite pour les images ?",options:["<code>title</code>","<code>name</code>","<code>alt</code>","<code>description</code>"],answer:2,explanation:"L'attribut <code>alt</code> fournit un texte alternatif pour les lecteurs d'ecran et quand l'image ne se charge pas."},
    {category:"HTML",question:"Quelle balise HTML5 est destinee a la navigation principale d'un site ?",options:["<code>&lt;menu&gt;</code>","<code>&lt;nav&gt;</code>","<code>&lt;header&gt;</code>","<code>&lt;aside&gt;</code>"],answer:1,explanation:"La balise <code>&lt;nav&gt;</code> est l'element semantique HTML5 dedie aux blocs de navigation principaux."},
    {category:"CSS",question:"Quelle propriete CSS permet de superposer les elements ?",options:["<code>position</code>","<code>float</code>","<code>z-index</code>","<code>overflow</code>"],answer:2,explanation:"<code>z-index</code> controle l'ordre d'empilement des elements positionnes. Un z-index plus eleve place l'element au-dessus."},
    {category:"CSS",question:"Quelle regle CSS permet de rendre un site responsive ?",options:["<code>@font-face</code>","<code>@media</code>","<code>@import</code>","<code>@keyframes</code>"],answer:1,explanation:"<code>@media</code> permet de definir des regles CSS conditionnelles selon la taille de l'ecran ou le type d'appareil."},
    {category:"CSS",question:"Quelle propriete permet de creer un layout flexible ?",options:["<code>display: grid</code>","<code>display: flex</code>","<code>display: inline</code>","<code>display: table</code>"],answer:1,explanation:"<code>display: flex</code> active le modele Flexbox qui permet de creer des mises en page flexibles et responsives."},
    {category:"CSS",question:"Quelle propriete CSS controle l'espacement interieur d'un element ?",options:["<code>margin</code>","<code>border</code>","<code>padding</code>","<code>spacing</code>"],answer:2,explanation:"<code>padding</code> definit l'espace entre le contenu d'un element et sa bordure. <code>margin</code> gere l'espace exterieur."},
    {category:"JavaScript",question:"Que retourne <code>typeof null</code> en JavaScript ?",options:["<code>null</code>","<code>object</code>","<code>undefined</code>","<code>boolean</code>"],answer:1,explanation:"C'est un bug historique de JavaScript : <code>typeof null</code> retourne <code>\"object\"</code> au lieu de <code>\"null\"</code>."},
    {category:"JavaScript",question:"Quelle methode permet de selectionner un element par ID ?",options:["<code>querySelector()</code>","<code>getElementById()</code>","<code>getElementsByClass()</code>","<code>selectElement()</code>"],answer:1,explanation:"<code>getElementById()</code> retourne l'element unique correspondant a l'ID specifie."},
    {category:"JavaScript",question:"Quel mot-cle permet de declarer une variable avec portee bloc ?",options:["<code>var</code>","<code>const</code>","<code>let</code>","<code>let</code> et <code>const</code>"],answer:3,explanation:"<code>let</code> et <code>const</code> ont tous les deux une portee bloc (block scope), contrairement a <code>var</code> qui a une portee fonction."},
    {category:"JavaScript",question:"Quelle fonction JavaScript convertit une chaine JSON en objet ?",options:["<code>JSON.parse()</code>","<code>JSON.stringify()</code>","<code>JSON.convert()</code>","<code>JSON.object()</code>"],answer:0,explanation:"<code>JSON.parse()</code> analyse une chaine JSON et la convertit en objet JavaScript. <code>JSON.stringify()</code> fait l'inverse."},
    {category:"PHP",question:"Quelle fonction permet de demarrer une session en PHP ?",options:["<code>session_open()</code>","<code>start_session()</code>","<code>session_start()</code>","<code>session_begin()</code>"],answer:2,explanation:"<code>session_start()</code> demarre ou reprend une session PHP existante."},
    {category:"PHP",question:"Quelle fonction protege contre l'injection SQL ?",options:["<code>mysqli_real_escape_string()</code>","<code>mysql_query()</code>","<code>htmlspecialchars()</code>","<code>strip_tags()</code>"],answer:0,explanation:"<code>mysqli_real_escape_string()</code> echappe les caracteres speciaux pour securiser les requetes SQL. Les requetes preparees (PDO) sont encore plus sures."},
    {category:"PHP",question:"Quel symbole est utilise pour acceder aux variables globales PHP ?",options:["<code>$GLOBALS</code>","<code>$_SERVER</code>","<code>$_POST</code>","<code>$_SESSION</code>"],answer:0,explanation:"<code>$GLOBALS</code> est un tableau superglobal qui donne acces a toutes les variables globales du script PHP."},
    {category:"PHP",question:"Quelle extension PHP est recommandee pour les requetes preparees ?",options:["MySQL","PDO","ODBC","SQLite"],answer:1,explanation:"PDO (PHP Data Objects) est l'extension recommandee car elle supporte les requetes preparees et est compatible avec plusieurs SGBD."},
    {category:"MySQL",question:"Quelle commande permet de supprimer une table ?",options:["<code>DELETE TABLE</code>","<code>REMOVE TABLE</code>","<code>DROP TABLE</code>","<code>CLEAR TABLE</code>"],answer:2,explanation:"<code>DROP TABLE</code> supprime completement une table et toutes ses donnees de la base."},
    {category:"MySQL",question:"Quelle clause permet de filtrer les resultats d'une requete SQL ?",options:["<code>FILTER</code>","<code>WHERE</code>","<code>ORDER</code>","<code>GROUP</code>"],answer:1,explanation:"<code>WHERE</code> filtre les lignes selon une condition. <code>ORDER BY</code> trie, <code>GROUP BY</code> regroupe."},
    {category:"MySQL",question:"Quelle commande permet de modifier une table existante ?",options:["<code>MODIFY TABLE</code>","<code>ALTER TABLE</code>","<code>UPDATE TABLE</code>","<code>CHANGE TABLE</code>"],answer:1,explanation:"<code>ALTER TABLE</code> permet de modifier la structure d'une table (ajouter/supprimer colonnes, changer types, etc.)."},
    {category:"MySQL",question:"Quelle cle garantit l'unicite d'un enregistrement dans une table ?",options:["Foreign Key","Primary Key","Index Key","Unique Field"],answer:1,explanation:"La <code>PRIMARY KEY</code> identifie de maniere unique chaque enregistrement d'une table. Elle ne peut pas contenir de valeurs NULL ni de doublons."}
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

    const cats=['HTML','CSS','JavaScript','PHP','MySQL'];
    const catStats={}; cats.forEach(c=>catStats[c]={total:0,correct:0});
    answers.forEach(a=>{catStats[a.question.category].total++;if(a.correct)catStats[a.question.category].correct++;});

    let catHtml='<div class="cat-scores">';
    cats.forEach(c=>{const s=catStats[c];const p=s.total>0?Math.round(s.correct/s.total*100):0;let color='#e74c3c';if(p>=80)color='#27ae60';else if(p>=60)color='#2980b9';else if(p>=40)color='#f39c12';const cc='cat-'+c.toLowerCase();catHtml+=`<div class="cat-score-card"><div class="cat-name"><span class="category-badge ${cc}">${c}</span></div><div class="cat-pct" style="color:${color}">${p}%</div><div class="cat-detail">${s.correct}/${s.total} correct${s.correct>1?'s':''}</div></div>`;});
    catHtml+='</div>';

    let weakest=null,weakPct=101;
    cats.forEach(c=>{const s=catStats[c];const p=s.total>0?(s.correct/s.total*100):0;if(p<weakPct){weakPct=p;weakest=c;}});
    let advice='';if(weakPct<60&&weakest){advice=`<p style="text-align:center;color:#896f3d;margin-top:10px">Point faible : <strong>${weakest}</strong> — concentrez vos revisions sur cette technologie.</p>`;}

    resultsDiv.innerHTML=`<div class="score-circle ${levelClass}">${pct}%<span class="label">${score}/${total}</span></div><div class="level-message">${message}</div><div class="level-detail">${detail}</div>${catHtml}${advice}<div class="btn-container" style="margin-top:30px"><button class="btn btn-primary" onclick="startQuiz()">Recommencer</button><button class="btn btn-restart" onclick="retryFailed()" style="margin-left:10px">Retravailler mes erreurs</button><button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">Accueil</button></div>`;

    fetch('/api/scores',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content},body:JSON.stringify({qcm_name:'qcm4',score:score,total:total,percentage:pct,duration_seconds:timerSeconds})});
}

function retryFailed() {
    const failed=answers.filter(a=>!a.correct);if(failed.length===0){alert('Aucune erreur ! Bravo !');return;}
    shuffledQuestions=failed.map(f=>Object.assign({},f.question));currentQuestion=0;score=0;answers=[];
    document.getElementById('start-screen').style.display='none';document.getElementById('quiz-area').style.display='block';document.getElementById('results').style.display='none';showQuestion();startTimer();
}
</script>
@endsection
