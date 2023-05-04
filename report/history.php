<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user !== 1 || $name !== 'admin') {
  header('Location: /home.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query('SELECT * FROM deleted ORDER BY exclusion DESC');
$db->close();

require_once('../tcpdf/tcpdf.php');

$pdf = new TCPDF('L');

$pdf->setTitle('Remove History');

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

  <h1>remove history report</h1>
  <table cellpadding="5">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Year</th>
      <th>System</th>
      <th>Developer</th>
      <th>User</th>
      <th>Exclusion</th>
    </tr>
EOD;

while ($row = $result->fetch_assoc()) {
  $html .= <<<EOD
    <tr>
      <td>$row[id]</td>
      <td>$row[name]</td>
      <td>$row[year]</td>
      <td>$row[system]</td>
      <td>$row[developer]</td>
      <td>$row[user]</td>
      <td>$row[exclusion]</td>
    </tr>
  EOD;
}

$pdf->writeHTML($html . '</table>');

$pdf->Output('history.pdf');
