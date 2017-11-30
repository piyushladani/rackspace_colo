function selectRack(){

  
  //var dataSet = {10: 123};
 
  var request = new XMLHttpRequest();
  
  request.open('GET',"http://localhost:8888/colocation/colocation-app/shelfs/getrack?location="+document.getElementById("loc").value, true);
  request.send(null);
  request.onreadystatechange=function()
        {
            if (request.readyState==4 && request.status==200)
            {
                console.log(request.responseText);

                var json = JSON.parse(request.responseText);
                
                
                html = "<option disabled selected value> -Select Rack- </option>";
            for(var key in json['groups']) {
            html += "<option value=" + json['groups'][key]['id']  + ">" +json['groups'][key]['name']+ "</option>"
            
        }

        document.getElementById("rac").innerHTML = html;

            }
            
        }

  }