<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user !== 1 || $name !== 'admin') {
  header('Location: /home.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query('SELECT game.*, IFNULL(system.name, "[empty]") AS systemName, user.name AS userName FROM game LEFT JOIN system ON game.system = system.id JOIN user ON game.user = user.id');
$db->close();

require_once('../tcpdf/tcpdf.php');

$pdf = new TCPDF('L');

$pdf->setTitle('Game Report');

$pdf->AddPage();

$html = '
  <table border="1" cellpadding="5">
    <tr style="font-weight: bold">
      <th>ID</th>
      <th>Name</th>
      <th>Year</th>
      <th>System</th>
      <th>Developer</th>
      <th>User</th>
    </tr>
';

while ($row = $result->fetch_assoc()) {
  $html .= "
    <tr>
      <td>$row[id]</td>
      <td>$row[name]</td>
      <td>$row[year]</td>
      <td>$row[systemName]</td>
      <td>$row[developer]</td>
      <td>$row[userName]</td>
    </tr>
  ";
}

$html .= '</table>';

$pdf->writeHTML($html);

$pdf->Output('report.pdf');
