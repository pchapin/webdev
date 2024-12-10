<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Database Demonstration</title>
  <style>
      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
          padding: 5px;
      }
  </style>
</head>
<body>
<h1>Database Demonstration</h1>

<?php
try {
    # Connect to the database.
    $db = new mysqli("localhost", "root", "", "variablestars");

    # The SQL query.
    $query_string = <<<EOT
    SELECT name, const, max_bright, min_bright, right_ascension, declination
    FROM   star
    WHERE  const = 'Ori' AND max_bright >= 2.0 AND min_bright < 9.0
    ORDER BY min_bright;
    EOT;

    # Execute the query.
    $result = $db->query($query_string);

    # Process the results.
    print "<table>\n";
    print "<tr><th>NAME</th><th>CONST</th><th>Max</th><th>Min</th><th>RA</th><th>DEC</th></tr>\n";
    while ($row = $result->fetch_row()) {
        print "<tr>";
        foreach ($row as $item) {
            print "<td>$item</td>";
        }
        print "</tr>\n";
    }
    print "</table>\n";
}
catch (Exception $exception) {
    if ($exception instanceof mysqli_sql_exception) {
        print "<p>Error: SQL exception!</p>\n";
        print "<pre>\n";
        print "Error number : " . $exception->getCode() . "\n";
        print "Error message: " . $exception->getMessage() . "\n";
        print "</pre>\n";
    }
    else {
      print "<p>Unknown exception!</p>\n";
    }
}
?>
</body>
</html>
