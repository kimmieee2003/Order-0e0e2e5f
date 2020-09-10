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
    <td><a href="?soort=serie&&serie=title">titel</a></td>
    <td><a href="?soort=serie&&serie=rating">Rating<a></td>
</tr>
<?php
$opdracht = 'SELECT title, rating, id FROM series';

if(isset($_GET["soort"]))
{ 
    $action = $_GET["soort"];
    $serie = $_GET["serie"];


    if($action === "serie" && $serie === "title"){
        $opdracht = 'SELECT title,rating,id FROM series  ORDER BY title'; 

    } elseif($action === "serie" && $serie === "rating"){
        $opdracht = 'SELECT title,rating,id FROM series  ORDER BY rating'; 

    }

}
?>
    <?php 
    
    $file = 'import.sql';
    $stmt = $dbh->query($opdracht);
    while ($row = $stmt->fetch()) {
        echo '<tr><td>' . $row['title'] . '</td><td>' . $row['rating'] . '<a href="series.php?id=' . $row['id'] . '" >Bekijk details</a></td></tr>'; 
    }
    
    ?>
</table>
    <h2>Films</h2>
    <table style="width:50%">
 <tr>
  <td><a href="?soort=films&&film=titel">titel</a></td></td>
  <td><a href="?soort=films&&film=duur">Duur<a></td>

<?php
$oefening = 'SELECT naam, duur_minuten, id FROM films';

if(isset($_GET["soort"]))
{ 
    $action2 = $_GET["soort"];
    $film = $_GET["film"];


    if($action2 === "films" && $film === "titel"){
        $oefening = 'SELECT naam, duur_minuten, id FROM films  ORDER BY naam'; 

    } elseif($action2 === "films" && $film === "duur"){
        $oefening = 'SELECT naam, duur_minuten, id FROM films  ORDER BY duur_minuten'; 

    }

}

?>


<?php 
    $file = 'import.sql';
    $stmt2 = $dbh->query($oefening);
while ($row2 = $stmt2->fetch()) {
        echo '<tr><td>' . $row2['naam'] . '</td><td>' . $row2['duur_minuten'] . '<a href="films.php?id=' . $row2['id'] . '">Bekijk details</a></td></tr>';
}
?>
</table>
</body>
</html>