<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Querty Library</title>
  <link rel="shortcut icon" href="img/joystick.png" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body class="grid grid-cols-2 place-items-center">
  <main class="col-span-2">
    <section class="w-[90vw] win98-container shadow-md shadow-[#555] flex flex-col">
      <header class="win98-title-bar flex items-center justify-between">
        <h1 class="font-mono text-white">Querty Library</h1>
        <div class="win98-container">
          <svg width="10" height="10" viewBox="0 0 100 100">
            <line stroke-width="20" stroke="#000" stroke-linecap="round" x1="10" y1="10" x2="90" y2="90" />
            <line stroke-width="20" stroke="#000" stroke-linecap="round" x1="90" y1="10" x2="10" y2="90" />
          </svg>
        </div>
      </header>
      <article class="flex-grow grid grid-cols-10 font-mono">
        <div class="pt-3 grid justify-center">
          <img src="img/joystick-48x48.png" alt="">
        </div>
        <div class="py-3 pr-3 space-y-3 col-span-8">
          <p>Welcome in, <?= $_SESSION['username'] ?>!<br>Feel free to add, edit and delete games from your library down below.</p>
          <table class="px-1 bg-white outline-1 [outline-style:inset] w-full">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>System</th>
              <th>Developer</th>
              <th>Year</th>
              <th>Cover</th>
              <th colspan="2">Options</th>
            </tr>
          </table>
        </div>
        <div class="p-3">
          <a href="insert_game.php">
            <button class="win98-button">New game</button>
          </a>
        </div>
      </article>
    </section>
  </main>
</body>

</html>