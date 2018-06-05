<?php
require 'controller/Station.php';
$st       = new Station();
//Multi Station
$stDataAll  = $st->getStationInfoAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>HAVA KALİTE</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="//cdn.leafletjs.com/leaflet-0.7.2/leaflet.ie.css" /><![endif]-->

    <link rel="stylesheet" href="css/leaflet-sidebar.css" />
	<link href="css/themify-icons.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/theme.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
    
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400%7CRaleway:100,400,300,500,600,700%7COpen+Sans:400,500,600' rel='stylesheet' type='text/css'>

    <style>
        body {
            padding: 0;
            margin: 0;
        }

        html, body, #map {
            height: 93%;
            width: 100%;
            font: 10pt "Helvetica Neue", Arial, Helvetica, sans-serif;
        }

        .lorem {
            font-style: italic;
            color: #AAA;
        }
    </style>
</head>
<body>
	<div class="nav-container">
			    
			    
			
			    <nav class="nav-centered">
			        
			        <div class="nav-bar text-center" style="height: 165px;">
			            <div class="module widget-handle mobile-toggle right visible-sm visible-xs">
			                <i class="ti-menu"></i>
			            </div>
			            <div class="module-group text-left" style="z-index: 999999;">
			                <div class="module left" style="z-index: 999999;">
			                    <ul class="menu" style="z-index: 999999;">
			                        
			                       
			                        <li class="has-dropdown" style="z-index: 999999;">
			                            <a href="#">
			                                ERHAN ARSLAN
			                            </a>
			                            <ul>
			                                <li>
			                                    <a href="#">
			                                        Web Sitesi
			                                    </a>
			                                </li>
			                            </ul>
			                        </li>
			                    </ul>
			                </div>
			                
			                
			            
			        </div>
			        </nav>

	</div>



    <div id="sidebar" class="sidebar collapsed">

        <!-- Nav tabs -->
        <div class="sidebar-tabs">
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-info"></i></a></li>
            </ul>

            <ul role="tablist">
                <li><a href="#settings" role="tab"><i class="fa fa-gear"></i></a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="sidebar-content">
            <div class="sidebar-pane" id="default">
            <h1 class="sidebar-header">İstasyon Bilgisi<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            <div>
            <br>
            <h3 id="stname" style="margin-left: 25px;"></h3>
            <h3 id="date" style="margin-left: 25px;"></h3>
            <br>
            	<h3 id="pm101" style="margin-left: 25px;">Pm10 24 Saatlik Grafiği</h3>
                 <canvas id="pm10"></canvas>
				<h3 id="pm251" style="margin-left: 25px;">Pm25 24 Saatlik Grafiği</h3>
                 <canvas id="pm25"></canvas>
				<h3 id="o31" style="margin-left: 25px;">O3 24 Saatlik Grafiği</h3>
                 <canvas id="o3"></canvas>
                 <h3 id="so21" style="margin-left: 25px;">SO2 24 Saatlik Grafiği</h3>
                 <canvas id="so2"></canvas>
                 <h3 id="no21" style="margin-left: 25px;">NO2 24 Saatlik Grafiği</h3>
                 <canvas id="no2"></canvas>
                 <h3 id="co1" style="margin-left: 25px;">CO 24 Saatlik Grafiği</h3>
                 <canvas id="co"></canvas>
                 </div>
            </div>
            <div class="sidebar-pane" id="home">
                

                <p>ERHAN ARSLAN KİMDİR?</p>

                <p class="lorem"></p>

                <p class="lorem"></p>

                <p class="lorem"></p>

                <p class="lorem"></p>
            </div>


            <div class="sidebar-pane" id="settings">
                <h1 class="sidebar-header">Settings<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            </div>
        </div>
    </div>
    <div id="map" class="sidebar-map"></div>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    <script src="js/leaflet-sidebar.js"></script>
    <script src="js/pako.js"></script>
    <script src="js/moment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/parallax.js"></script>
	<script src="js/scripts.js"></script>
    

    <script>
        var stationAll=<?php echo json_encode($stDataAll)?>;

        var points=[];
        var point=[];

        for(var i in stationAll)
        {
        	point.push(parseFloat(stationAll[i]['stationId']));
            point.push(parseFloat(stationAll[i]['stationLat']));
            point.push(parseFloat(stationAll[i]['stationLong']));
            points.push(point);
            point=[];
        }
		var singleStData;
		var dataSaat = [];
		var dataY = [];
		var dataColor = [];
		var chartType=["pm10","pm25","o3","so2","no2","co"];
        function createChartData(){

        	for(var i = 0; i < stationAll.length; i++)
			{
				 if(stationAll[i].stationId == singleStData['data'][0].idx)
				 {
				    document.getElementById("stname").innerHTML ="İstayson Adı: "+stationAll[i].stationName;
				 }
			}
        	document.getElementById("date").innerHTML ="Ölçüm Tarihi: "+singleStData['data'][0]['time']+" / "+ moment(singleStData['data'][0]['date']).format('D-MM-YYYY');
        for(var k in chartType){
        	dataSaat = [];
        	dataY = [];
        	dataColor = [];
        var stData=singleStData["analizData"][singleStData["data"][0]["idx"]][chartType[k]];
		for(var i in stData)
		{
			dataSaat.push(stData[i]['label']);
			dataY.push(stData[i]['y']);
			dataColor.push(dataGetColor(stData[i]['y']));
		}
		if(dataY[0] != "-" || dataY[3] != "-" || dataY[5] != "-" || dataY[7] != "-" || dataY[9] != "-" || dataY[11] != "-" || dataY[13] != "-" || dataY[15] != "-" || dataY[17] != "-" || dataY[19] != "-" || dataY[21] != "-" || dataY[23] != "-"){
			document.getElementById(chartType[k]).style.display = "block";
			document.getElementById(chartType[k]+"1").style.display = "block";
			var old_element = document.getElementById(chartType[k]);
					var new_element = old_element.cloneNode(true);
					old_element.parentNode.replaceChild(new_element, old_element);
		createChart(chartType[k]);
			}else{
				document.getElementById(chartType[k]).style.display = "none";
				document.getElementById(chartType[k]+"1").style.display = "none";
			}
		}
	}
        var map = L.map('map');
        map.setView([39, 34.5], 6);

        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; OpenStreetMap contributors'
        }).addTo(map);

        var sidebar = L.control.sidebar('sidebar').addTo(map);
   

    // for (var i = 0; i < points.length; i++) {
    	<?php for ($i=0; $i <count($stDataAll) ; $i++) {?>
            marker = new L.marker([<?= $stDataAll[$i]['stationLat']?>,<?= $stDataAll[$i]['stationLong']?>])
                .addTo(map).on('click', function () {
            

            sidebar.toggle();
            document.getElementById("default").classList.add("active");
            document.getElementById("home").classList.remove("active");
            getStationData(<?= $stDataAll[$i]['stationId']?>);
        });
        // }
        <?php }?>

                

                function getStationData(val)
                {
                	var settings = {
					  "async": true,
					  "crossDomain": true,
					  "url": "http://45.55.134.38:8091/station/data?idx="+val,
					  "method": "GET"
					}

					$.ajax(settings).done(function (response) {
					 singleStData= JSON.parse(decompressData(response));
					 createChartData();
					});
                }

                function decompressData(data)
                {
                	// Get some base64 encoded binary data from the server. Imagine we got this:
					var b64Data     = data;;

					// Decode base64 (convert ascii to binary)
					var strData     = atob(b64Data);

					// Convert binary string to character-number array
					var charData    = strData.split('').map(function(x){return x.charCodeAt(0);});

					// Turn number array into byte-array
					var binData     = new Uint8Array(charData);

					// Pako magic
					var data        = pako.inflate(binData, { raw: true });

					// Convert gunzipped byteArray back to ascii string:
					var strData     = String.fromCharCode.apply(null, new Uint16Array(data));

					return strData;
                }



                function createChart(val){
                	
	                var ctx = document.getElementById(val).getContext('2d');
	                    var myChart = new Chart(ctx, {
	                      type: 'bar',
	                      data: {
	                        labels: dataSaat,
	                        datasets: [{
	                          label: 'Değer',
	                          data: dataY,
	                          backgroundColor: dataColor
	                        }]
	                    },options: {
	    					legend: {
	        					display: false
	   						 },
	    						tooltips: {
	      						  callbacks: {
	        						   label: function(tooltipItem) {
	                					  return tooltipItem.yLabel;
	          					 }
	       							 }
	  						  }
						}
	                });
                 }

              function dataGetColor($val)
              {
                  return ($val <=50) ? "rgba(43, 251, 0, 1)" :
					  (($val <=70) ? "rgba(255, 254, 0, 1)" :
					   (($val <=100) ? "rgba(254, 157, 0, 1)" :
					    (($val <=120) ? "rgba(255, 0, 0, 1)" :
					    (($val <=150) ? "rgba(97, 3, 128, 1)" : "rgba(97, 3, 77, 1)"))));
               }
    </script>
</body>
</html>
