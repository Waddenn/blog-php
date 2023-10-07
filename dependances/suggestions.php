<?php
$articleDir = 'articles/*.txt';

$articles = glob($articleDir);

shuffle($articles);

$articles = array_slice($articles, 0, 3);

foreach ($articles as $article) {
    $lines = file($article);

    $title = trim(str_replace('Title: ', '', $lines[0]));
    $imageLink = trim(str_replace('ImageLink: ', '', $lines[1]));
    $content = trim(str_replace('Content:', '', implode("\n", array_slice($lines, 5))));
    $creationDate = trim(str_replace('CreationDate: ', '', $lines[3]));
    ?>
<a class="suggestionRedirection" href="article-created.php?article=articles/<?php echo basename($article) ?>">
    <section class="suggestion">
        <h2>
            Suggestion
        </h2>

        <div class="sectsuggestion">

            <div class="flex">
                <img id="imageLink" src="<?php echo $imageLink ?>">
                <div class="suggestion">

                        <h3>
                            <?php echo $title ?>
                        </h3>
                        <p>
                            <?php echo $creationDate ?>
                        </p>

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
            </div>
        </div>
    </section>
</a>


<?php } ?>
