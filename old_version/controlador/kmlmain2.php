<?php
include 'simplepoly.php';

class GeoPoint {
    public $latitude;
    public $longitude;

    public function __construct($lat,$lng)
    {
        $this->latitude = (float)$lat;
        $this->longitude = (float)$lng;
    }
};

$points = array(
new GeoPoint(53,-1.2),
new GeoPoint(53,-1.2001),
new GeoPoint(53.01,-1.2002),
new GeoPoint(53,-1.2402),
new GeoPoint(53,-1.25),
);

$reducer = new PolylineReducer($points);
$simple_line = $reducer->SimplerLine(0.001);

echo "ddddddd<pre>\n";
print_r($points);
print_r($simple_line);
echo "</pre>\n";
?>