<html>
<head>
<title>minipov code display generator - repulsor.net</title>
</head>
<body>
<strong>minipov code display pixel code generator</strong>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
[<a href="/">text generator</a>]
<br />
akula [at] repulsor [dot] net
<p />

<?

if (isset($_POST["smug"])) $smug = $_POST["smug"];
if (!isset($_POST["cols"])){
   $cols = 50;
}else{
   $cols = $_POST["cols"];
   if ($cols > 250){ $cols = 250; }
}

if (!isset($smug)){
?>

<form method=post>
columns (250 max): <input type="text" name="cols" value="<?=$cols?>" size="4">
<input type="submit" name="newcols" value="set">
<br />
<table cellpadding="0" cellspacing="0">
<?
for($bit=7;$bit>=0;$bit--){
   print "<tr>\n";
   for($line=0;$line<$cols;$line++){
      print "<td><input type=\"checkbox\" name=\"b[$line][$bit]\" value=\"1\"></td>\n";
   }
   print "</tr>\n";
}
$limit = $cols - 1;
print "<input type=\"hidden\" name=\"limit\" value=\"$limit\" />\n";

?>
</table>
<p />
<input type="submit" name="smug" value="generate">
</form>

<?
}else{
   print "use your back button to edit<br>";
   print "or you can <a href=\"\">clear</a> the whole thing<p />";

   $limit = $_POST["limit"];
   if (isset($_POST["b"])) $data = $_POST["b"];

   $output = "## start code below-----------------<br />\n";
   for($row=0;$row<=$limit;$row++){
       $output .= "B8(";
       for($col=0;$col<=7;$col++){
          if (isset($data[$row][$col])){
             $output .= "1";
          }else{
             $output .= "0";
          }
       }
       $output .= "),<br />\n";
   }
   $output = substr($output,0,-8);
   print $output;
}
?>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-2647861-1");
pageTracker._trackPageview();
</script>

<p />
&nbsp;
<p />
&nbsp;
<p />
&nbsp;
<p />
&nbsp;
<p />
&nbsp;
<p />
&nbsp;
<p />
<script type="text/javascript"><!--
google_ad_client = "pub-7045767875932893";
/* repulsor banner */
google_ad_slot = "8367645209";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>


</body>
</html>
