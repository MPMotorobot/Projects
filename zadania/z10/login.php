<?php
    session_start();
    if (isset($_POST['login'])) {
        if ($_POST['login'] == 'admin' && $_POST['haslo'] == 'Haslo321*') {
            $_SESSION['user'] = 'admin';
            header("Location: wynik.php");
        };
    };

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj sie</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Portal laboratorium</h1>
    </header>
    <main class="login">
        <h2>Zaloguj sie do systemu</h2>
        <form action="login.php" method="post">
            <lable for="login">Login:</lable>
            <input type="text" name="login" id="login"><br><br>
            <lable for="haslo">Haslo:</lable>
            <input type="password" name="haslo" id="haslo"><br><br>
            <input type="submit" value="Zaloguj sie">
        </form>
    </main>
    <footer>
        <p>Wykonal: Yelisieiev Yevhenii</p>
    </footer>
</body>
</html>