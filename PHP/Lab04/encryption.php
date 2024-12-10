<!DOCTYPE html>

<html lang="en-US">
<head>
    <title>Encryption</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
<h1>Encryption</h1>
<p>This script is used by the professor to generate a <b>secret message</b> for the students to
    decrypt in Lab 4.
</p>
<?php

$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$rotation = 13;

$plaintext = "We hold these truths to be self-evident, that all men are created equal, that they are endowed by their Creator with certain inalienable rights, that among these are life, liberty and the pursuit of happiness.";
$plaintext = "a secret message";
$ciphertext = "";

function plain2cipher($p)
{
    # $p is a plain text character.
    # $rot is the cipher key.
    # This function returns the encrypted ciphertext.
    global $letters, $rotation;
    $p = strtoupper($p);
    $pn = strpos($letters, $p);
    if ($pn !== FALSE) {
        $cn = ($pn + $rotation) % 26;   # cipher
        $c = $letters[$cn];
    }
    else {
        # char not found in $letters
        $c = $p;
    }
    return $c;
}

echo "<p>plaintext = $plaintext</p>";

for ($i = 0; $i < strlen($plaintext); $i++) {
    $p = strtoupper($plaintext[$i]);  # plain
    $c = plain2cipher($p);            # cipher
    $ciphertext = $ciphertext . $c;   # append
}

echo "<p>This is the ciphertext: $ciphertext</p>";

?>

</body>
</html>
