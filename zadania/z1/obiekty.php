<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Islandia</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <a href="islandia.php">
            <h1>Zwiedzaj Islandię</h1>
        </a>
    </header>
    <aside>
        <h3>Do zwiedzania</h3>
        <ul>
            <li>Wodospady:
                <ol>
                    <?php
                        $conn = mysqli_connect('localhost','root','','islandia');
                        $q3 = mysqli_query($conn, "SELECT nazwa from obiekty WHERE panstwo = 'islandia' AND idRodzaj = 10;");
                        while ($row = mysqli_fetch_array($q3)) {
                            echo "<li>" . $row['nazwa'] . "</li>";
                        }
                    ?>
                </ol>
            </li>
            <li>Siedliska zwierząt:
                <ol>
                    <?php
                        $q3_m = mysqli_query($conn, "SELECT nazwa FROM obiekty WHERE panstwo = 'Islandia' AND idRodzaj = 14;");
                        while ($row = mysqli_fetch_array($q3_m)) {
                            echo "<li>" . $row['nazwa'] . "</li>";
                        }
                    ?>
                </ol>
            </li>
        </ul>
    </aside>
    <main>
        <h2>Opis miejsca</h2>
        <section>
            <?php
                if (isset($_GET['id'])) {
                $idObiektu = (int)$_GET['id'];

                $q2 = "SELECT o.plik, o.nazwa, o.nazwaCechy, o.wartoscCechy, o.opis, r.rodzaj 
                                FROM obiekty o 
                                JOIN rodzaje r ON o.idRodzaj = r.idRodzaj 
                                WHERE o.idObiekt = $idObiektu;";

                    $s4 = mysqli_query($conn, $q2);

                    if ($s4 && $row = mysqli_fetch_array($s4)) {
                        echo "<img src='" . $row['plik'] . "' alt='" . $row['nazwa'] . "'>";
                        echo "<h2>" . $row['nazwa'] . "</h2>";
                        echo "<h3>" . $row['rodzaj'] . "</h3>";
                        echo "<p>" . $row['nazwaCechy'] . ": " . $row['wartoscCechy'] . "</p>";
                        echo "<p>" . $row['opis'] . "</p>";
                    }
                }
                mysqli_close($conn);
            ?>

        </section>
    </main>
    <footer>
        <hr>
        <p>Autor: 0000000</p>
    </footer>
</body>
</html>