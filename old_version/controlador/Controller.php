<?php
include_once("mysql.php");
//include_once("data.php");
$filtro=$_GET["filtro"];

$sql = "select * from geocodes";

$json=json_decode(stripslashes($_POST["_gt_json"]));
$pageNo = $json->{'pageInfo'}->{'pageNum'};
$pageSize = 10;//10 rows per page





//to get how many records totally.
$sql = "select count(*) as cnt from geocodes";
$handle = mysql_query($sql);
$row = mysql_fetch_object($handle);
$totalRec = $row->cnt;

//make sure pageNo is inbound
if($pageNo<1||$pageNo>ceil(($totalRec/$pageSize))){
  $pageNo = 1;
}


//pageno starts with 1 instead of 0
$sql = "select * from geocodes limit " . ($pageNo - 1)*$pageSize . ", " . $pageSize;
$handle = mysql_query($sql);	
$retArray = array();
while ($row = mysql_fetch_object($handle)) {
  $retArray[] = $row;
}


$data = json_encode($retArray);
$ret = "{data:" . $data .",\n";
$ret .= "pageInfo:{totalRowNum:" . $totalRec . "},\n";
$ret .= "recordType : 'object'}";
echo $ret;


?>