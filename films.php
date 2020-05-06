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
<?php
$stmt = $dbh->query('SELECT * FROM films WHERE id = "' . $_GET['id'] . '"');
foreach ($stmt as $row) {
    echo $row['naam'] . "\n";
    echo "<br> land:" . $row['land'] . "\n";
    echo "<br> datum uitkomst:" . $row['datum_uitkomst'] . "\n";
    echo "<br> omschrijving:" . $row['omschrijving'] . "\n";
    echo '<iframe width="560" height="315" src= "https://www.youtube.com/embed/' . $row["id_trailer"] . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media;
    gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
?>
</body>
</html>