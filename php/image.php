<?php
/* test code
$array = array(
   "00000011",
   "00000011",
   "00000011",
   "11111111",
   "11111111",
   "00000011",
   "00000011",
   "00000011",
   "00000000",
   "00000011",
   "00000011",
   "00000011",
   "11111111",
   "11111111",
   "00000011",
   "00000011",
   "00000011",
   "00000000"
);
 */

$string = $_GET["data"];
$array = explode(",",$string);
#print_r($array);

$init = "2";
$mult = "4";

$img_l = sizeof($array) * $mult + 2;
$img_h = 8 * $mult + 3;
$image = imagecreatetruecolor($img_l,$img_h);
$black = imagecolorallocate($image,240,230,200);
$red = imagecolorallocate($image,255,0,0);

$x1 = $init; $x2 = $mult;
foreach($array as $input){
#   preg_match("/^B8\((\\d+)\)/",$input,$match);
#   $input = $match[1];

   $y1 = $init; $y2 = $mult;
   $input = strrev($input);
   for ($i=0;$i<8;$i++){
      if (substr($input,$i,1) == 1){
         imagefilledrectangle($image, $x1, $y1, $x2, $y2, $red);
#         print "$x1 $y1 $x2 $y2<br>";
      }
      $y1 = $y1 + $mult;
      $y2 = $y2 + $mult;
   }
   $x1 = $x1 + $mult;
   $x2 = $x2 + $mult;
}


header('Content-Type: image/jpeg');
imagejpeg ($image, null, 100);
imagedestroy ($image);

?>
