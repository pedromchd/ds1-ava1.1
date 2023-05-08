<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user !== 1 || $name !== 'admin') {
  header('Location: /home.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');

$result = $db->query(
  <<<SQL
    SELECT
      IFNULL(game.cover, "uploads/empty.png") AS cover,
      game.name,
      user.name AS userName
    FROM game
    JOIN user ON game.user = user.id
  SQL
);

$db->close();

require_once('../tcpdf/examples/tcpdf_include.php');

$pdf = new TCPDF('P');

$pdf->setTitle('Report Summary');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$w = $pdf->getPageWidth();
$h = $pdf->getPageHeight();

$cellWidth = ($w - 40) / 3;
$imgWidth = ($w - 70) / 3;
$imgHeight = ($h - 160) / 5;

$html = <<<HTML
<style>
  td {
    line-height: 5mm;
    border: 1px solid #fb923c;
    background-color: #fed7aa;
    width: $cellWidth mm;
  }
  img {
    width: $imgWidth mm;
    height: $imgHeight mm;
  }
</style>

<table cellspacing="5mm" cellpadding="5mm">
  <tr>
HTML;

for ($i = 0; $row = $result->fetch_assoc(); $i++) {
  if ($i !== 0 && $i % 3 === 0) {
    $html .= '</tr><tr>';
  }

  $html .= <<<HTML
  <td><img src="../library/$row[cover]"><br>$row[name]<br>$row[userName]</td>
  HTML;
}

$pdf->writeHTML($html . '</tr></table>');

$pdf->Output('summary.pdf');
exit;
