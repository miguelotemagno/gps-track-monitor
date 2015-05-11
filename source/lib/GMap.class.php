<?php

// Make GMap independent from symfony
if (!class_exists('GMapBounds', true))
{
  require_once(dirname(__FILE__).'/GMapBounds.class.php');
}
if (!class_exists('GMapClient', true))
{
  require_once(dirname(__FILE__).'/GMapClient.class.php');
}
if (!class_exists('GMapCoord', true))
{
  require_once(dirname(__FILE__).'/GMapCoord.class.php');
}
if (!class_exists('GMapEvent', true))
{
  require_once(dirname(__FILE__).'/GMapEvent.class.php');
}
if (!class_exists('GMapGeocodedAddress', true))
{
  require_once(dirname(__FILE__).'/GMapGeocodedAddress.class.php');
}
if (!class_exists('GMapIcon', true))
{
  require_once(dirname(__FILE__).'/GMapIcon.class.php');
}
if (!class_exists('GMapMarkerImage', true))
{
  require_once(dirname(__FILE__).'/GMapMarkerImage.class.php');
}
if (!class_exists('GMapMarker', true))
{
  require_once(dirname(__FILE__).'/GMapMarker.class.php');
}


if (!class_exists('GMapDirection', true))
{

  require_once(dirname(__FILE__).'/GMapDirection.class.php');
}
if (!class_exists('GMapDirectionWaypoint', true))
{

  require_once(dirname(__FILE__).'/GMapDirectionWaypoint.class.php');
}

if (!class_exists('RenderTag', true))
{
  require_once(dirname(__FILE__).'/external/RenderTag.class.php');
}

/**
 * Google Map class
 * @author Fabrice Bernhard
 *
 */

class GMap
{

  protected $options = array(
    // boolean  If true, do not clear the contents of the Map div.  
    'noClear ' => null,
    // string Color used for the background of the Map div. This color will be visible when tiles have not yet loaded as a user pans.  
    'backgroundColor' => null,
    // string The name or url of the cursor to display on a draggable object.  
    'draggableCursor' => null,
    // string The name or url of the cursor to display when an object is dragging.  
    'draggingCursor' => null,
    // boolean If false, prevents the map from being dragged. Dragging is enabled by default.  
    'draggable' => null,
    // boolean If true, enables scrollwheel zooming on the map. The scrollwheel is disabled by default.  
    'scrollwheel' => null,
    // boolean If false, prevents the map from being controlled by the keyboard. Keyboard shortcuts are enabled by default.  
    'keyboardShortcuts' => null,
    // LatLng The initial Map center. Required.  
    'center' => null,
    // number The initial Map zoom level. Required.  
    'zoom' => null,
    // string The initial Map mapTypeId. Required.  
    'mapTypeId' => 'google.maps.MapTypeId.ROADMAP',
    // boolean Enables/disables all default UI. May be overridden individually.  
    'disableDefaultUI' => null,
    // boolean The initial enabled/disabled state of the Map type control.  
    'mapTypeControl' => null,
    // MapTypeControl options The initial display options for the Map type control.  
    'mapTypeControlOptions' => 'google.maps.MapTypeControlStyle.DROPDOWN_MENU',
    // boolean The initial enabled/disabled state of the scale control.  
    'scaleControl' => null,
    // ScaleControl options The initial display options for the scale control.  
    'scaleControlOptions' => null,
    // boolean The initial enabled/disabled state of the navigation control.  
    'navigationControl' => null,
    // NavigationControl options The initial display options for the navigation control.  
    'navigationControlOptions' => null
  );
  
  protected $parameters = array(
      'js_name' => 'map',
      'onload_method' => 'js'
  );

  // id of the Google Map div container
  protected $container_attributes = array(
  		'id' =>'map'
  );
  
  // style of the container
  protected $container_style=array(
    'width'=>'512px',
    'height'=>'512px'
  );

  // objects linked to the map
  protected $icons=array();
  protected $markers=array();
  protected $events=array();
protected $directions=array();
  // customise the javascript generated
  protected $after_init_js=array();
  protected $global_variables=array();

  // the interface to the Google Maps API web service
  protected $gMapClient = false;

