<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>Guessing Game</title>
</head>
<body>


<?php
echo "<!--  get values from form POST -->\n";
$max = 100;

# ---------------------------------------------------------
# Controller
# ---------------------------------------------------------
#  - There are 3 things to control:
#      1) State variables
#      2) Process previous guess and present new option to guess
#      3) Is game over?

# 1) state variables
if (empty($_POST['submit'])) {
    # first time here!
    $guess = "";
    $secret = rand(1, $max);  # Starting new secret for rest of game
    $num = 0;  # I'll increment later
}
else {
    # Get state variables from POST form
    $guess = $_POST['guess'];
    $secret = $_POST['secret'];
    $num = $_POST['num'];
}
print("<pre>\$_POST=" . print_r($_POST, true) . "</pre>");

echo "<!--  The Model/Controller: guess, message and game_over vars  -->\n";
$game_over = false;
$num = $num + 1; # increment
$result = "";
$status = "";

# 2) previous guess result
if ($guess == $secret) {
    $result = "Woo Hoo! You won. <b>$guess</b> was correct!!!!  ";
    $game_over = true;  # End method #1
}
elseif ($guess > $secret) {
    $result = "Your guess, $guess, was <b>too high.</b>";
}
else {
    $result = "Your guess, $guess, was <b>too low.</b>";
}

# 3) is game over? (game playing status)
if ($num > 10) {
    $status = "Game Over. You did not guess my secret number of $secret.";
    $game_over = true;  # End method #2
}
elseif (empty($guess)) {
    # New game
    $status = "Let's start a guessing game!";
    $result = "";  # reset
}
else {
    # Just playing along...
    $status = "This is guess #$num. <br>";
}
?>

<!-- =============================================  -->
<!--  View -->
<!-- =============================================  -->

<h1>Guess My Secret Number</h1>

<p>I am thinking of a secret number between 1 and <?= $max ?>.<br>You have 10 tries to guess
  it.</p>
<p><?= $status ?></p>
<p><?= $result ?></p>

<form method=POST>
    <?php
    if ($game_over) {
        echo "<input type=submit value='New Game' name=reset>\n";
    }
    else {
        echo <<<EOT
        Try a guess: 
        <input type=text   name=guess  value=$guess>
        <input type=submit name=submit value='Submit'>
        <input type=hidden name=secret value=$secret >
        <input type=hidden name=num    value=$num >
        EOT;
    }
    ?>

</form>
</body>
</html>
