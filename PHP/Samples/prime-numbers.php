<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title>Prime Numbers</title>
  <style>
      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
          padding: 5px;
      }
      th {
          background-color: lightblue;
      }
      td {
          text-align: right;
      }
  </style>
</head>

<body>
<h1>Prime Numbers</h1>

<?php
$n_primes = 10;
print "<p>Let's print the first $n_primes prime numbers!</p>";
?>

<table>
  <thead>
  <tr>
    <th>Rank</th>
    <th>Prime</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <th>1</th>
    <td>2</td>
  </tr>

  <?php
  $current_value = 2;

  # Print the desired number of primes...
  for ($i = 2; $i <= $n_primes; $i++) {
      $found_prime = False;
      while (!$found_prime) {
          $current_value++;

          # Check to see if $current_value is prime...
          $is_prime = True;
          for ($divisor = 2; $divisor < $current_value; $divisor++) {
              if ($current_value % $divisor == 0) {
                  $is_prime = False;
                  break;
              }
          }
          if ($is_prime) {
              $found_prime = True;
          }
      }
      echo "<tr><th>$i</th><td>", $current_value, "</td></tr>\n";
  }
  ?>

  </tbody>
</table>

</body>
</html>
