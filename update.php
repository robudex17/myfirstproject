<?php
//Database Connect
$servername = "localhost";
$username = "root";
$password = "P88sI55d";
$dbname = "csddatabase";

$myfile = fopen("sample.txt", "w") or die("Unable to open file!");
$serversettings = "exten => _290948[05],1,Set$(PH_IAX=IAX2/sbphilippines:sbtrading@103.5.6.2)\n";
$Setattributes = "exten => _290948[05],n,Set";
fwrite ($myfile , $serversettings );
	
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	echo "What Happen";
} else {
	
?>

<button onclick ="myFunctionadd()">ADD TIME-FRAME </button><br><br>
AVAILABLE TIME-FRAME <br>
<select id="exten" size=<?php echo $a;?> style="width:300px;"> <?php echo $notincluded ;?></select><br>

<button onclick ="myFunctionadd()">ADD TIME-FRAME </button><br><br>


<p id="group"></p>
ACTIVE TIME-FRAME<br>

<select id="exten" size=<?php echo $b;?> style="width:300px;">
  <?php echo $included ;?>
</select>

<button onclick ="myFunctionremove()">REMOVE TIME-FRAME </button>
