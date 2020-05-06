<?php
$host = '127.0.0.1:3306';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $dbh = new PDO($dsn, $user, $pass, $options);
    echo("Connected to: " . $db . " on " . $host . " version: " . phpversion());
    echo("<br>");
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welkom op het netland beheerspaneel</h1>
    <h2>Series</h2>
    <table style="width:50%">
    <tr>
    <td>Titel</td>
    <td>Rating</td>
</tr>
    <?php 
    
    $file = 'import.sql';
    $stmt = $dbh->query('SELECT title, rating, id FROM series');
    while ($row = $stmt->fetch()) {
        echo '<tr><td>' . $row['title'] . '</td><td>' . $row['rating'] . '<a href="series.php?id=' . $row['id'] . '" >Bekijk details</a></td></tr>'; 
    }
    
    ?>
</table>
    <h2>Films</h2>
    <table style="width:50%">
 <tr>
  <td>Titel</td>
  <td>Duur</td>

<?php 
    $file = 'import.sql';
    $stmt = $dbh->query('SELECT naam, duur_minuten, id FROM films');
while ($row = $stmt->fetch()) {
        echo '<tr><td>' . $row['naam'] . '</td><td>' . $row['duur_minuten'] . '<a href="films.php?id=' . $row['id'] . '">Bekijk details</a></td></tr>';
}
?>
</table>
</body>
</html>