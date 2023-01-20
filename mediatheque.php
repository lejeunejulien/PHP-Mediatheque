<?php
require_once("fonctions.php");

try{

$dbh=connexion_DB();
$tab=tab_general($dbh);
$nbre_film=count($tab);

$recherche="";
$activation_recherche=false;

$page=0;
$nbre_page=6;


if (isset($_POST["bouton_recherche"])){
    if (isset($_POST["recherche"])){
        if($_POST["recherche"]!=""){
        $recherche=$_POST["recherche"];
        $tab=recherche($dbh,$recherche);
        $activation_recherche=true;
        $nbre_film=nbre_film($dbh,$recherche)[0]["nbrefilms"];
        $nbre_page=nbre_page($nbre_film);}}}



if (isset($_POST["suivant"])){
    if ($_POST["page_suivant_recherche"]!=""){
        if($_POST["page_suivant"]<$_POST["nbre_page_recherche_suivant"]){
            $page=$_POST["page_suivant"]+1;
            $recherche=$_POST["page_suivant_recherche"];
            $tab=recherche($dbh,$recherche);
            $activation_recherche=true;
            $nbre_film=nbre_film($dbh,$recherche)[0]["nbrefilms"];
            $nbre_page=nbre_page($nbre_film);}

        else{
            $page=$_POST["nbre_page_recherche_suivant"];
            $recherche=$_POST["page_suivant_recherche"];
            $tab=recherche($dbh,$recherche);
            $activation_recherche=true;
            $nbre_film=nbre_film($dbh,$recherche)[0]["nbrefilms"];
            $nbre_page=nbre_page($nbre_film);}}

    else{
        if($_POST["page_suivant"]<6){
            $page=$_POST["page_suivant"]+1;}
        else{
            $page=6;}}}


if (isset($_POST["precedent"])){
    if ($_POST["page_precedent_recherche"]!=""){
            if($_POST["page_precedent"]>=1){
                $page=$_POST["page_precedent"]-1;
                $recherche=$_POST["page_precedent_recherche"];
                $tab=recherche($dbh,$recherche);
                $activation_recherche=true;
                $nbre_film=nbre_film($dbh,$recherche)[0]["nbrefilms"];
                $nbre_page=nbre_page($nbre_film);}
            else{
                $page=0;
                $recherche=$_POST["page_precedent_recherche"];
                $tab=recherche($dbh,$recherche);
                $activation_recherche=true;
                $nbre_film=nbre_film($dbh,$recherche)[0]["nbrefilms"];
                $nbre_page=nbre_page($nbre_film);}}
    else{
        if($_POST["page_precedent"]>=1){
            $page=$_POST["page_precedent"]-1;}
        else{
            $page=0;}}}
}

catch (Exception $ex) {
    die("ERREUR FATALE : ". $ex->getMessage().'<form><input type="button" value="Retour" onclick="history.go(-1)"></form>');
    }
      
require_once("template.php");
?>

