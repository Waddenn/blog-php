<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style/styleCreateArticle.css?<?php echo time(); ?>">
</head>

<?php include("./dependances/header.php"); ?>

<form method="post" action="submit-article.php">
  <label for="title">Titre :</label>
  <input type="text" id="title" name="title" required><br><br>

  <label for="image-link">Lien de l'image de présentation :</label>
  <input type="text" id="image-link" name="image-link" required><br><br>

  <label for="content">Contenu :</label>
  <textarea id="content" name="content" required></textarea><br><br>

  <label for="category">Catégorie :</label>
<select id="category" name="category" required>
  <option value="">Choisir une catégorie</option>
  <option value="Actualités">Actualités</option>
  <option value="Technologie">Technologie</option>
  <option value="Santé et bien-être">Santé et bien-être</option>
  <option value="Mode et beauté">Mode et beauté</option>
  <option value="Voyages et tourisme">Voyages et tourisme</option>
  <option value="Education">Education</option>
  <option value="Culture">Culture</option>
  <option value="Sports">Sports</option>
  <option value="Finance">Finance</option>
  <option value="Divers">Divers</option>
</select><br><br>


  <label for="creation-date">Date de création :</label>
  <input type="date" id="creation-date" name="creation-date" required><br><br>

  <label for="creator-username">Pseudo du créateur :</label>
  <input type="text" id="creator-username" name="creator-username" required><br><br>

  <input type="submit" value="Créer l'article">
</form>