  /**
   * Constructs a Google Map PHP object
   *
   * @param array $options
   * @param array $attributes
   */
  public function __construct($options=array(), $container_style=array(), $container_attributes=array(), $parameters=array())
  {
    $this->setOptions($options);
    $this->setContainerAttributes($container_attributes);
    $this->setContainerStyles($container_style);
    $this->setParameters($parameters);
    
    // delcare the Google Map Javascript object as global
    $this->addGlobalVariable($this->getJsName(),'null');

  }
  /**
   * Defines the style of the Google Map div
   * @param array $style Associative array with the style of the div container
   */
  public function setContainerStyles($container_style)
  {
    $this->container_style = array_merge($this->container_style,$container_style);
  }
  /**
   * Gets the style Array of the div container
   */
  public function getContainerStyles()
  {

    return $this->container_style;
  }
  /**
   * Defines the attributes of the Google Map div
   * @param array $container_attributes Associative array with the attributes of the div container
   * @author fabriceb
   * @since 2009-08-21
   */
  public function setContainerAttributes($container_attributes)
  {
    $this->container_attributes = array_merge($this->container_attributes,$container_attributes);
  }
  /**
   * Gets the attributes array of the div container
   * @author fabriceb
   * @since 2009-08-21
   */
  public function getContainerAttributes()
  {

    return $this->container_attributes;
  }
  /**
   * @param array $options
   * @author fabriceb
   * @since 2009-08-21
   */
  public function setOptions($options)
  {
    $this->options = array_merge($this->options,$options);
  }
  /**
   * @return array $options
   * @author fabriceb
   * @since 2009-08-21
   */
  public function getOptions()
  {

    return $this->options;
  }
  /**
   * @param array $parameters
   * @author fabriceb
   * @since 2009-08-21
   */
  public function setParameters($parameters)
  {
    $this->parameters = array_merge($this->parameters,$parameters);
  }
  /**
   * @return array $parameters
   * @author fabriceb
   * @since 2009-08-21
   */
  public function getParameters()
  {

    return $this->parameters;
  }
  /**
   * @param string $name
   * @param mixed $value
   * @author fabriceb
   * @since 2009-08-21
   */
  public function setParameter($name, $value)
  {
    $this->parameter[$name] = $value;
  }
  /**
   * @return mixed $value
   * @author fabriceb
   * @since 2009-08-21
   */
  public function getParameter()
  {

    return $this->parameter[$name];
  }
  /**
   * gets an instance of the interface to the Google Map web geocoding service
   *
   * @return GMapClient
   * @author fabriceb
   * @since 2009-06-17
   */
  public function getGMapClient()
  {
    if ($this->gMapClient===false)
    {
      $this->gMapClient = new GMapClient();
    }

    return $this->gMapClient;
  }

  /**
   * sets an instance of the interface to the Google Map web geocoding service
   *
   * @param GMapClient
   * @author fabriceb
   * @since 2009-06-17
   */
  public function setGMapClient($gMapClient)
  {
    $this->gMapClient = $gMapClient;
  }


  /**
   * Geocodes an address
   * @param string $address
   * @return GMapGeocodedAddress
   * @author Fabrice Bernhard
   */
  public function geocode($address)
  {
    $address = trim($address);

    $gMapGeocodedAddress = new GMapGeocodedAddress($address);
    $accuracy = $gMapGeocodedAddress->geocode($this->getGMapClient());

    if ($accuracy)
    {
      return $gMapGeocodedAddress;
    }

    return null;
  }

  /**
   * Geocodes an address and returns additional normalized information
   * @param string $address
   * @return GMapGeocodedAddress
   * @author Fabrice Bernhard
   */
  public function geocodeXml($address)
  {
    $address = trim($address);

    $gMapGeocodedAddress = new GMapGeocodedAddress($address);
    $gMapGeocodedAddress->geocodeXml($this->getGMapClient());

    return $gMapGeocodedAddress;
  }

  /**
   * @return string $this->options['js_name'] Javascript name of the googlemap
   */
  public function getJsName()
  {

    return $this->parameters['js_name'];
  }

  /**
   * Defines one style of the div container
   * @param string $style_tag name of css tag
   * @param string $style_value value of css tag
   */
  public function setContainerStyle($style_tag,$style_value)
  {
    $this->container_style[$style_tag]=$style_value;
  }
  /*
   * Gets one style of the Google Map div
   * @param string $style_tag name of css tag
   */
  public function getContainerStyle($style_tag)
  {

    return $this->container_style[$style_tag];
  }

  public function getContainerId()
  {

    return $this->container_attributes['id'];
  }

  /**
   * returns the Html for the Google map container
   * @param Array $options Style options of the HTML container
   * @return string $container
   * @author Fabrice Bernhard
   */
  public function getContainer($styles=array(),$attributes=array())
  {
    $this->container_style = array_merge($this->container_style,$styles);
    $this->container_attributes = array_merge($this->container_attributes,$attributes);

    $style="";
    foreach ($this->container_style as $tag=>$val)
    {
      $style.=$tag.":".$val.";";
    }

    $attributes = $this->container_attributes;
    $attributes['style'] = $style;

    return RenderTag::renderContent('div',null,$attributes);
  }
  
