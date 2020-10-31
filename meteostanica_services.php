<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php

$db2 = mysql_connect('*****' , '****' ,'****' ) or die('Nemozem sa
pripojit k databaze');
mysql_select_db('*****', $db2) or die(mysql_error($db2));


$today = date("Y-m-d H:i:s");
$datum = date("Y-m-d");
$cas = date("H:i");
$den = date("D");

$s = $_GET['smer_vetra'];
if($s < 22){
$smer_vetra = "S";
}
elseif($s < 67){
$smer_vetra = "SV";
}
elseif($s < 112){
$smer_vetra = "V";
}
elseif($s < 157){
$smer_vetra = "JV";
}
elseif($s < 212){
$smer_vetra = "J";
}
elseif($s < 247){
$smer_vetra = "JZ";
}
elseif($s < 292){
$smer_vetra = "Z";
}
elseif($s < 337){
$smer_vetra = "SZ";
}
else{
$smer_vetra = "S";
}		

if((float)$_GET['zrazky'] > 20){


}
else{


$sql = "SELECT * FROM teplota WHERE cas = '".$cas."' AND datum = '".$datum. "' LIMIT 1";
$test = mysql_query($sql, $db2);
$row = mysql_num_rows($test);
if((float)$_GET['zrazky'] > 0){
$row = 0;
}

$url = 'https://amaterskameteorologia.sk/ams_data/data/velcice/posielamudaje.php?zrazky='.$_GET['zrazky'].'&rychlost_vetra='.$_GET['rychlost_vetra'].'&smer_vetra='.$smer_vetra.'&teplota='.$_GET['teplota'].'&lux='.$_GET['lux'].'&tlak='.$_GET['tlak'].'&vlhkost='.$_GET['vlhkost'].'';
//Once again, we use file_get_contents to GET the URL in question.
$contents = file_get_contents($url);
//If $contents is not a boolean FALSE value.
if($contents !== false){
    //Print out the contents.
    echo $contents;
}	


if($row == 0){


	$query = 'INSERT INTO
					teplota
						(teplota, smer_vetra, rychlost_vetra, zrazky,  vlhkost, tlak, intenzita, den, cas, datum)
					VALUES
						(' . $_GET['teplota'] . ',"' . $smer_vetra . '",' . $_GET['rychlost_vetra'] . ',' . $_GET['zrazky'] . ',' . $_GET['vlhkost'] . ','  . $_GET['tlak'] . ',' . $_GET['lux'] . ',"' . $den . '" ,"' . $cas . '" ,"' . $today. '")';

	$result2 = mysql_query($query, $db2) or die(mysql_error($db2));

	}else{
	echo 'neprida uz existuje zaznam';
	}
	}
?>
</body>
</html>


