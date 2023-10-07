<?php
function getCommentCount($filename) {
  if (!file_exists($filename)) {
    return 0;
  }

  $content = file_get_contents($filename);
  $commentCount = substr_count($content, 'Comment:');
  return $commentCount;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

}
?>