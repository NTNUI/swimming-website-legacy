<body>
<?php
function display_info($email, $row_person, $result_email_lists) {
?>
    <form action="<?php register();?>" method="post">
    <p> firstname: <input type="text" size=40 name="firstname" value="<?php print($row_person[2]);?>">
    <p> lastname: <input type="text" size=40 name="lastname" value="<?php print($row_person[3]);?>">
    <p> dateofbirth (format YYYY-MM-DD): <input type="text" size=10 name="dateofbirth" value="<?php print($row_person[4]);?>">
    <p> gender: <input type="text" size=1 name="sex" value="<?php print($row_person[5]);?>">
    <p> address: <input type="text" size=50 name="address" value="<?php print($row_person[6]);?>">
    <p> zipcode: <input type="text" size=4 name="zipcode" value="<?php print($row_person[7]);?>">
    <p> email: <input type="text" size=50 name="email" value="<?php print($row_person[8]);?>">
    <p> password: <input type="password" size=15 name="password1" value="<php print($password);?>">
    <p> retype password: <input type="password" size=15 name="password2" value="<php print($password);?>">
    <p> home phone: <input type="text" size=8 name="phoneh" value="<?php print($row_person[9]);?>">
    <p> cellular phone: <input type="text" size=8 name="phonec" value="<?php print($row_person[10]);?>">
    <p> office phone: <input type="text" size=8 name="phonew" value="<?php print($row_person[11]);?>">
    <p> language: <input type="text" size=15 name="language" value="<?php print($row_person[12]);?>"> <input type="submit" value="<?php register();?>">
    </form>
<?php
}

function register() {
        // Note: We need an explicit space between arguments to exec()
        //       because otherwise all the arguments are passed as one
        //       (no whitespace split in shell) which destroys argument 
        //       checking in the DB access methods.
        //
        //      --Bård Skaflestad, 2002-07-14
        exec("/home/groups/svommer/publci_html/admin/bin/exec_wrapper " .
             escapeshellarg($firstname)   . " " .
             escapeshellarg($lastname)    . " " .
             escapeshellarg($dateofbirth) . " " .
             escapeshellarg($address)     . " " .
             escapeshellarg($zipcode)     . " " .
             escapeshellarg($language)    . " " .
             escapeshellarg($phonec)      . " " .
             escapeshellarg($phoneh)      . " " .
             escapeshellarg($phonew)      . " " .
             escapeshellarg($email)       . " " .
             escapeshellarg($password)    . " " .
             escapeshellarg($login)       . " " .
             escapeshellarg($password));
}

include("/home/groups/svommer/public_html/admin/dbsettings.php");

$db = mysql_connect("REDACTED", 
                    $db_user . "_query",
                    $db_pw_query) or
      die("Unable to open database: " . mysql_error());
mysql_select_db($db_user . "_member", $db) or
      die("Unable to access database:" . mysql_error());

$query = "SELECT password, id, firstname, lastname, dateofbirth, 
                 sex, address, zipcode, email,
                 phoneh, phonec, phonew, language
          FROM PERSON WHERE email='$login'";

$result = mysql_query($query) or die("Person query failed");
$row_person = mysql_fetch_row($result);

if ($password == $row_person[0]) {
        $query = "select list from EMAIL where id=$row_person[1]";
        $result_email_lists = mysql_query($query) or
                              die ("Email query failed");
        display_info($login, $row_person, $result_email_lists);
}
else {
        print("Login name or password is incorrect. Please try again");
}

mysql_close($db);
?>
</body>
