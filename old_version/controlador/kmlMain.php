<?php
ob_start();
require('mysql.php');
require_once("../modelo/gmp1_1_1.php");
     $map = new GoogleMapAPI('map_canvas');
// Opens a connection to a MySQL server
$connection = mysql_connect ($server, $username, $password);

if (!$connection)
{
   die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);

if (!$db_selected)
{
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query = " SELECT lon, lat  FROM geocodes limit 10";

$result = mysql_query($query);
if (!$result)
{
  die('Invalid query: ' . mysql_error());
}

// Start KML file, create parent node
$dom = new DOMDocument('1.0','UTF-8');

//Create the root KML element and append it to the Document
$node = $dom->createElementNS('http://earth.google.com/kml/2.1','kml');
$parNode = $dom->appendChild($node);

//Create a Folder element and append it to the KML element
$fnode = $dom->createElement('Folder');
$folderNode = $parNode->appendChild($fnode);
$datos;
$date= $_GET['data'];
$op= $_GET['op'];

require('../temp/data.php');
//Iterate through the MySQL results
if ($op=="txt"){
    $datos=$date;
    
$archivo = "../temp/data.php";
$id = fopen($archivo, 'w+');
fwrite($id, "<?php \n");
fwrite($id, "\$xmlD='".$xmlD." ".$datos."';\n");
fwrite($id, "?> \n");
fclose($id);
echo $datos."<br>";
    
}else{


$cor="";
while ($row = @mysql_fetch_assoc($result)){
    $cor.="new google.maps.LatLng(".$map->lon($row['lon']).",".$map->lat($row['lat'])."), ";


}

//Create a Placemark and append it to the document
$node = $dom->createElement('Placemark');
$placeNode = $folderNode->appendChild($node);

//Create an id attribute and assign it the value of id column
$placeNode->setAttribute('id','linestring1');

//Create name, description, and address elements and assign them the values of
//the name, type, and address columns from the results

$nameNode = $dom->createElement('name','My path');
$placeNode->appendChild($nameNode);
$descNode= $dom->createElement('description', 'This is the path that I took through my favorite restaurants in Seattle');
$placeNode->appendChild($descNode);

//Create a LineString element
$lineNode = $dom->createElement('LineString');
$placeNode->appendChild($lineNode);
$exnode = $dom->createElement('extrude', '3');
$lineNode->appendChild($exnode);
$almodenode =$dom->createElement(altitudeMode,'relativeToGround');
$lineNode->appendChild($almodenode);

//Create a coordinates element and give it the value of the lng and lat columns from the results

$coorNode = $dom->createElement('coordinates',$xmlD);
$lineNode->appendChild($coorNode);
$kmlOutput = $dom->saveXML();


//assign the KML headers.
header('Content-type: application/vnd.google-earth.kml+xml');
echo $kmlOutput;}
?>