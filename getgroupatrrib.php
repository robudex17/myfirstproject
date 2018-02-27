<?php

//require_once 'db.php';

$group = $_GET['group'];
$time_range= $_GET['selectavail'];
$bit =  $_GET['bit'];

if(isset($group) && isset($time_range) && isset($bit)){
	updateGroupTimeRange($group,$time_range,$bit);
	//getGroupTimeRange($group);
   
}else {
	getGroupTimeRange($group);
}	



function updateGroupTimeRange() {
	include 'db.php';
	global $group, $time_range, $bit;
	$sql = "SELECT * FROM `time_range`  WHERE `time_range`='$time_range' ";
	$resultsql = $conn->query($sql);
   while($row = $resultsql->fetch_assoc()){
   	$sqlupdate = "UPDATE `extension_group` SET tme$row[id]='$bit' WHERE `group`='$group'";
      $resultupdate = $conn->query($sqlupdate);
    }
    echo "Success";
}

 function getGroupTimeRange($group){

    include 'db.php';

	$sqlselecttmerange ="SELECT * FROM `time_range`";
	$resulttmerange = $conn->query($sqlselecttmerange);
	$a=0;
	$b=0;

	while($rowtmerange = $resulttmerange->fetch_assoc() )
	{
		$sqlselectgroup ="SELECT * FROM `extension_group` WHERE `group`='$group'";
		$resultgroup = $conn->query($sqlselectgroup);
		
		
		while ($row_group = $resultgroup->fetch_assoc()) 
		{
			
			$x = tme."$rowtmerange[id]";
			if($row_group[$x]!=1) {
				//$notincluded .= "<option value='{$rowtmerange[time_range]}'>{$rowtmerange[time_range]}</option>";
				$notincluded .= $rowtmerange[time_range] . "|";
				$a++;
			}else {
				//$included .= "<option value='{$rowtmerange[time_range]}'>{$rowtmerange[time_range]}</option>";
				$included .= $rowtmerange[time_range] . "|";
				$b++;
			}
		}	
	}
	 $included = substr_replace($included, "", -1); // get the last '|'	
	 $notincluded = substr_replace($notincluded, "", -1); // get the last '|'	
	 
     $combine = $a."@".$notincluded."&".$b."@".$included;
	 
echo $combine;
}




?>

