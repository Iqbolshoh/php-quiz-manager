<?php
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['logined'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class="bg-slate-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-72 bg-slate-900 text-white shadow-xl">

            <div class="p-6 border-b border-slate-700">
                <h2 class="text-2xl font-bold flex items-center gap-3">
                    <i class="fa-solid fa-shield-halved text-blue-400"></i>
                    Admin Panel
                </h2>
            </div>

            <nav class="p-4">
                <ul class="space-y-2">

                    <li>
                        <a href="index.php"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800">
                            <i class="fa-solid fa-house"></i>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="quiz.php"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800">
                            <i class="fa-solid fa-list"></i>
                            Quizlar
                        </a>
                    </li>

                    <li>
                        <a href="quiz-create.php"
                            class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800">
                            <i class="fa-solid fa-plus"></i>
                            Quiz qo'shish
                        </a>
                    </li>
                </ul>
            </nav>

        </aside>

        <!-- Right Side -->
        <div class="flex-1 flex flex-col">

            <!-- Navbar -->
            <header class="h-16 bg-white border-b flex items-center justify-between px-8">

                <div>
                    <h1 class="font-semibold text-lg">
                        Dashboard
                    </h1>
                </div>

                <div class="flex items-center gap-4">

                    <button class="relative">
                        <i class="fa-solid fa-bell text-xl text-slate-600"></i>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                            A
                        </div>

                        <div>
                            <p class="font-medium">Admin</p>
                            <p class="text-xs text-slate-500">Administrator</p>
                        </div>
                    </div>

                </div>

            </header>

            <!-- Content -->
            <main class="flex-1 p-8">