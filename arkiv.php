<h2>Arkiv</h2>

Her kommer det etter hvert litt om NTNUI-Svømmings historie, referater fra gen.fors. osv.<br>
<?php

//setter riktig directory for filene og sjekker at det er gyldig
if ($handle = opendir('/home/others/groupdisk1/s/svommer/public_html/arkiv')) {


   //itererer igjennom filene i mappen
   while (false !== ($file = readdir($handle))) {

   	   //tester om fila i mappa er av typen *.pdf
       if (substr(strrchr($file, "."), 1) == 'pdf'){
           //lager HTMl linje med link med klikkbart link til hvert dokument
       	   print "<a href=arkiv/"; echo "$file\n"; print ">";
       	   print "$file\n"; print " </a><br>";
		}


   }

   closedir($handle);

}

?>

<br>
Her er en del eksempler på treningsprogrammer:<br>

<?php

//setter riktig directory for filene og sjekker at det er gyldig
if ($handle = opendir('/home/others/groupdisk1/s/svommer/public_html/program')) {


   //itererer igjennom filene i mappen
   while (false !== ($file = readdir($handle))) {

   	   //tester om fila i mappa er av typen *.doc
       if (substr(strrchr($file, "."), 1) == 'doc'){
           //lager HTMl linje med link med klikkbart link til hvert dokument
       	   print "<a href=program/"; echo "$file\n"; print ">";
       	   print "$file\n"; print " </a><br>";
		}


   }

   closedir($handle);

}

?>
Eldre treningsprogrammer kan du finne <a href="http://redacted-domain.com/svomming/program/gamle/">her</a>
