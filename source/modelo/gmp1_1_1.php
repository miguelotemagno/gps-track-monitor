<?php
session_start();



class GoogleMapAPI {

    var $dsn = null;
   
    var $api_key ='';

    var $map_id = null;

   
    var $sidebar_id = null;    
    
    
    var $app_id = null;

    var $onload = true;
    
   
    var $center_lat = null;

   
    var $center_lon = null;
    
    
    var $map_controls = true;

    var $control_size = 'large';
    
   
    var $type_controls = true;

    var $map_type = 'G_NORMAL_MAP';
    
   
    var $scale_control = true;
    
   
    var $overview_control = false;    
     
    
    var $zoom = 16;

    var $width = '500px';
    
    var $height = '500px';

    var $browser_alert = 'Sorry, the Google Maps API is not compatible with this browser.';
    
    var $js_alert = '<b>Javascript must be enabled in order to use Google Maps.</b>';

    var $sidebar = true;    

    var $directions = true;

    var $info_window = true;    
    
    var $window_trigger = 'click';    

    var $lookup_service = 'GOOGLE';
	var $lookup_server = array('GOOGLE' => 'maps.google.com', 'YAHOO' => 'api.local.yahoo.com');
    
    var $driving_dir_text = array(
            'dir_to' => 'Direccion de Inicio: (include direccion, ciudad/region)',
            'to_button_value' => 'Ir Directions',
            'to_button_type' => 'submit',
            'dir_from' => 'Direccion final: (include direccion, ciudad/region)',
            'from_button_value' => 'Get Directions',
            'from_button_type' => 'submit',
            'dir_text' => 'Directions: ',
            'dir_tohere' => 'Desde aqui',
            'dir_fromhere' => 'Hasta aqui'
            );             
               
    
    var $_version = '2.5';

    var $_markers = array();

    var $_max_lon = -1000000;
    
    var $_min_lon = 1000000;
    
    var $_max_lat = -1000000;
    var $_min_lat = 1000000;
    var $zoom_encompass = true;

    var $bounds_fudge = 0.01;

    var $use_suggest = false;

    
   
    var $_polylines = array();    


    var $_icons = array();

   
    
        
        function GoogleMapAPI($map_id = 'map', $app_id = 'MyMapApp') {
        $this->map_id = $map_id;
        $this->sidebar_id = 'sidebar_' . $map_id;
        $this->app_id = $app_id;
    }
   
    function setDSN($dsn) {
        $this->dsn = $dsn;   
    }
    
    function setAPIKey($key) {
        $this->api_key = $key;   
    }

    function setWidth($width) {
        if(!preg_match('!^(\d+)(.*)$!',$width,$_match))
            return false;

        $_width = $_match[1];
        $_type = $_match[2];
        if($_type == '%')
            $this->width = $_width . '%';
        else
            $this->width = $_width . 'px';
        
        return true;
    }

  
    function setHeight($height) {
        if(!preg_match('!^(\d+)(.*)$!',$height,$_match))
            return false;

        $_height = $_match[1];
        $_type = $_match[2];
        if($_type == '%')
            $this->height = $_height . '%';
        else
            $this->height = $_height . 'px';
        
        return true;
    }        

   
    function setZoomLevel($level) {
        $this->zoom = (int) $level;
    }    
            
   
    function enableMapControls() {
        $this->map_controls = true;
    }


    function disableMapControls() {
        $this->map_controls = false;
    }    
    
    function setControlSize($size) {
        if(in_array($size,array('large','small')))
            $this->control_size = $size;
    }            

  
    function enableTypeControls() {
        $this->type_controls = true;
    }

 
    function disableTypeControls() {
        $this->type_controls = false;
    }


    function setMapType($type) {
        switch($type) {
            case 'hybrid':
                $this->map_type = 'G_HYBRID_MAP';
                break;
            case 'satellite':
                $this->map_type = 'G_SATELLITE_MAP';
                break;
            case 'map':
            default:
                $this->map_type = 'G_NORMAL_MAP';
                break;
        }       
    }    
    

    function enableOnLoad() {
        $this->onload = true;
    }

    function disableOnLoad() {
        $this->onload = false;
    }
    
    function enableSidebar() {
        $this->sidebar = true;
    }

    function disableSidebar() {
        $this->sidebar = false;
    }    

    function enableDirections() {
        $this->directions = true;
    }

    function disableDirections() {
        $this->directions = false;
    }    
        
    function setBrowserAlert($message) {
        $this->browser_alert = $message;
    }
    function setJSAlert($message) {
        $this->js_alert = $message;
    }

    function enableInfoWindow() {
        $this->info_window = true;
    }
    function disableInfoWindow() {
        $this->info_window = false;
    }
    
    function setInfoWindowTrigger($type) {
        switch($type) {
            case 'mouseover':
                $this->window_trigger = 'mouseover';
                break;
            default:
                $this->window_trigger = 'click';
                break;
            }
    }

  
    function enableZoomEncompass() {
        $this->zoom_encompass = true;
    }
    
    function disableZoomEncompass() {
        $this->zoom_encompass = false;
    }

    function setBoundsFudge($val) {
        $this->bounds_fudge = $val;
    }
    
