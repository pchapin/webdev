<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fahrenheit to Celsius</title>
  <style>
      table {
          border: thin solid black;
      }
      th {
          width: 1.0in;
          text-align: right;
      }
      td {
          text-align: right;
      }
  </style>
</head>

<body>
<h1>Fahrenheit to Celsius</h1>

<p>The following table converts Fahrenheit temperatures to Celsius.</p>

<table>
  <thead>
  <tr>
    <th>Fahrenheit</th>
    <th>Celsius</th>
  </tr>
  </thead>
  <tbody>

  <?php
  for ($temp_f = 0.0; $temp_f <= 100.0; $temp_f += 10.0) {
      $temp_c = (5.0 / 9.0) * ($temp_f - 32.0);
      $formatted_temp_c = number_format($temp_c, 2);
      $fully_formatted_temp_c = sprintf("%6s", $formatted_temp_c);
      print "<tr><td>$temp_f</td><td>$fully_formatted_temp_c</td></tr>\n";
  }
  ?>

  </tbody>
</table>

</body>
</html>
