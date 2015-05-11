<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>KeyDragZoom Multiple Map Support</title>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
        </script>
    
        <script type="text/javascript">
            var map1;
            var map2;
            function createMap(mapDiv) {
               var myOptions = {
                zoom: 12,
                center: new google.maps.LatLng(35.227, -80.84),
                mapTypeId: google.maps.MapTypeId.ROADMAP
              }
              var map = new google.maps.Map(document.getElementById(mapDiv), myOptions);


             
               
            
              return map;
            }

            function init() {
              map1 = createMap('map1');
              map2 = createMap('map2');
              map3 = createMap('map3');
              map4 = createMap('map4');
              
            }
        </script>

        <style>
            #map1 {
                position:absolute;
                left :0px;
                top: 0px;
                width: 400px;
                height: 500px;
                border: 1px solid black
            }
            #map2 {
                position:absolute;
                left : 450px;
                top: 0px;
                width: 400px;
                height: 500px;
                border: 1px solid black
            }
               #map3 {
                position:absolute;
                left : 650px;
                top: 0px;
                width: 400px;
                height: 500px;
                border: 1px solid black
            }
               #map4 {
                position:absolute;
                left : 950px;
                top: 0px;
                width: 400px;
                height: 500px;
                border: 1px solid black
            }


        </style>
    </head>
    <body onload="init()">
        <a href='?packed'>Packed </a>
        | <a href='?'> Unpacked</a>
        Version of the script.
        <br/>

        Hold down a Shift key while dragging the zoom box.
        <div style="position:relative">
        <div id="map1" >
        </div>
        <div id="map2">
        </div>
            <div id="map3">
        </div>
            <div id="map4">
        </div>
        </div>
    </body>
</html>