    function enableScaleControl() {
        $this->scale_control = true;
    }

    function disableScaleControl() {
        $this->scale_control = false;
    }    
            
    function enableOverviewControl() {
        $this->overview_control = true;
    }

    function disableOverviewControl() {
        $this->overview_control = false;
     }    
    
    
    function setLookupService($service) {
        switch($service) {
            case 'GOOGLE':
                $this->lookup_service = 'GOOGLE';
                break;
            case 'YAHOO':
            default:
                $this->lookup_service = 'YAHOO';
                break;
        }       
    }
    
        
    function addMarkerByAddress($address,$title = '',$html = '',$tooltip = '') {
        if(($_geocode = $this->getGeocode($address)) === false)
            return false;
        return $this->addMarkerByCoords($_geocode['lon'],$_geocode['lat'],$title,$html,$tooltip);
    }

    function addMarkerByCoords($lon,$lat,$title = '',$html = '',$tooltip = '') {
        $_marker['lon'] = $lon;
        $_marker['lat'] = $lat;
        $_marker['html'] = (is_array($html) || strlen($html) > 0) ? $html : $title;
        $_marker['title'] = $title;
        $_marker['tooltip'] = $tooltip;
        $this->_markers[] = $_marker;
        $this->adjustCenterCoords($_marker['lon'],$_marker['lat']);
        // return index of marker
        return count($this->_markers) - 1;
    }

    function addPolyLineByAddress($address1,$address2,$color='',$weight=0,$opacity=0) {
        if(($_geocode1 = $this->getGeocode($address1)) === false)
            return false;
        if(($_geocode2 = $this->getGeocode($address2)) === false)
            return false;
        return $this->addPolyLineByCoords($_geocode1['lon'],$_geocode1['lat'],$_geocode2['lon'],$_geocode2['lat'],$color,$weight,$opacity);
    }


  function addPolyLineByCoords($lon1,$lat1,$lon2,$lat2,$color='',$weight=0,$opacity=0) {
        $_polyline['lon1'] = $lon1;
        $_polyline['lat1'] = $lat1;
        $_polyline['lon2'] = $lon2;
        $_polyline['lat2'] = $lat2;
        $_polyline['color'] = $color;
        $_polyline['weight'] = $weight;
        $_polyline['opacity'] = $opacity;
        $this->_polylines[] = $_polyline;
        $this->adjustCenterCoords($_polyline['lon1'],$_polyline['lat1']);
        $this->adjustCenterCoords($_polyline['lon2'],$_polyline['lat2']);
        // return index of polyline
        return count($this->_polylines) - 1;
    }        
        
    function adjustCenterCoords($lon,$lat) {
        if(strlen((string)$lon) == 0 || strlen((string)$lat) == 0)
            return false;
        $this->_max_lon = (float) max($lon, $this->_max_lon);
        $this->_min_lon = (float) min($lon, $this->_min_lon);
        $this->_max_lat = (float) max($lat, $this->_max_lat);
        $this->_min_lat = (float) min($lat, $this->_min_lat);
        
        $this->center_lon = (float) ($this->_min_lon + $this->_max_lon) / 2;
        $this->center_lat = (float) ($this->_min_lat + $this->_max_lat) / 2;
        return true;
    }

    function setCenterCoords($lon,$lat) {
        $this->center_lat = (float) $lat;
        $this->center_lon = (float) $lon;
    }    

    function createMarkerIcon($iconImage,$iconShadowImage = '',$iconAnchorX = 'x',$iconAnchorY = 'x',$infoWindowAnchorX = 'x',$infoWindowAnchorY = 'x') {
        $_icon_image_path = strpos($iconImage,'https') === 0 ? $iconImage : $_SERVER['DOCUMENT_ROOT'] . $iconImage;
        if(!($_image_info = @getimagesize($_icon_image_path))) {
            die('GoogleMapAPI:createMarkerIcon: Error reading image: ' . $iconImage);   
        }
        if($iconShadowImage) {
            $_shadow_image_path = strpos($iconShadowImage,'http') === 0 ? $iconShadowImage : $_SERVER['DOCUMENT_ROOT'] . $iconShadowImage;
            if(!($_shadow_info = @getimagesize($_shadow_image_path))) {
                die('GoogleMapAPI:createMarkerIcon: Error reading image: ' . $iconShadowImage);
            }
        }
        
        if($iconAnchorX === 'x') {
            $iconAnchorX = (int) ($_image_info[0] / 2);
        }
        if($iconAnchorY === 'x') {
            $iconAnchorY = (int) ($_image_info[1] / 2);
        }
        if($infoWindowAnchorX === 'x') {
            $infoWindowAnchorX = (int) ($_image_info[0] / 2);
        }
        if($infoWindowAnchorY === 'x') {
            $infoWindowAnchorY = (int) ($_image_info[1] / 2);
        }
                        
        $icon_info = array(
                'image' => $iconImage,
                'iconWidth' => $_image_info[0],
                'iconHeight' => $_image_info[1],
                'iconAnchorX' => $iconAnchorX,
                'iconAnchorY' => $iconAnchorY,
                'infoWindowAnchorX' => $infoWindowAnchorX,
                'infoWindowAnchorY' => $infoWindowAnchorY
                );
        if($iconShadowImage) {
            $icon_info = array_merge($icon_info, array('shadow' => $iconShadowImage,
                                                       'shadowWidth' => $_shadow_info[0],
                                                       'shadowHeight' => $_shadow_info[1]));
        }
        return $icon_info;
    }
    