  /**
   * 
   * @return string
   * @author fabriceb
   * @since 2009-08-20
   */
  public function optionsToJs()
  {
  	$options_array = array();
  	foreach($this->options as $name => $value)
  	{
  	  if (!is_null($value))
  	  {
  	  	switch($name)
  	  	{
  	  	  case 'navigationControlOptions':
  	      case 'scaleControlOptions':
  	      case 'mapTypeControlOptions':
  	      	$options_array[] = $name.': {style: '.$value.'}';
  	      	break;
  	      case 'center':
  	      	$options_array[] = $name.': '.$value->toJs();
  	      	break;
  	      default:
  	      	$options_array[] = $name.': '.$value;
  	      	break;
  	  	}
  	  }
  	}
  	$tab = '  ';
  	$separator = "\n".$tab.$tab;
  	
  	return '{'.$separator.$tab.implode(','.$separator.$tab, $options_array).$separator.',

navigationControl: true,
    navigationControlOptions: {
        style: google.maps.NavigationControlStyle.ZOOM_PAN,
        position: google.maps.ControlPosition.TOP_RIGHT
    }
    }';
  }
  
  public function getOnloadJs()
  {
  	switch ($this->parameters['onload_method'])
  	{
  	  case 'jQuery':
  	  	return 'jQuery(document).ready(function(){initialize();});';
  	  	break;
  	  default:
  	  case 'js':
  	  	return 'window.onload = function(){initialize()};';
  	  	break;
  	}
  }

  /**
   * Returns the Javascript for the Google map
   * @param Array $options
   * @return $string
   * @author Fabrice Bernhard
   * @since 2009-08-21 fabriceb v3
   */
  public function getJavascript()
  {
    if (class_exists('sfContext'))
    {
      sfContext::getInstance()->getResponse()->addJavascript($this->getGoogleJsUrl());
    }


    $return ='';
    $init_events = array();
    $init_events[] = 'geocoder = new google.maps.Geocoder();
 var infowindow = new google.maps.InfoWindow();

 elevationService = new google.maps.ElevationService();
 GDir1=new google.maps.DirectionsService();
 GDir2=new google.maps.DirectionsService();
directionsService = new google.maps.DirectionsService();
directionsService2 = new google.maps.DirectionsService();


var mapOptions = '.$this->optionsToJs().';';
    $init_events[] = $this->getJsName().' = new google.maps.Map($(\'#map\')[0], mapOptions);';

    // add some more events
    $init_events[] = $this->getEventsJs();
    $init_events[] = $this->getIconsJs();
    $init_events[] = $this->getMarkersJs();
        $init_events[] = $this->getDirectionsJs();

    foreach ($this->after_init_js as $after_init)
    {
      $init_events[] = $after_init;
    }

    foreach($this->global_variables as $name=>$value)
    {
      $return .= '
  var '.$name.' = '.$value.';';
    }
    $return .= '
  //  Call this function when the page has been loaded
  function initialize()
  {';
  $return.='   google.maps.Map.prototype.markers = new Array();
     google.maps.Map.prototype.addMarker = function(marker) {
    this.markers[this.markers.length] = marker;
  };';

    foreach($init_events as $init_event)
    {
      if ($init_event)
      {
        $return .= '
    '.$init_event;
      }
    }
    $return .= '
  }
';
    $return .= $this->getOnloadJs()."\n";

$r.='var infowindow;
function createMarker(name,latlng) {';
$r.="\n
    var autoicono = new google.maps.MarkerImage('images/auto.png',
new google.maps.Size(100,50),
new google.maps.Point(0,0),
new google.maps.Point(50,50)
);
";
  $r.='var marker = new google.maps.Marker({position: latlng, map: map,icon: autoicono});;';
  $r.="\n";
   $r.=' google.maps.event.addListener(marker, "click", function() {';
   $r.="\n";
     $r.=' if (infowindow) infowindow.close();';
     $r.="\n";
      $r.='infowindow = new google.maps.InfoWindow({content: name});';
      $r.="\n";
      $r.='infowindow.open(map, marker);';
      $r.="\n";
    $r.='});';
    $r.='return marker;';
  $r.='}';
  $r.="\n";
  $r.="\n";
  $return.=$r;
    return $return;
  }

  /**
   * returns the URLS for the google map Javascript file
   * @return string $js_url
   */
  public function getGoogleJsUrl($auto_load = true)
  {

    return $this->getGMapClient()->getGoogleJsUrl($auto_load);
  }

  /**
   * Adds an icon to be loaded
   * @param GMapIcon $icon A google Map Icon
   */
  public function addIcon($icon)
  {
    $this->icons[$icon->getName()] = $icon;
  }

  /**
   * returns the GMapIcon corresponding to a name
   *
   * @param string $name
   * @return GMapIcon
   *
   * @author Vincent
   * @since 2008-12-02
   */
  public function getIconByName($name)
  {

    return $this->icons[$name];
  }

  /**
   * @param GMapMarker $marker a marker to be put on the map
   */
  public function addMarker($marker)
  {
    array_push($this->markers,$marker);
  }
  /**
   * @param GMapMarker[] $markers marker to be put on the map
   */
  public function setMarkers($markers)
  {
    $this->markers = $markers;
  }
  /**
   * @param GMapEvent $event an event to be attached to the map
   */
  public function addEvent($event)
  {
    array_push($this->events,$event);
  }

  /**
   * checks which markers have special icons and binds these icons to the map
   * 
   * @return void
   */
  public function loadMarkerIcons()
  {
    foreach($this->markers as $marker)
    {
      if ($marker->getIcon() instanceof GMapIcon)
      {
        $this->addIcon($marker->getIcon());
      }
    }
  }
  /**
   * Returns the javascript string which defines the icons
   * @return string
   */
  public function getIconsJs()
  {
  	$this->loadMarkerIcons();
    $return = '';
    foreach ($this->icons as $icon)
    {
      $return .= $icon->getIconJs();
    }

    return $return;
  }
  /**
   * Returns the javascript string which defines the markers
   * @return string
   */
  public function getMarkersJs()
  {
    $return = '';
    foreach ($this->markers as $marker)
    {
      $return .= $marker->toJs($this->getJsName());
      $return .= "\n      ";
    }

    return $return;
  }

  /*
   * Returns the javascript string which defines events linked to the map
   * @return string
   */
  public function getEventsJs()
  {
    $return = '';
    foreach ($this->events as $event)
    {
      $return .= $event->getEventJs($this->getJsName());
      $return .= "\n";
    }
    
    return $return;
  }

  /*
   * Gets the Code to execute after Js initialization
   * @return string $after_init_js
   */
  public function getAfterInitJs()
  {
    return $this->after_init_js;
  }
  /*
   * Sets the Code to execute after Js initialization
   * @param string $after_init_js Code to execute
   */
  public function addAfterInitJs($after_init_js)
  {
    array_push($this->after_init_js,$after_init_js);
  }

  public function addGlobalVariable($name, $value='null')
  {
    $this->global_variables[$name] = $value;
  }
  
  /**
   * 
   * @param string $name
   * @return mixed
   * @author fabriceb
   * @since 2009-08-21
   */
  public function getOption($name)
  {
  	
  	return $this->options[$name];
  }
  
  /**
   * 
   * @param string $name
   * @param mixed $value
   * @return void
   * @author fabriceb
   * @since 2009-08-21
   */
  public function setOption($name, $value)
  {
  	$this->options[$name] = $value;
  }
  
  /**
   * 
   * @return integer $zoom
   */
  public function getZoom()
  {

    return $this->getOption('zoom');
  }
  
  /**
   * 
   * @param integer $zoom
   * @return void
   */
  public function setZoom($zoom)
  {
    $this->setOption('zoom',$zoom);
  }
  
  /**
   * Sets the center of the map at the beginning
   *
   * @param float $lat
   * @param float $lng
   * @since 2009-08-20 fabriceb now everything is in the options array
   */
  public function setCenter($lat=null,$lng=null)
  {
    $this->setOption('center',new GMapCoord($lat, $lng));
  }
  
  /**
   *
   * @return GMapCoord
   * @author fabriceb
   * @since 2009-05-02
   * @since 2009-08-20 fabriceb now everything is in the options array
   */
  public function getCenterCoord()
  {

    return $this->getOption('center');
  }
   /**
   *
   * @return float
   * @author fabriceb
   * @since 2009-05-02
   */
  public function getCenterLat()
  {

    return $this->getCenterCoord()->getLatitude();
  }
    /**
   *
   * @return float
   * @author fabriceb
   * @since 2009-05-02
   */
  public function getCenterLng()
  {
    return $this->getCenterCoord()->getLongitude();
  }


  /**
   * gets the width of the map in pixels according to container style
   * @return integer
   * @author fabriceb
   * @since 2009-05-03
   */
  public function getWidth()
  {
    // percentage or 0px
  	if (substr($this->getContainerStyle('width'),-2,2) != 'px')
  	{
  		
  	  return false;
  	}
  	
    return intval(substr($this->getContainerStyle('width'),0,-2));
  }

  /**
   * gets the width of the map in pixels according to container style
   * @return integer
   * @author fabriceb
   * @since 2009-05-03
   */
  public function getHeight()
  {
  	// percentage or 0px
  	if (substr($this->getContainerStyle('height'),-2,2) != 'px')
  	{
  		
  	  return false;
  	}

    return intval(substr($this->getContainerStyle('height'),0,-2));
  }

  /**
   * sets the width of the map in pixels
   *
   * @param integer
   * @author fabriceb
   * @since 2009-05-03
   */
  public function setWidth($width)
  {
  	if (is_int($width))
  	{
  	  $width = $width.'px';
  	}
    $this->setContainerStyle('width', $width);
  }

  /**
   * sets the width of the map in pixels
   *
   * @param integer
   * @author fabriceb
   * @since 2009-05-03
   */
  public function setHeight($height)
  {
    if (is_int($height))
  	{
  	  $height = $height.'px';
  	}
    $this->setContainerStyle('height',$height);
  }


  /**
   * Returns the URL of a static version of the map (when JavaScript is not active)
   * Supports only markers and basic parameters: center, zoom, size.
   * @param string $map_type = 'mobile'
   * @param string $hl Language (fr, en...)
   * @return string URL of the image
   * @author Laurent Bachelier
   */
  public function getStaticMapUrl($maptype='mobile', $hl='es')
  {
    $params = array(
      'maptype' => $maptype,
      'zoom'    => $this->getZoom(),
      'key'     => $this->getAPIKey(),
      'center'  => $this->getCenterLat().','.$this->getCenterLng(),
      'size'    => $this->getWidth().'x'.$this->getHeight(),
      'hl'      => $hl,
      'markers' => $this->getMarkersStatic()
    );
    $pairs = array();
    foreach($params as $key => $value)
    {
      $pairs[] = $key.'='.$value;
    }

    return 'http://maps.google.com/staticmap?'.implode('&',$pairs);
  }

  /**
   * Returns the static code to create markers
   * @return string
   * @author Laurent Bachelier
   */
  protected function getMarkersStatic()
  {
    $markers_code = array();
    foreach ($this->markers as $marker)
    {
      $markers_code[] = $marker->getMarkerStatic();
    }

    return implode('|',$markers_code);
  }

  /**
   *
   * calculates the center of the markers linked to the map
   *
   * @return GMapCoord
   * @author fabriceb
   * @since 2009-05-02
   */
  public function getMarkersCenterCoord()
  {

    return GMapMarker::getCenterCoord($this->markers);
  }

  /**
   * sets the center of the map at the center of the markers
   *
   * @author fabriceb
   * @since 2009-05-02
   */
  public function centerOnMarkers()
  {
    $center = $this->getMarkersCenterCoord();

    $this->setCenter($center->getLatitude(), $center->getLongitude());
  }

  /**
   *
   * calculates the zoom which fits the markers on the map
   *
   * @param integer $margin a scaling factor around the smallest bound
   * @return integer $zoom
   * @author fabriceb
   * @since 2009-05-02
   */
  public function getMarkersFittingZoom($margin = 0)
  {
    $bounds = GMapBounds::getBoundsContainingMarkers($this->markers, $margin);

    return $bounds->getZoom(min($this->getWidth(),$this->getHeight()));
  }

  /**
   * sets the zoom of the map to fit the markers (uses mercator projection to guess the size in pixels of the bounds)
   * WARNING : this depends on the width in pixels of the resulting map
   *
   * @param integer $margin a scaling factor around the smallest bound
   * @author fabriceb
   * @since 2009-05-02
   */
  public function zoomOnMarkers($margin = 0)
  {
    $this->setZoom($this->getMarkersFittingZoom($margin));
  }

   /**
   * sets the zoom and center of the map to fit the markers (uses mercator projection to guess the size in pixels of the bounds)
   *
   * @param integer $margin a scaling factor around the smallest bound
   * @author fabriceb
   * @since 2009-05-02
   */
  public function centerAndZoomOnMarkers($margin = 0)
  {
    $this->centerOnMarkers();
    $this->zoomOnMarkers($margin);
  }

  /**
   *
   * @return GMapBounds
   * @author fabriceb
   * @since Jun 2, 2009 fabriceb
   */
  public function getBoundsFromCenterAndZoom()
  {

    return GMapBounds::getBoundsFromCenterAndZoom($this->getCenterCoord(),$this->getZoom(),$this->getWidth(),$this->getHeight());
  }
  public function getDirections()
  {

    return $this->directions;
  }

  /**
   * $directions setter
   *
   * @param array $directions
   * @author Vincent Guillon <vincentg@theodo.fr>
   * @since 2009-11-13 17:21:18
   */
  public function setDirections($directions = null)
  {
    $this->directions = $directions;
  }

  /**
   * Add direction to list ($this->directions)
   *
   * @param GMapDirection $directions
   * @author Vincent Guillon <vincentg@theodo.fr>
   * @since 2009-11-20 14:59:55
   */
  public function addDirection($direction = null)
  {
    if (!$direction instanceof GMapDirection)
    {
      throw new sfException('The direction must be an instance of GMapDirection !');
    }

    array_push($this->directions, $direction);
  }

  /**
   * Get the directions javascript code
   *
   * @return string $js_code
   * @author Vincent Guillon <vincentg@theodo.fr>
   * @since 2009-11-20 15:03:00
   */
  public function getDirectionsJs()
  {
    $js_code = '';

    foreach ($this->directions as $direction)
    {
      $js_code .= $direction->toJs($this->getJsName());
      $js_code .= "\n      ";
    }

    return $js_code;
  }
public function getxml(){
    


    $ss.=" var infoWindow = new google.maps.InfoWindow;";


   
$ss.="function searchLocationsNear(tip,date2) {

    var markers = [];delay=-1;

for(var y=0;y<contg;y++){ swg[y]=0;for (var i=0;i<total[y];i++){\n";

                       $ss.="point[y][i]=\"\";\n";
                       $ss.="pat[y][i]=\"\";\n";

                       $ss.="mod[y][i]=\"\";\n";
                       $ss.="mar[y][i]=\"\";\n";
                       $ss.="hora[y][i]=\"\";\n";
                       $ss.="pat[y][i]=\"\";\n";
                       $ss.="vel[y][i]=\"\";\n";
                       $ss.="Direcc[y][i]=\"\";\n";


                         $ss.="cont2[y]=\"\";total[i]=\"\";}}\n";
                $ss.="gmarkers=[];var fecha2='12/10/2008';\n";
                $ss.=" var hora2='18:00';\n";
                $ss.="var op=false; if (!op){ var op2=true ;}\n";
                $ss.="var pate=0;if (op) { var pate=document.getElementById('d').options[document.getElementById('d').selectedIndex ].text}\n";

		    $ss.="var urlstr='controlador/run.php?opt='+tip+'&date2='+date2+'&idv='+pate+'&iduser=0001';\n
   
 var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    };
    
     
     var searchUrl = urlstr;
     downloadUrl(searchUrl, function(data) {
       var xml = parseXml(data);
       var locations = xml.documentElement.getElementsByTagName(\"marker\");
       if (locations.length==0){swg[0]=0;swg[1]=0;swg[2]=0;initd();clearLocations2();return null;}
       var bounds = new google.maps.LatLngBounds();
       sw=0;var data=\"\";var ii=0;clearLocations2();
       cont2[contg]=0;recorrido[sw]=new Array();vel[sw]=new Array();hora[sw]=new Array();fech[sw]=new Array();mod[sw]=new Array();mar[sw]=new Array();lat[sw]=new Array();lng[sw]=new Array();point[sw]=new Array();pat[sw]=new Array();
       for (var io = 0; io < locations.length; io++) {
 var dat=locations[io].getAttribute('id');if (sw==0){ data=locations[io].getAttribute('id');swg[contg]=1;sw=1;}";
$ss.=" if(data==dat){}else{cont2[contg]=0;ii=0;recorrido[contg]=new Array();vel[contg]=new Array();hora[contg]=new Array();fech[contg]=new Array();mod[contg]=new Array();mar[contg]=new Array();lat[contg]=new Array();lng[contg]=new Array();point[contg]=new Array();pat[contg]=new Array();data=locations[io].getAttribute('id');sw=sw+1; contg++;swg[contg]=1;}";
$ss.="rr=sw-1;lat[contg][ii]=(locations[io].getAttribute('lat'));";
$ss.="total[contg]=ii+1;lng[sw-1][ii]=locations[io].getAttribute('lng');";
    $ss.="point[contg][ii]= new google.maps.LatLng(parseFloat(locations[io].getAttribute('lat')),parseFloat(locations[io].getAttribute('lng')));\n";
    $ss.="pat[contg][ii]='<b>Patente: </b>'+locations[io].getAttribute('patente')+'<br>';\n";
    $ss.="mar[contg][ii]=' <b>Marca: </b>'+locations[io].getAttribute('marca')+'<br>';\n";
    $ss.="mod[contg][ii]=' <b>Modelo </b>'+locations[io].getAttribute('modelo')+'<br>';\n";
    $ss.="fech[contg][ii]=' <b>Fecha: </b>'+locations[io].getAttribute('fecha')+'<br>';\n";
    $ss.="hora[contg][ii]=' <b>Hora: </b>'+locations[io].getAttribute('hora')+'<br>';\n";
    $ss.="vel[contg][ii]=' <b>Velocidad: </b>'+locations[io].getAttribute('velocidad')+' km/h<br>';\n";

    $ss.="recorrido[contg][ii]=' <b>Kilometros Recorridos: </b>'+locations[io].getAttribute('dist')+'<br>';\n";

    $ss.="ii++;tiemporecorrido=locations[io].getAttribute('dist');\n";

    $ss.="}";
   $ss.="cont=0;dir=null;var t=setTimeout(\"gbelmm();\", 2500);

var icon = customIcons['bar'] || {};



       

       
       });
      }


    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }


function downloadUrl(url,callback) {
 var request = window.ActiveXObject ?
     new ActiveXObject('Microsoft.XMLHTTP') :
     new XMLHttpRequest;

 request.onreadystatechange = function() {
   if (request.readyState == 4) {
     request.onreadystatechange = doNothing;
     callback(request.responseText, request.status);
   }
 };

 request.open('GET', url, true);
 request.send(null);
}

   function clearLocations2() {
     infoWindow.close();
        if (flightPath) {
      flightPath.setMap(null);
    }
    flightPath=null;
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
     }
     markers.length = 0;

   }
       function parseXml(str) {
      if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
      } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
      }
    }
    map = new google.maps.Map($('#map')[0]);
    function initMapDirs() {
            $('#getDirs').gMapDirections({
                                map: map
                                
                                , close: function() {
                                    $('#getDirs').gMapDirections('destroy');
                                }
                            });
        }


