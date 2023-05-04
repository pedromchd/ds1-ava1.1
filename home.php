<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user === 1 && $name === 'admin') {
  header('Location: /admin.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query("SELECT game.*, IFNULL(system.name, '[empty]') AS systemName FROM game LEFT JOIN system ON game.system = system.id WHERE game.user = $user");
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

<body class="h-screen bg-green-100 flex">
  <header class="py-3 px-5 bg-green-300">
    <h1 class="mb-3 text-3xl font-bold">Querty Library</h1>
    <nav class="text-lg space-y-2">
      <ol class="border border-green-500 divide-y divide-green-500">
        <li class="bg-green-400 hover:bg-green-500"><a href="/new.php" class="p-2 block">Add game</a></li>
        <li class="bg-green-400 hover:bg-green-500"><a href="/report/user.php" target="blank" class="p-2 block">Game Report</a></li>
      </ol>
      <ol class="border border-red-500 divide-y divide-red-500">
        <li class="bg-red-400 hover:bg-red-500"><a href="/auth/logout.php" class="p-2 block">Logout</a></li>
      </ol>
    </nav>
  </header>
  <main class="flex-grow p-5 overflow-y-scroll">
    <section>
      <h2 class="mb-3 text-xl font-semibold">Viewing <?= $name ?>'s games</h2>
      <article>
        <table class="border border-green-300">
          <tr class="bg-green-200 border border-green-300 divide-x divide-green-300 text-center font-semibold">
            <th class="p-2">Cover</th>
            <th class="p-2">Name</th>
            <th class="p-2">Year</th>
            <th class="p-2">System</th>
            <th class="p-2">Developer</th>
            <th class="p-2">Options</th>
          </tr>
          <?php
          while ($row = $result->fetch_assoc()) {
            echo <<<EOD
            <tr class='border border-green-300 divide-x divide-green-300 text-center'>
              <td><img src='/library/$row[cover]' class='object-cover h-20 w-40' /></td>
              <td class='p-2'>$row[name]</td>
              <td class='p-2'>$row[year]</td>
              <td class='p-2'>$row[systemName]</td>
              <td class='p-2'>$row[developer]</td>
              <td class='p-1 space-y-1'>
                <a href='/edit.php?game=$row[id]'class='block p-1 bg-green-200 hover:bg-green-300'>Edit</a>
                <a href='/delete.php?game=$row[id]'class='block p-1 bg-green-200 hover:bg-green-300'>Delete</a>
              </td>
            </tr>
            EOD;
          }
          ?>
        </table>
      </article>
    </section>
  </main>
</body>

</html>
