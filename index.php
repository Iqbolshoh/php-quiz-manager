<!DOCTYPE html>
<html lang="uz" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Test ishlash | Savol bo'yicha</title>
    <!-- Tailwind CSS 3 CDN (barqaror versiya) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide ikonlar kutubxonasi -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <script>
        // Tailwind konfiguratsiyasi
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-primary: #f1f5f9;
            --bg-card: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
        }

        .dark {
            --bg-primary: #0f172a;
            --bg-card: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --border-color: #334155;
            --primary: #60a5fa;
            --primary-dark: #3b82f6;
            --success: #34d399;
            --error: #f87171;
            --warning: #fbbf24;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .variant-item {
            background-color: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 0.75rem;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .variant-item:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .variant-selected {
            border-color: var(--primary) !important;
            background-color: rgba(59, 130, 246, 0.05) !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .dark .variant-selected {
            background-color: rgba(96, 165, 250, 0.1) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: var(--bg-primary);
        }

        .btn-secondary:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .progress-bar {
            background-color: var(--border-color);
            border-radius: 9999px;
            height: 0.5rem;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6, #2563eb);
            border-radius: 9999px;
            transition: width 0.3s ease;
        }

        .icon-wrapper {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-weight: 700;
            font-size: 0.875rem;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-primary {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .badge-secondary {
            background-color: var(--bg-primary);
            color: var(--text-secondary);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        .theme-toggle {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            border: 1px solid var(--border-color);
            background-color: var(--bg-card);
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            transform: scale(1.05);
            border-color: var(--primary);
        }
    </style>
</head>

<body class="min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-6">
        <!-- Header -->
        <div class="fade-in mb-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                        <i data-lucide="graduation-cap" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold" style="color: var(--text-primary);">Test ishlash</h1>
                        <p class="text-sm" style="color: var(--text-secondary);">Matematika bo'limi</p>
                    </div>
                </div>

                <!-- Dark mode toggle -->
                <button onclick="toggleDarkMode()" class="theme-toggle">
                    <i data-lucide="moon" class="w-5 h-5 dark-mode-icon"></i>
                </button>
            </div>

            <!-- Progress -->
            <div class="flex items-center justify-between mb-3">
                <span class="badge badge-secondary" id="questionCounter">1/5</span>
                <span class="text-sm" style="color: var(--text-secondary);" id="progressText">5 ta savoldan 1-si</span>
            </div>

            <div class="progress-bar">
                <div class="progress-fill" id="progressBar" style="width: 20%;"></div>
            </div>
        </div>

        <!-- Savol kartasi -->
        <div class="card p-6 md:p-8 mb-6 fade-in">
            <!-- Savol sarlavhasi -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="badge badge-primary" id="questionNumber">1-savol</span>
                    <span class="badge badge-secondary flex items-center gap-1">
                        <i data-lucide="star" class="w-3 h-3"></i>
                        <span id="questionBall">10 ball</span>
                    </span>
                </div>
                <h2 class="text-xl md:text-2xl font-semibold leading-relaxed" style="color: var(--text-primary);" id="questionText">
                    Savol yuklanmoqda...
                </h2>
            </div>

            <!-- Variantlar -->
            <div class="space-y-3 mb-6" id="variantsContainer">
                <!-- Dinamik to'ldiriladi -->
            </div>

            <!-- Status -->
            <div class="flex items-center justify-center gap-2 text-sm" style="color: var(--text-secondary);" id="selectionStatus">
                <i data-lucide="mouse-pointer-click" class="w-4 h-4"></i>
                <span>Javobni tanlash uchun variant ustiga bosing</span>
            </div>
        </div>

        <!-- Navigatsiya -->
        <div class="flex items-center justify-between gap-3 mb-4 fade-in">
            <button id="prevButton" class="btn-secondary flex items-center gap-2" disabled>
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
                Oldingi
            </button>

            <button id="nextButton" class="btn-primary flex items-center gap-2">
                Keyingi
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Nuqtalar -->
        <div class="flex justify-center gap-2 mb-2" id="dotsIndicator">
            <!-- Dinamik to'ldiriladi -->
        </div>

        <!-- Klaviatura yorliqlari -->
        <div class="text-center" style="color: var(--text-secondary);">
            <p class="text-xs flex items-center justify-center gap-3">
                <span class="flex items-center gap-1">
                    <i data-lucide="arrow-left" class="w-3 h-3"></i> ←
                </span>
                <span class="flex items-center gap-1">
                    → <i data-lucide="arrow-right" class="w-3 h-3"></i>
                </span>
                <span>1-4 tugmalari</span>
            </p>
        </div>
    </div>

    <script>
        // Lucide ikonlarini ishga tushirish
        lucide.createIcons();

        // Global o'zgaruvchilar
        let tests = [];
        let currentQuestionIndex = 0;
        let userAnswers = {};
        let isDarkMode = false;

        // Dark mode funksiyasi
        function toggleDarkMode() {
            isDarkMode = !isDarkMode;
            document.documentElement.classList.toggle('dark', isDarkMode);
            localStorage.setItem('darkMode', isDarkMode);
            updateDarkModeIcon();
            lucide.createIcons();
        }

        function updateDarkModeIcon() {
            const icon = document.querySelector('.dark-mode-icon');
            if (icon) {
                icon.setAttribute('data-lucide', isDarkMode ? 'sun' : 'moon');
                lucide.createIcons();
            }
        }

        // Saqlangan dark mode holatini tekshirish
        if (localStorage.getItem('darkMode') === 'true') {
            isDarkMode = true;
            document.documentElement.classList.add('dark');
        }
        updateDarkModeIcon();

        // tests.json faylini yuklash
        async function loadTests() {
            try {
                const response = await fetch('./data/tests.json');
                if (!response.ok) {
                    throw new Error('tests.json yuklab bo\'lmadi');
                }
                tests = await response.json();

                tests.forEach(test => {
                    userAnswers[test.id] = null;
                });

                createDotsIndicator();
                renderQuestion(0);
                lucide.createIcons();

            } catch (error) {
                console.error('Xatolik:', error);
                // Agar tests.json topilmasa, demo test ma'lumotlari
                tests = [{
                        id: 1,
                        question: "2 + 2 * 2 ifodaning qiymati nechaga teng?",
                        variants: ["8", "6", "4", "10"],
                        correctIndex: 1,
                        ball: 10
                    },
                    {
                        id: 2,
                        question: "O'zbekistonning poytaxti qaysi shahar?",
                        variants: ["Samarqand", "Buxoro", "Toshkent", "Namangan"],
                        correctIndex: 2,
                        ball: 5
                    },
                    {
                        id: 3,
                        question: "Quyidagilardan qaysi biri dasturlash tili?",
                        variants: ["HTML", "CSS", "Python", "XML"],
                        correctIndex: 2,
                        ball: 10
                    },
                    {
                        id: 4,
                        question: "Yer Quyosh atrofida necha kunda aylanib chiqadi?",
                        variants: ["30 kun", "365 kun", "180 kun", "24 kun"],
                        correctIndex: 1,
                        ball: 15
                    },
                    {
                        id: 5,
                        question: "3x² + 2x - 5 funksiyaning hosilasini toping",
                        variants: ["6x + 2", "3x² + 2", "6x + 2x", "x² + 2x"],
                        correctIndex: 0,
                        ball: 20
                    }
                ];

                tests.forEach(test => {
                    userAnswers[test.id] = null;
                });

                createDotsIndicator();
                renderQuestion(0);
                lucide.createIcons();
            }
        }

        // Nuqtalar indikatorini yaratish
        function createDotsIndicator() {
            const dotsContainer = document.getElementById('dotsIndicator');
            dotsContainer.innerHTML = '';

            tests.forEach((test, index) => {
                const dot = document.createElement('button');
                dot.style.width = '0.625rem';
                dot.style.height = '0.625rem';
                dot.style.borderRadius = '50%';
                dot.style.border = 'none';
                dot.style.backgroundColor = 'var(--border-color)';
                dot.style.cursor = 'pointer';
                dot.style.transition = 'all 0.2s ease';
                dot.setAttribute('data-index', index);
                dot.title = `${index + 1}-savolga o'tish`;

                dot.addEventListener('click', () => {
                    if (index !== currentQuestionIndex) {
                        renderQuestion(index);
                    }
                });

                dot.addEventListener('mouseenter', () => {
                    if (index !== currentQuestionIndex) {
                        dot.style.transform = 'scale(1.3)';
                    }
                });

                dot.addEventListener('mouseleave', () => {
                    dot.style.transform = 'scale(1)';
                });

                dotsContainer.appendChild(dot);
            });
        }

        // Nuqtalarni yangilash
        function updateDots() {
            const dots = document.querySelectorAll('#dotsIndicator button[data-index]');
            dots.forEach((dot, index) => {
                dot.style.width = '0.625rem';
                dot.style.height = '0.625rem';

                if (index === currentQuestionIndex) {
                    dot.style.width = '0.75rem';
                    dot.style.height = '0.75rem';
                    dot.style.backgroundColor = '#3b82f6';
                    dot.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.3)';
                } else if (userAnswers[tests[index].id] !== null) {
                    dot.style.backgroundColor = '#10b981';
                    dot.style.boxShadow = 'none';
                } else {
                    dot.style.backgroundColor = 'var(--border-color)';
                    dot.style.boxShadow = 'none';
                }
            });
        }

        // Savolni render qilish
        function renderQuestion(index) {
            if (index < 0 || index >= tests.length) return;

            currentQuestionIndex = index;
            const test = tests[index];

            document.getElementById('questionNumber').textContent = `${test.id}-savol`;
            document.getElementById('questionBall').textContent = `${test.ball} ball`;
            document.getElementById('questionText').textContent = test.question;

            document.getElementById('questionCounter').textContent = `${index + 1}/${tests.length}`;
            document.getElementById('progressText').textContent = `${tests.length} ta savoldan ${index + 1}-si`;

            const progressPercent = ((index + 1) / tests.length) * 100;
            document.getElementById('progressBar').style.width = progressPercent + '%';

            const variantsContainer = document.getElementById('variantsContainer');
            variantsContainer.innerHTML = '';

            const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

            test.variants.forEach((variant, vIndex) => {
                const variantDiv = document.createElement('div');
                variantDiv.className = 'variant-item';
                variantDiv.setAttribute('data-variant-index', vIndex);

                if (userAnswers[test.id] === vIndex) {
                    variantDiv.classList.add('variant-selected');
                }

                variantDiv.addEventListener('click', () => selectVariant(vIndex));

                variantDiv.innerHTML = `
                    <div class="icon-wrapper">
                        ${letters[vIndex]}
                    </div>
                    <span class="font-medium text-lg flex-1" style="color: var(--text-primary);">${variant}</span>
                    <span class="hidden" id="check-${letters[vIndex]}" style="color: var(--primary);">
                        <i data-lucide="check-circle" class="w-6 h-6"></i>
                    </span>
                `;

                variantsContainer.appendChild(variantDiv);
            });

            if (userAnswers[test.id] !== null) {
                updateSelectedVariantUI(userAnswers[test.id]);
            }

            updateStatusText();
            updateButtons();
            updateDots();
            lucide.createIcons();
        }

        // Variant tanlash
        function selectVariant(variantIndex) {
            const test = tests[currentQuestionIndex];

            // Avvalgi tanlovni tozalash
            const allVariants = document.querySelectorAll('.variant-item');
            allVariants.forEach(v => {
                v.classList.remove('variant-selected');
                const checkIcon = v.querySelector('[id^="check-"]');
                if (checkIcon) checkIcon.classList.add('hidden');
            });

            // Yangi tanlov
            userAnswers[test.id] = variantIndex;
            updateSelectedVariantUI(variantIndex);
            updateStatusText();
            updateDots();
            lucide.createIcons();
        }

        // Tanlangan variant UI
        function updateSelectedVariantUI(variantIndex) {
            const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

            const selectedVariant = document.querySelector(`[data-variant-index="${variantIndex}"]`);
            if (selectedVariant) {
                selectedVariant.classList.add('variant-selected');
                const checkIcon = document.getElementById(`check-${letters[variantIndex]}`);
                if (checkIcon) {
                    checkIcon.classList.remove('hidden');
                }
            }
        }

        // Status matni
        function updateStatusText() {
            const test = tests[currentQuestionIndex];
            const statusDiv = document.getElementById('selectionStatus');
            const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

            if (userAnswers[test.id] !== null) {
                statusDiv.innerHTML = `
                    <i data-lucide="check-circle" class="w-4 h-4" style="color: var(--success);"></i>
                    <span><strong style="color: var(--primary);">${letters[userAnswers[test.id]]}</strong> variant tanlandi</span>
                `;
            } else {
                statusDiv.innerHTML = `
                    <i data-lucide="mouse-pointer-click" class="w-4 h-4"></i>
                    <span>Javobni tanlash uchun variant ustiga bosing</span>
                `;
            }
            lucide.createIcons();
        }

        // Tugmalarni yangilash
        function updateButtons() {
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');

            prevButton.disabled = currentQuestionIndex === 0;

            if (currentQuestionIndex === tests.length - 1) {
                nextButton.innerHTML = `
                    Yakunlash
                    <i data-lucide="check" class="w-5 h-5"></i>
                `;
                nextButton.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            } else {
                nextButton.innerHTML = `
                    Keyingi
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                `;
                nextButton.style.background = 'linear-gradient(135deg, #3b82f6, #2563eb)';
            }
            lucide.createIcons();
        }

        // Keyingi savol
        function nextQuestion() {
            if (currentQuestionIndex < tests.length - 1) {
                renderQuestion(currentQuestionIndex + 1);
            } else {
                finishTest();
            }
        }

        // Oldingi savol
        function prevQuestion() {
            if (currentQuestionIndex > 0) {
                renderQuestion(currentQuestionIndex - 1);
            }
        }

        // Testni yakunlash
        function finishTest() {
            let totalBall = 0;
            let correctCount = 0;
            let resultsHTML = '';

            const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

            tests.forEach((test, index) => {
                const userAnswer = userAnswers[test.id];
                const isCorrect = userAnswer === test.correctIndex;

                if (isCorrect) {
                    correctCount++;
                    totalBall += test.ball;
                }

                resultsHTML += `
                    <div class="card p-4 mb-3" style="border-left: 4px solid ${isCorrect ? 'var(--success)' : 'var(--error)'};">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: ${isCorrect ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)'};">
                                <i data-lucide="${isCorrect ? 'check-circle' : 'x-circle'}" class="w-5 h-5" style="color: ${isCorrect ? 'var(--success)' : 'var(--error)'};"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold mb-2" style="color: var(--text-primary);">${index + 1}. ${test.question}</p>
                                <p class="text-sm mb-1">
                                    <span style="color: var(--text-secondary);">Javobingiz:</span>
                                    <span class="font-medium ml-1" style="color: ${isCorrect ? 'var(--success)' : 'var(--error)'};">
                                        ${userAnswer !== null ? letters[userAnswer] + ') ' + test.variants[userAnswer] : 'Belgilanmagan'}
                                    </span>
                                </p>
                                ${!isCorrect ? `
                                    <p class="text-sm mb-1">
                                        <span style="color: var(--text-secondary);">To'g'ri javob:</span>
                                        <span class="font-medium ml-1" style="color: var(--success);">
                                            ${letters[test.correctIndex]}) ${test.variants[test.correctIndex]}
                                        </span>
                                    </p>
                                ` : ''}
                                <div class="flex items-center gap-1 mt-2">
                                    <i data-lucide="star" class="w-3 h-3" style="color: var(--warning);"></i>
                                    <span class="text-xs font-medium" style="color: var(--warning);">${test.ball} ball</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            const percentage = Math.round((correctCount / tests.length) * 100);
            const emoji = percentage >= 80 ? '🏆' : percentage >= 60 ? '👏' : percentage >= 40 ? '📚' : '💪';

            document.querySelector('.max-w-2xl').innerHTML = `
                <div class="card p-6 md:p-8 fade-in">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                            <i data-lucide="trophy" class="w-10 h-10 text-white"></i>
                        </div>
                        <h2 class="text-3xl font-bold mb-2" style="color: var(--text-primary);">
                            Test yakunlandi! ${emoji}
                        </h2>
                        <p style="color: var(--text-secondary);">Natijangiz</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="card p-4 text-center" style="background-color: var(--bg-primary);">
                            <div class="text-3xl font-bold mb-1" style="color: var(--primary);">${correctCount}/${tests.length}</div>
                            <p class="text-sm" style="color: var(--text-secondary);">To'g'ri javoblar</p>
                        </div>
                        <div class="card p-4 text-center" style="background-color: var(--bg-primary);">
                            <div class="text-3xl font-bold mb-1" style="color: var(--success);">${totalBall}</div>
                            <p class="text-sm" style="color: var(--text-secondary);">Jami ball</p>
                        </div>
                    </div>

                    <div class="card p-4 mb-6" style="background-color: var(--bg-primary);">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium" style="color: var(--text-secondary);">Natija</span>
                            <span class="text-sm font-bold" style="color: var(--primary);">${percentage}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: ${percentage}%"></div>
                        </div>
                    </div>

                    <div class="mb-6">
                        ${resultsHTML}
                    </div>

                    <div class="flex gap-3">
                        <button onclick="location.reload()" class="btn-primary flex-1 flex items-center justify-center gap-2">
                            <i data-lucide="rotate-ccw" class="w-5 h-5"></i>
                            Qayta boshlash
                        </button>
                        <button onclick="window.print()" class="btn-secondary flex items-center justify-center">
                            <i data-lucide="printer" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            `;

            lucide.createIcons();
        }

        // Event listenerlar
        document.getElementById('nextButton').addEventListener('click', nextQuestion);
        document.getElementById('prevButton').addEventListener('click', prevQuestion);

        // Klaviatura navigatsiyasi
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') {
                e.preventDefault();
                nextQuestion();
            } else if (e.key === 'ArrowLeft') {
                e.preventDefault();
                prevQuestion();
            } else if (e.key >= '1' && e.key <= '8') {
                const index = parseInt(e.key) - 1;
                if (tests.length > 0 && index < tests[currentQuestionIndex].variants.length) {
                    selectVariant(index);
                }
            }
        });

        // Sahifa yuklanganda
        window.addEventListener('load', () => {
            loadTests();
            lucide.createIcons();
        });
    </script>
</body>

</html>