<?php

function before ($thi, $inthat){
    
    return substr($inthat, 0, strpos($inthat, $thi));
}

function annee_scolaire_actuelle()
{
    $mois = date("m");//Le mois de la date actuelle
    $annee_actuelle = date("Y");//L'année de la date actuelle
    if ($mois >= 9 && $mois <= 12) {
        $annee1 = $annee_actuelle;
        $annee2 = $annee_actuelle + 1;
    } else {
        $annee1 = $annee_actuelle - 1;
        $annee2 = $annee_actuelle;
    }

    $annee_scolaire_actuelle = $annee1 . "/" . $annee2;
    return $annee_scolaire_actuelle;
}

function nombre_annee_scolaire()
{
    $annee_debut = annee_scolaire_actuelle();
    $mois = date("m");
    $annee_actuelle = date("Y");
    if ($mois >= 7 && $mois <= 12)
        return ($annee_actuelle - $annee_debut) + 1;
    else
        return $annee_actuelle - $annee_debut;
}

function les_annee_scolaire($annee_debut = 2020)
{
    $les_annees = array();
    for ($i = 1; $i <= nombre_annee_scolaire(); $i++) {
        $annee_sc = ($annee_debut + ($i - 1)) . "/" . ($annee_debut + $i);
        $les_annees[] = $annee_sc;
    }
    return $les_annees;

}

function dateEnToDateFr($dateEn)
{
    //$dateEn='2019-02-26';
    return substr($dateEn, 8, 2) . "/" . substr($dateEn, 5, 2) . "/" . substr($dateEn, 0, 4);
    // Result: '26/02/2019'
}