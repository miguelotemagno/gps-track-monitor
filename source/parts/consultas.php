<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>

</title>
    <style type="text/css" media="all">
        body {font-size:80%;}
        #jQueryUICssSwitch {width:150px;}
    </style>


<script type="text/javascript" src="js/ui-gMapDirections.js"></script>




<body>

    <div>
        <div id="styleSelector"></div>


   <style>
    #map {width:600px;height:600px;float:left;}
   </style>


 <link id="jQueryUICssSrc" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <div id="jQueryUICssSwitch"></div>
    <script type="text/javascript">
        $('#jQueryUICssSwitch').combobox({
            listHeight:200,
            list: [
                    { value: "base", text: "base" },
                    { value: "black-tie", text: "black-tie" },
                    { value: "blitzer", text: "blitzer" },
                    { value: "cupertino", text: "cupertino" },
                    { value: "dark-hive", text: "dark-hive" },
                    { value: "dot-luv", text: "dot-luv" },
                    { value: "eggplant", text: "eggplant" },
                    { value: "excite-bike", text: "excite-bike" },
                    { value: "flick", text: "flick" },
                    { value: "hot-sneaks", text: "hot-sneaks" },
                    { value: "humanity", text: "humanity" },
                    { value: "le-frog", text: "le-frog" },
                    { value: "mint-choc", text: "mint-choc" },
                    { value: "overcast", text: "overcast" },
                    { value: "pepper-grinder", text: "pepper-grinder" },
                    { value: "redmond", text: "redmond" },
                    { value: "smoothness", text: "smoothness" },
                    { value: "south-street", text: "south-street" },
                    { value: "start", text: "start" },
                    { value: "sunny", text: "sunny" },
                    { value: "swanky-purse", text: "swanky-purse" },
                    { value: "trontastic", text: "trontastic" },
                    { value: "ui-darkness", text: "ui-darkness"},
                    { value: "ui-lightness", text: "ui-lightness", selected: true },
                    { value: "vader", text: "vader" },
                    ]
                , changed: function(e, ui) {
                    $('#jQueryUICssSrc').attr('href', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/' + ui.value + '/jquery-ui.css');
                }
        });
        function jQueryUICss_Changed(ddl, i) {

        }
    </script>






    <div id="map"></div>

    <div id="getDirs"></div>


    <script type="text/javascript">

        var urMap=null;
        function InitMap() {
            var urMapOptions = {
                zoom: 13,
                center: new google.maps.LatLng(41.38572, 2.17025),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            urMap = new google.maps.Map($('#map')[0], urMapOptions);
            initMapDirs();
        }

        function initMapDirs() {
            $('#getDirs').gMapDirections({
                                map: urMap
                                , close: function() {
                                    //
                                }
                            });
        }

        $(document).ready(function() {
            InitMap();

        })

    </script>


        
        <div class="sampleButtons">
            <input type="button" value="destroy" onclick="$('#getDirs').gMapDirections('destroy');" />
            <input type="button" value="create" onclick="initMapDirs();" />
            <input type="button" value="get map" onclick="alert($('#getDirs').gMapDirections('option', 'map'));" />
            <input type="button" value="set new Opacity" onclick="$('#getDirs').gMapDirections('option', 'opacity', '0.1');" />
            <input type="button" value="set resizable false" onclick="$('#getDirs').gMapDirections('option', 'resizable', 'false');" />
            <input type="button" value="set draggable false" onclick="$('#getDirs').gMapDirections('option', 'draggable', 'false');" />
            <input type="button" value="set width 400" onclick="$('#getDirs').gMapDirections('option', 'width', '400');" />
            <input type="button" value="set height 400" onclick="$('#getDirs').gMapDirections('option', 'height', '400');" />
        </div>





    </div>




<!-- End of Google Analytics code -->

</body>
</html>