    function setMarkerIcon($iconImage,$iconShadowImage = '',$iconAnchorX = 'x',$iconAnchorY = 'x',$infoWindowAnchorX = 'x',$infoWindowAnchorY = 'x') {
        $this->_icons = array($this->createMarkerIcon($iconImage,$iconShadowImage,$iconAnchorX,$iconAnchorY,$infoWindowAnchorX,$infoWindowAnchorY));
    }
    
    function addMarkerIcon($iconImage,$iconShadowImage = '',$iconAnchorX = 'x',$iconAnchorY = 'x',$infoWindowAnchorX = 'x',$infoWindowAnchorY = 'x') {
        $this->_icons[] = $this->createMarkerIcon($iconImage,$iconShadowImage,$iconAnchorX,$iconAnchorY,$infoWindowAnchorX,$infoWindowAnchorY);
        return count($this->_icons) - 1;
    }

    function printHeaderJS() {
        echo $this->getHeaderJS();   
    }
    
    function getHeaderJS() {
        return sprintf('<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=%s" type="text/javascript" charset="utf-8"></script>', $this->api_key);
    }    
    
    function printOnLoad() {
        echo $this->getOnLoad();
    }

    function getOnLoad() {
        return '<script language="javascript" type="text/javascript" charset="utf-8">window.onload=onLoad;</script>';                       
    }

    function printMapJS() {
        echo $this->getMapJS();
    }    

