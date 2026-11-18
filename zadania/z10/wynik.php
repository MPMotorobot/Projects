<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przegladaj wyniki</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1>Portal laboratorium</h1>
        <p>Witaj, <strong><?php echo $_SESSION['user']; ?></strong></p>
        <a href="wyloguj.php">Wyloguj</a>
    </header>
    <main>
        <h2>Wyniki pacjentow</h2>
        <table>
            <tr>
                <th>Imie pacjenta</th>
                <th>Nazwisko pacjenta</th>
                <th>PESEL</th>
                <th>Data zlecenia</th>
                <th>Data wykonania</th>
                <th>Wynik</th>
            </tr>
            <?php
                $conn = mysqli_connect('localhost','root','','laboratorium');
                $q = mysqli_query($conn, 'SELECT p.imie, p.nazwisko, p.pesel, z.data, w.data, w.plik FROM pacjent p JOIN zlecenie z ON p.id = z.idPacjenta LEFT JOIN wynik w ON z.id = w.idZlecenia;');
                while($row = mysqli_fetch_array($q)){
                    echo "<tr>";
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "<td>" . $row[4] . "</td>";
                    echo "<td>";
                    if (!empty($row[5])) {
                      echo "<a href='$row[5]' target='_blank'>wynik</a>";
                    };
                    echo "</td></tr>";
                }
                mysqli_close($conn);
            ?>
        </table>
    </main>
    <footer>
        <p>Wykonal: Yelisieiev Yevhenii</p>
    </footer>
</body>
</html>