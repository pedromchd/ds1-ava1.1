<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user !== 1 || $name !== 'admin') {
  header('Location: /home.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query('SELECT game.cover, game.name, user.name FROM game JOIN user ON game.user = user.id');
$db->close();

require_once('../tcpdf/tcpdf.php');

// class MYPDF extends TCPDF {
//   function Table(array $row = []) {
//     $cellWidth = ($this->getPageWidth() - 20) / sizeof($row);
//     $y_start = $y_end = $this->GetY();
//     foreach ($row as $value) {
//       $this->MultiCell($cellWidth, 0, $value, 1, 'L', true, 2, $this->GetX(), $y_start, true, 0);
//       $y_end = max($this->GetY(), $y_end);
//     }
//     $this->setXY(10, $y_end);
//   }
// }

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('admin');
$pdf->setTitle('Report Summary');

$pdf->setHeaderData('', 0, 'Game Report Summary', 'by Querty Library', array(0, 0, 0), array(0, 0, 0));
$pdf->setHeaderFont(array('helvetica', 'B', 16));
$pdf->setHeaderMargin(10);

$pdf->setFooterData(array(0, 0, 0), array(0, 0, 0));
$pdf->setFooterFont(array('helvetica', 'R', 10));
$pdf->setFooterMargin(10);

$pdf->setMargins(10, 30, 10);
$pdf->setAutoPageBreak(true, 20);

$pdf->AddPage();

$pdf->setCellPaddings(2, 2, 2, 2);
$pdf->setLineStyle(array('width' => 0.25, 'color' => array(74, 222, 128)));

// $pdf->setFillColorArray(array(187, 247, 208));
$pdf->setFont('helvetica', 'R', 12);

// $row = $result->fetch_assoc();

$pdf->StartTransform();
$pdf->Rect($pdf->GetX() + 5, $pdf->GetY() + 15, 60, 50, 'CNZ');
$pdf->Image('example.jpg', $pdf->GetX() + 5, $pdf->GetY() + 15, 0, 50, '', '', '', false);
$pdf->StopTransform();
$pdf->writeHTMLCell(70, 70, $pdf->GetX(), $pdf->GetY(), '<p>Olá<br>Pedro</p>', 1, 0, false, true, 'C', true);

$pdf->StartTransform();
$pdf->Rect($pdf->GetX() + 5, $pdf->GetY() + 15, 60, 50, 'CNZ');
$pdf->Image('example.jpg', $pdf->GetX() + 5, $pdf->GetY() + 15, 0, 50, '', '', '', false);
$pdf->StopTransform();
$pdf->writeHTMLCell(70, 70, $pdf->GetX(), $pdf->GetY(), '<p>Olá<br>Pedro</p>', 1, 0, false, true, 'C', true);

$pdf->StartTransform();
$pdf->Rect($pdf->GetX() + 5, $pdf->GetY() + 15, 60, 50, 'CNZ');
$pdf->Image('example.jpg', $pdf->GetX() + 5, $pdf->GetY() + 15, 0, 50, '', '', '', false);
$pdf->StopTransform();
$pdf->writeHTMLCell(70, 70, $pdf->GetX(), $pdf->GetY(), '<p>Olá<br>Pedro</p>', 1, 0, false, true, 'C', true);

$pdf->Ln();

$pdf->StartTransform();
$pdf->Rect($pdf->GetX() + 5, $pdf->GetY() + 15, 60, 50, 'CNZ');
$pdf->Image('example.jpg', $pdf->GetX() + 5, $pdf->GetY() + 15, 0, 50, '', '', '', false);
$pdf->StopTransform();
$pdf->writeHTMLCell(70, 70, $pdf->GetX(), $pdf->GetY(), '<p>Olá<br>Pedro</p>', 1, 0, false, true, 'C', true);

$pdf->StartTransform();
$pdf->Rect($pdf->GetX() + 5, $pdf->GetY() + 15, 60, 50, 'CNZ');
$pdf->Image('example.jpg', $pdf->GetX() + 5, $pdf->GetY() + 15, 0, 50, '', '', '', false);
$pdf->StopTransform();
$pdf->writeHTMLCell(70, 70, $pdf->GetX(), $pdf->GetY(), '<p>Olá<br>Pedro</p>', 1, 0, false, true, 'C', true);

$pdf->StartTransform();
$pdf->Rect($pdf->GetX() + 5, $pdf->GetY() + 15, 60, 50, 'CNZ');
$pdf->Image('example.jpg', $pdf->GetX() + 5, $pdf->GetY() + 15, 0, 50, '', '', '', false);
$pdf->StopTransform();
$pdf->writeHTMLCell(70, 70, $pdf->GetX(), $pdf->GetY(), '<p>Olá<br>Pedro</p>', 1, 0, false, true, 'C', true);

$pdf->Ln();

$pdf->StartTransform();
$pdf->Rect($pdf->GetX() + 5, $pdf->GetY() + 15, 60, 50, 'CNZ');
$pdf->Image('example.jpg', $pdf->GetX() + 5, $pdf->GetY() + 15, 0, 50, '', '', '', false);
$pdf->StopTransform();
$pdf->writeHTMLCell(70, 70, $pdf->GetX(), $pdf->GetY(), '<p>Olá<br>Pedro</p>', 1, 0, false, true, 'C', true);

$pdf->StartTransform();
$pdf->Rect($pdf->GetX() + 5, $pdf->GetY() + 15, 60, 50, 'CNZ');
$pdf->Image('example.jpg', $pdf->GetX() + 5, $pdf->GetY() + 15, 0, 50, '', '', '', false);
$pdf->StopTransform();
$pdf->writeHTMLCell(70, 70, $pdf->GetX(), $pdf->GetY(), '<p>Olá<br>Pedro</p>', 1, 0, false, true, 'C', true);

$pdf->StartTransform();
$pdf->Rect($pdf->GetX() + 5, $pdf->GetY() + 15, 60, 50, 'CNZ');
$pdf->Image('example.jpg', $pdf->GetX() + 5, $pdf->GetY() + 15, 0, 50, '', '', '', false);
$pdf->StopTransform();
$pdf->writeHTMLCell(70, 70, $pdf->GetX(), $pdf->GetY(), '<p>Olá<br>Pedro</p>', 1, 0, false, true, 'C', true);

$pdf->Ln();

$pdf->Output('summary.pdf', 'I');
exit;
