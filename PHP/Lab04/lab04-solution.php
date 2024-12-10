<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>CIS-1152, Lab #4: Functions and Files</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
<h1>Decryption</h1>

<?php
$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$rotation = 13;

function cipher2plain(string $c): string
{
    # $c is an encrypted cipher character.
    # $rotation is the cipher key (rotation distance).
    # This function returns the plain text decrypted character.
    global $letters, $rotation;

    $c = strtoupper($c);
    $cn = strpos($letters, $c);
    if ($cn === False) {
        # The character is not found in $letters.
        $p = $c;
    }
    else {
        $pn = ($cn - $rotation) % 26;  # Plain int
        $p = $letters[$pn];            # Plain char
    }
    return $p;
}

function decrypt(string $ciphertext): string
{
    $plaintext = "";
    for ($i = 0; $i < strlen($ciphertext); $i++) {
        $c = $ciphertext[$i];          # cipher
        $p = cipher2plain($c);         # plain
        $plaintext = $plaintext . $p;  # append
    }
    return $plaintext;
}

$ciphertext1 = file_get_contents("cipher1.txt");
$ciphertext2 = file_get_contents("cipher2.txt");

$plaintext1 = decrypt($ciphertext1);
$plaintext2 = decrypt($ciphertext2);

echo "<p>Here is ciphertext1: $ciphertext1<br/>It decrypts to: $plaintext1</p>";
echo "<p>Here is ciphertext2: $ciphertext2<br/>It decrypts to: $plaintext2</p>";
?>

<h1>Welcome to My Restaurant</h1>

<?php

global $tax_rate;
$tax_rate = 0.06;

# Read the table order from the file.
# Steve locked the file (see flock below). However, that's not really necessary in this
# case because the file is only ever being read. I choose to delay talking about locking
# until it makes a difference to avoid adding yet another concept to the student's plate.
$fp = fopen("./restaurant-data.txt", 'r');
#flock($fp, LOCK_SH);
if (!$fp) {
    echo "<p><b>Error. Cannot open file.</b><br>";
    exit;
}

# Initialize variables here which are updated in the loop.
$p = -1; # number of plate orders (plate=customer) 0-based
$plates = array();
$drinks = array();
$tip = 0;

while (!feof($fp)) {
    $line = rtrim(fgets($fp));     # Read one line and strip the ending return \n.
    if (empty($line)) continue;    # Empty line.
    list($key, $value) = explode("=", $line);
    $key = trim($key);
    $value = trim($value);
    switch ($key) {
        case "plate"  :
            $plates[++$p] = (empty($value)) ? 0 : floatval($value);
            break;
        case "drink"  :
            $drinks[$p] = (empty($value)) ? 0 : floatval($value);
            break;
        case "server" :
            $server = $value;
            break;
        case "tip"    :
            $tip = floatval($value);
            break;
    }
    #echo "debug: p = $p; key = $key; value = $value<br>\n";
}
#flock($fp, LOCK_UN);
fclose($fp);

#echo "#p = " . count($plates) . "; #d = " . count($drinks) . "<br><br>\n";
print("<pre>plates=" . print_r($plates, true) . "</pre>");
print("<pre>drinks=" . print_r($drinks, true) . "</pre>");


echo "Your server, $server, was happy to serve you.<br><br>\n";
$party = 0.0;  # The total bill from the party

print <<<EOT
<table>
<tr style="background-color: #EEEEEE">
  <th>Cust</th>
  <th>Plate</th>
  <th>Drink</th>
  <th>bill</th>
  <th>tax*</th>
  <th>subtotal</th>
</tr>
EOT;

for ($i = 0; $i < count($plates); $i++) {
    # One row per customer at the table. Do computations...
    $n = $i + 1;
    $bill = $plates[$i] + $drinks[$i];
    $tax = $bill * $tax_rate;
    $subtotal = $bill + $tax;
    $party = $party + $subtotal;

    # Display results...
    echo "<tr style='text-align: center;'><th style='text-align: center;'>$n</th>\n";
    echo "<td>\$ " . number_format($plates[$i], 2) . "</td>";
    echo "<td>\$ " . number_format($drinks[$i], 2) . "</td>";
    echo "<td>\$ " . number_format($bill, 2) . "</td>";
    echo "<td>\$ " . number_format($tax, 2) . "</td>";
    echo "<td>\$ " . number_format($subtotal, 2) . "</td>";
    echo "<tr>\n";
}
print "</table>\n";
$t2 = $tax_rate * 100;
print "<em>* A tax rate of $t2% has been applied per customer</em><br><br>\n\n";

$total = number_format($party + $tip, 2);
print "The total expense from the table is: \$ " . number_format($party, 2) . "<br>\n";
print "The party tip was: \$ " . number_format($tip, 2) . "<br>\n";
print "The total income from the party was: \$ " . number_format($party + $tip, 2) . "<br>\n";

?>

<br><b> Thank you and come again. </b>

</body>
</html>
