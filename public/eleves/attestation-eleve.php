<?php
session_start();
$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/School";

require_once 'fpdf/fpdf.php';
include '../../model/Eleve.php';
include '../function.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];
}
    $eleve = new Eleve();
    $eleve->setId_eleve($id);

    $stmt = $eleve->getSqlSingleEleveByID($eleve->getId_eleve());
    $row = $stmt->execute();
    $row = $stmt->fetch();

    $today =date("d/m/Y");

    if($row['sexe'] == 'M'){
        $n = "Né";
        $in = "Inscrit";
    }else{
        $n = "Née";
        $in = "Inscrite";
    }

    $pdf = new FPDF('P', 'mm', 'A5');
    $pdf->AddPage();
    // entete
    $pdf->Image($_SESSION['root'].'/assets/img/logo.png', 10,6,30);
    $pdf->Ln(24);

    // Titre
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'ATTESTATION DE SCOLARITE', 'TB', 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 11);
    $h = 7;
    $retrait = "      ";
    $pdf->Write($h, utf8_decode("Je soussigné, Directeur de l'établissement Afpa school Certifie que : \n"));
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Write($h, $retrait . utf8_decode("L'élève : "));
    $pdf->SetFont('Arial','B',12);
    $pdf->Write($h,utf8_decode($row['nom']. ' '. $row['prenom']. " \n"));

    $pdf->SetFont('Arial', '', 12);
    $pdf->Write($h, $retrait . utf8_decode($n. " le : "));
    $pdf->SetFont('Arial','B',12);
    $pdf->Write($h,utf8_decode(dateEnToDateFr($row['date_naissance']) . " à ". strtoupper($row['lieu_naissance']). "\n"));

    $pdf->SetFont('Arial', '', 12);
    $pdf->Write($h, $retrait . utf8_decode("Domicile : "));
    $pdf->SetFont('Arial','B',12);
    $pdf->Write($h,utf8_decode($row['adresse']. " à ". strtoupper($row['ville']). ' ' . $row['cp']. "\n"));

    $pdf->SetFont('Arial', '', 12);
    $pdf->Write($h, $retrait . utf8_decode($in. " le : "));
    $pdf->SetFont('Arial','B',12);
    $pdf->Write($h,utf8_decode(dateEnToDateFr($row['date_inscription']) . ' en ' . $row['nom_classe']. ' pour l\'année '. $row['annee_scolaire'] ."\n"));
    
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 11);
    $pdf->Write($h, utf8_decode("La présente attestation est délivrée à l'intéressé Pour servir et valoir ce que de droit. \n"));
    $pdf->Write($h, utf8_decode("Fait à Champs sur Marne le : ".$today  ."\n"));
    $pdf->Output('I', 'Attestation de scloarité'.$row['nom']. ' '. $row['prenom'] , true);
?>