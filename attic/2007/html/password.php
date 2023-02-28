<?php
function connect_mysql() {
    include("/home/groups/svommer/public_html/admin/dbsettings.php");
    $db = mysql_connect("REDACTED",
                        $db_user . "_query",
                        $db_pw_query) or die ("Unable to open database.");
    mysql_select_db($db_user . "_member", $db) or
    die ("Unable to access database.");
}

// seed random value with microseconds
function make_seed() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}

// create a random password consisting of 8 digits, each in the range [0,9]
function create_password($email) {
    // Note: We need an explicit space between arguments to exec()
    //       because otherwise all the arguments are passed as one
    //       (no whitespace split in shell) which destroys argument
    //       checking in the DB access methods.
    //
    //      --Bård Skaflestad, 2002-07-14
    mt_srand(make_seed());
    $password = "";
    for ($i = 0; $i <= 7; $i++) {
        // No need to evaluate  $password  twice when string
        // append operator (.=) is available...
        // $password = $password . strval(mt_rand(0, 9));
        $password .= strval(mt_rand(0, 9));
    }
    $result = mysql_query("SELECT id FROM PERSON WHERE email='$email'")
              or die (mysql_error());
    if (mysql_num_rows($result) == 0) {
        // Registrer not in DB. Pass registration date to backend.
        // Note: date(format) returns a string representing current date
        //       and time (using localtime(), not gmtime()).
        //       See online doc at http://www.php.net/
        //      --Bård Skaflestad, 2002-07-17
        print("<pre>\n");
        system("/home/groups/svommer/public_html/admin/bin/exec_wrapper " .
               escapeshellarg($email)    . " " .
               escapeshellarg($password) . " " .
               escapeshellarg(date("Y-m-d")) . " 2>&1", $ret);
        print("</pre>\n");
        //print("<br>\$ret = $ret\n");
    }
    else {
        // Registrer already in DB. May have forgotten pw...
        print("<pre>");
        system("/home/groups/svommer/public_html/admin/bin/exec_wrapper " .
               escapeshellarg($email) . " " .
               escapeshellarg($password) . " 2>&1", $ret);
        print("</pre>\n");
        //print("<br>\$ret = $ret\n");
    }

    // Check wether or not we were able to create a new password (ie.
    // update the DB).
    if ($ret == 0) {
        // Yes.  $ret == 0 equals success in shell...
        return -1;
    }
    else {
        // No.
        return -1;
    }
}

// send mail to the person requesting the password
function send_mail($email, $password) {
    $subject = "Password for $email";
    $txt = "Your new password for the site "              .
           "http://redacted-domain.com/studorg/svommer/\n\n" .
           "\temail:    $email\n"                         .
           "\tpassword: $password";
    $mailstatus = mail($email, $subject, $txt,
                       "From: REDACTED\n" .
                       "Content-Type: text/plain; charset=iso-8859-1\n" .
                       "Content-Transfer-Encoding: 8bit");
    if ($mailstatus) {
        echo "Password sent to $email.<br>\n" .
             "You may now login using your email address and password.";
    }
    else {
        echo "Error, no password sent";
    }
}

if ($email != "") {
    connect_mysql();
    make_seed();

    $password = create_password($email);
    if ($password > 0) {
        send_mail($email, $password);
    }
    else {
        echo "<br>Unable to create password\n";
    }
}
else {
    echo "email address invalid";
}
?>
