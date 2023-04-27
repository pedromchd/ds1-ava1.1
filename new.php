<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query("SELECT * FROM system");
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <main>
    <fieldset>
      <legend>New</legend>
      <form action="/library/new.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="year">Year:</label>
        <input type="number" name="year" id="year" required>
        <label for="system">System:</label>
        <select name="system" id="system" required>
          <option disabled selected>Select one</option>
          <?php
          while ($row = $result->fetch_assoc()) {
            echo "<option value=$row[id]>$row[name]</option>";
          }
          ?>
        </select>
        <label for="developer">Developer:</label>
        <input type="text" name="developer" id="developer" required>
        <label for="cover">Cover:</label>
        <input type="file" name="cover" id="cover">
        <input type="hidden" name="user" value="<?= $user ?>">
        <input type="submit" value="Submit">
      </form>
    </fieldset>
  </main>
</body>

</html>
