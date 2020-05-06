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
<?php
 $file = 'import.sql';
 $stmt = $dbh->query('SELECT title FROM series WHERE id = "' . $_GET['id'] . '"');
foreach ($stmt as $row) {
     echo $row['title'] . "\n";
}
 $stmt = $dbh->query('SELECT has_won_awards FROM series WHERE id = "' . $_GET['id'] . '"');
foreach ($stmt as $row) {
     echo "<br> awards:" . $row['has_won_awards'] . "\n";
}

$stmt = $dbh->query('SELECT seasons FROM series WHERE id = "' . $_GET['id'] . '"');
foreach ($stmt as $row) {
    echo "<br> seasons:" . $row['seasons'] . "\n";
}
$stmt = $dbh->query('SELECT country FROM series WHERE id = "' . $_GET['id'] . '"');
foreach ($stmt as $row) {
    echo "<br> country:" . $row['country'] . "\n";
}
$stmt = $dbh->query('SELECT language FROM series WHERE id = "' . $_GET['id'] . '"');
foreach ($stmt as $row) {
    echo "<br> language:" . $row['language'] . "\n";
}
$stmt = $dbh->query('SELECT description FROM series WHERE id = "' . $_GET['id'] . '"');
foreach ($stmt as $row) {
    echo "<br> description:" . $row['description'] . "\n";
}
?>
