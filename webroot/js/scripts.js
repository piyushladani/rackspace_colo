function selectRack(){

  
  //var dataSet = {10: 123};
 
  var request = new XMLHttpRequest();
  
  request.open('GET',"http://localhost:8888/colocation/colocation-app/colocations/getdata?location="+document.getElementById("loc").value, true);
  request.send(null);
  request.onreadystatechange=function()
        {
            if (request.readyState==4 && request.status==200)
            {
                
                var json = JSON.parse(request.responseText);
                
                
                html = "";
            for(var key in json['groups']) {
            html += "<option value=" + key  + ">" +json['groups'][key] + "</option>"
            
        }

        document.getElementById("rac").innerHTML = html;

            }
            
        }

  }