function doNothing() {}
    function createMarker2(latlng, name, address,html,lat,lng) {
      var html = html;
      var latlng2 = new google.maps.LatLng(lat, lng);
        var autoicono = new google.maps.MarkerImage('images/ao2.png',
new google.maps.Size(100,50),
new google.maps.Point(0,0),
new google.maps.Point(50,50)
);
      var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        icon: autoicono
      });
      var lg=latlng;
         var flightPlanCoordinates=[];
             if (flightPath){ var pa = flightPath.getPath();
                   pa.insertAt(pa.length, lg);

       }else{
       var  flightPlanCoordinates = [latlng2,
  		  latlng
	];flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    strokeColor: \"#FF0000\",
    strokeOpacity: 1.0,
    strokeWeight: 6
  });flightPath.setMap(map);}
    
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
      markers.push(marker);
       map.setCenter(latlng);

    }

  function codeLatLng(point,lat,lng,html) {
    
    var lat = lat;
    var lng = lng;
    var latlng = new google.maps.LatLng(lat, lng);
    var infowindow = new google.maps.InfoWindow();

    if (geocoder) {
      geocoder.geocode({'latLng': point}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[1]) {
          clearLocations();
            map.setZoom(15);
            createMarker2(latlng, 'fg', results[1].formatted_address,html,lat,lng)

            //infowindow.setContent(results[1].formatted_address+html);
           //infowindow.open(map, markers);
          }
        } else {
           //clearLocations();
        }
      });
    }
  }
  function clearLocations() {
     infoWindow.close();
  
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
     }
     markers.length = 0;

   }

        
       
