<?php
$article = $_GET['article'];

$articleDir = './comments/' . pathinfo($article, PATHINFO_FILENAME);
$filename_comments = $articleDir . '/' . pathinfo($article, PATHINFO_BASENAME);

if (file_exists($filename_comments)) {
    $content = file_get_contents($filename_comments);
    $comments = explode("\n\n", $content);

    foreach ($comments as $comment) {
        if (trim($comment) !== '') {
            $commentLines = explode("\n", $comment);
            $commentName = explode(": ", $commentLines[0])[1];
            $commentDate = explode(": ", $commentLines[1])[1];
            $commentcontent = explode(": ", $commentLines[2])[1];
            echo '<div class="commentsdash">';
            echo "<p><strong>$commentName</strong> à écrit le $commentDate:</p>";
            echo "<p>$commentcontent</p>";
            echo '</div>';
        }
    }
} else {
    echo "<span>No comments found for this article.</span>";
}
?>
