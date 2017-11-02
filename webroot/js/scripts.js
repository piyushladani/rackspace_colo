function selectRack(){

  
  //var dataSet = {10: 123};
 
  var request = new XMLHttpRequest();
  
  request.open('GET',"http://localhost:8888/colocation/colocation-app/colocations/getrack?location="+document.getElementById("loc").value, true);
  request.send(null);
  request.onreadystatechange=function()
        {
            if (request.readyState==4 && request.status==200)
            {
                console.log(request.responseText);

                var json = JSON.parse(request.responseText);
                
                
                html = "<option disabled selected value> -Select Rack- </option>";
                html1 = "<option disabled selected value> -Select Shelf- </option>";
            for(var key in json['groups']) {
            html += "<option value=" + json['groups'][key]['id']  + ">" +json['groups'][key]['name']+ "</option>"
            
        }

        document.getElementById("rac").innerHTML = html;
        document.getElementById("shelf").innerHTML = html1;

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
                
                html = "<option disabled selected value> -Select Shelf- </option>";

            for(var key in json['groups']) {
            html += "<option value=" + key  + ">" +json['groups'][key] + "</option>"
            
        }
                
                
        console.log('hi');

        document.getElementById("shelf").innerHTML = html;

            }
            
        }

  }