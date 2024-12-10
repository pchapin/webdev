<!DOCTYPE html>

<?php
# My PHP library...

# Type declarations are optional, but can be useful for catching errors.
function is_prime(int $number): bool
{
    $prime = True;
    for ($divisor = 2; $divisor < $number; $divisor++) {
        if ($number % $divisor == 0) {
            $prime = False;
            break;
        }
    }
    return $prime;
}
?>

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
          if (is_prime($current_value)) {
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
