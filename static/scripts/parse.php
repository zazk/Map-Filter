<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
// parse.php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
// LESSQL

// Connection
require_once("./LessQL/Database.php");
require_once("./LessQL/Result.php");
require_once("./LessQL/Row.php");

$dsn = 'mysql:host=localhost;dbname=brushlee_mecanico';
$username = 'brushlee_mecanic';
$password = 'mecanico';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

$pdo = new PDO($dsn, $username, $password, $options);

$db = new LessQL\Database( $pdo );
$result = $db->talleres()->limit(5000);
$rows = $result->fetchAll();


if( isset($_GET['latitud']) && isset($_GET['longitud']) ){

    $stmt = $pdo->prepare("UPDATE talleres SET latitud = ?, longitud = ?  WHERE id = ?");
    $result = $stmt->execute( array( $_GET['latitud'], $_GET['longitud'], $_GET['id'] ) );
    echo json_encode( array( 'response'=> $result ) );
    exit();
}
$stmt = $pdo->query("SELECT distrito from talleres GROUP BY distrito", PDO::FETCH_ASSOC);
$rows_districts = $stmt->fetchAll();

$stmt = $pdo->query("SELECT estado from talleres GROUP BY estado", PDO::FETCH_ASSOC);
$rows_estados = $stmt->fetchAll();

$stmt = $pdo->query("SELECT educacion_1 as educacion from talleres where educacion_1 != '' GROUP BY educacion_1", PDO::FETCH_ASSOC);
$rows_educacion = $stmt->fetchAll();

$stmt = $pdo->query("SELECT direccion_urbanizacion as urbanizacion from talleres where direccion_urbanizacion != '' group by direccion_urbanizacion", PDO::FETCH_ASSOC);
$rows_urbanizacion = $stmt->fetchAll();

$stmt = $pdo->query("SELECT MAX(nro_trabajadores) as trabajadores from talleres ", PDO::FETCH_ASSOC);
$rows_trabajadores = $stmt->fetch();

$stmt = $pdo->query("SELECT MAX(edad_1) as edad from talleres  ", PDO::FETCH_ASSOC);
$rows_edad = $stmt->fetch();

echo json_encode(array(
    'locations'=>$rows,
    'distritos'=>$rows_districts,
    'estados'=>$rows_estados,
    'educacion'=>$rows_educacion,
    'urbanizacion'=>$rows_urbanizacion,
    'trabajadores'=>$rows_trabajadores,
    'edad'=>$rows_edad,
    ));

// Close
exit;
// Get Points from Directions
$urlBase = 'https://maps.googleapis.com/maps/api/geocode/json?&key=AIzaSyBmEwV9vl1UJv_m5_Teedtyjk8rPsbL4DY&address=';

foreach ($rows as $key=>$value) {
    # code...

    if($key < 933){
        echo 'continue';
        continue;
    }else{
        sleep(1);
    }

    $urlPoint = $value->direccion_nombre_de_la_via.'+'.$value->direccion_enumeracion.'+'.$value->distrito;//+{$point.numero}+{$point.distrito}";
    $urlAddress = $urlBase.urlencode($urlPoint) ;
    // get the json response
    $resp_json = file_get_contents($urlAddress); 

    // decode the json
    $resp = json_decode($resp_json, true);
        // response status will be 'OK', if able to geocode given address 

    echo '<pre>';
    echo $key;
    echo '</pre>';
    echo $urlAddress.' <br />';

    if($resp['status']=='OK'){
        // get the important data
        $latitud = $resp['results'][0]['geometry']['location']['lat'];
        $longitud = $resp['results'][0]['geometry']['location']['lng'];
        // get Row 
        $row = $db->talleres( $value->id );
        $row->latitud = $latitud;
        $row->longitud = $longitud;
        $row->save();
        echo "$value->id Parsed Point <br />".$longitud.' '.$latitud;
    }
}
//print_r($rows[0]); 


// Insert SQL
exit;
$data = file_get_contents("./db.all.js");
$obj=json_decode($data,true);
//var_dump($obj);
foreach ($obj as $key => $value) { 
    $statement = $result->insert( $value );

    $mecanicos =  null;//R::getAll( 'SELECT * FROM mecanicos' );
    echo '<pre>';
    echo "·········································";
    print_r($statement); 
    echo "·········································"; 
}

?>