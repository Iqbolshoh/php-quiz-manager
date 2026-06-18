<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Test ishlash | Savol bo‘yicha</title>
    <!-- Tailwind CSS CDN (barqaror versiya) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Qo'shimcha konfiguratsiya yoki shriftlar uchun -->
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
        /* variantlar ustiga sichqoncha olib borilganda yumshoq effekt */
        .variant-card {
            transition: all 0.2s ease;
        }

        .variant-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        /* tanlangan variant uchun stil (JavaScript orqali qo'shiladi) */
        .variant-selected {
            border-color: #2563eb;
            background-color: #eff6ff;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.3);
        }

        /* progress bar animatsiyasi */
        .progress-fill {
            transition: width 0.3s ease;
        }

        body {
            background-color: #f8fafc;
        }
    </style>
</head>

<body class="font-sans antialiased h-screen flex flex-col">

    <!-- Asosiy konteyner: toʻliq ekran balandligi, ichidagi kontent markazlashtirilgan -->
    <div class="flex flex-col h-full max-w-2xl mx-auto w-full px-4 md:px-0 py-4">

        <!-- Yuqori qism: Test nomi va progress indikatori -->
        <div class="mb-6 mt-2">
            <div class="flex items-center justify-between mb-3">
                <h1 class="text-lg md:text-xl font-bold text-gray-800">
                    📋 Matematika testi
                </h1>
                <span class="text-sm font-medium bg-gray-200 text-gray-700 px-3 py-1 rounded-full">
                    4/12
                </span>
            </div>
            <!-- Progress bar -->
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="progress-fill bg-blue-600 h-2.5 rounded-full" style="width: 33%"></div>
            </div>
            <p class="text-xs text-gray-500 mt-2 text-right">12 ta savoldan 4-si</p>
        </div>

        <!-- Asosiy karta: 1 ta savol va uning variantlari (toʻliq koʻrinadi) -->
        <div class="flex-1 flex flex-col bg-white rounded-2xl shadow-md border border-gray-100 p-6 md:p-8 relative">

            <!-- Savol raqami va matni -->
            <div class="mb-8">
                <div class="flex items-baseline gap-2 mb-3">
                    <span class="text-blue-600 font-bold text-lg bg-blue-50 px-3 py-1 rounded-lg">4-savol</span>
                    <span class="text-xs text-gray-500 font-medium">10 ball</span>
                </div>
                <h2 class="text-xl md:text-2xl font-semibold text-gray-900 leading-relaxed">
                    Quyidagi funksiyaning hosilasini toping: <br>
                    <span class="text-blue-700 font-mono text-lg bg-blue-50 px-2 py-0.5 rounded">f(x) = 3x² + 2x - 5</span>
                </h2>
            </div>

            <!-- Variantlar ro'yxati (A, B, C, D) -->
            <div class="space-y-4 flex-1">

                <!-- Variant A -->
                <div class="variant-card flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 transition-colors" onclick="selectVariant(this, 'A')" id="variant-A">
                    <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-full mr-4 text-sm">A</span>
                    <span class="text-gray-800 font-medium text-lg">6x + 2</span>
                    <span class="ml-auto hidden text-blue-600" id="check-A">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                </div>

                <!-- Variant B -->
                <div class="variant-card flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 transition-colors" onclick="selectVariant(this, 'B')" id="variant-B">
                    <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-full mr-4 text-sm">B</span>
                    <span class="text-gray-800 font-medium text-lg">3x² + 2</span>
                    <span class="ml-auto hidden text-blue-600" id="check-B">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                </div>

                <!-- Variant C -->
                <div class="variant-card flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 transition-colors" onclick="selectVariant(this, 'C')" id="variant-C">
                    <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-full mr-4 text-sm">C</span>
                    <span class="text-gray-800 font-medium text-lg">6x + 2x</span>
                    <span class="ml-auto hidden text-blue-600" id="check-C">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                </div>

                <!-- Variant D -->
                <div class="variant-card flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-400 transition-colors" onclick="selectVariant(this, 'D')" id="variant-D">
                    <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-gray-100 text-gray-700 font-bold rounded-full mr-4 text-sm">D</span>
                    <span class="text-gray-800 font-medium text-lg">x² + 2x</span>
                    <span class="ml-auto hidden text-blue-600" id="check-D">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Tanlov haqida qisqa ma'lumot (ixtiyoriy) -->
            <div class="mt-6 text-center text-sm text-gray-500" id="selection-status">
                Javobni tanlash uchun variant ustiga bosing
            </div>
        </div>

        <!-- Pastki navigatsiya tugmalari: Oldingi / Keyingi savol -->
        <div class="mt-6 flex items-center justify-between gap-3 mb-2">
            <button class="flex items-center justify-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-colors shadow-sm w-full md:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Oldingi savol
            </button>

            <button class="flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors shadow-md w-full md:w-auto">
                Keyingi savol
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Sahifa ko'rsatkichi (nuqtalar) -->
        <div class="flex justify-center mt-2 pb-2">
            <div class="flex space-x-2">
                <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                <span class="w-2 h-2 rounded-full bg-gray-300"></span>
            </div>
        </div>
    </div>

    <!-- JavaScript: variant tanlash funksiyasi -->
    <script>
        // Hozirgi tanlangan variantni kuzatish uchun
        let currentSelectedId = null;

        function selectVariant(element, variantLetter) {
            // Avval barcha variantlardan tanlangan klassni olib tashlaymiz
            const allVariants = document.querySelectorAll('.variant-card');
            allVariants.forEach(card => {
                card.classList.remove('variant-selected');
                // barcha belgi (check) ikonkalarni yashiramiz
                const checkIcon = card.querySelector('[id^="check-"]');
                if (checkIcon) checkIcon.classList.add('hidden');
            });

            // Yangi tanlangan variantga klass qo'shamiz
            element.classList.add('variant-selected');

            // Shu variantga tegishli check belgisini ko'rsatamiz
            const checkIcon = document.getElementById('check-' + variantLetter);
            if (checkIcon) {
                checkIcon.classList.remove('hidden');
            }

            // Holat matnini yangilash
            const statusDiv = document.getElementById('selection-status');
            if (statusDiv) {
                statusDiv.innerHTML = `Siz <span class="font-semibold text-blue-700">${variantLetter}</span> variantni tanladingiz`;
            }

            // Joriy tanlangan ID ni yangilash (agar kerak bo'lsa)
            currentSelectedId = element.id;

            // Konsolga chiqarish (tekshirish uchun)
            console.log(`Tanlangan variant: ${variantLetter}, element ID: ${element.id}`);
        }

        // Sahifa yuklanganda, agar oldin tanlangan bo'lsa (real loyihada serverdan keladi), shuni ko'rsatish mumkin.
        // Hozircha demo uchun bo'sh.
        window.addEventListener('load', () => {
            // Misol uchun avtomatik A variantni tanlab qo'yish (ixtiyoriy)
            // const defaultVariant = document.getElementById('variant-A');
            // if(defaultVariant) selectVariant(defaultVariant, 'A');
        });
    </script>

</body>

</html>