function selectRack(){

  
  //var dataSet = {10: 123};
 
  var request = new XMLHttpRequest();
  
  request.open('GET',"http://localhost:8888/colocation/colocation-app/colocations/getrack?location="+document.getElementById("loc").value, true);
  request.send(null);
  request.onreadystatechange=function()
        {
            if (request.readyState==4 && request.status==200)
            {
                
                var json = JSON.parse(request.responseText);
                
                
                html = "<option disabled selected value> -Select Rack- </option>";
            for(var key in json['groups']) {
            html += "<option value=" + key  + ">" +json['groups'][key] + "</option>"
            
        }

        document.getElementById("rac").innerHTML = html;
        document.getElementById("shelf").innerHTML = null;

            }
            
        }

  }

  function selectShelf(){

  
  //var dataSet = {10: 123};
 
  var request = new XMLHttpRequest();
  
  request.open('GET',"http://localhost:8888/colocation/colocation-app/colocations/getshelf?location="+document.getElementById("rac").value, true);
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

        document.getElementById("shelf").innerHTML = html;

            }
            
        }

  }