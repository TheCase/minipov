<html>
<head>
<title>minipov code display generator - repulsor.net</title>
</head>
<body>
<strong>minipov code display pixel code generator</strong>
&nbsp;
[<a href="/">text generator</a>]
<p />

<?php

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
<?php
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

<?php
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

</body>
</html>
