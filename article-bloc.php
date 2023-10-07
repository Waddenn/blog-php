<?php include("CommentCount.php");?>

<?php
$articleDir = 'articles/*.txt';
function getLikeCount($likesFile) {
  if (file_exists($likesFile)) {
      return intval(file_get_contents($likesFile));
  } else {
      return 0;
  }
}

$articles = glob($articleDir);

usort($articles, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

function searchArticles($articles, $searchQuery) {
  return array_filter($articles, function($article) use ($searchQuery) {
      $lines = file($article);
      $title = trim(str_replace('Title: ', '', $lines[0]));
      $content = trim(str_replace('Content:', '', implode("\n", array_slice($lines, 5))));
      return stripos($title, $searchQuery) !== false || stripos($content, $searchQuery) !== false;
  });
}

function filterByCategory($articles, $category) {
    return array_filter($articles, function($article) use ($category) {
        $lines = file($article);
        $categoryLine = trim(str_replace('Category: ', '', $lines[2]));
        return empty($category) || $categoryLine == $category;
    });
}

if (isset($_GET['q'])) {
  $searchQuery = trim($_GET['q']);
  $filteredArticles = searchArticles($articles, $searchQuery);
} else {
  $filteredArticles = $articles;
}

if (isset($_GET['category'])) {
  $category = $_GET['category'];
  $filteredArticles = filterByCategory($filteredArticles, $category);
if (empty($filteredArticles)) {
      echo "<p>No articles found in the '$category' category.</p>";
  }
}

$filteredArticles = array_slice($filteredArticles, 0, 10);

$lastCategory = '';
foreach ($filteredArticles as $article) {
    $lines = file($article);
    ?>

<?php include("dataArticleExtraction.php");?>
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
  <i id="thumb" class="fa-solid fa-thumbs-up" data-article="<?php echo basename($article) ?>"></i>
  <p>
    <span class="gris">
      <?php
        $likesFile = 'likes/' . pathinfo($article, PATHINFO_FILENAME) . '/likes.txt';
        $likeCount = getLikeCount($likesFile);
        echo $likeCount . " pouces";
      ?>
    </span>
  </p>
</div>

  <div class="logoflex">
    <i id="comment" class="fa-regular fa-comments"></i>
    <p>
    <a href="article-created.php?article=articles/<?php echo basename($article) ?>#comments">
        <?php
        $commentFilename = 'comments/' . pathinfo($article, PATHINFO_FILENAME) . '/' . pathinfo($article, PATHINFO_BASENAME);
        $commentCount = getCommentCount($commentFilename);
        echo "<span class='gris'>$commentCount commentaires</span>";
        ?>
      </a>
    </p>
  </div>
</footer>

  </section>
<?php } ?>  

<script>
document.addEventListener("DOMContentLoaded", function() {
  const thumbsUp = document.querySelectorAll(".fa-thumbs-up");

  thumbsUp.forEach(thumb => {
    thumb.addEventListener("click", function() {
      const article = thumb.getAttribute("data-article");
      const likeCountElement = thumb.nextElementSibling.querySelector("span");

      // Ajouter l'animation
      thumb.classList.add("thumb-animation");

      // Ajouter la classe pour changer la couleur du pouce
      thumb.classList.add("thumb-clicked");

      // Supprimer l'animation après qu'elle soit terminée
      setTimeout(() => {
        thumb.classList.remove("thumb-animation");
      }, 300);

      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          likeCountElement.textContent = this.responseText + " pouces";
        }
      };

      xhttp.open("POST", "increment_likes.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("article=" + encodeURIComponent(article));
    });
  });
});

</script>

