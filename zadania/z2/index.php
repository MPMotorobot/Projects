<?php
    $conn = mysqli_connect('localhost', 'root', '', 'wodospady');

    if (!$conn) {
    die("Błąd połączenia z bazą: " . mysqli_connect_error());
    }

    if (isset($_POST['et']) && isset($_POST['turysta'])) {

        $idObiekt = $_POST['et'];
        $idTurysta = $_POST['turysta'];

        mysqli_query(
            $conn, "INSERT INTO osiagniecia (idObiekt, idTurysta) VALUES ($idObiekt, $idTurysta)"
        );
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wodospady</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h2>Łowcy wodospadów</h2>
    </header>
    <main>
        <aside>
            <?php 
                $result = mysqli_query($conn, "SELECT idKontynent, nazwa from kontynenty;");
                
                while ($row = mysqli_fetch_array($result)) {
                    echo 
                        '<a href="index.php?idKontynent='
                        . $row['idKontynent']
                        . '">'
                        . $row['nazwa']
                        . '</a>';
                }
            ?>
        </aside>
        <section>
            <table>
                <tr>
                    <th>identyfikator</th>
                    <th>Państwo</th>
                    <th>Nazwa wodospadu</th>
                    <th>Wysokość</th>
                </tr>
                <?php
                    if (isset($_GET['idKontynent'])) {
                        $idKontynent = $_GET['idKontynent'];
                    } else {
                        $idKontynent = 6;
                    }

                    $result = mysqli_query($conn, "SELECT idObiekt, panstwo, nazwa, wartoscCechy from obiekty where idRodzaj = 10 AND idKontynent = $idKontynent;");
                    
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['idObiekt'] . "</td>";
                        echo "<td>" . $row['panstwo'] . "</td>";
                        echo "<td>" . $row['nazwa'] . "</td>";
                        echo "<td>" . $row['wartoscCechy'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
            <h4>Wpisz osiągnięcie do bazy</h4>
            <form action="index.php" method="POST">
                <label for="et">
                    identyfikator wodospadu
                </label>
                <input type="number" name="et" id="et">

                <label for="turysta">
                    turysta
                </label>
                <select name="turysta" id="turysta">
                    <?php
                    $result = mysqli_query($conn, "SELECT idTurysta, nick FROM turysci;");

                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value="' . $row['idTurysta'] . '">'
                        . $row['nick']
                        . '</option>';
                    }
                    mysqli_close($conn)
                    ?>
                </select>
                <button type="submit">Wpisz</button>
            </form>
        </section>
    </main>
    <article>
        <h3>Wodospady w Polsce</h3>
        <img src="kamienczyk.jpg" alt="wodospad">
        <img src="siklawica.jpg" alt="wodospad" width="133">
        <img src="siklawa.jpg" alt="wodospad">
        <img src="wilczki.jpg" alt="wodospad">
    </article>
    <footer>Autor: 0000000</footer>
</body>
</html>