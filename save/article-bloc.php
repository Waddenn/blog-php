<?php
// Define article file path
$articleDir = 'articles/*.txt';

// Set category filter
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Set keyword filter
$keywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';

// Get all articles
$articles = glob($articleDir);

// Sort articles by creation date
usort($articles, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

// Filter articles by category and keyword
$filteredArticles = array_filter($articles, function($article) use ($category, $keywords) {
    $lines = file($article);
    $categoryLine = trim(str_replace('Category: ', '', $lines[2]));
    $content = implode('', array_slice($lines, 5));
    $matchCategory = empty($category) || $categoryLine == $category;
    $matchKeywords = empty($keywords) || stripos($content, $keywords) !== false;
    return $matchCategory && $matchKeywords;
});

// Limit articles to 5
$filteredArticles = array_slice($filteredArticles, 0, 5);

// Display articles
$lastCategory = '';
foreach ($filteredArticles as $article) {
    $lines = file($article);

    $title = trim(str_replace('Title: ', '', $lines[0]));
    $imageLink = trim(str_replace('Image link: ', '', $lines[1]));
    $category = trim(str_replace('Category: ', '', $lines[2]));
    $creationDate = trim(str_replace('Creation date: ', '', $lines[3]));
    $creatorUsername = trim(str_replace('Creator username: ', '', $lines[4]));
    $content = trim(str_replace('Content:', '', implode("\n", array_slice($lines, 5))));

    // Display category header if category exists and is different from last category
    if (!empty($category) && $category != $lastCategory) {
        echo '<h1>' . $category . '</h1>';
        $lastCategory = $category;
    }
    ?>
<section class="èreBoite">    
  <header class="profil">
    <img id="imageprofilr" src="Admin-Profile-PNG-Clipart.png">
    <div>
      <h2><a href="article-created.php?article=articles/<?php echo basename($article) ?>"><?php echo $title ?></a></h2>
      <span class="gris"><p><?php echo $creationDate ?></p></span>
    </div>
  </header>
  <img src="<?php echo $imageLink ?>">
  <div class="content">
    <p><?php echo substr($content, 0, 600) ?></p>
  </div>
  <footer class="réactions">
    <div class="logoflex">
      <img src="pouce.png">
      <p>
        <span class="gris">120 pouces</span>
      </p>
    </div>
    <div class="logoflex">
      <img src="message.png">
      <p>
        <span class="gris">12 commentaires</span>
        </p>
      </div>
    </footer>
  </section>
<?php } ?>  