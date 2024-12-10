<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>15 Squares Game</title>
  <style>
      table, th, td {
          border: 1px solid black;
          /* border-collapse: collapse; */
      }
  </style>
</head>

<body>
<h1>15 Squares Game</h1>

<p>Let's play 15-squares game!</p>
<table>

    <?php
    $board = range(1, 16);
    shuffle($board);

    for ($row = 0; $row < 4; $row++) {
        print "<tr>";
        for ($column = 0; $column < 4; $column++) {
            $index = $row * 4 + $column;
            $token = $board[$index];
            $color = "";
            if ($token == 16) {
                $token = " ";
                $color = "#EEE";
            }
            print "<td style='text-align: center; width: 0.25in; background-color: $color'>$token</td>";
        }
        print "</tr>\n";
    }
    ?>

</table>
<p><em>Refresh</em> to shuffle the board.</p>
</body>
</html>
