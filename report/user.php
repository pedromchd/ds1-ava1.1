<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user === 1 && $name === 'admin') {
  header('Location: /report/admin.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query("SELECT game.*, IFNULL(system.name, '[empty]') AS systemName FROM game LEFT JOIN system ON game.system = system.id WHERE game.user = $user");
$db->close();

require_once('../tcpdf/tcpdf.php');

$pdf = new TCPDF('L');

$pdf->setTitle('Game Report');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$html = <<<EOD
  <style>
    table, td {
      background-color: #dcfce7;
      border: 1px solid #86efac;
    }
    th {
      background-color: #bbf7d0;
      border: 1px solid #86efac;
      font-weight: bold;
    }
  </style>

  <h1>$name's game report</h1>
  <table cellpadding="5">
    <tr>
      <th>Name</th>
      <th>Year</th>
      <th>System</th>
      <th>Developer</th>
    </tr>
EOD;

while ($row = $result->fetch_assoc()) {
  $html .= <<<EOD
    <tr>
      <td>$row[name]</td>
      <td>$row[year]</td>
      <td>$row[systemName]</td>
      <td>$row[developer]</td>
    </tr>
  EOD;
}

$pdf->writeHTML($html . '</table>');

$pdf->Output("$name.pdf");
exit;
