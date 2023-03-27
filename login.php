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

<body class="grid grid-cols-2 md:grid-cols-3 place-items-center">
  <main class="col-span-2">
    <section class="w-[34rem] win98-container shadow-md shadow-[#555] flex flex-col">
      <header class="win98-title-bar flex items-center justify-between">
        <h1 class="font-mono text-white">Querty Library Login</h1>
        <div class="win98-container">
          <svg width="10" height="10" viewBox="0 0 100 100">
            <line stroke-width="20" stroke="#000" stroke-linecap="round" x1="10" y1="10" x2="90" y2="90" />
            <line stroke-width="20" stroke="#000" stroke-linecap="round" x1="90" y1="10" x2="10" y2="90" />
          </svg>
        </div>
      </header>
      <article class="flex-grow grid grid-cols-5 font-mono">
        <div class="grid grid-rows-2 place-items-center">
          <img src="img/keys.png" alt="">
        </div>
        <div class="py-3 pr-3 space-y-3 col-span-3">
          <p>Welcome to Querty Library!<br>Login or register to proceed.</p>
          <form name="login" id="login" action="auth.php" method="post" class="space-y-4" autocomplete="off">
            <div class="w-[100%] flex justify-between">
              <label for="username">User name:</label>
              <input type="text" name="username" id="username" class="win98-form">
            </div>
            <div class="w-[100%] flex justify-between">
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" class="win98-form">
            </div>
          </form>
        </div>
        <div class="p-3">
          <button type="submit" class="win98-button mb-3" form="login">Login</button>
          <a href="register.php">
            <button class="win98-button">Register</button>
          </a>
        </div>
      </article>
    </section>
  </main>
</body>

</html>