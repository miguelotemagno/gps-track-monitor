<?php ob_start();
session_start();
include('Alertas.php');
include('Geocodes.php');
include('Vehiculos.php');
include("dbconfig.php");
require('ConfiguracionApp.php');

require_once('../lib/GMap.class.php');
$vehiculo=new Vehiculos();
$alertas=new Alertas();
$geo=new Geocodes();
$tabla = $_GET['table'];
$data= $_GET['dataOP'];
$wr= $_GET['wr'];
$campos=str_replace('-',',',$data);
$page = $_GET['page'];
$_search = $_GET['_search'];

// get how many rows we want to have into the grid
// rowNum parameter in the grid
$limit = $_GET['rows'];
// get index row - i.e. user click to sort
// at first time sortname parameter - after that the index from colModel
$sidx = $_GET['sidx'];
$id=$_GET[$sidx];
// sorting order - at first time sortorder
$sord = $_GET['sord'];
$totalrows = isset($_GET['totalrows']) ? $_GET['totalrows']: false; if($totalrows) { $limit = $totalrows; }
// if we not pass at first time index use the first column for the index
if(!$sidx) $sidx =1;
// connect to the MySQL database server
$db = mysql_connect($dbhost, $dbuser, $dbpassword)
or die("Connection Error: " . mysql_error());

// select the database
mysql_select_db($database) or die("Error conecting to db.");

// calculate the number of rows for the query. We need this to paging the result
//$result = mysql_query("SELECT COUNT(*) AS count FROM invheader a, clients b WHERE a.client_id=b.client_id");
$result = mysql_query("SELECT COUNT(*) AS count FROM ".$tabla);
$row = @mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];
$config= new ConfiguracionApp();
    $datanormal=$config->getNormal($tabla);
    $datanormal=str_replace('-',',',$datanormal);
    
    $dataFull=$config->getFull($tabla);
    $dataFull=str_replace('all','*',$dataFull);
    $relacion=$config->getRelacion($tabla);
    $opciones=$config->getOpciones($tabla);
    $tab=$config->getTablas($tabla);
    $tab=str_replace('-',',',$tab);
// calculation of total pages for the query
if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}

// if for some reasons the requested page is greater than the total
// set the requested page to total page
if ($page > $total_pages) $page=$total_pages;

// calculate the starting position of the rows
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
// if for some reasons start position is negative set it to 0
// typical case is that the user type 0 for the requested page
if($start <0) $start = 0;
$wh;
// the actual query for the grid data
if ($_search=="true"){
$abuscar=$_GET['searchField'];
$operacion=$_GET['eq'];

	$fld = $_GET['searchField'];
	if($fld!='') {
		$fldata =$_GET['searchString'];
		$foper =$_GET['searchOper'];
		// costruct where
		$wh .= " ".$fld;
		switch ($foper) {
			case "bw":
				$fldata .= "%";
				$wh .= " LIKE '".$fldata."'";
				break;
			case "eq":
				if(is_numeric($fldata)) {
					$wh .= " = ".$fldata;
				} else {
					$wh .= " = '".$fldata."'";
				}
				break;
			case "ne":
				if(is_numeric($fldata)) {
					$wh .= " <> ".$fldata;
				} else {
					$wh .= " <> '".$fldata."'";
				}
				break;
			case "lt":
				if(is_numeric($fldata)) {
					$wh .= " < ".$fldata;
				} else {
					$wh .= " < '".$fldata."'";
				}
				break;
			case "le":
				if(is_numeric($fldata)) {
					$wh .= " <= ".$fldata;
				} else {
					$wh .= " <= '".$fldata."'";
				}
				break;
			case "gt":
				if(is_numeric($fldata)) {
					$wh .= " > ".$fldata;
				} else {
					$wh .= " > '".$fldata."'";
				}
				break;
			case "ge":
				if(is_numeric($fldata)) {
					$wh .= " >= ".$fldata;
				} else {
					$wh .= " >= '".$fldata."'";
				}
				break;
			case "ew":
				$wh .= " LIKE '%".$fldata."'";
				break;
			case "ew":
				$wh .= " LIKE '%".$fldata."%'";
				break;
                        case "cn":
				$wh .= " LIKE '%".$fldata."%'";
				break;
                        case "en":
				$wh .= " NOT LIKE '%".$fldata."'";
				break;
                        case "nc":
				$wh .= " NOT LIKE '%".$fldata."%'";
				break;
			default :
				$wh = "";
		}
	}

if ($wr!=""){$SQL = "SELECT ".$campos." FROM ".$tabla.",usuarios where ".$wh." ".$wr." ORDER BY $sidx $sord LIMIT $start , $limit";
$SQL=str_replace('Direccion','lon as Direccion',$SQL);
$SQL=str_replace('Velocidad','otro1 as Velocidad',$SQL);
}
else
{$SQL = "SELECT ".$campos." FROM ".$tabla." where ".$wh." ORDER BY $sidx $sord LIMIT $start , $limit";
$SQL=str_replace('Direccion','lon as Direccion',$SQL);
$SQL=str_replace('Velocidad','otro1 as Velocidad',$SQL);
}


}

