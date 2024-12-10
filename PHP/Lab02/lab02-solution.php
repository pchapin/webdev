<!DOCTYPE html>
<!--
  This is a solution to the CIS-1152 Lab #2.

  This solution is based on a version by Steve Ruegsegger, but it has been extensively edited by
  Peter Chapin.
  -->

<html lang="en-US">
<head><title>CIS-1152 Lab #2: PHP Logic and Loops</title>
  <style>
      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
          padding: 5px;
      }
  </style>
</head>

<body>
<h1>Task 1: Multiplication Table</h1>

<!-- This code uses 'print' for output. -->
<?php
$n = 10;  # Sets the upper bound on the values in the table.

print "<p>This is a <b>$n x $n</b> multiplication table.</p>\n";
print "<table>\n";

# Print the top header row.
print "<tr><th style='width:20px'>x</th>";
for ($column = 1; $column <= $n; $column++) {
    print "<th style='background-color: #EEE;' style='width:20px'>$column</th>";
}
print "</tr>\n";

# Print the rest of the rows.
for ($row = 1; $row <= $n; $row++) {
    print "<tr><th style='background-color: #EEE'>$row</th>";   # Start row and row header (first column)
    for ($column = 1; $column <= $n; $column++) {
        $product = $row * $column;
        $color = ($row == $column) ? '#EEF' : "";  # Adjust the color for the diagonal elements.
        print "<td style='text-align:center; width: 0.25in; background-color: $color' $color>$product</td>";
    }
    print "</tr>\n";
}
print "</table>\n\n";
?>

<h1>Task 2: Collatz Sequence</h1>

<!-- This code uses 'echo' for output. -->
<?php
$n0 = 4387347843877575; # Sets the value to check.

echo "<p>The initial number is: <b>", number_format($n0), "</b>.</p>\n";
$n = $n0;  # Current value.
$i = 0;    # Step number.

echo "<table>\n";
while (True) {
    $i++;

    # Update the current value.
    if ($n % 2 == 0) {
        $n = $n / 2;
    }
    else {
        $n = 3 * $n + 1;
    }

    # Display the results of this step.
    echo "<tr><th>step $i</th><td style='text-align: right'>", number_format($n), "</td></tr>\n";
    if ($n == 1) {
        break;
    }
}
echo "</table>\n";
echo "<p>Woo Hoo! The integer ", number_format($n0), " finished in $i steps.</p>\n"
?>

</body>
</html>
