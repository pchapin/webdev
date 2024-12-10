<!DOCTYPE html>
<html>
<head>
    <title>Database Test</title>
</head>
<body>
<h1>Database Test</h1>
<?php
echo "<p>Testing a database connection...</p>";

// Various data items. Change only here to affect the entire script.
$servername = "localhost";
$username   = "pchapin";
$password   = "s^3miDT6VjcA";
$dbname     = "pccVariableStars";
$query      = <<<EOT
  SELECT name, const, max_bright, min_bright
  FROM star
  WHERE const = 'Ori' AND min_bright <= 9.0
  EOT;

try {
    // Connect and do the deed!
    $connection = new PDO("pgsql:host=$servername;dbname=$dbname", "$username", "$password");
    echo "<p>Connected!</p>";
    foreach($connection->query($query) as $row) {
        print_r($row); print "<br>";
    }
    $connection = null;
}
catch (PDOException $e) {
    print "<p>Error: " . $e->getMessage() . "</p>";
    die();
}
?>
</body>
</html>
