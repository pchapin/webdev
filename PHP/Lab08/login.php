<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>App Login</title>
  <style>
      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
      }
  </style>
</head>
<body>
<?php session_start(); ?>

<form method="POST">

    <?php

    # mysql options
    $dbid = "awd";
    $dbpw = "awd456";
    $db = "advwebdev";


    #ini_set('display_errors', 1);
    #ini_set('display_startup_errors', 1);
    #error_reporting(E_ALL);

    if (isset($_POST['logoff'])) {
        session_destroy();
        $_SESSION = array();
    }
    # proper, valid role in SESSION
    #  there is only place to get this SESSION role
    $role = $_SESSION['role'] ?? "";
    $priority = $_SESSION['priority'] ?? "";

    # =================================================
    #  step 1 - get role
    # =================================================
    if (empty($role)) {
        print("<h1>App Login</h1>");

        # ----------------------------
        #  step 1a (no role & no submit)  show the login form
        # ----------------------------
        if (empty($_POST['submit'])) {
            print("
    <p style='color:blue'> Hello.  I see that you have <u>not</u> logged in
    yet.  Please do so now.</p>
  <br><br>
<b>Username</b>: <input type='input' name=userid> <em>admin, sales or report</em><br><br>
<b>Password</b>: <input type=password name=pw> <em>same pw as id</em> <br><br>
 <input type=submit name=submit value='Login'>
");

        }
        # ----------------------------
        #  step 1b (no role & submit)  authenticate
        # ----------------------------
        else {

            $id = $_POST['userid'] ?? "";
            $pw = $_POST['pw'] ?? "";       # plaintext pw

            # check
            if (empty($id) or empty($pw)) {
                print "<p style='color:red'> Error: Not all vars are filled in.</p><br>";
                endHTML();
                exit;
            }

            $db = new mysqli('localhost', $dbid, $dbpw, $db);
            if (mysqli_connect_errno()) {
                echo "<p style='color:red'>Error: Could not connect to database.<br/>
                  Please try again later.</p>";
                endHTML();
                exit;
            }

            $query = "select b.userid, b.salthashpw, c.rolename, c.priority
                  from permission_fact a
                  inner join users b on a.userid=b.userid
                  inner join roles c on a.roleid=c.roleid
                  where b.userid = ?";
            print "<p>Query = $query </p><br>\n"; # debug

            $stmt = $db->prepare($query);
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = $result->num_rows;
            if ($rows != 1) {
                echo "<p style='color:red'>Ack!  Something is wrong.</p>
      Please contact the web administrator<br><br>
      <input type=submit name=continue value='Continue'>
      </form></body></html>";
                exit;
            }
            # if you get here, 1 user was returned...
            $row = $result->fetch_assoc();
            $salthash = $row['salthashpw'];
            $role = $row['rolename'];
            $priority = $row['priority'];
            $stmt->free_result();
            $db->close();


            # ----------------------------------------
            if (password_verify($pw, $salthash)) {
                echo "<em>User <b>$id</b> authenticated</em><br>
And the allowed role is: <b>$role</b><br><br>\n\n
<input type=submit name=continue value='Continue'>
          ";

                # this is the ONLY place to get these SESSION values!
                $_SESSION['user'] = $id;
                $_SESSION['role'] = $role;
                $_SESSION['priority'] = $priority;

                print("<pre> SESSION: ");
                print_r($_SESSION);
                print("</pre>");
            }
            else {
                print "<p style='color:red'>Error: Wrong pw.</p><br>
<input type=submit name=continue value='Continue'>
</form></body></html>\n";
                exit;
            }

        } # end 1b


    } #end step 1

# =================================================
#  step 2 - I have a role.  Show the bake sale menu
# =================================================
    else {

        print("<h1>My App Main Menu</h1>
<p style='color:blue'>You have the proper role=$role!</p>

<p>Select your desired action.</p><br>
<table cellpadding=10>
  <tr><td> &nbsp; <input type=button value='Admin stuff'
                        onClick=\"location.href='login.php?action=admin';\"> &nbsp; </td>
      <td>Must be admin authority</td></tr>
  <tr><td> &nbsp; <input type=button value='Sell stuff'
                        onClick=\"location.href='login.php?action=sales';\"> &nbsp; </td>
      <td>Must be on the sales team</td></tr>
  <tr><td> &nbsp; <input type=button value='View Reports'
                        onClick=\"location.href='login.php?action=report';\"> &nbsp; </td>
      <td>Must be a registered user</td></tr>
</table>
");

        # ----------------------------------------------
        # if there is an action -- verify that we can continue
        # ----------------------------------------------
        $action = $_REQUEST['action'] ?? null;

        if (empty($action)) {
            # they need to select an action
            print("<p style='color:red'>Error.  Please select an appropriate action above.</p>");
            print("action=$action;  role=$role;  priority=$priority<br><br>\n\n");

        }
        else {
            # action selected -- validate
            $error = True;
            if ($action == 'admin' && $priority == 3) {
                print("<p>Congrats!  You can do Admin things!</p>");
                $error = False;
            }
            if ($action == 'sales' && $priority >= 2) {
                print("<p>Congrats!  You can do Sales things!</p>");
                $error = False;
            }
            if ($action == 'report' && $priority >= 1) {
                print("<p>Congrats!  You can Report things!</p>");
                $error = False;
            }

            if ($error) {
                print("<p style='color:red'>Error.  You do not have permissions to go here!</p>");
                print("action=$action;  role=$role;  priority=$priority<br><br>\n\n");
            }
        }

    }


    if (True) {
        print "<pre> REQUEST ";
        print_r($_REQUEST);
        print "SESSION ";
        print_r($_SESSION);
        print "</pre>";
    }

    ?>
  <br><br> <input type=submit name=logoff value='Logoff'>

</form>
</body>
</html>
