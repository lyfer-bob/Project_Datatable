<?php


/*
The Julian (*JUL) date format is CYYDDD, where:

C is added to 19 to create the century, i.e. 0 + 19 = 19, 1 + 19 = 20. YY is the year within the century,
 DDD is the day in the year.
*/

// $Julian = '098185';
// $c = substr($Julian,0,1)+19;
// $YY = substr($Julian,1,2);
// $DDD = substr($Julian,3,3);

// //$c = int($c[0])+19;
// echo $c.$YY ;
// $day = "2020-01-26 23:02:01";
// $strdate = preg_split('/-|:|\s+/', $day);
// $c = substr($strdate[0],0,2)-19;
// $YY = substr($strdate[0],2,2);
// $DDD = date('z', mktime(0, 0, 0, $strdate[1], $strdate[2], $strdate[0]))+1;
// echo $c.$YY.sprintf("%'.03d\n",$DDD);

$input_line='2020-01-28 12:37:32';
$splitdate = preg_split('/\s|:|-/', $input_line);
echo $splitdate[3].$splitdate[4].$splitdate[5];
// $todayid = '185';  // to get today's day of year
 
// function dayofyear2date( $tDay, $tFormat = 'd-m' ) {
//     $day = intval( $tDay );
//     $day = ( $day == 0 ) ? $day : $day - 1;
//     $offset = intval( intval( $tDay ) * 86400 );
//     $str = date( $tFormat, strtotime( 'Jan 1, ' . date( 'Y' ) ) + $offset );
//     return( $str );
// }
 
// echo dayofyear2date($todayid);
?>