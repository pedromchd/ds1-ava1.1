<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-green-100 flex">
  <header class="py-3 px-5 bg-green-300">
    <h1 class="text-3xl font-bold">Querty Library</h1>
  </header>
  <main class="flex-grow grid place-items-center">
    <form action="/auth/register.php" method="post">
      <fieldset class="w-[20rem] p-5 border-2 border-green-800 grid gap-2">
        <legend class="px-1 text-xl text-green-800 font-semibold">Register</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
        <input type="submit" value="Register" class="mt-2 py-1 bg-green-300 cursor-pointer hover:bg-green-400">
        <a href="/login.php" class="text-center py-1 bg-green-300 hover:bg-green-400">Return</a>
      </fieldset>
    </form>
  </main>
</body>

</html>
