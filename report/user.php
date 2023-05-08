<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user === 1 && $name === 'admin') {
  header('Location: /report/admin.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query(
  <<<SQL
    SELECT
      game.*,
      IFNULL(system.name, "[empty]") AS systemName
    FROM game
    LEFT JOIN system ON game.system = system.id
    WHERE game.user = $user
  SQL
);
$db->close();

require_once('../tcpdf/examples/tcpdf_include.php');

$pdf = new TCPDF('P');

$pdf->setTitle('Game Report');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$html = <<<HTML
<style>
  th {
    border: 1px solid #4ade80;
    background-color: #86efac;
    font-weight: bold;
  }
  td {
    border: 1px solid #4ade80;
    background-color: #bbf7d0;
  }
</style>

<table cellpadding="5">
  <tr>
    <th>Name</th>
    <th>Year</th>
    <th>System</th>
    <th>Developer</th>
  </tr>
HTML;

while ($row = $result->fetch_assoc()) {
  $html .= <<<HTML
  <tr>
    <td>$row[name]</td>
    <td>$row[year]</td>
    <td>$row[systemName]</td>
    <td>$row[developer]</td>
  </tr>
  HTML;
}

$pdf->writeHTML($html . '</table>');

$pdf->Output("$name.pdf");
exit;
