<?php

require_once 'db.php';

$myfile = fopen("sample.txt", "w") or die("Unable to open file!");
$serversettings = "exten => _290948[05],1,Set$(PH_IAX=IAX2/sbphilippines:sbtrading@103.5.6.2)\n";
$Setattributes = "exten => _290948[05],n,Set";
fwrite ($myfile , $serversettings );
	
	//Delete all callgroups
	$sqldelete = "DELETE FROM `call_group`";
	$result_delete = $conn->query($sqldelete);
	
	$sql_extension_group = "Select * From extension_group Where Status='active'";
	$result_extension_group = $conn->query($sql_extension_group);
	if  ($result_extension_group->num_rows > 0){
	   while ($row = $result_extension_group->fetch_assoc()) {
			 $sql_extension = "Select extension From extensions WHERE group_id=$row[id]";
			 $result_extension = $conn->query($sql_extension);
			 if ($result_extension->num_rows > 0){
				$phiax = "\${PH_IAX}/";
				$iaxstring = array();
				while ($row1 = $result_extension->fetch_assoc()) {
					$iaxstring[] = $phiax.$row1[extension]. "&";
				}
				$iaxstring = implode("" ,$iaxstring);  // array into string
				$iaxstring = substr_replace($iaxstring, "", -1); // get the last '&'
				
				fwrite ($myfile , $Setattributes ."(" . $row['group']."=" . $iaxstring . ")\n" ); // write to a file
			}
			
		}
		
	}else
		echo "No Group active";


// Gotoiftme start here..

fwrite ($myfile , "\n\n" ); // write to a file

$Gotoiftme = "exten => _290948[05],n,GotoIftme";	

$gotoiftmesql = "Select * from time_range";
$resultgotoiftme = $conn->query($gotoiftmesql);
if ($resultgotoiftme->num_rows > 0) {
	while ($gotoiftme_row = $resultgotoiftme->fetch_assoc()) {
		$id=$gotoiftme_row[id];
		
	   $groupsql = "Select `group` From extension_group Where tme$id=1 AND `Status`='active'";
	   $resultgroup = $conn->query($groupsql);
	  
	   if($resultgroup->num_rows > 0) {
		   
			$gotoifstring = array();
			while($resultgroup_rows = $resultgroup->fetch_assoc()){
				
				$gotoifstring[] = $resultgroup_rows[group];					
			}
			$gotoifstring = implode("",$gotoifstring);
			fwrite ($myfile , $Gotoiftme ."(" . $gotoiftme_row[time_range] ."?" . $gotoifstring .")\n" ); // write to a file
		}
	
	}
}else {
	echo "No active tme range";
	
}
fwrite ($myfile , "\n\n" ); // write to a file
//PHQUEUE Dial Group start Here

$ibddial = "exten => _290948[05],n,Goto(IBD-DIAL)";
$tmesql = "Select * from time_range";
$resultgotoiftme = $conn->query($tmesql);
if ($resultgotoiftme->num_rows > 0) {
	while ($gotoiftme_row = $resultgotoiftme->fetch_assoc()) {
		$id=$gotoiftme_row[id];
		
	   $groupsql = "Select `group` From extension_group Where tme$id=1 AND `Status`='active'";
	   $resultgroup = $conn->query($groupsql);
	  
	   if($resultgroup->num_rows > 0) {
		   
			$gotoifstring = array();
			while($resultgroup_rows = $resultgroup->fetch_assoc()){
				$gotoifstring[] = $resultgroup_rows[group];
			}
			
			$gotoifstring = implode("",$gotoifstring);
			
			// AND EXTRA CONDITION HERE TO AVOID DUPLICATE in creating callgroup
		  
			$sqlcheckexistcallgroup = "SELECT * FROM `call_group` WHERE cgroup='$gotoifstring'";
			$resultcallgroup = $conn->query($sqlcheckexistcallgroup);
			
		
			if ($resultcallgroup->num_rows==0){
				$sqladdcallgroup = "INSERT INTO `call_group` (`cgroup`) VALUES ('$gotoifstring')";
				$resultaddcallgroup = $conn->query($sqladdcallgroup);
				
				fwrite ($myfile , "exten => _290948[05],n(".$gotoifstring .")Set(PHQUEUE="); // write to a file
			
				$gotoifstring = str_split($gotoifstring);
				$x=0;
				$string = array();
				$total = count($gotoifstring);
				while ($x<$total){
					$string[] = "\$"."{". $gotoifstring[$x] ."}" . "&";
					$x++;
					
				}
				$string = implode("", $string);
				$string = substr_replace($string, "", -1);
				
				fwrite ($myfile ,$string . ")\n" ); // write to a file
				fwrite ($myfile ,$ibddial . "\n\n" ); // write to a file
			}	
		}

	}
}else {
	echo "No active tme range";
	
}
fclose($myfile);


//for USER INTERFACE

$sqlselectexten = "SELECT extension FROM `extensions`";


	$sqlselecttmerange ="SELECT * FROM `time_range`";
	$resulttmerange = $conn->query($sqlselecttmerange);
	$a=0;
	$b=0;
	$group =$_GET['group'];
	while($rowtmerange = $resulttmerange->fetch_assoc() )
	{
		$sqlselectgroup ="SELECT * FROM `extension_group` WHERE `group`='$group'";
		$resultgroup = $conn->query($sqlselectgroup);
		
		
		while ($row_group = $resultgroup->fetch_assoc()) 
		{
			
			$x = tme."$rowtmerange[id]";
			if($row_group[$x]!=1) {
				$notincluded .= "<option value='{$rowtmerange[time_range]}'>{$rowtmerange[time_range]}</option>";
				$a++;
			}else {
				$included .= "<option value='{$rowtmerange[time_range]}'>{$rowtmerange[time_range]}</option>";
				$b++;
			}
		}	
		

	}	

	while ($row_group = $resultgroup->fetch_assoc()) 
	{
				echo $row_group['tme1'];
	}	

	$resultofquery = $conn->query($sqlselectexten);
	$activeexten = $resultofquery->num_rows;

	while($extension = $resultofquery->fetch_assoc())
	{
			$options .= "<option value='{$extension[extension]}'>{$extension[extension]}</option>";
	}
	$sqlactivegroups = " SELECT `group` FROM `extension_group` WHERE `Status`='active' ORDER BY `id` ASC";
	$resultactivegroups = $conn->query($sqlactivegroups);
	while ($row_groupactive = $resultactivegroups->fetch_assoc())
	{
		$activegroups .= "<option value='{$row_groupactive[group]}'>{$row_groupactive[group]}</option>";
		
	}

?>

<!DOCTYPE html>
<html>
<head>
	<script src="js/group.js"></script>
</head>
<body>

SELECT GROUP :
<select  style="width:300px;" id="groupselect" placeholder="SELECT GROUP"onchange="myseclectfunction()" > 
<option value="" disabled selected >Select Group</option>
<?php echo $activegroups ;?>
</select><br>

<div id="groupsettings" >
	<div id="divavailable">
		<p id="availtime"></p>
		<select id="selectavail" style="width:300px;" ondblclick="myFunctionadd()"></select>
		
		<button onclick ="myFunctionadd()">ADD TIME-FRAME </button><br><br>
	</div>
	<div id="divcurrent">
		<p id="usedtime"></p>
		<select id="selectcurrent"  style="width:300px;" ondblclick="myFunctionremove()"></select>
		
		<button onclick ="myFunctionremove()">REMOVE TIME-FRAME </button>
	</div>
</div>

</body>
</html>



