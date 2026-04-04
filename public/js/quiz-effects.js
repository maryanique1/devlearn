// ═══════════════════════════════════════
// Quiz Visual Effects - Dev Learn
// ═══════════════════════════════════════

// ── Confetti on good score ──
function launchConfetti() {
    const colors = ['#896f3d', '#f0db4f', '#27ae60', '#2980b9', '#e44d26', '#8892BF'];
    const canvas = document.createElement('canvas');
    canvas.id = 'confetti-canvas';
    canvas.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:9999;';
    document.body.appendChild(canvas);
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const particles = [];
    for (let i = 0; i < 150; i++) {
        particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height - canvas.height,
            w: Math.random() * 10 + 5,
            h: Math.random() * 6 + 3,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 4,
            vy: Math.random() * 3 + 2,
            rot: Math.random() * 360,
            rotSpeed: (Math.random() - 0.5) * 10,
            opacity: 1
        });
    }

    let frame = 0;
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        frame++;
        let alive = false;
        particles.forEach(p => {
            if (p.opacity <= 0) return;
            alive = true;
            p.x += p.vx;
            p.y += p.vy;
            p.vy += 0.05;
            p.rot += p.rotSpeed;
            if (frame > 60) p.opacity -= 0.01;
            ctx.save();
            ctx.translate(p.x, p.y);
            ctx.rotate(p.rot * Math.PI / 180);
            ctx.globalAlpha = Math.max(0, p.opacity);
            ctx.fillStyle = p.color;
            ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
            ctx.restore();
        });
        if (alive) requestAnimationFrame(animate);
        else canvas.remove();
    }
    animate();
}

// ── Inject quiz animation styles ──
(function() {
    const style = document.createElement('style');
    style.textContent = `
        /* Shake animation for wrong answers */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-8px); }
            40% { transform: translateX(8px); }
            60% { transform: translateX(-6px); }
            80% { transform: translateX(6px); }
        }
        .options li.wrong { animation: shake 0.5s ease; }

        /* Pulse animation for correct answers */
        @keyframes pulse-correct {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }
        .options li.correct { animation: pulse-correct 0.4s ease; }

        /* Slide transition for questions */
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .question-card, [id="questionCard"] { animation: slideIn 0.35s ease; }

        /* Streak badge */
        .streak-badge {
            position: fixed;
            top: 80px;
            right: 20px;
            background: linear-gradient(135deg, #896f3d, #f0db4f);
            color: #fff;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            z-index: 1000;
            animation: streakPop 0.5s ease;
            pointer-events: none;
            box-shadow: 0 4px 16px rgba(137,111,61,0.4);
        }
        @keyframes streakPop {
            0% { opacity: 0; transform: scale(0.5) translateY(10px); }
            60% { transform: scale(1.15) translateY(-5px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        /* Score progress bar color */
        .progress-fill, .progress-bar-fill, #progressFill {
            transition: width 0.4s ease, background 0.4s ease !important;
        }
    `;
    document.head.appendChild(style);
})();

// ── Streak counter ──
let streakCount = 0;

function showStreak(count) {
    const existing = document.querySelector('.streak-badge');
    if (existing) existing.remove();

    if (count < 3) return;

    const badge = document.createElement('div');
    badge.className = 'streak-badge';
    const fire = count >= 7 ? '&#128293;&#128293;' : count >= 5 ? '&#128293;' : '&#9889;';
    badge.innerHTML = `${fire} ${count} d'affilee !`;
    document.body.appendChild(badge);

    setTimeout(() => {
        badge.style.transition = 'opacity 0.5s';
        badge.style.opacity = '0';
        setTimeout(() => badge.remove(), 500);
    }, 2000);
}

// ── Color-changing progress bar ──
function updateProgressColor(correct, total) {
    const pct = total > 0 ? (correct / total) * 100 : 0;
    let color;
    if (pct >= 75) color = 'linear-gradient(90deg, #27ae60, #2ecc71)';
    else if (pct >= 50) color = 'linear-gradient(90deg, #2980b9, #3498db)';
    else if (pct >= 25) color = 'linear-gradient(90deg, #f39c12, #f1c40f)';
    else color = 'linear-gradient(90deg, #e74c3c, #c0392b)';

    const fills = document.querySelectorAll('.progress-fill, .progress-bar-fill, #progressFill');
    fills.forEach(f => f.style.background = color);
}

// ── Hook into quiz answer validation ──
// This patches the global validateAnswer to add effects
(function() {
    // Wait for quiz to load
    const checkInterval = setInterval(() => {
        if (typeof window.validateAnswer !== 'function') return;
        clearInterval(checkInterval);

        const original = window.validateAnswer;
        window.validateAnswer = function() {
            const scoreBefore = window.score || 0;
            original.apply(this, arguments);
            const scoreAfter = window.score || 0;

            if (scoreAfter > scoreBefore) {
                // Correct
                streakCount++;
                showStreak(streakCount);
            } else {
                // Wrong
                streakCount = 0;
            }

            // Update progress bar color
            const total = (window.shuffledQuestions || window.shuffled || []).length;
            const current = (window.currentQuestion || window.current || 0) + 1;
            if (total > 0) updateProgressColor(scoreAfter, current);
        };
    }, 200);
})();

// ── Hook into quiz results to trigger confetti ──
(function() {
    const checkInterval = setInterval(() => {
        const fn = window.showResults || window.showResultsScreen;
        if (typeof fn !== 'function') return;
        clearInterval(checkInterval);

        const fnName = window.showResults ? 'showResults' : 'showResultsScreen';
        const original = window[fnName];
        window[fnName] = function() {
            original.apply(this, arguments);
            // Check score percentage
            const total = (window.shuffledQuestions || window.shuffled || window.questions || []).length;
            const score = window.score || 0;
            const pct = total > 0 ? Math.round(score / total * 100) : 0;
            if (pct >= 80) {
                setTimeout(launchConfetti, 300);
            }
            streakCount = 0;
        };
    }, 200);
})();
