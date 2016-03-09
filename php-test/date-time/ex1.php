<?php
/*
+ timestamp - временная емтка
+ unix время

1 января 1970 00:00:00 UTC
*/
// '2015-02-12'

$time1 = time();
// date_default_timezone_set('Europe/Kiev');
// date_default_timezone_set('UTC');

echo Date("Y-m-d H:i:s", $time1);
// echo $time1;

// 1453479360
// 1453392936809
+(new Date())

// SELECT UNIX_TIMESTAMP();
// SELECT UNIX_TIMESTAMP('2015-02-02');
// SELECT FROM_UNIXTIME(1453479360);