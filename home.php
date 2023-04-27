<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query("SELECT game.*, system.name AS 'systemName' FROM game JOIN system ON game.system = system.id WHERE game.user = $user");
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <header>
    <h1>Querty Library</h1>
    <a href="/auth/logout.php">Logout</a>
  </header>
  <main>
    <h2><?= $name ?>'s library</h2>
    <section>
      <h3>All games</h3>
      <article>
        <p><a href="/new.php">Add game</a></p>
        <table>
          <tr>
            <td>Cover</td>
            <td>Name</td>
            <td>Year</td>
            <td>System</td>
            <td>Developer</td>
            <td>Options</td>
          </tr>
          <?php
          while ($row = $result->fetch_assoc()) {
            echo
            "<tr>
              <td>$row[cover]</td>
              <td>$row[name]</td>
              <td>$row[year]</td>
              <td>$row[systemName]</td>
              <td>$row[developer]</td>
              <td>
                <a href=/edit.php?game=$row[id]>Edit</a>
                <a href=/delete.php?game=$row[id]>Delete</a>
              </td>
            </tr>";
          }
          ?>
        </table>
      </article>
    </section>
  </main>
</body>

</html>
