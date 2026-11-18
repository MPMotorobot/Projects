<?php
    session_start();
    if(isset($_SESSION['login'])){
        unset($_SESSION['login']);
        session_destroy();
    };
    header("Location: login.php");
    exit;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wylogowanie</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header></header>
    <main></main>
    <footer>
        <p>Wykonal: Yelisieiev yevhenii</p>
    </footer>
</body>
</html>