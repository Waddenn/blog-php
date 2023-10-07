<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
  $imageLink = filter_var($_POST['image-link'], FILTER_SANITIZE_URL);
  $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
  $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
  $creationDate = htmlspecialchars($_POST['creation-date'], ENT_QUOTES, 'UTF-8');
  $creatorUsername = htmlspecialchars($_POST['creator-username'], ENT_QUOTES, 'UTF-8');

  if (!is_dir('articles')) {
    mkdir('articles');
  }

  $formattedDate = date('Y-m-d', strtotime($creationDate));
  $filename = "articles/{$formattedDate}_{$category}_{$creatorUsername}.txt";

  $data = "Title: $title\nImageLink: $imageLink\nCategory: $category\nCreationDate: $creationDate\nCreatorUsername: $creatorUsername\nContent:\n$content";
  $success = file_put_contents($filename, $data);

  if ($success === false) {
    http_response_code(500);
    echo "Error writing article data to file.";
    exit;
  }

  header("Location: article-created.php?article=$filename");
  exit;
}
?>