";
return $ss;
}
function appmain(){
    $ss="function gbelmm(r){";
$ss.="var op=opckek2 ; if (!op){ var op2=opckek ;}
cambiartiempo(document.getElementById(\"delay\").selectedIndex);
";
//$ss.="for (var oo=0;oo<12;oo++){";
$ss.=" for (var iii=0;iii<sw;iii++){\n
var cont=cont2[contg];
var tot=total[contg];
var color=dame_color_aleatorio();
if (sw<2)op=true;";

//$ss.="mostrar(contg,cont,tot,op,color,flightPath);\n \n cont2[iii]++;";
$ss.="Concurrent.Thread.create(mostrar,contg,cont,tot,op,color);\n \n cont2[iii]++;";
$ss.="}\n }";
    return $ss;
}
function despliega(){
           $ss.="function mostrar(sss,cc,tt,li,color){";
       $ss.=" \n  var mark=[]; var ss=sss; for (iu=0;iu<tt;iu++){\n if (swg[ss]==1){\n";
//for (iu=0;iu<tt;iu++){\n";
$ss.="if (cc>0){\n";
 $ss.="var lati=lat[ss][cc-1];var longg=lng[ss][cc-1];var lati2=lat[ss][cc];var long2=lng[ss][cc];\n";


                $ss.="}";


$ss.="infoWindow.close();
    var html='<div>'+pat[ss][cc]+mar[ss][cc]+mod[ss][cc]+hora[ss][cc]+fech[ss][cc]+vel[ss][cc]+'<\/div>'
if (cc>0) codeLatLng(point[ss][cc],lat[ss][cc-1],lng[ss][cc-1],html); else codeLatLng(point[ss][cc],lat[ss][cc],lng[ss][cc],html);";
      $ss.="cc++; \n \n   if (delay>0){Concurrent.Thread.sleep (delay);}else {Concurrent.Thread.cancel;}\n";
      $ss.="}else {Concurrent.Thread.cancel;return false;}}}";
       return $ss;
}
function rutas(){
$ss="     function crearRuta(val){
        if (val){ if (!swadd && markersArray.length>0){
                swadd=true;markersArray = [];}else{swadd=true;
                

google.maps.event.trigger(map, \"resize\");
       google.maps.event.addListener(map, 'click', function(event) {
      addMarker2(event.latLng, true);
    });}

   }else { swadd=false;

    }
    }
function addMarker2(latlng, doQuery) {
if (swadd){
if (markersArray.length <10) {

      var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        draggable: true
      })

      google.maps.event.addListener(marker, 'dragend', function(e) {
        updateElevation();
      });

   markersArray.push(marker);

      if (doQuery) {
        updateElevation();
      }

}else {
      alert(\"No se pueden crear mas puntos\");
    }


  }
}

  function updateElevation() {
    if (markersArray.length > 1) {
      var travelMode = 'driving';
      if (travelMode != 'direct') {
        calcRoute(travelMode);
      } else {
        var latlngs = [];
        for (var i in markersArray) {
          latlngs.push(markersArray[i].getPosition())
        }

      }
    }
  }
function calcRoute(travelMode) {
    var origin = markersArray[0].getPosition();
    var destination = markersArray[markersArray.length - 1].getPosition();

    var waypoints = [];
for (var i = 1; i < markersArray.length - 1; i++) {
      waypoints.push({
        location: markersArray[i].getPosition(),
        stopover: true
      });
    }

    var request = {
      origin: origin,
      destination: destination,
      waypoints: waypoints
    };

    switch (travelMode) {
      case \"bicycling\":
        request.travelMode = google.maps.DirectionsTravelMode.BICYCLING;
        break;
      case \"driving\":
        request.travelMode = google.maps.DirectionsTravelMode.DRIVING;
        break;
      case \"walking\":
        request.travelMode = google.maps.DirectionsTravelMode.WALKING;
        break;
    }
var SAMPLES = 512;

    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        elevationService.getElevationAlongPath({
          path: response.routes[0].overview_path,
          samples: SAMPLES
        }, plotElevation);

      } else if (status == google.maps.DirectionsStatus.ZERO_RESULTS) {
        alert(\"Could not find a route between these points\");
      } else {
        alert(status);
      }
    });
  }

