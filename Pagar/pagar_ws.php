<?php
    $id = $_POST['id'];
    $nom = $_POST['name'];
    $est = $_POST['estado'];
    $mon = $_POST['monto'];

    try {
        $wsdl_url = 'http://localhost:8000/WSDatosBD/WSDDatosSOAP?WSDL';
        $client = new SOAPClient($wsdl_url);
        $datos = $client->consulta()->return;
        $datosdecode = json_decode($datos);
        for ($index = 0; $index < count($datosdecode); $index++) {
            $obj_dato = $datosdecode[$index];
            if($obj_dato->id == $id){
                $prop = $obj_dato;
            }
        }
    } catch (Exception $e) {
        echo "Exception occured: " . $e;
    }
    if ($mon >= $prop->monto){
        $datos = new stdClass();
        $datos->id = $id;
        $datos->nombre = $nom;
        $datos->estado = "Inactivo";
        $datos->monto = floatval($mon);
        $json = json_encode([$datos]);
        try {
            $wsdl_url = 'http://localhost:8000/WSDatosBD/WSDDatosSOAP?WSDL';
            $client = new SOAPClient($wsdl_url);
            $client->__soapCall("actualizar", array(["json" => $json]));
            echo '<script type="text/javascript">alert("Saldo Pagado!");window.location.href = "../index.php";</script>';
        } catch (Exception $e) {
            echo '<script type="text/javascript">alert('.$e.');window.location.href = "../index.php";</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Saldo Insuficiente!");window.location.href = "../detalles.php?id='.$id.'";</script>';
    }
?>