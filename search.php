<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/style-search.css">
</head>

<?php include("./dependances/header.php"); ?>

<?php
$articleDir = 'articles/*.txt';

$keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';

$articles = glob($articleDir);

usort($articles, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

$matchedArticles = array_filter($articles, function($article) use ($keywords) {
    $lines = file($article);
    $title = trim(str_replace('Title: ', '', $lines[0]));
    $content = trim(str_replace('Content:', '', implode("\n", array_slice($lines, 5))));
    return empty($keywords) || stripos($title, $keywords) !== false || stripos($content, $keywords) !== false;
});

if (!empty($matchedArticles)) {
    echo '<h2>Search results for "' . $keywords . '":</h2>';
    echo '<ul>';
    foreach ($matchedArticles as $article) {
        $lines = file($article);
        $title = trim(str_replace('Title: ', '', $lines[0]));
        $category = trim(str_replace('Category: ', '', $lines[2]));
        $creationDate = trim(str_replace('Creation date: ', '', $lines[3]));
        $creatorUsername = trim(str_replace('Creator username: ', '', $lines[4]));

        echo '<li>';
        echo '<h3><a href="' . $article . '">' . $title . '</a></h3>';
        if (!empty($category)) {
            echo '<p>Category: ' . $category . '</p>';
        }
        echo '<p>' . $creationDate . ' by ' . $creatorUsername . '</p>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No articles found for "' . $keywords . '".</p>';
}
?>

<form method="get">
    <label for="keywords">Search articles:</label>
    <input type="text" name="keywords" id="keywords" value="<?php echo htmlspecialchars($keywords); ?>">
    <button type="submit">Search</button>
</form>
