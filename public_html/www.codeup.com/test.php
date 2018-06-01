
<!--

 Dejane ignorisi ovo, koristim ovaj fajl kad hocu da testiram sta radi
neki funkcija PHPa


-->

<?php

define("DAYS", 10);
define("HOURS_IN_DAY", 24);
define("MINS_IN_HOUR", 60);

echo DAYS . ' days, or ' .
DAYS*HOURS_IN_DAY . ' hours, or ' .
 DAYS * HOURS_IN_DAY * MINS_IN_HOUR .' minutes';

 ?>
