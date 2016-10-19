<?php
#
#Fortinet FortiGuard Lion Team
#18/10/2016
#
#That script is used to decrypt files encrypted with Awesome ransomware version 1
#available at https://github.com/bug7sec/Ransomware/blob/master/v1/shcransome.php
#

$encrypted_file = "<encrypted file path here>";


$leak    = file_get_contents($encrypted_file); 
$woh = "/<!--#LOCK#(.*?)-->/";
if (!preg_match($woh, $leak, $matches))
{
   print "Sorry, can't decrypt the file".PHP_EOL;
   return false;
}

if($matches[1]){
   $leak = $matches[1];
   for ($i=1; $i <3; $i++) {
      $leak = substr($leak,(strlen($leak)/2)) . substr($leak,0,(strlen($leak)/2));
      $leak = str_rot13(base64_decode($leak));
      $leak = substr($leak,(strlen($leak)/2)) . substr($leak,0,(strlen($leak)/2));
   }
   print "whooh";
   print $leak;
}
else 
{
   print "Sorry, prefix found but can't decrypt the file".PHP_EOL;
   return false;
}

return true;

?>
