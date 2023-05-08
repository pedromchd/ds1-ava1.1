<?php
require('config.php');

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query(
  <<<SQL
    SELECT
      system.*,
      COUNT(game.id) AS games
    FROM system
    LEFT JOIN game ON system.id = game.system
    GROUP BY system.id
  SQL
);
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
        <li class="bg-green-400 hover:bg-green-500"><a href="/admin.php" class="p-2 block">View games</a></li>
        <li class="bg-green-400 hover:bg-green-500"><a href="/report/admin.php" target="blank" class="p-2 block">Game Report</a></li>
      </ol>
      <ol class="border border-orange-500 divide-y divide-orange-500">
        <li class="bg-orange-400 hover:bg-orange-500"><a href="/report/summary.php" target="blank" class="p-2 block">Report Summary</a></li>
        <li class="bg-orange-400 hover:bg-orange-500"><a href="/report/history.php" target="blank" class="p-2 block">Remove History</a></li>
      </ol>
      <ol class="border border-blue-500 divide-y divide-blue-500">
        <li class="bg-blue-400 hover:bg-blue-500"><a href="/system/new.php" class="p-2 block">Add system</a></li>
      </ol>
      <ol class="border border-red-500 divide-y divide-red-500">
        <li class="bg-red-400 hover:bg-red-500"><a href="/auth/logout.php" class="p-2 block">Logout</a></li>
      </ol>
    </nav>
  </header>
  <main class="flex-grow p-5 overflow-y-scroll">
    <section>
      <h2 class="mb-3 text-xl font-semibold">Viewing all systems</h2>
      <article>
        <table class="border border-blue-300">
          <tr class="bg-blue-200 border border-blue-300 divide-x divide-blue-300 text-center font-semibold">
            <th class="p-2">ID</th>
            <th class="p-2">Name</th>
            <th class="p-2">Owner</th>
            <th class="p-2">Games</th>
            <th class="p-2">Options</th>
          </tr>
          <?php while ($row = $result->fetch_assoc()) :
          echo <<<HTML
          <tr class='border border-blue-300 divide-x divide-blue-300 text-center'>
            <td class='p-2'>$row[id]</td>
            <td class='p-2'>$row[name]</td>
            <td class='p-2'>$row[owner]</td>
            <td class='p-2'>$row[games]</td>
            <td class='p-1 space-y-1'>
              <a href='/system/edit.php?system=$row[id]'class='block p-1 bg-blue-200 hover:bg-blue-300'>Edit</a>
              <a href='/system/delete.php?system=$row[id]'class='block p-1 bg-blue-200 hover:bg-blue-300'>Delete</a>
            </td>
          </tr>
          HTML;
          endwhile; ?>
        </table>
      </article>
    </section>
  </main>
</body>

</html>
