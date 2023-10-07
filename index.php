<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>réseau social</title>
    <link rel="stylesheet" type="text/css" href="./style/styleIndex.css?<?php echo time(); ?>">
</head>
<body>

    <?php include("./dependances/header.php"); ?>

    <div class="main">

    <?php include("./dependances/category.php"); ?>

    <div class="scroll">
    
    <?php include("article-bloc.php"); ?>

</div>

<div class="rightsection">

<section class="messages">
    <header class="profil">
        <img id="imageprofilr" src="Admin-Profile-PNG-Clipart.png">
        <div>
            <h2>Mon Pseudo</h2>
            <span class="gris"><p>Il y a 10 minutes</p></span>
        </div>
    </header>
    <p id="messages">
        Oh right. I forgot about the battle. I just told 
        you! You've killed me! You don't know how to 
        do any of those. Hey, you add a one and two 
        Zeros to that or we walk! No! Don't jump!</p>
</section>

    <?php include("./dependances/suggestions.php"); ?>

</div>
</div>
<script src="https://kit.fontawesome.com/cf1cef4dee.js" crossorigin="anonymous"></script>
<script src="./js/animation.js" crossorigin="anonymous"></script>

</body>
<?php include("./dependances/footer.php"); ?>
</html>