function plotElevation(results, status) {
    if (status == google.maps.ElevationStatus.OK) {

   elevations = results;

    // Extract the elevation samples from the returned results
    // and store them in an array of LatLngs.
    var elevationPath = [];
    for (var i = 0; i < results.length; i++) {
      elevationPath.push(elevations[i].location);
    }


    if (flightPath) {
      flightPath.setMap(null);
    }


    flightPath = new google.maps.Polyline({
      path: elevationPath,
      strokeColor: \"#000000\",
      map: map});



  }
}
 function reset() {
     swadd=false;
    if (flightPath) {
      flightPath.setMap(null);
    }
if (markersArray) {

    for (var i =0;markersArray.length; i++) {
      markersArray[i].setMap(null);
    }

    markersArray.length = 0;

}

  }

    function initd(){
     	$(function() {
		$(\"#dialog2\").dialog({
			bgiframe: true,
			height: 200,
                         width:300,
			modal: true,
                        
                        Close: function() {
                        
				$(this).dialog('destroy');}

		});
	});
}
    function noencontrada(){
     	$(function() {
		$(\"#dialog4\").dialog({
			bgiframe: true,
			height: 200,
                         width:300,
			modal: true,
                        Close: function() {
				$(this).dialog('destroy');}

		});
	});
}
	$(function() {
        
		$(\"#accordion\").accordion({
        
                    event: 'mouseover',
                        autoHeight: true,
                        collapsible: true,
                        navigation: true ,
                        animated: 'bounceslide',
                        active: 0,
                        clearStyle: true
                        

		}).mouseleave(function(){
			$(\"#accordion\").accordion({active: -1});
		});

	});
