<!DOCTYPE html PUBLIC "-//W3C//DTD html 4.01 Transitional//EN">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
   <meta http-equiv="Refresh" content="600">
   <meta name="GENERATOR" content="Mozilla/4.78 [en] (WinNT; U) [Netscape]">
   <title>NTNUI - SVøMMEGRUPPA</title>
</head>
<body BGCOLOR="#FFFFFF">

<h1>
<img SRC="logo1.jpg" height=100 width=600></h1>

<h1>
  <font face="Verdana, Arial, Helvetica, sans-serif">
    <font size=+1>Members of the NTNUI Swimming Group</font>
  </font>
</h1>

<h2>
<?php
    print "<H5>Generated from most recently updated list at " .
          strftime("%Y-%m-%d %H:%M"). "</H5>\n\n<BR>\n\n";

    include("/home/groups/svommer/public_html/admin/dbsettings.php");

    $db = mysql_connect("REDACTED",
                        $db_user .  "_query",
                        $db_pw_query) or
          die("Unable to open database: " . mysql_error());

    mysql_select_db($db_user . "_member", $db) or
          die ("Unable to access database: " . mysql_error());

    // bardsk: 2004-01-16
    // update: 2004-10-06
    //
    // Any single `id' may (and in many or indeed most cases does) occur
    // several times in the NSF table.  This has a nasty implication:
    //
    //     Creating a product table (as done with any kind of JOIN's,
    //     including the particular LEFT JOIN below) will pick up an id
    //     match for *every* occurrence in the NSF table, rather than
    //     just the latest (highest numerical NSF.year value).
    //
    // The correct solution to this problem is a subquery such as:
    //
    //     SELECT p.lastname,p.firstname,p.email FROM PERSON AS p WHERE
    //         p.dateofbirth IS NOT NULL AND
    //         p.zipcode     IS NOT NULL AND
    //         (p.id IN (SELECT n.id FROM NSF AS n WHERE
    //                          n.year=YEAR(NOW()))
    //          OR p.credit>=270)
    //     ORDER BY p.lastname,p.firstname
    //
    // which not only avoids generating the product table but also makes
    // the intention more explicit from a set theoretic point of view.
    // At least in this coder's opinion.  However, conditions beyond our
    // control excludes this option as subqueries are only supported in
    // MySQL server versions 4.1 and later, and, at the moment, server
    // version 4.0.17 (SELECT VERSION()) is installed at database host
    // REDACTED.
    //
    // The least incorrect solution is to simulate the above solution
    // with two queries:
    //
    //     - One to retrieve the subsets of id's satisfying
    //       NSF.year=YEAR(NOW()).
    //
    //     - One query to retrieve the proper information based on this
    //       subset and PERSON.credit.
    //
    // This solution is not really attractive because the id subset
    // retrieved from the first query must be programatically built into
    // a list suitable for SQL IN membership testing.  This processing
    // must take place in PHP which will substantially increase run time
    // and memory foot print on the server side.
    //
    // At the moment, the best solution to this problem (from a
    // cleanliness and processing perspective) is to create a temporary
    // table containing just id's and their respective latest NSF
    // licence years, eg.
    //
    //     CREATE TEMPOARY TABLE t
    //         SELECT id, max(year) AS year FROM NSF GROUP BY id
    //
    // and then perform the below SELECT as (eg.)
    //
    //     SELECT p.lastname,p.firstname,p.email FROM
    //     PERSON AS p LEFT JOIN t ON p.id=t.id WHERE
    //         p.dateofbirth IS NOT NULL AND
    //         p.zipcode     IS NOT NULL AND
    //         (t.year=YEAR(NOW()) OR p.credit>=270)
    //     ORDER BY p.lastname,p.firstname
    //
    // The temporary table `t' will be removed when closing the DB
    // connection at the end of PHP processing.
    //
    // The above solution, however, has some fairly grave security
    // consequences.  In particular having to grant CREATE privileges to
    // a DB user that should be limited to read-only access, so we
    // employ a less pure work-around: Using the SELECT DISTINCT
    // construct to remove duplicates.
    //
    // This decision can (and probably should) be revisited if the
    // problem (duplicate SELECT results) re-occurs.
    $result = mysql_query("SELECT DISTINCT p.lastname,p.firstname,p.email
                           FROM PERSON AS p LEFT JOIN NSF AS n
                           ON p.id=n.id WHERE
                           p.dateofbirth IS NOT NULL AND
                           p.zipcode     IS NOT NULL AND
                           (n.year=YEAR(NOW()) OR p.credit>=300)
                           ORDER BY lastname") or
               die (mysql_error());

    print "<TABLE BORDER=1>\n";
    print "<TR>\n";

    print "  <TH><FONT FACE=\"Verdana, Arial, Helvetica, " .
          "sans-serif\">Surname</FONT></TH>\n";
    print "  <TH><FONT FACE=\"Verdana, Arial, Helvetica, " .
          "sans-serif\">Given name</FONT></TH>\n";
    print "  <TH><FONT FACE=\"Verdana, Arial, Helvetica, " .
          "sans-serif\">Email</FONT></TH>\n";

    $row_count=0;
    while ($namelist = mysql_fetch_array($result)) {
        print "<TR>\n";
        print "  <TD><FONT FACE=\"Verdana, Arial, Helvetica, " .
              "sans-serif\" SIZE=-1>$namelist[0]</FONT></TD>\n";
        print "  <TD><FONT FACE=\"Verdana, Arial, Helvetica, " .
              "sans-serif\" SIZE=-1>$namelist[1]</FONT></TD>\n";
        if ($namelist[2] != NULL) {
            print "  <TD><FONT FACE=\"Verdana, Arial, Helvetica, " .
                  "sans-serif\" SIZE=-1>$namelist[2]</FONT></TD>\n";
        } else {
            print "  <TD><FONT FACE=\"Verdana, Arial, Helvetica, " .
                  "sans-serif\" SIZE=-1>&nbsp;</FONT></TD>\n";
        }
        print "</TR>\n";
        $row_count++;
    }
    print("</TABLE>\n");
    print("<p>Members: $row_count</p>\n");

    // Cleanup is automatic at PHP shutdown so we don't bother calling
    // mysql_free_result() or mysql_close() here.  Even if purity
    // reasons clearly say we should.
    //
    // So sue me ;-)
?>
</body>
</html>
