<table border="0" width="580">
<tr><td width="300">
<h3>minipov font-based code generator</h3>
</td><td valign="top">
[<a href="/pixels.php">pixel&nbsp;generator<a/>]
</td></tr>
<tr><td><font size="2" face="arial">
if this tool is of value to you, please consider a donation to my beer fund (donate button) &mdash;&gt;
</font>
</td><td valign="middle" align="center">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="XBJRLULW6UKGU">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form></td></tr>
<tr><td valign="top" colspan="2">


<form method="post">
<?
$mode_arr = array("minipov"=>"B8(X),","blinky"=>"RETLW   B'X'");
if (!isset($_POST["mode_set"])){ 
   $mode_set = "minipov"; 
}else{
   $mode_set = $_POST["mode_set"];
}
$modeout = "mode: \n";
foreach($mode_arr as $mode_draw=>$mode_format){
   $modeout .= "<input type=\"radio\" name=\"mode_set\" ";
   $modeout .= "value=\"$mode_draw\" ";
   if ($mode_set == $mode_draw){ $modeout .= "checked "; }
   $modeout .= "/> $mode_draw&nbsp; &nbsp;\n";
}
print $modeout."<p />\n";

?>
enter text to generate:<br />
<input type="text" name="text" value="<? 
if (isset($_POST["text"])){ print $_POST["text"]; } 
?>" size="30" maxlength="30" />
<select name="font">
<?

   if (isset($_POST["font"])){
      $font = $_POST["font"];
   }else{
      $font = "";
   }

   $items = scandir("/fonts");
   foreach($items as $item) if (substr($item,-3) == "ttf") $fonts[] = $item;

foreach($fonts as $item){
   print "<option value=\"$item\"";
   if ($font == $item){ print " selected"; }
   print ">$item</option>\n";
}
?>
</select>
<input type="submit" value="generate">
<p />
<?

if (isset($_POST["text"])){

   $text = $_POST["text"];

   $size = "8"; #8 pixels
   $x = 0;
   $y = $size;
   $angle = 0;
   
   $fontfile = "/fonts/$font";

   $bbox = imageftbbox($size, $angle, $fontfile, $text);
   $width = $bbox[2];

   $image = imagecreatetruecolor($width+1, $y);
   $black = imagecolorallocate($image, 0, 0, 0);
   $white = imagecolorallocate($image, 255, 255, 255);

   imagefttext($image, $size, $angle, $x, $y, $white, $fontfile, $text);

   $output = "";
   $raw = "";
#   print "format: ".$mode_arr[$mode_set]."<br>";
   for ($px=0;$px<=$width;$px++){
      $row = "";
      for ($py=($size - 1);$py >= 0;$py--){
         $shade = imagecolorat($image,$px,$py);
         if ($shade > pow(14,6)){ $row .= "1"; }else{ $row .= "0"; }
      }
      $output .= preg_replace("/X/",$row,$mode_arr[$mode_set])."\n";
      $raw .= "$row,\n";
   }
   if ($mode_set == "minipov"){ $output = substr($output,0,-2); }
   $raw = substr($raw,0,-2);
?>
preview: <br />
<img src="image.php?data=<?=$raw?>" border="0" />
<p />
code (click, Select All, Copy):
<br />
<form>
<textarea rows="30" cols="20" wrap="virtual" scrollbars="yes"><?=$output?></textarea>
</form>

<? /*
<pre><span id="copytext" style="font-family:courier new,monospace;white-space:pre;font-size:12px;"><?=$output?></span></pre>
 */ ?>

<?

imagedestroy($image);

}

?>
</td></tr>
</table>
