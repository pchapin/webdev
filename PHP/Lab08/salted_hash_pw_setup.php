<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>Salted Hash PW setup</title>
</head>
<body>
<h1>Salted Hash PW setup</h1>

<form method="POST">

  <p style="color:blue"> This PHP script generates 60-char salted hash passwords using the PHP
    password_hash() function!<br> It could stop there. It could <u>only</u> display the 60-char
    salted hash from the plaintext password.<br> But, I've gone further and actually also do the
    UPDATE into the database.</p>

    <?php

    # mysql options
    $dbid = "awd";
    $dbpw = "awd456";
    $db = "advwebdev";

    # mysql -u root -p  <root password>
    # create user 'awd'@'localhost' identified by 'awd456';
    # select host,user from mysql.user;
    # create database 'advwebdev'
    # grant all privileges on advwebdev.* to 'awd'@'localhost';


    # -----------------------------------------------
    #  state 1- enter information
    # -----------------------------------------------
    if (empty($_POST['submit'])) {
        print("
<p>User</b>: <input type=text  name=userid> (if this script is submitting SQL also)</p>
<p>Plain Text Password</b>: <input type=password name=pw> </p>
<p><input type=submit name=submit value=Submit></p>
");

    }


# -----------------------------------------------
#  state 2- display the 60-char salted pw string
# -----------------------------------------------
#  this PHP script  may or may not do the actual insert also
    else {
        # get user inputs
        $userid = $_POST['userid'] ?? "";
        $pw = $_POST['pw'] ?? "";

        # generate the 60-char salted hash string
        $pwhash = password_hash($pw, PASSWORD_DEFAULT);  # salted pw 60-char hash
        $l = strlen($pwhash);                           # length

        # print the results to this user
        print("============================================<br>\n");
        print("<b>1. Here is the salted pw hash to enter into mysql:</b><br>\n");
        print("<p>userid=$userid<br> pw = $pw<br> pwhash=$pwhash <br> length=($l) chars</p><br>\n\n");

        # -------------------------------------------------------------
        # print the SQL command to the user
        print("============================================<br>\n");
        print("<b>2. Here is the SQL to do the UPDATE:</b><br>\n");

        $query = "update users set salthashpw = ? where userid = ?";
        print("<pre>sql query 1 = \n$query</pre>");

        # -------------------------------------------------------------
        # now, do the update
        $db = new mysqli('localhost', $dbid, $dbpw, $db);
        $stmt = $db->prepare($query);
        $stmt->bind_param("ss", $pwhash, $userid);  # protect against SQL Injection
        $stmt->execute();
        $ar = $stmt->affected_rows;                 # did it work?
        if ($ar <= 0) {
            print("<p>ERROR, Query 1 did <u>not</u> go well.  affected_rows=$ar.<br>");
            print("statement error: " . $stmt->error . "</p>\n");
        }
        else {
            print("<p>Success.  Query 1 seemed to UPDATE just fine.</p><br><br>");
        }
        $stmt->close();
        # don't close yet


        # -------------------------------------------------------------
        # verify
        print("============================================<br>\n");
        print("<b>3. verify</b><br>\n");

        $query = "select * from users where userid = ?";
        print("<pre>sql query 2 = \n$query</pre><br>");
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $userid);  # input bind
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_row();    // should only be 1 row
        print("<p>Verify: " . implode(":", $row) . "</p><br>\n");
        $stmt->close();
        $db->close();

    }


    if (True) {
        print "<pre> POST ";
        print_r($_POST);
        print "</pre>";
    }

    ?>

</form>
</body>
</html>
