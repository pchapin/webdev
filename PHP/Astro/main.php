<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title>Astronomical Calculations</title>
  <style>
      .grid-container {
          display: grid;
          grid-template-columns: 0.75in 1.75in 0.75in 1.75in;
          gap: 5px;
      }
  </style>
</head>

<body>
<h1>Astronomical Calculations</h1>

<p>This page demonstrates some (hopefully) interesting computations.</p>

<!-- Create the form. -->
<?php

# This is for debugging.
print "<pre>";
print "\$_POST = ";
var_dump($_POST);
print "</pre>";

# Deal with special, first time steps.
if (!isset($_POST['submit'])) {
    # This is the first time the page has been viewed.
    $do_calculations = False;
}
else {
    $do_calculations = True;
}

# $do_calculations = !isset($_POST['submit']) ? False : True;

# Get the state from the form (if posted) or use default values for the first time.
$longitude = floatval($_POST['longitude']) ?? 0.0;
$latitude = floatval($_POST['latitude']) ?? 0.0;
$date = $_POST['date'] ?? '2020-01-01';
$time = $_POST['time'] ?? '00:00:00';
$sun = $_POST['option_sun'] ?? "";
$moon = $_POST['option_moon'] ?? "";
$internal_value = floatval($_POST['internal']) ?? 3.14159;  # A hidden value passed through the form.

# Update the hidden state. This is a silly, meaningless computation just to demonstrate.
$internal_value += ($longitude + $latitude) / 2.0;

print <<< EOT
<form method="post">
<div class="grid-container">
  <div class="grid-column: 1/2"><b>Location</b></div>
  <div style="grid-column: 1/2">Longitude:</div>
  <div style="grid-column: 2/3"><input type="text" name="longitude" value="$longitude"/></div>
  <div style="grid-column: 3/4">Latitude:</div>
  <div style="grid-column: 4/5"><input type="text" name="latitude" value="$latitude"/></div>
  
  <div class="grid-column: 1/2"><b>Date/Time</b></div>
  <div style="grid-column: 1/2">Date:</div>
  <div style="grid-column: 2/3"><input type="text" name="date" value="$date"/></div>
  <div style="grid-column: 3/4">Time:</div>
  <div style="grid-column: 4/5"><input type="text" name="time" value="$time"/></div>
</div>
Sun: <input type="checkbox" name="option_sun" value="checked" $sun/>
Moon: <input type="checkbox" name="option_moon" value="checked" $moon/><br/>
<input type="hidden" name="internal" value="$internal_value">
<input type="submit" name="submit" value="Submit"/>
</form>
EOT;

print "<br/>";

# Display output of this iteration based on form variables and updated internal state.
if (!$do_calculations) {
    print "Enter values above to compute results!<br/>";
}
else {
    if ($sun == "checked") {
        print "Doing calculations. Visualize sun altitude and azimuth!<br/>";

    }
    if ($moon == "checked") {
        print "Doing calculations. Visualize moon altitude and azimuth!<br/>";
    }
}
print "The internal state = $internal_value<br/>";

?>

</body>
</html>
