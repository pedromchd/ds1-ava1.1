<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user !== 1 || $name !== 'admin') {
  header('Location: /home.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query('SELECT IFNULL(game.cover, "uploads/empty.png") AS cover, game.name, user.name AS userName FROM game JOIN user ON game.user = user.id');
$db->close();

require_once('../tcpdf/examples/tcpdf_include.php');

$pdf = new TCPDF('P');

$pdf->setTitle('Report Summary');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$w = $pdf->getPageWidth();
$h = $pdf->getPageHeight();

$imgWidth = ($w - 50) / 3;
$imgHeight = ($h - 140) / 5;

$html = <<<HTML
<style>
  td {
    line-height: 5mm;
    border: 1px solid #fb923c;
    background-color: #fed7aa;
  }
  img {
    width: $imgWidth mm;
    height: $imgHeight mm;
  }
</style>

<table cellpadding="5mm">
  <tr>
HTML;

$count = 0;
while ($row = $result->fetch_assoc()) {
  if ($count == 3) {
    $html .= '</tr><tr>';
    $count %= 3;
  }
  $count++;

  $html .= <<<HTML
  <td><img src="../library/$row[cover]"><br>$row[name]<br>$row[userName]</td>
  HTML;
}

$pdf->writeHTML($html . '</tr></table>');

$pdf->Output('summary.pdf');
exit;
