<?php
require('fpdf/fpdf.php'); // Télécharge FPDF si tu ne l’as pas
require_once ROOT_PATH . '../app/models/model.php';

$pdo = $connect();
$apprenants = $pdo->query("SELECT * FROM apprenant")->fetchAll(PDO::FETCH_ASSOC);

if ($_GET['format'] === 'pdf') {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,'Liste des Apprenants',0,1,'C');
    $pdf->Ln();

    $pdf->SetFont('Arial','',10);
    foreach ($apprenants as $a) {
        $pdf->Cell(0,8, $a['nom'].' '.$a['prenom'].' - '.$a['email'], 0, 1);
    }

    $pdf->Output('D', 'apprenants.pdf');
    exit;
}
?>
