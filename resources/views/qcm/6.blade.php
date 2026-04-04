@extends('layouts.app')
@section('title', 'QCM - Examen National SIL')

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
    <p class="subtitle">Examen National de Licence SIL</p>

    <div id="start-screen" class="start-screen">
        <p>Epreuve pratique professionnelle couvrant :</p>
        <div class="tech-tags">
            <span class="category-badge cat-html">HTML</span>
            <span class="category-badge cat-css">CSS</span>
            <span class="category-badge cat-php">PHP</span>
            <span class="category-badge cat-mysql">MySQL</span>
        </div>
        <p>25 questions &bull; Duree 2h &bull; Resultat detaille a la fin</p>
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
    {category:"HTML",question:"Quel attribut HTML est obligatoire pour un champ input de type checkbox ?",options:["<code>checked</code>","<code>name</code>","<code>id</code>","<code>value</code>"],answer:1,explanation:"L'attribut <code>name</code> est obligatoire pour que la valeur du checkbox soit envoyee avec le formulaire."},
    {category:"HTML",question:"Quelle balise est utilisee pour integrer du contenu interactif externe comme une video Youtube ?",options:["<code>&lt;embed&gt;</code>","<code>&lt;iframe&gt;</code>","<code>&lt;object&gt;</code>","<code>&lt;video&gt;</code>"],answer:1,explanation:"<code>&lt;iframe&gt;</code> permet d'integrer du contenu externe comme des videos YouTube."},
    {category:"HTML",question:"Quelle balise est consideree comme semantique ?",options:["<code>&lt;div&gt;</code>","<code>&lt;span&gt;</code>","<code>&lt;section&gt;</code>","<code>&lt;br&gt;</code>"],answer:2,explanation:"<code>&lt;section&gt;</code> est une balise semantique HTML5 representant un regroupement thematique de contenu."},
    {category:"HTML",question:"Quel attribut permet d'ameliorer l'accessibilite d'une image ?",options:["<code>srcset</code>","<code>alt</code>","<code>aria-hidden</code>","<code>role</code>"],answer:1,explanation:"L'attribut <code>alt</code> fournit un texte alternatif descriptif pour les lecteurs d'ecran."},
    {category:"HTML",question:"Laquelle de ces balises est obsolete en HTML5 ?",options:["<code>&lt;center&gt;</code>","<code>&lt;strong&gt;</code>","<code>&lt;em&gt;</code>","<code>&lt;header&gt;</code>"],answer:0,explanation:"<code>&lt;center&gt;</code> est obsolete en HTML5. Utilisez CSS (<code>text-align: center</code>) a la place."},
    {category:"CSS",question:"Dans la specificite CSS, quel selecteur a le plus de poids ?",options:["<code>#id</code>","<code>.class</code>","<code>div p</code>","<code>:hover</code>"],answer:0,explanation:"Le selecteur <code>#id</code> a une specificite de 100, bien superieure a <code>.class</code> (10)."},
    {category:"CSS",question:"Quelle unite relative s'adapte a la taille de police de l'element parent ?",options:["<code>rem</code>","<code>em</code>","<code>%</code>","<code>vw</code>"],answer:1,explanation:"<code>em</code> est relatif a la taille de police du parent. <code>rem</code> est relatif a la racine."},
    {category:"CSS",question:"Quel module CSS permet de creer un layout en deux dimensions ?",options:["Flexbox","Grid","Float","Inline-block"],answer:1,explanation:"CSS Grid est le seul systeme de layout veritablement bidimensionnel (lignes ET colonnes)."},
    {category:"CSS",question:"Quelle propriete permet de creer une animation CSS ?",options:["<code>transform</code>","<code>transition</code>","<code>animation</code>","<code>keyframes</code>"],answer:2,explanation:"La propriete <code>animation</code> applique une animation definie par <code>@keyframes</code>."},
    {category:"CSS",question:"Que signifie 'inherit' en CSS ?",options:["Valeur par defaut","Herite de l'element parent","Applique au document entier","Aucune importance"],answer:1,explanation:"<code>inherit</code> force un element a heriter la valeur de la propriete de son parent."},
    {category:"CSS",question:"Quel pseudo-element permet d'ajouter du contenu avant un element ?",options:["<code>:hover</code>","<code>::before</code>","<code>::after</code>","<code>:first-child</code>"],answer:1,explanation:"<code>::before</code> insere du contenu genere avant le contenu de l'element."},
    {category:"CSS",question:"Quelle est la valeur initiale de la propriete 'position' ?",options:["<code>relative</code>","<code>absolute</code>","<code>fixed</code>","<code>static</code>"],answer:3,explanation:"La valeur par defaut de <code>position</code> est <code>static</code> : l'element suit le flux normal."},
    {category:"CSS",question:"Quelle syntaxe CSS permet de definir une variable personnalisee ?",options:["<code>--ma-variable</code>","<code>$ma-variable</code>","<code>@ma-variable</code>","<code>var-ma-variable</code>"],answer:0,explanation:"Les variables CSS sont definies avec <code>--</code> et utilisees avec <code>var(--ma-variable)</code>."},
    {category:"PHP",question:"Quel mot-cle definit une classe en PHP ?",options:["<code>class</code>","<code>object</code>","<code>new</code>","<code>define</code>"],answer:0,explanation:"Le mot-cle <code>class</code> declare une classe en PHP."},
    {category:"PHP",question:"Quelle superglobale contient les donnees envoyees par methode POST ?",options:["<code>$_GET</code>","<code>$_REQUEST</code>","<code>$_POST</code>","<code>$_SESSION</code>"],answer:2,explanation:"<code>$_POST</code> contient toutes les donnees envoyees via la methode HTTP POST."},
    {category:"PHP",question:"Quel mot-cle permet d'heriter d'une classe en PHP ?",options:["<code>extends</code>","<code>implements</code>","<code>inherits</code>","<code>use</code>"],answer:0,explanation:"<code>extends</code> permet a une classe d'heriter des proprietes et methodes d'une classe parente."},
    {category:"PHP",question:"Quelle fonction PHP demarre une session ?",options:["<code>start_session()</code>","<code>session_start()</code>","<code>open_session()</code>","<code>begin_session()</code>"],answer:1,explanation:"<code>session_start()</code> initialise ou reprend une session PHP existante."},
    {category:"PHP",question:"Quelle est la valeur de retour de <code>count([1,2,3])</code> ?",options:["2","3","4","Erreur"],answer:1,explanation:"<code>count()</code> retourne le nombre d'elements. <code>[1,2,3]</code> contient 3 elements."},
    {category:"PHP",question:"Quel est le resultat de <code>echo (true == '1');</code> ?",options:["true (affiche 1)","false","Erreur","NULL"],answer:0,explanation:"En PHP, <code>true == '1'</code> est vrai car PHP convertit '1' en booleen <code>true</code>. <code>echo</code> affiche <code>1</code>."},
    {category:"PHP",question:"Quel mot-cle definit une constante de classe ?",options:["<code>define</code>","<code>const</code>","<code>static</code>","<code>final</code>"],answer:1,explanation:"Le mot-cle <code>const</code> definit des constantes au sein d'une classe."},
    {category:"MySQL",question:"Quelle clause permet de regrouper les resultats en MySQL ?",options:["<code>WHERE</code>","<code>GROUP BY</code>","<code>ORDER BY</code>","<code>HAVING</code>"],answer:1,explanation:"<code>GROUP BY</code> regroupe les lignes ayant les memes valeurs dans les colonnes specifiees."},
    {category:"MySQL",question:"Quelle commande permet de creer un index sur une colonne ?",options:["<code>ALTER TABLE table ADD INDEX (colonne)</code>","<code>CREATE INDEX table(colonne)</code>","<code>INDEX colonne ON table</code>","<code>ADD INDEX colonne ON table</code>"],answer:0,explanation:"<code>ALTER TABLE table ADD INDEX (colonne)</code> est la syntaxe correcte."},
    {category:"MySQL",question:"Quelle instruction limite le nombre de resultats retournes ?",options:["<code>LIMIT</code>","<code>TOP</code>","<code>RANGE</code>","<code>ROWNUM</code>"],answer:0,explanation:"<code>LIMIT</code> restreint le nombre de lignes retournees en MySQL."},
    {category:"MySQL",question:"Quelle commande supprime une base de donnees ?",options:["<code>DROP DATABASE</code>","<code>DELETE DATABASE</code>","<code>REMOVE DATABASE</code>","<code>DESTROY DATABASE</code>"],answer:0,explanation:"<code>DROP DATABASE</code> supprime completement une base de donnees et toutes ses tables."},
    {category:"MySQL",question:"Quelle commande cree un utilisateur MySQL ?",options:["<code>CREATE USER</code>","<code>ADD USER</code>","<code>NEW USER</code>","<code>GRANT USER</code>"],answer:0,explanation:"<code>CREATE USER</code> cree un nouveau compte utilisateur dans MySQL."}
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
const cats=['HTML','CSS','PHP','MySQL'];const catStats={};cats.forEach(c=>catStats[c]={total:0,correct:0});answers.forEach(a=>{catStats[a.question.category].total++;if(a.correct)catStats[a.question.category].correct++;});
let catHtml='<div class="cat-scores">';cats.forEach(c=>{const s=catStats[c];const p=s.total>0?Math.round(s.correct/s.total*100):0;let color='#e74c3c';if(p>=80)color='#27ae60';else if(p>=60)color='#2980b9';else if(p>=40)color='#f39c12';const cc='cat-'+c.toLowerCase();catHtml+=`<div class="cat-score-card"><div class="cat-name"><span class="category-badge ${cc}">${c}</span></div><div class="cat-pct" style="color:${color}">${p}%</div><div class="cat-detail">${s.correct}/${s.total} correct${s.correct>1?'s':''}</div></div>`;});catHtml+='</div>';
let weakest=null,weakPct=101;cats.forEach(c=>{const s=catStats[c];const p=s.total>0?(s.correct/s.total*100):0;if(p<weakPct){weakPct=p;weakest=c;}});let advice='';if(weakPct<60&&weakest){advice=`<p style="text-align:center;color:#896f3d;margin-top:10px">Point faible : <strong>${weakest}</strong></p>`;}
resultsDiv.innerHTML=`<div class="score-circle ${levelClass}">${pct}%<span class="label">${score}/${total}</span></div><div class="level-message">${message}</div><div class="level-detail">${detail}</div>${catHtml}${advice}<div class="btn-container" style="margin-top:30px"><button class="btn btn-primary" onclick="startQuiz()">Recommencer</button><button class="btn btn-restart" onclick="retryFailed()" style="margin-left:10px">Retravailler mes erreurs</button><button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">Accueil</button></div>`;
fetch('/api/scores',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content},body:JSON.stringify({qcm_name:'qcm6',score:score,total:total,percentage:pct,duration_seconds:timerSeconds})});}
function retryFailed(){const failed=answers.filter(a=>!a.correct);if(failed.length===0){alert('Aucune erreur ! Bravo !');return;}shuffledQuestions=failed.map(f=>Object.assign({},f.question));currentQuestion=0;score=0;answers=[];document.getElementById('start-screen').style.display='none';document.getElementById('quiz-area').style.display='block';document.getElementById('results').style.display='none';showQuestion();startTimer();}
</script>
@endsection
