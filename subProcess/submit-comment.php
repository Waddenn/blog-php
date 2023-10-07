<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
  $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
  $article = $_POST['article'];
  $date = date('Y-m-d H:i');

  $articleDir = '../comments/' . pathinfo($article, PATHINFO_FILENAME);
  if (!is_dir($articleDir)) {
    mkdir($articleDir, 0777, true);
  }

  $filename = $articleDir . '/' . pathinfo($article, PATHINFO_BASENAME);

  $data = "Name: $name\nDate: $date\nComment: $comment\n\n";
  $success = file_put_contents($filename, $data, FILE_APPEND);

  if ($success === false) {
    http_response_code(500);
    echo "Error writing comment data to file.";
    exit;
  }

  header("Location: ../article-created.php?article=$article#comments");
  exit;
}
?>
