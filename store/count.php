<?php 

include("connect.inc");	

$sbgdb=mysql_query("select * from sbgrb as a join sbj as b
on  a.sbgid = b.sbgid
where a.sblid=4");

$totalArray = array();
while($sbgrs=mysql_fetch_array($sbgdb)){	
							
		$id = $sbgrs['sbid'];	
		$result =  mysql_query("select count(*) as num from ".$id );

		if($result){
				$data = mysql_fetch_array($result);
				array_push($totalArray,$data['num']);		
		}

}

var_dump($totalArray);
$begin = 0;
foreach($totalArray as $num){
	$begin +=  (int) $num;
		
}
var_dump($begin);


?>