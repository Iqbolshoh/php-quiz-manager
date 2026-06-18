<?php include './header.php' ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $question = trim($_POST['question']);

    $variants = array_values(
        array_filter(
            array_map('trim', $_POST['variants'])
        )
    );

    $correctIndex = (int) $_POST['correctIndex'];
    $ball = (int) $_POST['ball'];

    $file = '../data/tests.json';

    $tests = json_decode(file_get_contents($file), true) ?? [];

    $newId = empty($tests)
        ? 1
        : max(array_column($tests, 'id')) + 1;

    $tests[] = [
        'id' => $newId,
        'question' => $question,
        'variants' => $variants,
        'correctIndex' => $correctIndex,
        'ball' => $ball,
    ];

    file_put_contents(
        $file,
        json_encode(
            $tests,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        )
    );

    header('Location: test.php?created=1');
    exit;
}

?>

<div class="bg-white rounded-2xl shadow-sm p-8">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">
            test qo'shish
        </h1>

        <a href="test.php"
            class="bg-slate-600 hover:bg-slate-700 text-white px-4 py-2 rounded-lg">
            Orqaga
        </a>
    </div>

    <form method="POST" class="space-y-6">

        <div>
            <label class="block mb-2 font-medium">
                Savol
            </label>

            <textarea
                name="question"
                rows="4"
                required
                class="w-full border rounded-lg p-3"></textarea>
        </div>

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

                <div class="variant-row flex gap-2 mb-3">
                    <input
                        type="text"
                        name="variants[]"
                        required
                        class="flex-1 border rounded-lg p-3">

                    <button
                        type="button"
                        onclick="removeVariant(this)"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 rounded-lg">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

                <div class="variant-row flex gap-2 mb-3">
                    <input
                        type="text"
                        name="variants[]"
                        required
                        class="flex-1 border rounded-lg p-3">

                    <button
                        type="button"
                        onclick="removeVariant(this)"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 rounded-lg">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

            </div>

        </div>

        <div>
            <label class="block mb-2 font-medium">
                To'g'ri javob
            </label>

            <select
                id="correctIndex"
                name="correctIndex"
                class="w-full border rounded-lg p-3">

                <option value="0">Variant 1</option>
                <option value="1">Variant 2</option>

            </select>
        </div>

        <div>
            <label class="block mb-2 font-medium">
                Ball
            </label>

            <input
                type="number"
                name="ball"
                min="1"
                value="10"
                required
                class="w-full border rounded-lg p-3">
        </div>

        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">

            <i class="fa-solid fa-floppy-disk"></i>
            Saqlash

        </button>

    </form>

</div>

<script>
    function updateCorrectOptions() {

        const rows = document.querySelectorAll('.variant-row');
        const select = document.getElementById('correctIndex');

        select.innerHTML = '';

        rows.forEach((row, index) => {

            const option = document.createElement('option');

            option.value = index;
            option.textContent = `Variant ${index + 1}`;

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
                required
                class="flex-1 border rounded-lg p-3">

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