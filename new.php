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

<body class="h-screen bg-green-100 flex">
  <header class="py-3 px-5 bg-green-300">
    <h1 class="mb-3 text-3xl font-bold">Querty Library</h1>
    <nav class="bg-green-400 border border-green-500">
      <ol class="text-lg divide-y divide-green-500">
        <li class="hover:bg-green-500"><a href="/new.php" class="p-2 block">Add game</a></li>
        <li class="hover:bg-green-500"><a href="/auth/logout.php" class="p-2 block">Logout</a></li>
      </ol>
    </nav>
  </header>
  <main class="flex-grow grid place-items-center">
    <form action="/library/new.php" method="post" enctype="multipart/form-data">
      <fieldset class="w-[25rem] p-5 border-2 border-green-800 grid gap-2">
        <legend class="px-1 text-xl text-green-800 font-semibold">New</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
        <label for="year">Year:</label>
        <input type="number" name="year" id="year" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
        <label for="system">System:</label>
        <select name="system" id="system" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
          <option disabled selected>Select one</option>
          <?php
          while ($row = $result->fetch_assoc()) {
            echo "<option value=$row[id]>$row[name]</option>";
          }
          ?>
        </select>
        <label for="developer">Developer:</label>
        <input type="text" name="developer" id="developer" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
        <label for="cover">Cover:</label>
        <input type="file" name="cover" id="cover">
        <input type="hidden" name="user" value="<?= $user ?>">
        <input type="submit" value="Add" class="mt-2 py-1 bg-green-300 cursor-pointer hover:bg-green-400">
        <a href="/home.php" class="text-center py-1 bg-green-300 hover:bg-green-400">Cancel</a>
      </fieldset>
    </form>
  </main>
</body>

</html>
