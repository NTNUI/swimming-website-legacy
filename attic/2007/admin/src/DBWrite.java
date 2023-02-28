import java.sql.*;
import java.io.*;
import java.util.Date;	// For debugging purposes, Bård Skaflestad 2002-07-16
import java.text.*;	// Ditto...

class DBWrite{

    Connection con;
    Statement stmt;
    ResultSet rs;
    String username;
    String password;

    public DBWrite(String query) {
	readDBInfo();
	try {
	    Class.forName("org.gjt.mm.mysql.Driver").newInstance();
	    con = DriverManager.getConnection("jdbc:" + 
					      "mysql://redacted-domain.com/" +
					      username + "_member",
					      username + "_update",
					      password);
	    stmt = con.createStatement();
	    stmt.executeQuery(query);
	}
	catch (Exception e) {
	    System.err.println("Unable to connect to database.");
	    e.printStackTrace();
	}
    }

    private void readDBInfo() {
	File dbInfo = new File("/home/groups/svommer/" +
                               "public_html/admin/db_info");
	try {
	    FileReader in = new FileReader(dbInfo);
	    BufferedReader reader = new BufferedReader(in);
	    username = reader.readLine();
	    password = reader.readLine();
	    in.close();
	}
	catch (Exception e) {
	    System.err.println("Unable to read file");
	    e.printStackTrace();
	}
    }

    public static void main (String[] args) {
	DBWrite dbw;
	if (args.length == 2) {
	    String query = "insert into PERSON (email,password) " +
			   "values ('" +
				    args[0] + "','" +
				    args[1] + 
			   "')";
	    dbw = new DBWrite(query);
	}
	else if (args.length == 3) {
	    String query = "insert into PERSON (email,password,registered) " +
			   "values ('" +
				    args[0] + "','" +
				    args[1] + "','" +
				    args[2] + 
			   ")";
	    dbw = new DBWrite(query);
	}
	else if (args.length == 13) {
	    String query = "update PERSON set " +
			   "firstname='"    + args[2]  + "', " +
			   "lastname='"     + args[3]  + "', " +
			   "dateofbirth='"  + args[4]  + "', " +
			   "address='"      + args[5]  + "', " +
			   "zipcode="       + args[6]  + "', " +
			   "language='"     + args[7]  + "', " +
			   "phonec="        + args[8]  + ", "  +
			   "phoneh="        + args[9]  + ", "  +
			   "phonew="        + args[10] + ", "  +
			   "email='"        + args[11] + "', " +
			   "password='"     + args[12] + "' "  +
			   "where email='"  + args[0]  + "' "  +
			   "and password='" + args[1]  + "'";
	    // System.out.println(query);
	    dbw = new DBWrite(query);
	}
//	else {
	    // Debug output.  To be removed when application works...
	    //	--Bård Skaflestad, 2002-07-16
	    try {
		File logFile = new File("/home/groups/svommer" +
                                        "public_html/DBWrite.log");
		FileWriter DBWriteLog = new FileWriter(logFile);
		BufferedWriter log = new BufferedWriter(DBWriteLog);

		DateFormat longTimeStamp = 
		    DateFormat.getDateTimeInstance(DateFormat.FULL, DateFormat.FULL);
		log.write(longTimeStamp.format(new Date()) + " - " + args.length + " - ");

		for (int i = 0; i < args.length - 1; i++) {
		    log.write(args[i] + ", ");
		}
		log.write(args[args.length - 1]);
		log.newLine();
		log.close();
	    }
	    catch (Exception e) {
		System.err.println("Exceptional situation: " + e.getMessage());
	    }
//	}
    }
}
