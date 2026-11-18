<?php
$conn = mysqli_connect('localhost', 'root', '', 'antyki');
if (mysqli_connect_errno()) {
    die(mysqli_connect_error());
}
;
$q1a = mysqli_query($conn, 'SELECT idMeble, nazwa, plik, styl, cena, opis from meble where kategoria = 1;');
$q1b = mysqli_query($conn, 'SELECT idMeble, nazwa, plik, styl, cena, opis from meble where kategoria = 2;');
$q1c = mysqli_query($conn, 'SELECT idMeble, nazwa, plik, styl, cena, opis from meble where kategoria = 3;');
$q3 = mysqli_query($conn, 'SELECT m.idMeble, m.nazwa, m.cena from meble m join zakupy z on m.idMeble=z.idMeble LEFT JOIN klienci k on z.idKlienci=k.idKlienci where k.idKlienci = 1;');

if (isset($_POST['idMeble'])) {
    $idMeble = (int) $_POST['idMeble'];
    $q2 = mysqli_query($conn, "INSERT INTO zakupy (idKlienci, idMeble, sztuk) VALUES (1,$idMeble,1);");
    header("Location: index.php");
    exit;
}
if (isset($_POST['del'])) {
    $del = mysqli_query($conn, "TRUNCATE TABLE zakupy");
    header("Location: index.php");
    exit;
}
if (isset($_POST['delItem'])) {
    $idMeble = (int) $_POST['delItem'];
    $delItem = mysqli_query($conn, "DELETE FROM zakupy WHERE idKlienci = 1 AND idMeble = $idMeble LIMIT 1");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprzedaż antyków</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <header>
        <h1>Najlepsze antyki w mieście</h1>
    </header>
    <main>
        <section>
            <h2>- Sofy -</h2>
            <?php
            while ($row = mysqli_fetch_array($q1a)) {
                echo '<div class="mebel">';
                echo '<div class="obraz">';
                echo '<img src="sofy/' . $row["plik"] . '" alt="mebel">';
                echo '</div>';
                echo '<div>';
                echo '<h3>' . $row['nazwa'] . '</h3>';
                echo '<h4> styl' . $row['styl'] . '</h4>';
                echo '<h3> CENA:' . $row['cena'] . 'zł</h3>';
                echo
                    '<form action="index.php" method="POST">
                            <button type="submit" name="idMeble" value="' . $row['idMeble'] . '">KUP</button>
                        </form>';
                echo '</div>';
                echo '<div class="opis">';
                echo '<p>' . $row['opis'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
            <h2>- Fotele -</h2>
            <?php
            while ($row = mysqli_fetch_array($q1b)) {
                echo '<div class="mebel">';
                echo '<div class="obraz">';
                echo '<img src="fotele/' . $row["plik"] . '" alt="mebel">';
                echo '</div>';
                echo '<div>';
                echo '<h3>' . $row['nazwa'] . '</h3>';
                echo '<h4> styl' . $row['styl'] . '</h4>';
                echo '<h3> CENA:' . $row['cena'] . 'zł</h3>';
                echo
                    '<form action="index.php" method="POST">
                            <button type="submit" name="idMeble" value="' . $row['idMeble'] . '">KUP</button>
                        </form>';
                echo '</div>';
                echo '<div class="opis">';
                echo '<p>' . $row['opis'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
            <h2>- Komody -</h2>
            <?php
            while ($row = mysqli_fetch_array($q1c)) {
                echo '<div class="mebel">';
                echo '<div class="obraz">';
                echo '<img src="komody/' . $row["plik"] . '" alt="mebel">';
                echo '</div>';
                echo '<div>';
                echo '<h3>' . $row['nazwa'] . '</h3>';
                echo '<h4> styl ' . $row['styl'] . '</h4>';
                echo '<h3> CENA: ' . $row['cena'] . 'zł</h3>';
                echo
                    '<form action="index.php" method="POST">
                            <button type="submit" name="idMeble" value="' . $row['idMeble'] . '">KUP</button>
                        </form>';
                echo '</div>';
                echo '<div class="opis">';
                echo '<p>' . $row['opis'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
            <?php

            ?>
        </section>
        <aside>
            <h2>Koszyk</h2>
            <p>Zalogowano: Anna Kowalska</p>
            <?php
            $koszt = 0;
            echo '<ol>';
            while ($row = mysqli_fetch_array($q3)) {
                echo '<li>';
                echo $row['nazwa'].', cena: '.$row['cena'];  
                echo '<form action="index.php" method="POST" style="display:inline;">
                    <button type="submit" name="delItem" value="'.$row['idMeble'].'" class="delItem">×</button>
                </form>';

                echo'</li>';
                $koszt += $row['cena'];
            }
            echo '</ol>';
            echo '<p>Koszt całkowity: ' . $koszt . '</p>';
            echo '<form action="index.php" method="POST" onsubmit="return confirm(\'Czy na pewno chcesz wyczyścić koszyk?\')">
                    <button type="submit" name="del">Opróżnij kosz</button>
                </form>';
            mysqli_close($conn);
            ?>
        </aside>
    </main>
    <footer>
        <p>Strone wykonal: Yelisieiev Yevhenii</p>
    </footer>
</body>

</html>