    function getMapJS() {
        $_output = '<script type="text/javascript" charset="utf-8">' . "\n";
        $_output .= 'var FECHA;';
        $_output .= 'var kkg=0;var swg=new Array();var contg=0;var sw=0;var dir;var recorrido=new Array();var Direcc=new Array ();var tiemporecorrido=0;var delay=2000;var distancia;var gmarkers =new Array();var cont=0;var cont2=new Array();var htt=new Array ();var HORA2=new Array ();var lat=new Array();var lngg=new Array ();var lng=new Array ();var point=new Array ();var pat=new Array ();var mar=new Array ();var mod=new Array ();var fech=new Array ();var hora=new Array ();var vel=new Array ();var total=new Array();';

                $_output .= 'var lat=new Array ();';
         $_output .= 'var lng=new Array ();';

        $_output .= '//<![CDATA[' . "\n";
     

        $_output .= 'var points = [];' . "\n";
        $_output .= 'var markers = [];' . "\n";
        $_output .= 'var counter = 0;' . "\n";
        if($this->sidebar) {        
            $_output .= 'var sidebar_html = "";' . "\n";
            $_output .= 'var marker_html = [];' . "\n";
        }

        if($this->directions) {        
            $_output .= 'var to_htmls = [];' . "\n";
            $_output .= 'var from_htmls = [];' . "\n";
        }        

        if(!empty($this->_icons)) {
            $_output .= 'var icon = [];' . "\n";
            for($i = 0, $j = count($this->_icons); $i<$j; $i++) {
                $info = $this->_icons[$i];

     
                $icon_key = md5(serialize($info));
                if(!isset($exist_icn[$icon_key])) {

                    $_output .= "icon[$i] = new GIcon();\n";   
                    $_output .= sprintf('icon[%s].image = "%s";',$i,$info['image']) . "\n";   
                    if($info['shadow']) {
                        $_output .= sprintf('icon[%s].shadow = "%s";',$i,$info['shadow']) . "\n";
                        $_output .= sprintf('icon[%s].shadowSize = new GSize(%s,%s);',$i,$info['shadowWidth'],$info['shadowHeight']) . "\n";   
                    }
                    $_output .= sprintf('icon[%s].iconSize = new GSize(%s,%s);',$i,$info['iconWidth'],$info['iconHeight']) . "\n";   
                    $_output .= sprintf('icon[%s].iconAnchor = new GPoint(%s,%s);',$i,$info['iconAnchorX'],$info['iconAnchorY']) . "\n";   
                    $_output .= sprintf('icon[%s].infoWindowAnchor = new GPoint(%s,%s);',$i,$info['infoWindowAnchorX'],$info['infoWindowAnchorY']) . "\n";
                } else {
                    $_output .= "icon[$i] = icon[$exist_icn[$icon_key]];\n";
                }
            }
        }
                           
        $_output .= 'var map = null;' . "\n";
                     
        if($this->onload) {
           $_output .= 'function onLoad() {' . "\n";   
        }
                
        if(!empty($this->browser_alert)) {
            $_output .= 'if (GBrowserIsCompatible()) {' . "\n";
        }

        $_output .= sprintf('var mapObj = document.getElementById("%s");',$this->map_id) . "\n";
        $_output .= 'if (mapObj != "undefined" && mapObj != null) {' . "\n";
        $_output .= sprintf('map = new GMap2(document.getElementById("%s"));',$this->map_id) . "\n";
        if(isset($this->center_lat) && isset($this->center_lon)) {
			// Special care for decimal point in lon and lat, would get lost if "wrong" locale is set; applies to (s)printf only
			$_output .= sprintf('  geocoder = new GClientGeocoder();map.setCenter(new GLatLng(%s, %s), %d, %s);', number_format($this->center_lat, 6, ".", ""), number_format($this->center_lon, 6, ".", ""), $this->zoom, $this->map_type) . "\n";
        }
        
        // zoom so that all markers are in the viewport
        if($this->zoom_encompass && count($this->_markers) > 1) {
            // increase bounds by fudge factor to keep
            // markers away from the edges
            $_len_lon = $this->_max_lon - $this->_min_lon;
            $_len_lat = $this->_max_lat - $this->_min_lat;
            $this->_min_lon -= $_len_lon * $this->bounds_fudge;
            $this->_max_lon += $_len_lon * $this->bounds_fudge;
            $this->_min_lat -= $_len_lat * $this->bounds_fudge;
            $this->_max_lat += $_len_lat * $this->bounds_fudge;

            $_output .= "var bds = new GLatLngBounds(new GLatLng($this->_min_lat, $this->_min_lon), new GLatLng($this->_max_lat, $this->_max_lon));\n";
            $_output .= 'map.setZoom(map.getBoundsZoomLevel(bds));' . "\n";
        }
        
        if($this->map_controls) {
          if($this->control_size == 'large')
              $_output .= 'map.addControl(new GLargeMapControl3D());' . "\n";
          else
              $_output .= 'map.addControl(new GSmallMapControl());' . "\n";
        }
        if($this->type_controls) {
            $_output .= 'map.addControl(new GMapTypeControl());' . "\n";
        }
        
        if($this->scale_control) {
            $_output .= 'map.addControl(new GScaleControl());' . "\n";
        }

        if($this->overview_control) {
            $_output .= 'map.addControl(new GOverviewMapControl());' . "\n";
        }
        
        $_output .= $this->getAddMarkersJS();

        $_output .= $this->getPolylineJS();

        if(!$this->sidebar) {
            $_output .= sprintf('document.getElementById("%s").innerHTML = "<ul class=\"gmapSidebar\">"+ sidebar_html +"<\/ul>";', $this->sidebar_id) . "\n";
        }

        $_output .= '}' . "\n";        
       
        if(!empty($this->browser_alert)) {
            $_output .= '} else {' . "\n";
			$_output .= 'alert("' . str_replace('"','\"',$this->browser_alert) . '");' . "\n";
            $_output .= '}' . "\n";
        }                        

        if($this->onload) {
           $_output .= '}' . "\n";
        }

        $_output .= $this->getCreateMarkerJS();

     
        $_output .= 'function isArray(a) {return isObject(a) && a.constructor == Array;}' . "\n";
        $_output .= 'function isObject(a) {return (a && typeof a == \'object\') || isFunction(a);}' . "\n";
        $_output .= 'function isFunction(a) {return typeof a == \'function\';}' . "\n";

        if($this->sidebar) {        
            $_output .= 'function click_sidebar(idx) {' . "\n";
            $_output .= '  if(isArray(marker_html[idx])) { markers[idx].openInfoWindowTabsHtml(marker_html[idx]); }' . "\n";
            $_output .= '  else { markers[idx].openInfoWindowHtml(marker_html[idx]); }' . "\n";
            $_output .= '}' . "\n";
        }
        $_output .= 'function showInfoWindow(idx,html) {' . "\n";
        $_output .= 'map.centerAtLatLng(points[idx]);' . "\n";
        $_output .= 'markers[idx].openInfoWindowHtml(html);' . "\n";
        $_output .= '}' . "\n";
        if($this->directions) {
            $_output .= 'function tohere(idx) {' . "\n";
            $_output .= 'markers[idx].openInfoWindowHtml(to_htmls[idx]);' . "\n";
            $_output .= '}' . "\n";
            $_output .= 'function fromhere(idx) {' . "\n";
            $_output .= 'markers[idx].openInfoWindowHtml(from_htmls[idx]);' . "\n";
            $_output .= '}' . "\n";
        }

        $_output .= '//]]>' . "\n";
        $_output .= '</script>' . "\n";
        return $_output;
    }

    
    function getAddMarkersJS() {
        $SINGLE_TAB_WIDTH = 88;    // constant: width in pixels of each tab heading (set by google)
        $i = 0;
        $_output = '';
        foreach($this->_markers as $_marker) {
            if(is_array($_marker['html'])) {
    
                $ti = 0;
                $num_tabs = count($_marker['html']);
                $tab_obs = array();
                foreach($_marker['html'] as $tab => $info) {
                    if($ti == 0 && $num_tabs > 2) {
                        $width_style = sprintf(' style=\"width: %spx\"', $num_tabs * $SINGLE_TAB_WIDTH);
                    } else {
                        $width_style = '';
                    }
                    $tab = str_replace('"','\"',$tab);
                    $info = str_replace('"','\"',$info);
					$info = str_replace(array("\n", "\r"), "", $info);
                    $tab_obs[] = sprintf('new GInfoWindowTab("%s", "%s")', $tab, '<div id=\"gmapmarker\"'.$width_style.'>' . $info . '</div>');
                    $ti++;
                }
                $iw_html = '[' . join(',',$tab_obs) . ']';
            } else {
                $iw_html = sprintf('"%s"',str_replace('"','\"','<div id="gmapmarker">' . str_replace(array("\n", "\r"), "", $_marker['html']) . '</div>'));
            }
            $_output .= sprintf('var point = new GLatLng(%s,%s);',$_marker['lat'],$_marker['lon']) . "\n";         
            $_output .= sprintf('var marker = createMarker(point,"%s",%s, %s,"%s");',
                                str_replace('"','\"',$_marker['title']),
                                str_replace('/','\/',$iw_html),
                                $i,
                                str_replace('"','\"',$_marker['tooltip'])) . "\n";
            //TODO: in above createMarker call, pass the index of the tab in which to put directions, if applicable
            $_output .= 'map.addOverlay(marker);' . "\n";
            $i++;
        }
        return $_output;
    }

    
    function getPolylineJS() {
        $_output = '';
        foreach($this->_polylines as $_polyline) {
            $_output .= sprintf('var polyline = new GPolyline([new GLatLng(%s,%s),new GLatLng(%s,%s)],"%s",%s,%s);',
                    $_polyline['lat1'],$_polyline['lon1'],$_polyline['lat2'],$_polyline['lon2'],$_polyline['color'],$_polyline['weight'],$_polyline['opacity'] / 100.0) . "\n";
            $_output .= 'map.addOverlay(polyline);' . "\n";
        }
        return $_output;
    }

    
    function ClearM($data){
       $ss= '<script>function clearMap(){ map.clearOverlays(); }</script>';
       return $ss;
    }