function busdir(){
	$(function() {
		function updateTips(t) {
			tips.text(t).effect(\"highlight\",{},1500);
		}



		function checkRegexp(o,regexp,n) {

			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass('ui-state-error');
				updateTips(n);
				return false;
			} else {
				return true;
			}

		}

		$(\"#dialog3\").dialog({
			bgiframe: true,
			autoOpen: true,
			height: 300,
                        show: 'bounce',
                        hide: 'fade',
			modal: true,
			buttons: {
				'Buscar': function() {


                                        BuscarDireccion(document.getElementById(\"address\").value);


					$(this).dialog('close');

				},
				Cancel: function() {
					$(this).dialog('close');
				}
			},
			close: function() {

			}
		});



		$('#create-user').click(function() {
			$('#dialog3').dialog('open');
		})
		.hover(
			function(){
				$(this).addClass(\"ui-state-hover\");
			},
			function(){
				$(this).removeClass(\"ui-state-hover\");
			}
		).mousedown(function(){
			$(this).addClass(\"ui-state-active\");
		})
		.mouseup(function(){
				$(this).removeClass(\"ui-state-active\");
		});
});
	}
  function BuscarDireccion(address) {
    var address2 = address;


    if (geocoder) {
      geocoder.geocode( { 'address': address2}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

          map.setCenter(results[0].geometry.location);
           map.setZoom(13);
          var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location

          });

          clearLocations2();
          markers.push(marker);
          infoWindow.setContent(results[0].formatted_address);
          infoWindow.open(map, marker);

        } else {noencontrada();
         
        }
      });
    }

  }
  $(function(){


	$.fn.multiSelect.defaults.minWidth = 215;




	$(\"select.multiselect\").multiSelect();





});

	function panel(){
        var div=document.getElementById('panel');
        div.style.visibility='visible'
          $(function(){
		$('#panel').dialog({
			
			show: 'bounce',
                        hide: 'fade',
                        resizable: true,
                        title: 'Panel Control' ,
                        draggable: true ,
                        height: 400 ,
                        position: 'center'
		});



	});}
        function Busqueda(){
        var div=document.getElementById('busqueda');
        div.style.visibility='visible'
        $(function(){
		$('#busqueda').dialog({
			show: 'bounce',
                        hide: 'fade',
                        resizable: true,
                        title: 'Busquedas' ,
                        draggable: true ,
                        height: 400 ,
                        position: 'center'
		});

	});
        }

";
return $ss;

}
}
