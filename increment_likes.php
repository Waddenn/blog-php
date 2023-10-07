<?php
if (isset($_POST['article'])) {
    $article = $_POST['article'];
    $likesDir = "likes/" . pathinfo($article, PATHINFO_FILENAME);

    if (!file_exists($likesDir)) {
        mkdir($likesDir, 0777, true);
    }

    $likesFile = $likesDir . "/likes.txt";

    if (!file_exists($likesFile)) {
        file_put_contents($likesFile, "0");
    }

    $currentLikes = file_get_contents($likesFile);
    $updatedLikes = intval($currentLikes) + 1;
    file_put_contents($likesFile, strval($updatedLikes));

    echo $updatedLikes;
}
?>
