<?php include './header.php' ?>

<?php

$testId = $_GET['id'] ?? null;

$tests = json_decode(file_get_contents('../data/tests.json'), true);

$editTest = null;

foreach ($tests as $test) {
    if ($test['id'] == $testId) {
        $editTest = $test;
        break;
    }
}

if (!$editTest) {
    die('Quiz topilmadi!');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $question = trim($_POST['question']);
    $variants = array_map('trim', $_POST['variants']);
    $correctIndex = (int) $_POST['correctIndex'];
    $ball = (int) $_POST['ball'];

    foreach ($tests as $index => $test) {

        if ($test['id'] == $testId) {

            $tests[$index] = [
                'id' => $test['id'],
                'question' => $question,
                'variants' => $variants,
                'correctIndex' => $correctIndex,
                'ball' => $ball
            ];

            break;
        }
    }

    file_put_contents(
        '../data/tests.json',
        json_encode(
            $tests,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        )
    );

    header('Location: test.php?updated=1');
    exit;
}
?>

<div class="bg-white rounded-2xl shadow-sm p-8">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">
            Quizni tahrirlash
        </h1>

        <a href="quiz.php"
            class="bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg">
            Orqaga
        </a>
    </div>

    <form action="" method="POST" class="space-y-6">

        <input type="hidden" name="id" value="<?= $editTest['id'] ?>">

        <!-- Savol -->
        <div>
            <label class="block mb-2 font-medium">
                Savol
            </label>

            <textarea
                name="question"
                rows="4"
                class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required><?= htmlspecialchars($editTest['question']) ?></textarea>
        </div>

        <!-- Variantlar -->
        <div>

            <div class="flex items-center justify-between mb-3">
                <label class="font-medium">
                    Variantlar
                </label>

                <button
                    type="button"
                    onclick="addVariant()"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    <i class="fa-solid fa-plus"></i>
                    Variant qo'shish
                </button>
            </div>

            <div id="variants-container">

                <?php foreach ($editTest['variants'] as $variant): ?>

                    <div class="variant-row flex gap-2 mb-3">

                        <input
                            type="text"
                            name="variants[]"
                            value="<?= htmlspecialchars($variant) ?>"
                            class="flex-1 border rounded-lg p-3"
                            required>

                        <button
                            type="button"
                            onclick="removeVariant(this)"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 rounded-lg">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

        <!-- To'g'ri javob -->
        <div>

            <label class="block mb-2 font-medium">
                To'g'ri javob
            </label>

            <select
                id="correctIndex"
                name="correctIndex"
                class="w-full border rounded-lg p-3">

                <?php foreach ($editTest['variants'] as $i => $variant): ?>

                    <option
                        value="<?= $i ?>"
                        <?= $editTest['correctIndex'] == $i ? 'selected' : '' ?>>
                        Variant <?= $i + 1 ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <!-- Ball -->
        <div>

            <label class="block mb-2 font-medium">
                Ball
            </label>

            <input
                type="number"
                name="ball"
                min="1"
                value="<?= $editTest['ball'] ?>"
                class="w-full border rounded-lg p-3">

        </div>

        <!-- Tugmalar -->
        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">

                <i class="fa-solid fa-floppy-disk"></i>
                Saqlash

            </button>

            <a
                href="./test.php"
                class="bg-slate-500 hover:bg-slate-600 text-white px-5 py-3 rounded-lg">

                Bekor qilish

            </a>

        </div>

    </form>

</div>

<script>
    function updateCorrectOptions() {

        const rows = document.querySelectorAll('.variant-row');
        const select = document.getElementById('correctIndex');

        const selected = select.value;

        select.innerHTML = '';

        rows.forEach((row, index) => {

            const option = document.createElement('option');

            option.value = index;
            option.textContent = `Variant ${index + 1}`;

            if (selected == index) {
                option.selected = true;
            }

            select.appendChild(option);

        });
    }

    function addVariant() {

        const container = document.getElementById('variants-container');

        const div = document.createElement('div');

        div.className = 'variant-row flex gap-2 mb-3';

        div.innerHTML = `
            <input
                type="text"
                name="variants[]"
                class="flex-1 border rounded-lg p-3"
                required>

            <button
                type="button"
                onclick="removeVariant(this)"
                class="bg-red-600 hover:bg-red-700 text-white px-4 rounded-lg">
                <i class="fa-solid fa-trash"></i>
            </button>
        `;

        container.appendChild(div);

        updateCorrectOptions();
    }

    function removeVariant(button) {

        const rows = document.querySelectorAll('.variant-row');

        if (rows.length <= 2) {
            alert('Kamida 2 ta variant bo‘lishi kerak!');
            return;
        }

        button.parentElement.remove();

        updateCorrectOptions();
    }
</script>

<?php include './footer.php' ?>