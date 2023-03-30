<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Querty Library</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="icon" href="/img/joystick.png" type="image/x-icon">
</head>

<body class="bg-[url(/img/zeal.png)] bg-cover bg-right-bottom">
  <main class="h-screen grid grid-cols-3 place-items-center">
    <div class="col-span-2 border-2 border-[#fff_#999_#999_#fff] outline-1 [outline-style:outset]">
      <section class="p-0.5 min-w-[31rem] bg-[#ccc]">
        <header class="px-1 bg-gradient-to-r from-[#009] to-[#09f]">
          <h1 class="font-mono text-white">Querty Library Login</h1>
        </header>
        <div class="p-4 space-x-5 flex justify-between">
          <div><img src="/img/keys.png" alt=""></div>
          <article class="flex-grow">
            <p>Welcome to Querty Library!</p>
            <p>Please, login or register to proceed.</p>
            <form name="login" id="login" action="session.php" method="post" class="mt-3 space-y-3">
              <div class="flex justify-between">
                <label for="username">User name:</label>
                <input type="text" name="username" id="username" class="px-1 outline-1 [outline-style:inset]">
              </div>
              <div class="flex justify-between">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="px-1 outline-1 [outline-style:inset]">
              </div>
            </form>
          </article>
          <div class="space-y-3">
            <button form="login" class="block w-20 border-2 border-[#fff_#999_#999_#fff] outline-1 [outline-style:outset]">
              Login
            </button>
            <a href="register.php" class="block">
              <button class="w-20 border-2 border-[#fff_#999_#999_#fff] outline-1 [outline-style:outset]">
                Register
              </button>
            </a>
          </div>
        </div>
      </section>
    </div>
  </main>
</body>

</html>