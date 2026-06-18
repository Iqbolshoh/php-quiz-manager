<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Test ishlash | Savol bo‘yicha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Segoe UI', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .variant-card {
            transition: all 0.2s ease;
        }

        .variant-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .variant-selected {
            border-color: #2563eb;
            background-color: #eff6ff;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.3);
        }

        .variant-correct {
            border-color: #16a34a;
            background-color: #f0fdf4;
            box-shadow: 0 0 0 2px rgba(22, 163, 74, 0.3);
        }

        .variant-incorrect {
            border-color: #dc2626;
            background-color: #fef2f2;
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.3);
        }

        .progress-fill {
            transition: width 0.3s ease;
        }

        body {
            background-color: #f8fafc;
        }
    </style>
</head>

<body class="font-sans antialiased h-screen flex flex-col">

    <div class="flex flex-col h-full max-w-2xl mx-auto w-full px-4 md:px-0 py-4">

        <!-- Yuqori qism: Test nomi va progress -->
        <div class="mb-6 mt-2">
            <div class="flex items-center justify-between mb-3">
                <h1 class="text-lg md:text-xl font-bold text-gray-800">
                    📋 Test ishlash
                </h1>
                <span class="text-sm font-medium bg-gray-200 text-gray-700 px-3 py-1 rounded-full" id="questionCounter">
                    1/5
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="progress-fill bg-blue-600 h-2.5 rounded-full" id="progressBar" style="width: 20%"></div>
            </div>
            <p class="text-xs text-gray-500 mt-2 text-right" id="progressText">5 ta savoldan 1-si</p>
        </div>

        <!-- Asosiy savol kartasi -->
        <div class="flex-1 flex flex-col bg-white rounded-2xl shadow-md border border-gray-100 p-6 md:p-8 relative">

            <!-- Savol raqami va matni -->
            <div class="mb-8">
                <div class="flex items-baseline gap-2 mb-3">
                    <span class="text-blue-600 font-bold text-lg bg-blue-50 px-3 py-1 rounded-lg" id="questionNumber">1-savol</span>
                    <span class="text-xs text-gray-500 font-medium" id="questionBall">10 ball</span>
                </div>
                <h2 class="text-xl md:text-2xl font-semibold text-gray-900 leading-relaxed" id="questionText">
                    Savol yuklanmoqda...
                </h2>
            </div>

            <!-- Variantlar ro'yxati -->
            <div class="space-y-4 flex-1" id="variantsContainer">
                <!-- Dinamik to'ldiriladi -->
            </div>

            <!-- Holat ko'rsatkichi -->
            <div class="mt-6 text-center text-sm text-gray-500" id="selectionStatus">
                Javobni tanlash uchun variant ustiga bosing
            </div>
        </div>

        <!-- Pastki navigatsiya -->
        <div class="mt-6 flex items-center justify-between gap-3 mb-2">
            <button id="prevButton" class="flex items-center justify-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-colors shadow-sm w-full md:w-auto disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Oldingi savol
            </button>

            <button id="nextButton" class="flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors shadow-md w-full md:w-auto">
                Keyingi savol
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Nuqtalar indikatori -->
        <div class="flex justify-center mt-2 pb-2" id="dotsIndicator">
            <!-- Dinamik to'ldiriladi -->
        </div>
    </div>

    <script>
        // Global o'zgaruvchilar
        let tests = [];
        let currentQuestionIndex = 0;
        let userAnswers = {}; // { questionId: selectedIndex }

        // tests.json faylini yuklash
        async function loadTests() {
            try {
                const response = await fetch('./data/tests.json');
                if (!response.ok) {
                    throw new Error('tests.json yuklab bo\'lmadi');
                }
                tests = await response.json();

                // Foydalanuvchi javoblari uchun bo'sh obyekt
                tests.forEach(test => {
                    userAnswers[test.id] = null;
                });

                // Nuqtalar indikatorini yaratish
                createDotsIndicator();

                // Birinchi savolni ko'rsatish
                renderQuestion(0);

            } catch (error) {
                console.error('Xatolik:', error);
                document.getElementById('questionText').textContent =
                    'Tests.json faylini yuklab bo\'lmadi. Iltimos, fayl mavjudligini tekshiring.';
            }
        }

        // Nuqtalar indikatorini yaratish
        function createDotsIndicator() {
            const dotsContainer = document.getElementById('dotsIndicator');
            dotsContainer.innerHTML = '<div class="flex space-x-2"></div>';
            const flexContainer = dotsContainer.querySelector('div');

            tests.forEach((test, index) => {
                const dot = document.createElement('span');
                dot.className = 'w-2 h-2 rounded-full bg-gray-300 cursor-pointer transition-colors';
                dot.setAttribute('data-index', index);
                dot.title = `${index + 1}-savolga o'tish`;
                dot.addEventListener('click', () => {
                    if (index !== currentQuestionIndex) {
                        renderQuestion(index);
                    }
                });
                flexContainer.appendChild(dot);
            });
        }

        // Nuqtalarni yangilash
        function updateDots() {
            const dots = document.querySelectorAll('#dotsIndicator span[data-index]');
            dots.forEach((dot, index) => {
                // Avval barcha klasslarni tozalash
                dot.className = 'w-2 h-2 rounded-full cursor-pointer transition-colors';

                if (index === currentQuestionIndex) {
                    // Joriy savol
                    dot.classList.add('bg-blue-600', 'w-3', 'h-3');
                } else if (userAnswers[tests[index].id] !== null) {
                    // Javob berilgan
                    dot.classList.add('bg-green-500');
                } else {
                    // Javob berilmagan
                    dot.classList.add('bg-gray-300');
                }
            });
        }

        // Savolni render qilish
        function renderQuestion(index) {
            if (index < 0 || index >= tests.length) return;

            currentQuestionIndex = index;
            const test = tests[index];

            // Savol raqami va matni
            document.getElementById('questionNumber').textContent = `${test.id}-savol`;
            document.getElementById('questionBall').textContent = `${test.ball} ball`;
            document.getElementById('questionText').textContent = test.question;

            // Counter yangilash
            document.getElementById('questionCounter').textContent = `${index + 1}/${tests.length}`;
            document.getElementById('progressText').textContent =
                `${tests.length} ta savoldan ${index + 1}-si`;

            // Progress bar yangilash
            const progressPercent = ((index + 1) / tests.length) * 100;
            document.getElementById('progressBar').style.width = progressPercent + '%';

            // Variantlarni yaratish
            const variantsContainer = document.getElementById('variantsContainer');
            variantsContainer.innerHTML = '';

            const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

            test.variants.forEach((variant, vIndex) => {
                const variantDiv = document.createElement('div');
                variantDiv.className = 'variant-card flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 transition-colors';
                variantDiv.setAttribute('data-variant-index', vIndex);
                variantDiv.addEventListener('click', () => selectVariant(vIndex));

                // Agar bu variant oldin tanlangan bo'lsa
                if (userAnswers[test.id] === vIndex) {
                    variantDiv.classList.add('variant-selected');
                }

                variantDiv.innerHTML = `
                    <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-full mr-4 text-sm">
                        ${letters[vIndex]}
                    </span>
                    <span class="text-gray-800 font-medium text-lg">${variant}</span>
                    <span class="ml-auto hidden text-blue-600" id="check-${letters[vIndex]}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                `;

                variantsContainer.appendChild(variantDiv);
            });

            // Agar oldin tanlangan javob bo'lsa, uni ko'rsatish
            if (userAnswers[test.id] !== null) {
                updateSelectedVariantUI(userAnswers[test.id]);
            }

            // Status matnini yangilash
            updateStatusText();

            // Tugmalarni yangilash
            updateButtons();

            // Nuqtalarni yangilash
            updateDots();
        }

        // Variant tanlash
        function selectVariant(variantIndex) {
            const test = tests[currentQuestionIndex];

            // Eski tanlovni o'chirish
            if (userAnswers[test.id] !== null) {
                const oldIndex = userAnswers[test.id];
                const oldVariant = document.querySelector(`[data-variant-index="${oldIndex}"]`);
                if (oldVariant) {
                    oldVariant.classList.remove('variant-selected', 'variant-correct', 'variant-incorrect');
                }
            }

            // Yangi tanlovni saqlash
            userAnswers[test.id] = variantIndex;

            // UI yangilash
            updateSelectedVariantUI(variantIndex);
            updateStatusText();
            updateDots();
        }

        // Tanlangan variant UI sini yangilash
        function updateSelectedVariantUI(variantIndex) {
            const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

            // Barcha check ikonkalarni yashirish
            document.querySelectorAll('[id^="check-"]').forEach(icon => {
                icon.classList.add('hidden');
            });

            // Tanlangan variantga klass qo'shish
            const selectedVariant = document.querySelector(`[data-variant-index="${variantIndex}"]`);
            if (selectedVariant) {
                selectedVariant.classList.add('variant-selected');

                // Check ikonkani ko'rsatish
                const checkIcon = document.getElementById(`check-${letters[variantIndex]}`);
                if (checkIcon) {
                    checkIcon.classList.remove('hidden');
                }
            }
        }

        // Status matnini yangilash
        function updateStatusText() {
            const test = tests[currentQuestionIndex];
            const statusDiv = document.getElementById('selectionStatus');
            const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

            if (userAnswers[test.id] !== null) {
                statusDiv.innerHTML = `Siz <span class="font-semibold text-blue-700">${letters[userAnswers[test.id]]}</span> variantni tanladingiz`;
            } else {
                statusDiv.textContent = 'Javobni tanlash uchun variant ustiga bosing';
            }
        }

        // Tugmalarni yangilash
        function updateButtons() {
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');

            // Oldingi tugma
            if (currentQuestionIndex === 0) {
                prevButton.disabled = true;
                prevButton.classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed');
            } else {
                prevButton.disabled = false;
                prevButton.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
            }

            // Keyingi tugma matni
            if (currentQuestionIndex === tests.length - 1) {
                nextButton.innerHTML = `
                    Yakunlash
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                `;
                nextButton.classList.add('bg-green-600', 'hover:bg-green-700');
                nextButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
            } else {
                nextButton.innerHTML = `
                    Keyingi savol
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                `;
                nextButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
                nextButton.classList.remove('bg-green-600', 'hover:bg-green-700');
            }
        }

        // Keyingi savol
        function nextQuestion() {
            if (currentQuestionIndex < tests.length - 1) {
                renderQuestion(currentQuestionIndex + 1);
            } else {
                // Test yakunlandi
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

            tests.forEach((test, index) => {
                const userAnswer = userAnswers[test.id];
                const isCorrect = userAnswer === test.correctIndex;
                const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

                if (isCorrect) {
                    correctCount++;
                    totalBall += test.ball;
                }

                resultsHTML += `
                    <div class="mb-4 p-4 rounded-lg ${isCorrect ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'}">
                        <p class="font-semibold text-gray-800">${index + 1}. ${test.question}</p>
                        <p class="text-sm mt-1">
                            Sizning javobingiz: 
                            <span class="font-medium ${isCorrect ? 'text-green-600' : 'text-red-600'}">
                                ${userAnswer !== null ? letters[userAnswer] + ') ' + test.variants[userAnswer] : 'Javob berilmagan'}
                            </span>
                        </p>
                        ${!isCorrect ? `
                            <p class="text-sm text-green-600">
                                To'g'ri javob: ${letters[test.correctIndex]}) ${test.variants[test.correctIndex]}
                            </p>
                        ` : ''}
                        <p class="text-xs text-gray-500 mt-1">${test.ball} ball</p>
                    </div>
                `;
            });

            // Natijalarni ko'rsatish
            document.querySelector('.max-w-2xl').innerHTML = `
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Test yakunlandi! 🎉</h2>
                    <div class="flex gap-4 mb-6">
                        <div class="bg-blue-50 rounded-xl p-4 flex-1 text-center">
                            <p class="text-3xl font-bold text-blue-600">${correctCount}/${tests.length}</p>
                            <p class="text-sm text-gray-600">To'g'ri javoblar</p>
                        </div>
                        <div class="bg-green-50 rounded-xl p-4 flex-1 text-center">
                            <p class="text-3xl font-bold text-green-600">${totalBall}</p>
                            <p class="text-sm text-gray-600">Jami ball</p>
                        </div>
                    </div>
                    <div class="mb-6">
                        ${resultsHTML}
                    </div>
                    <button onclick="location.reload()" class="w-full py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
                        Testni qaytadan boshlash
                    </button>
                </div>
            `;
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
                if (index < tests[currentQuestionIndex].variants.length) {
                    selectVariant(index);
                }
            }
        });

        // Sahifa yuklanganda testlarni yuklash
        window.addEventListener('load', loadTests);
    </script>

</body>

</html>