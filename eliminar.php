<?php
    $us = $_GET['id'];

    $datos = new stdClass();
    $datos->id = $us;
    $json = json_encode([$datos]);
    try {
        $wsdl_url = 'http://localhost:8000/WSDatosBD/WSDDatosSOAP?WSDL';
        $client = new SOAPClient($wsdl_url);
        $client->__soapCall("borrar", array(["json" => $json]));
        echo '<script type="text/javascript">alert("Propietario Eliminado!");window.location.href = "index.php";</script>';
    } catch (Exception $e) {
        echo '<script type="text/javascript">alert('.$e.');window.location.href = "index.php";</script>';
    }
?>