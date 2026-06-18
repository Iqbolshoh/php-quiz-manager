<?php include './header.php' ?>

<div class="bg-white rounded-2xl shadow-sm p-8">

    <?php
    $tests = json_decode(file_get_contents('../data/tests.json'), true);
    ?>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Quizlar</h1>

        <a href="test-create.php"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            <i class="fa-solid fa-plus"></i>
            Quiz qo'shish
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-slate-200">
            <thead class="bg-slate-100">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Savol</th>
                    <th class="p-3 text-center">Variantlar</th>
                    <th class="p-3 text-center">Ball</th>
                    <th class="p-3 text-center">Amallar</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($tests as $test): ?>
                    <tr class="border-t hover:bg-slate-50">

                        <td class="p-3">
                            <?= $test['id'] ?>
                        </td>

                        <td class="p-3">
                            <?= htmlspecialchars($test['question']) ?>
                        </td>

                        <td class="p-3 text-center">
                            <?= count($test['variants']) ?>
                        </td>

                        <td class="p-3 text-center">
                            <?= $test['ball'] ?>
                        </td>

                        <td class="p-3">
                            <div class="flex justify-center gap-2">

                                <a href="test-edit.php?id=<?= $test['id'] ?>"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="test-delete.php" method="POST" class="inline">
                                    <input type="hidden" name="id" value="<?= $test['id'] ?>">

                                    <button
                                        type="submit"
                                        onclick="return confirm('Rostdan ham o‘chirmoqchimisiz?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

</div>

<?php include './footer.php' ?>