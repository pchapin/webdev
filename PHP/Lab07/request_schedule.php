<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Request Schedule</title>
</head>
<body>
<h1>Request Schedule</h1>

<?php
try {
    # Query the database to get a list of student names.
    # Connect to the database.
    $db = new mysqli("localhost", "root", "", "scheduling");

    # The SQL query.
    $query_string = <<<EOT
    SELECT   first_name
    FROM     student
    ORDER BY first_name
    EOT;

    # Do the query.
    $result = $db->query($query_string);
    ?>

  <form action="display_schedule.php" method="post">
    <!-- Display a drop-down list of student names -->
    <label for="students">Select a student name</label> <select id="students" name="student_name">
          <?php
          while ($row = $result->fetch_row()) {
              $student_name = $row[0];
              print "<option value='$student_name'>$student_name</option>";
          }
          ?>
    </select>
    <input type="submit" name="submit" value="Submit"/>
  </form>

    <?php
}
catch (mysqli_sql_exception $exception) {
    print "<p>Error: SQL exception!</p>\n";
    print "<pre>\n";
    print "Error number : " . $exception->getCode() . "\n";
    print "Error message: " . $exception->getMessage() . "\n";
    print "</pre>\n";
}
?>

</body>
</html>
