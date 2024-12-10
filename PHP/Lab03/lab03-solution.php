<!DOCTYPE html>
<!--
  This is a solution to the CIS-1152 Lab #3.

  This solution is based on a version by Steve Ruegsegger, but it has been extensively edited by
  Peter Chapin.
  -->

<html lang="en-US">
<head>
    <title>CIS-1152, Lab #3: PHP Arrays</title>
    <style>
        table.tic, th.tic, td.tic {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100px;
        }

        table.bill, th.bill {
            border: 1px solid black;
            border-collapse: collapse;
        }
        td.bill {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: right;
        }
    </style>
</head>

<body>
<h1>Tic-Tac-Toe</h1>

<?php
$n = 3;
$board = [['x', 'o', 'x'],
    ['o', 'x', 'x'],
    ['o', 'o', 'x']];

print "Let's play Tic-Tac-Toe.<br><br>\n";

print "<table class='tic'>\n";
# rest of rows
for ($row = 0; $row < $n; $row++) {
    print "<tr>";
    for ($column = 0; $column < $n; $column++) {
        $token = $board[$row][$column];
        print "<td class='tic' style='text-align: center'>$token</td>";
    }
    print "</tr>\n";
}
print "</table>\n";
?>

<h1>Student Addresses</h1>

<?php
$names = [["steve", "smith", "123 main street", "smallville", "OH", "45444"],
    ["betty", "jones", "456 elm street", "bigville", "VT", "05445"],
    ["bob", "rapp", "789 maple street", "circleville", "ME", "02827"]];
?>

<p>The address I have are:</p>

<ol>
    <?php
    foreach ($names as $n) {
        print <<<EOT
        <li><b>$n[1], $n[0]</b>
          <ul>
            <li>$n[0] $n[1]</li>
            <li>$n[2]</li>
            <li>$n[3], $n[4] $n[5]</li>
          </ul></li>
        EOT;
    }
    ?>
</ol>

<h1>Restaurant Bill</h1>

<?php
$server = "steve";
$plates = [10.23, 9.99, 12.32];
$drinks = [2.50, 0.0, 1.50];
$tax_rate = 0.06; # 6% tax on the food
$tip = 5.00;      # tip from table

print "<p>Your server, " . $server . ", was happy to serve you.</p>\n";

print <<<EOT
    <table class="bill">
    <tr style="background-color: #EEEEEE">
        <th class="bill">Customer</th>
        <th class="bill">Plate</th>
        <th class="bill">Drink</th>
        <th class="bill">Bill</th>
        <th class="bill">Tax*</th>
        <th class="bill">Subtotal</th>
    </tr>
    EOT;

$party = 0.0;  # The total bill from the party
for ($i = 0; $i < count($plates); $i++) {
    $customer_number = $i + 1;
    $bill = $plates[$i] + $drinks[$i];
    $tax = $bill * $tax_rate;
    $subtotal = $bill + $tax;
    $party = $party + $subtotal;  # The total for the table.
    print "<tr>";
    print "<th class='bill'>$customer_number</th>";
    print "<td class='bill'>\$ " . number_format($plates[$i], 2) . "</td>";
    print "<td class='bill'>\$ " . number_format($drinks[$i], 2) . "</td>";
    print "<td class='bill'>\$ " . number_format($bill, 2) . "</td>";
    print "<td class='bill'>\$ " . number_format($tax, 2) . "</td>";
    print "<td class='bill'>\$ " . number_format($subtotal, 2) . "</td>";
    print "</tr>";
}
print "</table>\n";

$tax_percent = $tax_rate * 100;
print "<p><em>* A tax rate of $tax_percent% has been applied per customer </em></p>\n";

print "The total expense from the table is: \$" . number_format($party, 2) . "<br>\n";
print "The party tip was: \$ " . number_format($tip, 2) . "<br>\n";
print "The total income from the party was: \$" . number_format($party + $tip, 2) . "<br>\n";
?>

<p><b>Thank you and come again.</b></p>

</body>
</html>
