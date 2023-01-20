<?php

function connexion_DB(){

    $dbh = new PDO(
            "mysql:dbname=mediatheque;host=localhost;port=3308",
            "root",
            "",
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            )
        );
	
    return $dbh;
}


function recherche($dbh,$recherche){

    $sql = "SELECT films_id as id,films_titre as titre,group_concat(distinct genres_nom separator ' | ') as genre,real_nom as realisateur,group_concat(distinct acteurs_nom separator ', ') as acteur,films_resume as resum,films_annee as annee,films_duree as duree,films_affiche as affiche FROM films JOIN realisateurs ON real_id=films_real_id JOIN films_acteurs ON films_id=fa_films_id JOIN acteurs ON fa_acteurs_id=acteurs_id LEFT OUTER JOIN films_genres ON films_id=fg_films_id LEFT OUTER JOIN genres on fg_genres_id=genres_id WHERE real_nom like :recherche or genres_nom like :recherche or acteurs_nom like :recherche or films_titre like :recherche or films_resume like :recherche GROUP BY films_id, real_nom, films_resume,films_annee";
    $stmt = $dbh -> prepare($sql);
    $stmt ->bindvalue(':recherche', "%$recherche%",PDO::PARAM_STR);
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC); //donc le tableau associatif résultant prendra comme clef les noms des colonnes
    $tab=$stmt->fetchAll(); //pour remplir le tableau du set résultat

    return $tab;
}

function nbre_film($dbh,$recherche){

    $sql = "SELECT count(distinct films_id) as nbrefilms FROM films JOIN realisateurs ON real_id=films_real_id JOIN films_acteurs ON films_id=fa_films_id JOIN acteurs ON fa_acteurs_id=acteurs_id LEFT OUTER JOIN films_genres ON films_id=fg_films_id LEFT OUTER JOIN genres on fg_genres_id=genres_id WHERE real_nom like :recherche or genres_nom like :recherche or acteurs_nom like :recherche or films_titre like :recherche or films_resume like :recherche";
    $stmt = $dbh -> prepare($sql);
    $stmt ->bindvalue(':recherche', "%$recherche%",PDO::PARAM_STR);
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC); //donc le tableau associatif résultant prendra comme clef les noms des colonnes
    $nbre=$stmt->fetchAll(); //pour remplir le tableau du set résultat

    return $nbre;
}



function tab_general($dbh){

    $sql = "SELECT films_id as id,films_titre as titre,group_concat(distinct genres_nom separator' | ') as genre,real_nom as realisateur,group_concat(distinct acteurs_nom separator ', ') as acteur,films_resume as resum,films_annee as annee,films_duree as duree,films_affiche as affiche FROM films JOIN realisateurs ON real_id=films_real_id JOIN films_acteurs ON films_id=fa_films_id JOIN acteurs ON fa_acteurs_id=acteurs_id LEFT OUTER JOIN films_genres ON films_id=fg_films_id LEFT OUTER JOIN genres on fg_genres_id=genres_id GROUP BY films_id,real_nom, films_resume,films_annee";
    $stmt = $dbh -> prepare($sql);
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC); //donc le tableau associatif résultant prendra comme clef les noms des colonnes
    $tab=$stmt->fetchAll(); //pour remplir le tableau du set résultat

    return $tab;
}


function nbre_page($nbre_film){
    $active=false;

    for($i=1;$i<8;$i++){
        $J=$i*10;
    if($active==false){
        if($J>=$nbre_film){
            $nbre_page=$i;
            $active=true;}
        }    
   }
   $nbre_page--;

   return $nbre_page;

}


function min_heure($minute){
    $activation=false;
    $heure_cplt=$minute/60;

    for($i=0;$i<5;$i++){
        if($activation==false){
            if($i>$heure_cplt){
                $activation=true;
                $reste_heure=$i-$heure_cplt;
                $heure_result=$i-1;
                $minute_result1=$reste_heure*60;}}}

    if($minute_result1<10){
        $minute_result2="0".$minute_result1;
    }
    else{
        $minute_result2=$minute_result1;
    }

    $result=$heure_result."h".$minute_result2;

    return $result;
}


?>