            function distance($lat1, $lng1, $lat2, $lng2, $miles = true)
        {
                $pi80 = M_PI / 180;
                $lat1 *= $pi80;
                $lng1 *= $pi80;
                $lat2 *= $pi80;
                $lng2 *= $pi80;

                $r = 6372.797; // mean radius of Earth in km
                $dlat = $lat2 - $lat1;
                $dlng = $lng2 - $lng1;
                $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
                $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                $km = $r * $c;

                return ($miles ? ($km * 0.621371192) : $km);
        }

 function lat($dd){
 

$s=substr($dd,0,2);

$e=substr($dd,2,7);

$g=$e/60;

$sur="-".($s+$g);

return $sur;
}
function lon($dd){

$ss=substr($dd,0,3);

$ee=substr($dd,3,7);

$gg=$ee/60;

$w="-".($ss+$gg);

return $w;
}
function appmain(){
    $ss="<script> function gbelmm(r){";
$ss.="var op=opckek2 ; if (!op){ var op2=opckek ;}
cambiartiempo(document.getElementById(\"delay\").selectedIndex);
";
//$ss.="for (var oo=0;oo<12;oo++){";
$ss.=" for (var iii=0;iii<sw;iii++){\n
var cont=cont2[contg];
var tot=total[contg];
var color=dame_color_aleatorio();
if (sw<2)op=true;";

$ss.="Concurrent.Thread.create(mostrar,contg,cont,tot,op,color);\n \n cont2[iii]++;";
$ss.="}\n }</script>";
    return $ss;
}
function despliega(){
           $ss.="\n\n<script>function mostrar(sss,cc,tt,li,color){";
       $ss.=" \n  var mark=[]; var ss=sss; for (iu=0;iu<tt;iu++){\n if (swg[ss]==1){\n";
//for (iu=0;iu<tt;iu++){\n";
$ss.="if (cc>0){\n";
 $ss.="var lati=lat[ss][cc-1];var longg=lng[ss][cc-1];var lati2=lat[ss][cc];var long2=lng[ss][cc];\n";


        $ss.="if (li){var color=color;var polyline = new GPolyline([
  		  new GLatLng(lati, longg),
  		  new GLatLng(lati2, long2)
		],color, 5);";
		$ss.="map.addOverlay(polyline);}";
                $ss.="var d=direccion(point[ss][cc]);}";

       
        $ss.="Direcc[cc] ='<b>Direccion: </b>'+d+'<br>';\n
         var h=hora[ss][cc].replace(/<\/b>/g, '').replace(/<b>/g, '').replace(/<\/br>/g, '').replace(/<br>/g, '');
        var p=pat[ss][cc].replace(/<\/b>/g, '').replace(/<b>/g, '').replace(/<\/br>/g, '').replace(/<br>/g, '');
          var toltip= p\n+h+'  Click para mas info.';";
       $ss.="var marker= createMarker(point[ss][cc], 'Informacion','<div>'+pat[ss][cc]+mar[ss][cc]+mod[ss][cc]+hora[ss][cc]+fech[ss][cc]+vel[ss][cc]+Direcc[cc]+recorrido[ss][cc]+'<\/div>', cc,toltip);\n";
        $ss.="gmarkers[kkg]=marker;mark.push(kkg);kkg++; \n if (cc>0) map.removeOverlay(gmarkers[mark[mark.length-2]]);\n  map.addOverlay(marker);\n";
       $ss.= "if (cc==0){map.setCenter(new GLatLng(lat[ss][cc],lng[ss][cc]), 12, G_NORMAL_MAP);} \n ";
        //$ss.="map.openInfoWindow(point[ss][cc], '<div>'+pat[ss][cc]+mar[ss][cc]+mod[ss][cc]+hora[ss][cc]+fech[ss][cc]+vel[ss][cc]+Direcc[cc]+recorrido[ss][cc]+'<\/div>');";

       
      $ss.="cc++; \n \n   if (delay>0){Concurrent.Thread.sleep (delay);}else {Concurrent.Thread.cancel;}\n";
      $ss.="}else {return false;}}}</script>";
       return $ss;
}
function GetNewLoad(){
           
       $ss="<script>";
        	$ss.="function getnewload(fecha){\n";
                $ss.="for(var y=0;y<contg;y++){ swg[y]=0;for (var i=0;i<total[y];i++){\n";
                       $ss.="point[y][i]=\"\";\n";
                       $ss.="pat[y][i]=\"\";\n";

                       $ss.="mod[y][i]=\"\";\n";
                       $ss.="mar[y][i]=\"\";\n";
                       $ss.="hora[y][i]=\"\";\n";
                       $ss.="pat[y][i]=\"\";\n";
                       $ss.="vel[y][i]=\"\";\n";
                       $ss.="Direcc[y][i]=\"\";\n";
                       

                         $ss.="cont2[y]=\"\";total[i]=\"\";}}\n";
                $ss.=";gmarkers=[];var fecha2=document.getElementById('dp-normal-1').value;if (fecha2!=\"\"){\n";
                $ss.=" var hora2=document.getElementById('hora').options[document.getElementById('hora').selectedIndex ].text+':'+document.getElementById('min').options[document.getElementById('min').selectedIndex ].text+':'+document.getElementById('seg').options[document.getElementById('seg').selectedIndex ].text;\n";
                $ss.="var op=opckek2 ; if (!op){ var op2=opckek ;}\n";
                $ss.="var pate=0;if (op) { var pate=document.getElementById('d').options[document.getElementById('d').selectedIndex ].text}\n";
                $user=$_SESSION["cod"];
		    $ss.="var urlstr='run.php?fecha='+fecha2+'&hora='+hora2+'&idv='+pate+'&iduser=\'".$user."\'';\n";
		    $ss.="var request = GXmlHttp.create();\n";
		    $ss.="request.open('GET', urlstr , true);\n";	// request XML from PHP with AJAX call
		    $ss.="request.onreadystatechange = function () {\n";
				$ss.="if (request.readyState == 4) {\n";
					$ss.="var xmlDoc = request.responseXML;\n";
					$ss.="locations = xmlDoc.documentElement.getElementsByTagName('location');\n";
					$ss.="markers = [];cont=0;clearMap('jj');";
                                        $ss.="if (locations.length==0){alert('No hay datos en este Dia o Hora!!');}\n";
                                        
					$ss.="sw=0;var data=\"\";var ii=0;if (locations.length){";
                                                $ss.="cont2[contg]=0;recorrido[sw]=new Array();vel[sw]=new Array();hora[sw]=new Array();fech[sw]=new Array();mod[sw]=new Array();mar[sw]=new Array();lat[sw]=new Array();lng[sw]=new Array();point[sw]=new Array();pat[sw]=new Array();";
						$ss.="for (var io = 0; io < locations.length; io++) {\n"; // cycle thru locations
                                                $ss.="var dat=locations[io].getAttribute('id');if (sw==0){ data=locations[io].getAttribute('id');swg[contg]=1;sw=1;}";
                                                $ss.=" if(data==dat){}else{cont2[contg]=0;ii=0;recorrido[contg]=new Array();vel[contg]=new Array();hora[contg]=new Array();fech[contg]=new Array();mod[contg]=new Array();mar[contg]=new Array();lat[contg]=new Array();lng[contg]=new Array();point[contg]=new Array();pat[contg]=new Array();data=locations[io].getAttribute('id');sw=sw+1; contg++;swg[contg]=1;}";
                                                $ss.="rr=sw-1;lat[contg][ii]=(locations[io].getAttribute('lat'));";
                                                $ss.="total[contg]=ii+1;lng[sw-1][ii]=locations[io].getAttribute('lng');";
                                                $ss.="point[contg][ii]= new GLatLng(locations[io].getAttribute('lat'),locations[io].getAttribute('lng'));\n";
                                                $ss.="pat[contg][ii]='<b>Patente: </b>'+locations[io].getAttribute('patente')+'<br>';\n";
                                                $ss.="mar[contg][ii]=' <b>Marca: </b>'+locations[io].getAttribute('marca')+'<br>';\n";
                                                $ss.="mod[contg][ii]=' <b>Modelo </b>'+locations[io].getAttribute('modelo')+'<br>';\n";
                                                $ss.="fech[contg][ii]=' <b>Fecha: </b>'+locations[io].getAttribute('fecha')+'<br>';\n";
                                                $ss.="hora[contg][ii]=' <b>Hora: </b>'+locations[io].getAttribute('hora')+'<br>';\n";
                                                $ss.="vel[contg][ii]=' <b>Velocidad: </b>'+locations[io].getAttribute('velocidad')+' km/h<br>';\n";
                                                
                                                $ss.="recorrido[contg][ii]=' <b>Kilometros Recorridos: </b>'+locations[io].getAttribute('dist')+'<br>';\n";
                                                
                                                $ss.="ii++;tiemporecorrido=locations[io].getAttribute('dist');\n";
                                                
						$ss.="}";
                                                $ss.="cont=0;dir=null;var t=setTimeout(\"gbelmm();\", 2500);";
                                              //  $ss.="var d=direccion(point[cont]);";
                                                $ss.= "\n";
					$ss.="}";
                                        $ss.= "\n";
				$ss.="}";
                                $ss.= "\n";
			$ss.="}";
                        $ss.= "\n";
			$ss.="request.send(null);}else{clearTimeout(t);alert(\"Ingrese Fecha!\");}";
	    $ss.="}";


$ss.="</script>";
  return $ss;
}

function getCreateMarkerJS() {
        $_output = 'function createMarker(point, title, html, n, tooltip) {' . "\n";
        $_output .= 'if(n >= '. sizeof($this->_icons) .') { n = '. (sizeof($this->_icons) - 1) ."; }\n";
        if(!empty($this->_icons)) {
            $_output .= 'var marker = new GMarker(point,{\'icon\': icon[n], \'title\': tooltip});' . "\n";
        } else {
            $_output .= 'var marker = new GMarker(point,{\'title\': tooltip});' . "\n";
        }
        if($this->directions) {
            $_output .= 'var tabFlag = isArray(html);' . "\n";
            $_output .= 'if(!tabFlag) { html = [{"contentElem": html}]; }' . "\n";
            $_output .= sprintf(
                     "to_htmls[counter] = html[0].contentElem + '<form class=\"gmapDir\" id=\"gmapDirTo\" style=\"white-space: nowrap;\" action=\"http://maps.google.com/maps\" method=\"get\" target=\"_blank\">' +
                     '<span class=\"gmapDirHead\" id=\"gmapDirHeadTo\">%s<strong>%s</strong> - <a href=\"javascript:fromhere(' + counter + ')\">%s</a></span>' +
                     '<p class=\"gmapDirItem\" id=\"gmapDirItemTo\"><label for=\"gmapDirSaddr\" class=\"gmapDirLabel\" id=\"gmapDirLabelTo\">%s<br /></label>' +
                     '<input type=\"text\" size=\"40\" maxlength=\"40\" name=\"saddr\" class=\"gmapTextBox\" id=\"gmapDirSaddr\" value=\"\" onfocus=\"this.style.backgroundColor = \'#e0e0e0\';\" onblur=\"this.style.backgroundColor = \'#ffffff\';\" />' +
                     '<span class=\"gmapDirBtns\" id=\"gmapDirBtnsTo\"><input value=\"%s\" type=\"%s\" class=\"gmapDirButton\" id=\"gmapDirButtonTo\" /></span></p>' +
                     '<input type=\"hidden\" name=\"daddr\" value=\"' +
                     point.y + ',' + point.x + \"(\" + title.replace(new RegExp(/\"/g),'&quot;') + \")\" + '\" /></form>';
                      from_htmls[counter] = html[0].contentElem + '<p /><form class=\"gmapDir\" id=\"gmapDirFrom\" style=\"white-space: nowrap;\" action=\"http://maps.google.com/maps\" method=\"get\" target=\"_blank\">' +
                     '<span class=\"gmapDirHead\" id=\"gmapDirHeadFrom\">%s<a href=\"javascript:tohere(' + counter + ')\">%s</a> - <strong>%s</strong></span>' +
                     '<p class=\"gmapDirItem\" id=\"gmapDirItemFrom\"><label for=\"gmapDirSaddr\" class=\"gmapDirLabel\" id=\"gmapDirLabelFrom\">%s<br /></label>' +
                     '<input type=\"text\" size=\"40\" maxlength=\"40\" name=\"daddr\" class=\"gmapTextBox\" id=\"gmapDirSaddr\" value=\"\" onfocus=\"this.style.backgroundColor = \'#e0e0e0\';\" onblur=\"this.style.backgroundColor = \'#ffffff\';\" />' +
                     '<span class=\"gmapDirBtns\" id=\"gmapDirBtnsFrom\"><input value=\"%s\" type=\"%s\" class=\"gmapDirButton\" id=\"gmapDirButtonFrom\" /></span></p>' +
                     '<input type=\"hidden\" name=\"saddr\" value=\"' +
                     point.y + ',' + point.x + encodeURIComponent(\"(\" + title.replace(new RegExp(/\"/g),'&quot;') + \")\") + '\" /></form>';
                     html[0].contentElem = html[0].contentElem + '<p /><div id=\"gmapDirHead\" class=\"gmapDir\" style=\"white-space: nowrap;\">%s<a href=\"javascript:tohere(' + counter + ')\">%s</a> - <a href=\"javascript:fromhere(' + counter + ')\">%s</a></div>';\n",
                     $this->driving_dir_text['dir_text'],
                     $this->driving_dir_text['dir_tohere'],
                     $this->driving_dir_text['dir_fromhere'],
                     $this->driving_dir_text['dir_to'],
                     $this->driving_dir_text['to_button_value'],
                     $this->driving_dir_text['to_button_type'],
                     $this->driving_dir_text['dir_text'],
                     $this->driving_dir_text['dir_tohere'],
                     $this->driving_dir_text['dir_fromhere'],
                     $this->driving_dir_text['dir_from'],
                     $this->driving_dir_text['from_button_value'],
                     $this->driving_dir_text['from_button_type'],
                     $this->driving_dir_text['dir_text'],
                     $this->driving_dir_text['dir_tohere'],
                     $this->driving_dir_text['dir_fromhere']
                    );
            $_output .= 'if(!tabFlag) { html = html[0].contentElem; }';
        }
        
        if($this->info_window) {

				$_output .='gmarkers22[tutu] = marker;
				gaddress[tutu] = "";
				gcomentarios[tutu] = "";
				glistas[tutu] = ""; //a las pocisiones impares le sumamos el maximo label que habia antes de cargar
				gtipos[tutu] = 3;
				gstatus[tutu] = 0;
				glabels[tutu] = lastLabel++;
				tutu++;';


 
            
     $_output .= sprintf('if(isArray(html)) { GEvent.addListener(marker, "%s", function() { marker.openInfoWindowTabsHtml(html);}); }',$this->window_trigger) . "\n";
            $_output .= sprintf('else { GEvent.addListener(marker, "%s", function() { marker.openInfoWindowHtml(html); }); }',$this->window_trigger) . "\n";
         
            

        }
        $_output .= 'points[counter] = point;' . "\n";
        $_output .= 'markers[counter] = marker;' . "\n";
        if($this->sidebar) {        
            $_output .= 'marker_html[counter] = html;' . "\n";
            $_output .= "sidebar_html += '<li class=\"gmapSidebarItem\" id=\"gmapSidebarItem_'+ counter +'\"><a href=\"javascript:click_sidebar(' + counter + ')\">' + title + '<\/a><\/li>';" . "\n";
        }
        $_output .= 'counter++;' . "\n";
        $_output .= 'return marker;' . "\n";
        $_output .= '}' . "\n";
        return $_output;
    }

    /**
     * print map (put at location map will appear)
     * 
     */
    function printMap() {
        echo $this->getMap();
    }

    /**
     * return map
     * 
     */
    function getMap() {
        $_output = '<script type="text/javascript" charset="utf-8">' . "\n" . '//<![CDATA[' . "\n";
        $_output .= 'if (GBrowserIsCompatible()) {' . "\n";
        if(strlen($this->width) > 0 && strlen($this->height) > 0) {
            $_output .= sprintf('document.write(\'<div id="%s" style="width: %s; height: %s"><\/div>\');',$this->map_id,$this->width,$this->height) . "\n";
        } else {
            $_output .= sprintf('document.write(\'<div id="%s"><\/div>\');',$this->map_id) . "\n";     
        }
        $_output .= '}';

        if(!empty($this->js_alert)) {
            $_output .= ' else {' . "\n";
            $_output .= sprintf('document.write(\'%s\');', str_replace('/','\/',$this->js_alert)) . "\n";
            $_output .= '}' . "\n";
        }

        $_output .= '//]]>' . "\n" . '</script>' . "\n";

        if(!empty($this->js_alert)) {
            $_output .= '<noscript>' . $this->js_alert . '</noscript>' . "\n";
        }

        return $_output;
    }

    
  
    function printSidebar() {
        echo $this->getSidebar();
    }    

  
    function getSidebar() {
        return sprintf('<div id="%s"></div>',$this->sidebar_id) . "\n";
    }    
            
  
    function getGeocode($address) {
        if(empty($address))
            return false;

        $_geocode = false;

        if(($_geocode = $this->getCache($address)) === false) {
            if(($_geocode = $this->geoGetCoords($address)) !== false) {
                $this->putCache($address, $_geocode['lon'], $_geocode['lat']);
            }
        }
        
        return $_geocode;
    }
   
    function geoGetCoords($address,$depth=0) {
        
        switch($this->lookup_service) {
                        
            case 'GOOGLE':
                
                $_url = sprintf('http://%s/maps/geo?&q=%s&output=csv&key=%s',$this->lookup_server['GOOGLE'],rawurlencode($address),$this->api_key);

                $_result = false;
                
                if($_result = $this->fetchURL($_url)) {

                    $_result_parts = explode(',',$_result);
                    if($_result_parts[0] != 200)
                        return false;
                    $_coords['lat'] = $_result_parts[2];
                    $_coords['lon'] = $_result_parts[3];
                }
                
                break;
            
            case 'YAHOO':
            default:
                        
                $_url = 'http://%s/MapsService/V1/geocode';
                $_url .= sprintf('?appid=%s&location=%s',$this->lookup_server['YAHOO'],$this->app_id,rawurlencode($address));

                $_result = false;

                if($_result = $this->fetchURL($_url)) {

                    preg_match('!<Latitude>(.*)</Latitude><Longitude>(.*)</Longitude>!U', $_result, $_match);

                    $_coords['lon'] = $_match[2];
                    $_coords['lat'] = $_match[1];

                }
                
                break;
        }         
        
        return $_coords;       
    }
    
    

    function fetchURL($url) {
	
        return file_get_contents($url);
        

    }

      


}

?>
