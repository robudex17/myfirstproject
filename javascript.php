<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ro">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
<title>Example Ajax POST</title>

    <script type= "text/javascript">

   function Send_Data() {
    var name = document.getElementById("name").value;
    var surname = document.getElementById("surname").value;
   // var the_data = "name="+name+"&surname="+surname;
    //var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');  // XMLHttpRequest object
    var request = new XMLHttpRequest();
    request.open("GET", "info.php?name="+name + "&surname=" + surname , true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send();    // calls the send() method with datas as parameter

    request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200) {
      document.getElementById("response").innerHTML = request.responseText;
    }
  }
}



    </script>
</head>
<body>

<div class="form">
<center><h3>Ajax Example </h3></center>
<hr/>
<input type="text" id="name" placeholder="Enter_name" />
<br/>
<input type="text" id="surname" placeholder="Enter_contact" /><br/>
<input type="button"  value="Submit" onclick="Send_Data()"/><br/>
<span id="response">
 

<script type= "text/javascript">




function only () {
	var name = document.getElementById("firstname").value;
	var surname = document.getElementById("surname").value;
    //var name = document.forms[0].element[0].value;
   // var surname = document.forms[0].element[1].value;
    var params ="name=rogmer&surname=bulaclac";
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            	alert(this.responseText);
            }	

        
         xmlhttp.open("POST", "info.php", true);
         xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         xmlhttp.send(params);

         
	};	   	


}


function mybutton () {
   var name = document.getElementById("firstname").value;
    var surname = document.getElementById("surname").value;

    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }else {
                alert ("ERROR");
            }   

         xmlhttp.onerror = function() {
            alert("Error");
         }
         xmlhttp.open("GET", "info.php?name=" + name + "&surname=" + surname, true);
        
         xmlhttp.send();
    };    
}  





</script>

<p id='success'></p>
</body>
</html>