else{ 
if ($wr!=""){
    if ($_SESSION["tipo"]>=10){
    $SQL = "SELECT ".$dataFull." FROM ".$tabla." ,usuarios where ".$wr."  ORDER BY $sidx $sord LIMIT $start , $limit";
    $SQL=str_replace('Direccion','lon as Direccion',$SQL);
    $SQL=str_replace('Velocidad','otro1 as Velocidad',$SQL);
    }
    else
    {
    $SQL = "SELECT ".$datanormal." FROM ".$tabla." ".$tab.",usuarios where ".$wr." and ".$opciones." ORDER BY $sidx $sord LIMIT $start , $limit";
    $SQL=str_replace('Direccion','lon as Direccion',$SQL);
    $SQL=str_replace('Velocidad','otro1 as Velocidad',$SQL);
    }
    //echo $SQL;
    }
    else
{$SQL = "SELECT ".$campos." FROM ".$tabla." ORDER BY $sidx $sord LIMIT $start , $limit";
if ($_SESSION["tipo"]>=10){
    if ($tabla=="alert_vel"){
    $result=$alertas->GetAlertasVel($_SESSION["cod"], $dataFull, $tab, '1', $opciones, $sidx, $start, $limit, $sord);}
    if ($tabla=="configuracion"){
    $result=$config->GetDat();}
    if ($tabla=="alert_hora"){
    $result=$alertas->GetAlertasHora($_SESSION["cod"], $dataFull, $tab, '1', $opciones, $sidx, $start, $limit, $sord);}
    if ($tabla=="geocodes"){
    $result=$geo->GetData($_SESSION["cod"], $dataFull, $tab, '1', $opciones, $sidx, $start, $limit, $sord);}
    if ($tabla=="userautos"){
        $result=$vehiculo->Getvehiculos($_SESSION['cod'], $dataFull, $tab,'1', $opciones, $sidx, $start, $limit, $sord);
    }
    //$SQL = "SELECT ".$dataFull." FROM ".$tabla." ORDER BY $sidx $sord LIMIT $start , $limit";//$SQL = "SELECT ".$dataFull." FROM ".$tabla." ".$tab." where ".$opciones." ORDER BY $sidx $sord LIMIT $start , $limit";
}else{
    if ($tabla=="alert_vel"){
    $result=$alertas->GetAlertasVel($_SESSION["cod"], $datanormal, $tab, '1', $opciones, $sidx, $start, $limit, $sord);}
    if ($tabla=="alert_hora"){
    $result=$alertas->GetAlertasHora($_SESSION["cod"], $datanormal, $tab, '1', $opciones, $sidx, $start, $limit, $sord);}
    if ($tabla=="geocodes"){
    $result=$geo->GetData($_SESSION["cod"], $datanormal, $tab, '1', $opciones, $sidx, $start, $limit, $sord);}
    if ($tabla=="userautos"){
        $result=$vehiculo->Getvehiculos($_SESSION["cod"], $datanormal, $tab,'1', $opciones, $sidx, $start, $limit, $sord);
    }
    //$SQL = "SELECT ".$datanormal." FROM ".$tabla." ".$tab." where ".$opciones." ORDER BY $sidx $sord LIMIT $start , $limit";}
//$SQL = "SELECT ".$datanormal." FROM ".$tabla." ".$tab." where ".$opciones." ORDER BY $sidx $sord LIMIT $start , $limit";
}}
}
//$SQL = "SELECT a.id, a.invdate, b.name, a.amount,a.tax,a.total,a.note FROM invheader a, clients b WHERE a.client_id=b.client_id ORDER BY $sidx $sord LIMIT $start , $limit";
//$result = mysql_query( $SQL ) or die($SQL."Couldn t execute query.".mysql_error());

// constructing a JSON
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
$data2;
$datos= Array();
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
header("Content-type: application/xhtml+xml;charset=utf-8"); } else {
header("Content-type: text/xml;charset=utf-8");
}
$et = ">";
//echo "<?xml version='1.0' encoding='utf-8'//>";

echo "<rows>";
echo "<page>".$page."</page>";
echo "<total>".$total_pages."</total>";
echo "<records>".$count."</records>";
$gMap = new GMap();
while($row = @mysql_fetch_assoc($result)) {
    echo "<row id='". $row[$sidx]."'>";
    for ($x=0;$x<@mysql_num_fields($result);$x++){

    if (@mysql_field_name($result, $x)=="Longitud"){
        if ($row[@mysql_field_name($result, $x)]<=0){
        echo "<cell>". $row[@mysql_field_name($result, $x)]."</cell>";}
        else{
            echo "<cell>". $gMap->lon($row[@mysql_field_name($result, $x)])."</cell>";}
        
    }else{
    if (@mysql_field_name($result, $x)=="Latitud"){
        if ($row[@mysql_field_name($result, $x)]<=0){
        echo "<cell>". $row[@mysql_field_name($result, $x)]."</cell>";}
        else {   echo "<cell>". $gMap->lat($row[@mysql_field_name($result, $x)])."</cell>";}
    }else{
  if (@mysql_field_name($result, $x)=="Direccion"){


            $gMap = new GMap();
            $geocoded_addr = new GMapGeocodedAddress(null);
            $geocoded_addr->setLat($gMap->lat($row[@mysql_field_name($result, $x-1)]));
            $geocoded_addr->setLng($gMap->lon($row[@mysql_field_name($result, $x-2)]));
            
            $geocoded_addr->reverseGeocode($gMap->getGMapClient());


                
                echo "<cell>". $geocoded_addr->getRawAddress()."</cell>";
            }else{

        echo "<cell>". $row[@mysql_field_name($result, $x)]."</cell>";}
        }}}



	echo "</row>";
}
echo "</rows>";

   /* $responce->rows[$i]['id']=$row2[$sidx];
    
       array_push($responce->rows[$i]['cell'],$row);

    
    
    $data2="";
    $i++;
}*/
// return the formated data
//echo $json->encode($responce);
//echo json_encode($responce);
?>
