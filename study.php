<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ro">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
<title>Example Ajax POST</title>

<script type="text/javascript"><!--
// sends data to a php file, via POST, and displays the received answer
function ajaxrequest(php_file, tagID) {
  var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');  // XMLHttpRequest object

  // create pairs index=value with data that must be sent to server
  var  the_data = 'test='+document.getElementById('txt2').innerHTML;

  request.open("POST", php_file, true);      // set the request

  // adds  a header to tell the PHP script to recognize the data as is sent via POST
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(the_data);    // calls the send() method with datas as parameter

  // Check request status
  // If the response is received completely, will be transferred to the HTML tag with tagID
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById(tagID).innerHTML = request.responseText;
    }
  }
}

function Send_Data() {
    var name = document.getElementById("name").value;
    var surname = document.getElementById("surname").value;
   // var the_data = "name="+name+"&surname="+surname;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');  // XMLHttpRequest object
    request.open("GET", "info.php?name="+name + "&surname=" + surname , true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send();    // calls the send() method with datas as parameter

    request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById("response").innerHTML = request.responseText;
    }
  }
}
--></script>
</head>
<body>

<h5 style="cursor:pointer;" onclick="ajaxrequest('test_post.php', 'context')"><u>Click</u></h5>
<div id="txt2">This string will be sent with Ajax to the server, via POST, and processed with PHP</div>
<div id="context">Here will be displayed the response from the php script.</div>


<div class="form">
<center><h3>Ajax Example </h3></center>
<hr/>
<input type="text" id="name" placeholder="Enter_name" />
<br/>
<input type="text" id="surname" placeholder="Enter_contact" /><br/>
<input type="button"  value="Submit" onclick="Send_Data()"/><br/>
<span id="response">

</body>
</html>

<?php

$sqlselectexten = "SELECT extension FROM `extensions`";
/*while ($row_group = $resultgroup->fetch_assoc()) 
    {
                echo $row_group['tme1'];
    }   

    $resultofquery = $conn->query($sqlselectexten);
    $activeexten = $resultofquery->num_rows;

    while($extension = $resultofquery->fetch_assoc())
    {
            $options .= "<option value='{$extension[extension]}'>{$extension[extension]}</option>";
    }
*/

?>