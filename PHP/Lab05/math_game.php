<!doctype html>
<html lang="en-US">
<head>
  <title>Math Game</title>
</head>
<body>

<?php
  echo "<!--   get vars from form -->\n";
  $max = 20;                   # highest random number
  $op = $_POST['op'] ?? "";    #
  $num = $_POST['num'] ?? 0;   # if empty, starting new
  $correct = $_POST['correct'] ?? 0;

  # the previous problem
  echo "<!--  grade previous problem  -->\n";
  $x2 = $_POST['x'] ?? "";
  $y2 = $_POST['y'] ?? "";
  if ($num > 0){
    $answer = $_POST['answer'] ?? "";  # if empty (not set), $answer is a string
    if ($op == 'add') { $this_answer = $x2 + $y2; }
    if ($op == 'mult') { $this_answer = $x2 * $y2; }
  }

  # the new problem
  echo "<!--  setup the new problem  -->\n";
  $x = rand(1,$max);
  $y = rand(1,$max);
  if ($op == 'mult') { $question = "$x * $y "; }
  if ($op == 'add') { $question = "$x + $y "; }

  # the controller
  $game_over = false;
  $num = $num + 1; # increment
  $message = "";
  $message2 = "";

  echo "<!--   controller: score, message and game over vars  -->\n";

  # -------------------------------------
  # 1. analyse the answer
  # -------------------------------------
  if ($op == ''){
    # state 1: operation not defined yet
    $message = "What operation do you want?";
  }
  elseif (empty($answer)) {
    $message = "Starting game now. ";
  }
  elseif ($answer == $this_answer){
    $message = "Woo Hoo!  Correct.";
    $correct++;
  }
  else {
    if ($op == 'mult') { $prevq = "$x2 * $y2 "; }
    if ($op == 'add') { $prevq = "$x2 + $y2 "; }
    $message = "You were incorrect.  The answer to $prevq is $this_answer (not $answer).";
  }

  # -------------------------------------
  # 2. is the game over?
  # -------------------------------------
  if ($num == 11) {
    $score = number_format(100* $correct / 10,0);
    $message2 = "Game Over.  You got a $score %.";
    $game_over = true;
  }

?>

<!-- =========================================================== -->
<h1> Math Game </h1>
I wil give you 10 problems.  Can you get them all correct?
<br><br>

<p> <?= $message ?> </p>
<p> <?= $message2 ?> </p>

<form method=POST>
<?php

  if ($op == '') {
    # state 1
    echo "
<!-- state 1 -->
<input type=radio name=op value='add' id=a> <label for=a>Addition</label> ;
<input type=radio name=op value='mult' id=m> <label for=m>Multiplication</label>
<input type=submit value='Submit' name=submit>
  ";
  }
  elseif ($game_over) {
    # state 3
    echo "<!-- state 3 -->\n";
    echo "<input type=submit value='Start new game' name=submit>";
  }
  else {
    # state 2
    echo "
  <!--  state 2 --->
  This is question #$num. <br>
  $question = <input type=text name=answer value=''><br><br>
  <input type=submit value='Submit' name=submit>

  <!--    5 states of game   -->
  <input type=hidden name=x    value=$x >
  <input type=hidden name=y    value=$y >
  <input type=hidden name=num  value=$num >
  <input type=hidden name=op   value=$op >
  <input type=hidden name=correct   value=$correct >
    ";
  }

echo "<pre>";
print_r($_POST);
echo "</pre>";

?>

</form>
</body>
</html>
