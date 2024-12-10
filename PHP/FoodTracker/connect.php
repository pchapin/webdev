<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Database Test</title>
</head>
<body>
<h1>Database Test</h1>

<?php
echo "<p>Testing a database connection...</p>";

// Various data items. Change only here to affect the entire script.
$servername = "localhost";
$username = "jjones";
$password = "frenchfry";
$dbname = "pccFoodTracker";
$query = <<<EOT
  SELECT *
  FROM USDAFood
  WHERE data_type = 'foundation_food'
  EOT;

try {
    // Connect and do the deed!
    $connection = new PDO("pgsql:host=$servername;port=5433;dbname=$dbname", "$username", "$password");
    echo "<p>Connected!</p>";
    foreach ($connection->query($query) as $row) {
        print_r($row);
        print "<br>";
    }
    $connection = null;
} catch (PDOException $e) {
    print "<p>Error: " . $e->getMessage() . "</p>";
    die();
}
?>
</body>
</html>
