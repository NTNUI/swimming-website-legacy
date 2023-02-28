<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Refresh" content="600">
  <meta name="GENERATOR" content="Mozilla/4.78 [en] (WinNT; U) [Netscape]">
  <title>NTNUI - SVøMMEGRUPPA</title>

  <style type="text/css">
     body {
        background-color: #FFFFFF;
     }
     div.c4  {font-family: Verdana, Arial, Helvetica, sans-serif;
              font-size: 80%; text-align: center}
     td.c3   {font-family: Verdana, Arial, Helvetica, sans-serif;
              font-size: 80%}
     h1.c2   {font-family: Verdana, Arial, Helvetica, sans-serif;
              font-weight: bold}
     span.c1 {font-size: 120%}
  </style>   
</head>
<body>

<h1><img SRC="logo1.jpg" height=100 width=600></h1>

<h1 class="c2"><span class="c1">Styret i NTNUI Svømmegruppa</span></h1>

<?php

include("/home/groups/svommer/public_html/admin/dbsettings.php");

// En-dashes (&ndash;) are better than dashes (-) from a typesetting POV
print "<h5>Generated from most recently updated list at " .
      strftime("%Y&ndash;%m&ndash;%d %H:%M"). "</h5>\n\n<br>\n<br>\n\n";

$db = mysql_connect("REDACTED",
                     $db_user . "_query",
                     $db_pw_query) or
      die ("Unable to open database: " . mysql_error());
mysql_select_db($db_user . "_member", $db) or 
      die ("Unable to access database:" . mysql_error());

$result = mysql_query("SELECT B.position, P.firstname, P.lastname,
                              P.email, P.phonec, P.phoneh
                       FROM PERSON P, BOARDMEMBER B
                       WHERE P.id=B.id ORDER BY B.rank") or 
          die (mysql_error());

print "<table border=1>\n";
print "  <tr>\n";
print "    <td class=\"c3\"><b>Styreverv</b></td>\n";
print "    <td class=\"c3\"><b>Fornavn</b></td>\n";
print "    <td class=\"c3\"><b>Etternavn</b></td>\n";
print "    <td class=\"c3\"><b>E-post</b></td>\n";
print "    <td class=\"c3\" align=\"center\"><b>Telefon</b></td>\n";
print "  </tr>\n";


while ($boardlist = mysql_fetch_array($result)) {
    $boardlist[0] = ucfirst($boardlist[0]);

    if ($boardlist[0] != "Stsk") {
        print "  <tr>\n";

        print "    <td class=\"c3\">$boardlist[0]</td>\n";
        print "    <td class=\"c3\">$boardlist[1]</td>\n";
        print "    <td class=\"c3\">$boardlist[2]</td>\n";
        print "    <td class=\"c3\">$boardlist[3]</td>\n";

        if ($boardlist[4] != NULL) {
            print "    <td class=\"c3\" align=\"center\">$boardlist[4]</td>\n";
        } elseif ($boardlist[5] != NULL) {
            print "    <td class=\"c3\" align=\"center\">$boardlist[5]</td>\n";
        } else {
            print "    <td class=\"c3\" align=\"center\">&ndash;</td>\n";
        }

        print "  </tr>\n";
    }
}
print "</table>\n";
?>

</body>
</html>
