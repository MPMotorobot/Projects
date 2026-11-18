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
        <h2>Galeria</h2>
        <section>
            <?php
                $q1 = mysqli_query($conn, "SELECT idObiekt, plik, nazwa from obiekty WHERE panstwo = 'islandia';");
                while ($row = mysqli_fetch_array($q1)) {
                            $id = $row['idObiekt'];
                            $plik = $row['plik'];
                            $nazwa = $row['nazwa'];
                
                            echo "<a href='obiekty.php?id=$id'>";
                            echo "<img src='$plik' alt='$nazwa' title='$nazwa' class='miniatury'>";
                            echo "</a>";
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