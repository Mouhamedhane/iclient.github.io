<?php
require_once 'vendor/autoload.php';

use TCPDF;

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('Helvetica', '', 12);
$pdf->Write(0, 'Test PDF Generation');
$pdf->Output('test.pdf', 'I'); // Affiche le PDF dans le navigateur
?>
