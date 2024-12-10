<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Display Schedule</title>
</head>
<body>
<h1>Display Schedule</h1>

<?php
try {
    # Pull the student name from the form.
    $student_name = $_POST["student_name"];

    # Query the database to get the student's schedule.
    # Connect to the database.
    $db = new mysqli("localhost", "root", "", "scheduling");

    # The SQL query.
    $query_string = <<<EOT
    SELECT   department_name, course_number, course_name, instructor, semester_offered, year_offered, days, start_time, end_time
    FROM     schedule sch JOIN student s on s.id = sch.student_id
                          JOIN course  c on c.id = sch.course_id
    WHERE first_name = '$student_name'
    ORDER BY department_name, course_number
    EOT;

    # Do the query.
    $result = $db->query($query_string);

    print "<p>Here is $student_name's schedule:</p>\n";
    print "<table>\n";
    print "<tr><th>Dept</th><th>Course</th><th>Name</th><th>Instructor</th><th>Semester</th><th>Year</th><th>Days</th><th>Start Time</th><th>End Time</th>\n";
    while ($row = $result->fetch_assoc()) {
        # Output an HTML table row containing the information.
        print <<<EOT
        <tr>
        <td>{$row['department_name']}</td>
        <td>{$row['course_number']}</td>
        <td>{$row['course_name']}</td>
        <td>{$row['instructor']}</td>
        <td>{$row['semester_offered']}</td>
        <td>{$row['year_offered']}</td>
        <td>{$row['days']}</td>
        <td>{$row['start_time']}</td>
        <td>{$row['end_time']}</td>
        </tr>
        EOT;
    }
    print "</table>\n";
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
