<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user !== 1 || $name !== 'admin') {
  header('Location: /home.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query('SELECT game.cover, game.name, user.name AS userName FROM game JOIN user ON game.user = user.id');
$db->close();

require_once('../tcpdf/examples/tcpdf_include.php');

$pdf = new TCPDF('P');

$pdf->setTitle('Report Summary');

$pdf->AddPage();

$html = <<<HTML
<style>
  table {
    border: 1px solid #4ade80;
  }
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
    <th>Cover</th>
    <th>Name</th>
    <th>User</th>
  </tr>
HTML;

while ($row = $result->fetch_assoc()) {
  $html .= <<<HTML
  <tr>
    <td><img src="example.jpg" /></td>
    <td>$row[name]</td>
    <td>$row[userName]</td>
  </tr>
  HTML;
}

$pdf->writeHTML($html . '</table>');

$pdf->Output('summary.pdf');
exit;
