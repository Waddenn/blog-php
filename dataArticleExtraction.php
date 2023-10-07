<?php

    $title = trim(str_replace('Title: ', '', $lines[0]));
    $imageLink = trim(str_replace('ImageLink: ', '', $lines[1]));
    $category = trim(str_replace('Category: ', '', $lines[2]));
    $creationDate = trim(str_replace('CreationDate: ', '', $lines[3]));
    $creatorUsername = trim(str_replace('CreatorUsername: ', '', $lines[4]));
    $content = trim(str_replace('Content:', '', implode("\n", array_slice($lines, 5))));

    ?>

    