<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: test.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

$file = '../data/tests.json';

$tests = json_decode(file_get_contents($file), true);

$tests = array_values(array_filter($tests, function ($test) use ($id) {
    return $test['id'] != $id;
}));

file_put_contents(
    $file,
    json_encode(
        $tests,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    )
);

header('Location: test.php?deleted=1');
exit;
