<?php
 echo uniqid();
 echo "<br>";
 echo uniqid('id');
 echo "<br>";
 echo uniqid('id',true);
 echo "<br>";
 echo md5(time() . mt_rand(1,5));
?>