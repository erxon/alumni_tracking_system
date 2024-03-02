<?php 

require("/xampp/htdocs/thesis/vendor/tecnickcom/tcpdf/tcpdf.php");

$pdf = new TCPDF();

$pdf->AddPage();

$pdf->Output();