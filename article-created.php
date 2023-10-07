<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/styleArticleCreated.css?<?php echo time(); ?>">
</head>

<?php include("./dependances/header.php"); ?>

<?php
if (isset($_GET['article'])) {
  $filename = $_GET['article'];

  if (file_exists($filename)) {
    $fileContents = file_get_contents($filename);

    $lines = file($filename);
  } else {
    echo 'Article introuvable.';
  }
  } else {
  echo 'Aucun article sélectionné.';
}

?>
    <?php include("dataArticleExtraction.php"); ?>

<div class="page">

<div class="article-container">
<h1><?php echo $title ?></h1>
<div class="metadata-container">
<span class="metadata"><p><strong>Catégorie:</strong> <?php echo $category ?></p></span>
<span class="metadata"><p><strong>Date de création:</strong> <?php echo $creationDate ?></p></span>
<span class="metadata"><p><strong>Créateur:</strong><?php echo $creatorUsername ?></p></span>
</div>
<img src="<?php echo$imageLink ?>">
<p><?php echo nl2br($content) ?></p>
</div>

<div id='comments' class='comments-container'>
<?php include("comments_display.php"); ?>

</div>

<form method="post" action="./subProcess/submit-comment.php">
  <label for="name">Nom:</label>
  <input type="text" name="name" id="name">
  <br>
  <label for="comment">Commentaire:</label>
  <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
  <br>
  <input type="hidden" name="article" value="<?php echo $filename; ?>">
  <input type="submit" value="Poster le commentaire">
</form>
</div>
<?php include("./dependances/footer.php"); ?>
