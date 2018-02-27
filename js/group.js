function myseclectfunction(){
	
	 var x = document.getElementById("groupselect").value;
     var selectavail = document.getElementById("selectavail");
	 var selectcurrent = document.getElementById("selectcurrent");
	 var availtime = document.getElementById("availtime").innerHTML = "ALL AVAILABLE TIME FRAME";
	 var usedtime = document.getElementById("usedtime").innerHTML = "Time Frame Under Group " + x;
		
		//clear SELECT Options first
	 selectavail.options.length = 0;
	 selectcurrent.options.length = 0;
  
   var group;
   var combine= " "; 
   var current = document.getElementById('current');
   var available = document.getElementById('available');
  
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
				combine = this.responseText;  // php output $a."@"."|".$notincluded."&".
				// process data from backend  
				var explode = combine.split("&");
	 			var notincluded = explode[0].split("@");  //$a."@"."|".$notincluded
				var included = explode[1].split("@"); //$b."@"."|".$included
				var counta = notincluded[0];
				var countb = included[0];
				
				
				var get_each_notincluded = notincluded[1].split("|");
				var get_each_included = included[1].split("|");
				
				selectavail.size = counta;
				selectcurrent.size = countb;
				//  available time range
				for (var i = 0; i<get_each_notincluded.length; i++) {
					var option = document.createElement('option');
					option.value = get_each_notincluded[i];
					option.text = get_each_notincluded[i];
					selectavail.appendChild(option);
					
				}
				// currently assign to selected group.
				for (var i = 0; i<get_each_included.length; i++) {
					var option = document.createElement('option');
					option.value = get_each_included[i];
					option.text = get_each_included[i];
					selectcurrent.appendChild(option);
					
				}
				
            }
			
        };
		
        xmlhttp.open("GET", "getgroupatrrib.php?group=" + x, true);
        xmlhttp.send();
		

}
function myFunctionremove(){

 	var selectselectcurrent = document.getElementById("selectcurrent");
	var group = document.getElementById("groupselect");
    var bit = 0; 
	var getcurrent = selectcurrent.options[selectcurrent.selectedIndex].value;
    var getgroup = group.options[group.selectedIndex].value;
   

	 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              
            }
        };
        xmlhttp.open("GET", "getgroupatrrib.php?group=" +  getgroup + "&selectavail=" + getcurrent + "&bit=" + bit , true);
        xmlhttp.send();

        myseclectfunction();

}

function myFunctionadd() {

	var selectavail = document.getElementById("selectavail");
	var group = document.getElementById("groupselect");
    var bit = 1; 
	var getavail = selectavail.options[selectavail.selectedIndex].value;
    var getgroup = group.options[group.selectedIndex].value;
   

	 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              
            }
        };
        xmlhttp.open("GET", "getgroupatrrib.php?group=" +  getgroup + "&selectavail=" + getavail + "&bit=" + bit , true);
        xmlhttp.send();

    myseclectfunction();    

}
