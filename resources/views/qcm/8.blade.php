@extends('layouts.app')
@section('title', 'QCM - Epreuve Pratique HTML/CSS')

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
        .cat-html { background: #e44d26; } .cat-css { background: #264de4; }
        .question-text { font-size: 18px; line-height: 1.6; margin-bottom: 20px; }
        .question-text code { background: rgba(20,81,142,0.08); padding: 2px 8px; border-radius: 4px; font-family: 'Consolas', monospace; font-size: 15px; color: #14518e; }
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
        .level-excellent { background: linear-gradient(135deg, #1a3e2a, #27ae60); color: #27ae60; } .level-good { background: linear-gradient(135deg, #1a3e3e, #2980b9); color: #2980b9; } .level-average { background: linear-gradient(135deg, #3e3a1a, #f39c12); color: #f39c12; } .level-weak { background: linear-gradient(135deg, #3e1a1a, #e74c3c); color: #e74c3c; }
        .level-message { text-align: center; font-size: 22px; font-weight: bold; margin: 15px 0; }
        .level-detail { text-align: center; margin-bottom: 30px; line-height: 1.6; }
        .cat-scores { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 15px; margin: 25px 0; }
        .cat-score-card { background: var(--bg-card); border-radius: 10px; padding: 15px; text-align: center; }
        .cat-score-card .cat-name { font-size: 13px; font-weight: bold; text-transform: uppercase; margin-bottom: 8px; } .cat-score-card .cat-pct { font-size: 28px; font-weight: bold; } .cat-score-card .cat-detail { font-size: 12px; margin-top: 4px; }
        .start-screen { overflow-wrap: break-word; text-align: center; padding: 40px 20px; } .start-screen p { margin: 15px 0; line-height: 1.6; }
        .tech-tags { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; margin: 20px 0; } .tech-tags span { padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: bold; }
        @media (max-width: 768px) { .container { padding: 20px 14px !important; } .question-card { padding: 20px !important; } .start-screen { padding: 24px 14px !important; } .question-text { font-size: 16px !important; } .options li { padding: 12px 14px !important; font-size: 14px !important; } .btn { padding: 10px 24px !important; font-size: 14px !important; } .score-circle { width: 140px !important; height: 140px !important; font-size: 36px !important; } }
        @media (max-width: 480px) { .container { padding: 14px 10px !important; } .question-card { padding: 16px !important; } .question-text { font-size: 15px !important; } .options li { padding: 10px 12px !important; font-size: 13px !important; } .category-badge { font-size: 10px !important; } .score-circle { width: 120px !important; height: 120px !important; font-size: 30px !important; } .cat-scores { grid-template-columns: 1fr 1fr !important; } h1 { font-size: 24px !important; } }
@endsection

@section('content')
<div class="container">
    <h1>QCM Epreuve Pratique</h1>
    <p class="subtitle">Systemes Informatiques et Logiciels 2025</p>
    <div id="start-screen" class="start-screen">
        <p>40 questions centrees sur HTML et CSS :</p>
        <div class="tech-tags"><span class="category-badge cat-html">HTML</span><span class="category-badge cat-css">CSS</span></div>
        <p>40 questions &bull; Duree 2h &bull; Resultat detaille a la fin</p>
        <div class="btn-container" style="margin-top:30px"><button class="btn btn-primary" onclick="startQuiz()">Commencer le QCM</button></div>
    </div>
    <div id="quiz-area" style="display:none">
        <div class="progress-text" id="progress-text"></div>
        <div class="progress-bar"><div class="progress-fill" id="progress-fill"></div></div>
        <div class="timer" id="timer">00:00</div>
        <div class="question-card" id="question-card"></div>
        <div class="btn-container"><button class="btn btn-primary" id="btn-validate" onclick="validateAnswer()" disabled>Valider</button><button class="btn btn-primary" id="btn-next" onclick="nextQuestion()" style="display:none">Suivant</button></div>
    </div>
    <div id="results" class="results"></div>
</div>

<script>
const questions = [
    {category:"HTML",question:"Quelle organisation definit les standards Web ?",options:["Apple Inc.","IBM Corporation","World Wide Web Consortium","Microsoft Corporation"],answer:2,explanation:"Le W3C definit les standards du Web (HTML, CSS, etc.)."},
    {category:"HTML",question:"HTML est considere comme :",options:["Langage de programmation","Langage POO","Langage de haut niveau","Langage de balisage"],answer:3,explanation:"HTML est un langage de balisage, pas un langage de programmation."},
    {category:"HTML",question:"HTML utilise des :",options:["Balises definies par l'utilisateur","Balises predefinies","Balises fixes definies par le langage","Balises uniquement pour les liens"],answer:2,explanation:"HTML utilise des balises predefinies et fixes par la specification du langage."},
    {category:"HTML",question:"HTML a ete propose pour la premiere fois en :",options:["1980","1990","1995","2000"],answer:1,explanation:"HTML a ete propose par Tim Berners-Lee en 1990 au CERN."},
    {category:"HTML",question:"Lequel n'est pas un navigateur ?",options:["Mozilla Firefox","Netscape","Microsoft Bing","Opera"],answer:2,explanation:"Microsoft Bing est un moteur de recherche, pas un navigateur."},
    {category:"HTML",question:"Qui est l'auteur principal du HTML ?",options:["Brendan Eich","Tim Berners-Lee","Developpeur web","Google Inc"],answer:1,explanation:"Tim Berners-Lee a invente le HTML en 1990 au CERN."},
    {category:"CSS",question:"Pour styler un seul element, quel selecteur CSS utiliser ?",options:["<code>id</code>","<code>text</code>","<code>class</code>","<code>name</code>"],answer:0,explanation:"Le selecteur <code>id</code> (avec <code>#</code>) cible un element unique."},
    {category:"HTML",question:"La balise HTML qui specifie un style CSS integre est :",options:["Design","Style","Modify","Define"],answer:1,explanation:"L'attribut <code>style</code> permet d'ajouter du CSS inline directement."},
    {category:"HTML",question:"La norme HTML qui n'exige pas de guillemets pour les attributs est :",options:["HTML 1","HTML 3","HTML 5","HTML 7"],answer:2,explanation:"HTML5 est plus tolerant et n'exige pas les guillemets pour les attributs simples."},
    {category:"HTML",question:"Un type de document HTML plus strict est connu sous :",options:["DHTML","XHTML","XML","HTML"],answer:1,explanation:"XHTML est une version plus stricte de HTML suivant les regles XML."},
    {category:"HTML",question:"Comment ajouter du texte alternatif pour une image ?",options:["Avec <code>alternate</code>","Avec <code>alt text</code>","Avec <code>alternate text</code>","Avec <code>alt</code>"],answer:3,explanation:"L'attribut <code>alt</code> fournit un texte alternatif pour les images."},
    {category:"HTML",question:"Comment incorporer des fichiers audio en HTML ?",options:["<code>&lt;embed src=\"audio.mp3\"&gt;</code>","<code>&lt;embed sound=\"audio.mp3\"&gt;</code>","<code>&lt;embed audio=\"audio.mp3\"&gt;</code>","<code>&lt;embed music=\"audio.mp3\"&gt;</code>"],answer:0,explanation:"La balise <code>&lt;embed&gt;</code> avec <code>src</code> incorpore des fichiers multimedia."},
    {category:"HTML",question:"En HTML, l'URL (Uniform Resource Locator) sert a :",options:["Creer un document frame","Creer une image map","Personnaliser une image","Identifier une ressource sur Internet"],answer:3,explanation:"L'URL identifie de maniere unique une ressource sur Internet."},
    {category:"CSS",question:"CSS est un acronyme pour :",options:["Cascading Style Sheet","Costume Style Sheet","Cascading System Style","Aucune de ces reponses"],answer:0,explanation:"CSS = Cascading Style Sheets (feuilles de style en cascade)."},
    {category:"HTML",question:"Quel protocole n'est pas utilise sur Internet ?",options:["Gopher","HTTP","WIRL","Telnet"],answer:2,explanation:"WIRL n'est pas un protocole Internet. HTTP, Gopher et Telnet sont reels."},
    {category:"HTML",question:"Quel element dans HEAD lie une feuille CSS externe ?",options:["<code>&lt;src&gt;</code>","<code>&lt;link&gt;</code>","<code>&lt;style&gt;</code>","<code>&lt;css&gt;</code>"],answer:1,explanation:"<code>&lt;link rel=\"stylesheet\" href=\"...\"&gt;</code> lie une feuille CSS externe."},
    {category:"HTML",question:"Quel attribut identifie un element comme membre d'un groupe ?",options:["<code>id</code>","<code>class</code>","<code>div</code>","<code>span</code>"],answer:1,explanation:"L'attribut <code>class</code> regroupe plusieurs elements pour un meme style."},
    {category:"HTML",question:"Dans <code>&lt;img src=\"img.png\"&gt;</code>, que represente \"img.png\" ?",options:["Un element","Un attribut","Une valeur","Un operateur"],answer:2,explanation:"\"img.png\" est la valeur de l'attribut <code>src</code>."},
    {category:"HTML",question:"Quelles balises sont liees a un tableau HTML ?",options:["<code>&lt;table&gt; &lt;row&gt; &lt;column&gt;</code>","<code>&lt;table&gt; &lt;tr&gt; &lt;td&gt;</code>","<code>&lt;table&gt; &lt;head&gt; &lt;body&gt;</code>","<code>&lt;table&gt; &lt;header&gt; &lt;footer&gt;</code>"],answer:1,explanation:"<code>&lt;table&gt;</code>, <code>&lt;tr&gt;</code> (lignes) et <code>&lt;td&gt;</code> (cellules)."},
    {category:"HTML",question:"A quoi sert la balise <code>&lt;tt&gt;</code> en HTML ?",options:["Mise en forme du texte (teletype)","Mise en forme d'image","Mise en forme de tableau","Aucune de ces reponses"],answer:0,explanation:"<code>&lt;tt&gt;</code> affichait le texte en police monospace. Elle est obsolete en HTML5."},
    {category:"HTML",question:"A quoi servent les formulaires en HTML ?",options:["Afficher un email","Effet d'animation","Recueillir les entrees de l'utilisateur","Aucune de ces reponses"],answer:2,explanation:"Les formulaires HTML servent a collecter les donnees de l'utilisateur."},
    {category:"HTML",question:"A quoi sert iframe en HTML ?",options:["Afficher une page dans une page","Afficher avec animation","Afficher sans navigateur","Toutes les reponses sont vraies"],answer:0,explanation:"<code>&lt;iframe&gt;</code> integre une page web a l'interieur d'une autre."},
    {category:"CSS",question:"Comment ecrire un commentaire en CSS ?",options:["<code>/* un commentaire */</code>","<code>// un commentaire //</code>","<code>/ un commentaire /</code>","<code>&lt;' un commentaire '&gt;</code>"],answer:0,explanation:"En CSS, les commentaires utilisent <code>/* ... */</code>."},
    {category:"CSS",question:"Quelle propriete ajoute une marge entre bordure et texte ?",options:["<code>spacing</code>","<code>margin</code>","<code>padding</code>","<code>inner-margin</code>"],answer:2,explanation:"<code>padding</code> est l'espace interieur entre contenu et bordure."},
    {category:"CSS",question:"Quelle propriete CSS controle la taille du texte ?",options:["<code>font-style</code>","<code>text-size</code>","<code>font-size</code>","<code>text-style</code>"],answer:2,explanation:"<code>font-size</code> definit la taille de la police."},
    {category:"CSS",question:"La valeur par defaut de la propriete position est :",options:["<code>fixed</code>","<code>absolute</code>","<code>inherit</code>","<code>relative</code>"],answer:3,explanation:"Note : la vraie valeur par defaut est <code>static</code>. Parmi les choix proposes, <code>relative</code> est la plus proche car l'element reste dans le flux."},
    {category:"CSS",question:"Comment rendre tous les paragraphes en rouge ?",options:["<code>p.all {color: red;}</code>","<code>p.all {color: #AA0000;}</code>","<code>all.p {color: #0000FF;}</code>","<code>p {color: red;}</code>"],answer:3,explanation:"Le selecteur <code>p</code> seul cible tous les paragraphes."},
    {category:"HTML",question:"Pour uploader un fichier sur un serveur Web, on utilise :",options:["HTTP","SMTP","SIP","FTP"],answer:3,explanation:"FTP est le protocole standard pour transferer des fichiers."},
    {category:"HTML",question:"En HTML5, on specifie ______ pour le mode standard :",options:["DOCTYPE","HEAD","BODY","TITLE"],answer:0,explanation:"<code>&lt;!DOCTYPE html&gt;</code> active le mode standard du navigateur."},
    {category:"HTML",question:"Une liste ordonnee est representee par :",options:["<code>&lt;ol&gt;</code>","<code>&lt;ul&gt;</code>","<code>&lt;li&gt;</code>","<code>&lt;el&gt;</code>"],answer:0,explanation:"<code>&lt;ol&gt;</code> cree une liste numerotee. <code>&lt;ul&gt;</code> cree une liste a puces."},
    {category:"HTML",question:"Quel attribut est obligatoire dans <code>&lt;img&gt;</code> ?",options:["<code>src</code>","<code>href</code>","<code>id</code>","<code>alt</code>"],answer:0,explanation:"<code>src</code> est obligatoire car il specifie le chemin de l'image."},
    {category:"HTML",question:"PNG signifie :",options:["Portable Network Graphic","Pivot Network Graphic","Pichart Network Graphic","Pythagorus Network Graphic"],answer:0,explanation:"PNG = Portable Network Graphics, format d'image sans perte."},
    {category:"HTML",question:"GIF signifie :",options:["Graph Interchange Format","Graphics Interlinked Format","Graphics Interchange Format","Aucune de ces reponses"],answer:2,explanation:"GIF = Graphics Interchange Format."},
    {category:"CSS",question:"Quel selecteur CSS selectionne un element sans sous-elements ?",options:["<code>:empty</code>","<code>:nochild</code>","<code>:inheritance</code>","<code>:no-child</code>"],answer:0,explanation:"<code>:empty</code> cible les elements sans aucun enfant."},
    {category:"CSS",question:"Quel selecteur cible le seul enfant de son parent ?",options:["<code>:nth-of-type(n)</code>","<code>:only-child</code>","<code>:root</code>","Aucune de ces reponses"],answer:1,explanation:"<code>:only-child</code> cible un element s'il est l'unique enfant de son parent."},
    {category:"CSS",question:"En CSS, <code>h1</code> est appele :",options:["Selecteur","Attribut","Valeur","Label"],answer:0,explanation:"<code>h1</code> est un selecteur de type qui cible tous les <code>&lt;h1&gt;</code>."},
    {category:"CSS",question:"En CSS, <code>color:red</code> est :",options:["Une regle","Un attribut","Une valeur","Une declaration"],answer:3,explanation:"<code>color:red</code> est une declaration CSS (propriete + valeur)."},
    {category:"CSS",question:"Quel est le role des media queries en CSS ?",options:["Creer des animations","Appliquer des styles selon la taille de l'ecran","Modifier les couleurs","Creer des menus deroulants"],answer:1,explanation:"Les media queries adaptent les styles selon la taille d'ecran ou le type d'appareil."},
    {category:"CSS",question:"Quelle est la valeur hexadecimale du rouge ?",options:["<code>#FF0000</code>","<code>#FF0100</code>","<code>#F00000</code>","<code>#F00001</code>"],answer:0,explanation:"<code>#FF0000</code> est le rouge pur : FF rouge, 00 vert, 00 bleu."},
    {category:"CSS",question:"Quelle propriete CSS controle le type d'affichage ?",options:["<code>position</code>","<code>display</code>","<code>visibility</code>","<code>float</code>"],answer:1,explanation:"<code>display</code> definit le type d'affichage (block, inline, flex, grid, none...)."}
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
function showResults(){stopTimer();document.getElementById('quiz-area').style.display='none';const resultsDiv=document.getElementById('results');resultsDiv.style.display='block';const total=shuffledQuestions.length,pct=Math.round(score/total*100);let levelClass,message,detail;if(pct>=80){levelClass='level-excellent';message='Excellent !';detail='Solide base en HTML et CSS.';}else if(pct>=60){levelClass='level-good';message='Bon niveau !';detail='Revoyez les questions manquees.';}else if(pct>=40){levelClass='level-average';message='Niveau moyen.';detail='Concentrez-vous sur vos points faibles.';}else{levelClass='level-weak';message='A renforcer.';detail='Reprenez les bases.';}
const cats=['HTML','CSS'];const catStats={};cats.forEach(c=>catStats[c]={total:0,correct:0});answers.forEach(a=>{catStats[a.question.category].total++;if(a.correct)catStats[a.question.category].correct++;});
let catHtml='<div class="cat-scores">';cats.forEach(c=>{const s=catStats[c];const p=s.total>0?Math.round(s.correct/s.total*100):0;let color='#e74c3c';if(p>=80)color='#27ae60';else if(p>=60)color='#2980b9';else if(p>=40)color='#f39c12';const cc='cat-'+c.toLowerCase();catHtml+=`<div class="cat-score-card"><div class="cat-name"><span class="category-badge ${cc}">${c}</span></div><div class="cat-pct" style="color:${color}">${p}%</div><div class="cat-detail">${s.correct}/${s.total}</div></div>`;});catHtml+='</div>';
resultsDiv.innerHTML=`<div class="score-circle ${levelClass}">${pct}%<span class="label">${score}/${total}</span></div><div class="level-message">${message}</div><div class="level-detail">${detail}</div>${catHtml}<div class="btn-container" style="margin-top:30px"><button class="btn btn-primary" onclick="startQuiz()">Recommencer</button><button class="btn btn-restart" onclick="retryFailed()" style="margin-left:10px">Retravailler mes erreurs</button><button class="btn btn-restart" onclick="location.href='/dashboard'" style="margin-left:10px">Accueil</button></div>`;
fetch('/api/scores',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content},body:JSON.stringify({qcm_name:'qcm8',score:score,total:total,percentage:pct,duration_seconds:timerSeconds})});}
function retryFailed(){const failed=answers.filter(a=>!a.correct);if(failed.length===0){alert('Aucune erreur !');return;}shuffledQuestions=failed.map(f=>Object.assign({},f.question));currentQuestion=0;score=0;answers=[];document.getElementById('start-screen').style.display='none';document.getElementById('quiz-area').style.display='block';document.getElementById('results').style.display='none';showQuestion();startTimer();}
</script>
@endsection
