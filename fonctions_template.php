<?php

function affiche_film($page,$nbre_page,$nbre_film,$tab,$recherche){

    if($nbre_film!=0){

    $cpt_color=2;
    $color=null;

    if($page==$nbre_page){
        $limite=$nbre_film;}
    else{
        $limite=($page+1)*10;}

    for($i=$page*10;$i<$limite;$i++){

        if($cpt_color%2==0){  ?>
            <div class="film1">
            <?php $color="blue_film";?>
        <?php }
        else{ ?>
            <div class="film2">
            <?php $color="red_film";?>
        <?php } ?>

        <img src="images/<?php echo $tab[$i]["affiche"]?>" alt="affiche">

        <div class="date_titre">
        <h2 class="inline"><?php echo $tab[$i]["titre"];?></h2>
        <p class="inline" id=<?php echo $color;?>><?php echo $tab[$i]["annee"];?></p></div>
        <p><?php echo $tab[$i]["genre"];?></p>
        <p class="inline" id="bold">Réalisateur : </p><p class="inline"><?php echo $tab[$i]["realisateur"];?><br><br></p>
        <p class="inline" id="bold">Acteurs : </p><p class="inline"><?php echo $tab[$i]["acteur"];?><br><br></p>
        <p class="inline" id="bold">Durée : </p><p class="inline"><?php echo min_heure($tab[$i]["duree"]);?><br></p>
        <p></p>
        <p id="grey"><?php echo $tab[$i]["resum"];?></p>

        </div>   
                
        <?php
        $cpt_color++;}}  

} ?>
