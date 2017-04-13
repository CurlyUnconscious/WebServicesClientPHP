<?php
    $id = $_POST['id'];
    $nom = $_POST['name'];
    $est = $_POST['estado'];
    $mon = $_POST['monto'];

    $datos = new stdClass();
    $datos->id = $id;
    $datos->nombre = $nom;
    $datos->estado = $est;
    $datos->monto = floatval($mon);
    $json = json_encode([$datos]);
    try {
        $wsdl_url = 'http://localhost:8000/WSDatosBD/WSDDatosSOAP?WSDL';
        $client = new SOAPClient($wsdl_url);
        $client->__soapCall("actualizar", array(["json" => $json]));
        echo '<script type="text/javascript">alert("Propietario Actualizado!");window.location.href = "../index.php";</script>';
    } catch (Exception $e) {
        echo '<script type="text/javascript">alert('.$e.');window.location.href = "../index.php";</script>';
    }
?>