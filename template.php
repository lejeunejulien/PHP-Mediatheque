<?php

require_once("fonctions_template.php");

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mediatheque</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/ec4fab33b9.js" crossorigin="anonymous"></script>
</head>


<body>
    <header>
        <form action="mediatheque.php" method="POST">
        <input type="text" name="recherche" placeholder="Recherchez un film..." value="<?php echo $recherche;?>">

        <button type="submit" name="bouton_recherche">
        <i class="fa-solid fa-magnifying-glass"></i></button></form>
    </header>

    <div class="recherche">
    <?php
    if($activation_recherche==true){ ?>
        <p class="inline" id="result1"><?php echo "$nbre_film résultats pour ";?></p><p class="inline" id="result2"><?php echo "$recherche";?></p>
    <?php } ?>
    </div>

    <section>
    <form action="mediatheque.php" method="POST">

    <button type="submit" name="precedent" value="precedent" id="blue_page1">précédent</button>
    <input type="hidden" name="page_precedent" id="page_precedent" value="<?php echo $page?>">
    <input type="hidden" name="page_precedent_recherche" id="page_precedent_recherche" value="<?php echo $recherche?>"></form>

    <p id="blue_page2">Page <?php echo ($page+1);?> sur <?php echo ($nbre_page+1) ?></p>
    
    <form action="mediatheque.php" method="POST">
    <button type="submit" name="suivant" value="suivant" id="blue_page1">suivant</button>
    <input type="hidden" name="page_suivant" id="page_suivant" value="<?php echo $page?>">
    <input type="hidden" name="page_suivant_recherche" id="page_suivant_recherche" value="<?php echo $recherche?>">
    <input type="hidden" name="nbre_page_recherche_suivant" id="nbre_page_recherche_suivant" value="<?php echo $nbre_page?>"></form>
    </section>

    <?php

    affiche_film($page,$nbre_page,$nbre_film,$tab,$recherche,$activation_recherche);
    
    ?>

</body>
</html>