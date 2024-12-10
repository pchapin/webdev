<?php

function conflict(
    string $student,        # Name of the student.
    string $new_semester,   # "Fall" or "Spring" indicating the semester when course will be taken.
    int    $new_year,       # Year in which course will be taken.
    string $new_days,       # A string of days "MTWHF".
    int    $new_start_time, # The time when the class starts (e.g., 1425).
    int    $new_end_time): bool
{
    # Connect to the database.
    $db = new mysqli("localhost", "root", "", "scheduling");

    # The SQL query.
    $query_string = <<<EOT
    SELECT   semester_offered, year_offered, days, start_time, end_time
    FROM     schedule sch JOIN student s on s.id = sch.student_id
                          JOIN course  c on c.id = sch.course_id
    WHERE first_name = '$student'
    ORDER BY start_time;
    EOT;

    # Do the query.
    $result = $db->query($query_string);

    # Analyze for conflicts (untested code).
    while ($course = $result->fetch_assoc()) {
        # Only courses scheduled for the same semester and year are relevant.
        if ($course['semester_offered'] != $new_semester) return false;
        if ($course['year_offered'] != $new_year) return false;

        # Consider each day the existing course runs...
        foreach ($course['days'] as $day) {
            # If the new course is also scheduled on that day...
            if (substr_count($new_days, $day) == 1) {
                $conflicted = true;
                if ($course['start_time'] >= $new_end_time) $conflicted = false;
                if ($course['end_time'] <= $new_start_time) $conflicted = false;
                if ($conflicted) return true;
            }
        }
    }
    return false;
}

?>
