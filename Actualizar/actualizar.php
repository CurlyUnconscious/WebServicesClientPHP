<?php
    $us=$_GET['id'];
    try {
        $wsdl_url = 'http://localhost:8000/WSDatosBD/WSDDatosSOAP?WSDL';
        $client = new SOAPClient($wsdl_url);
        $datos = $client->consulta()->return;
        $datosdecode = json_decode($datos);
        for ($index = 0; $index < count($datosdecode); $index++) {
            $obj_dato = $datosdecode[$index];
            if($obj_dato->id == $us){
                $prop = $obj_dato;
            }
        }
    } catch (Exception $e) {
        echo "Exception occured: " . $e;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Practica</title>

    <!-- Styles -->
    <link href="../css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a href="../index.php" class="navbar-brand">Home</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Actualizar Propietario</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="actualizar_ws.php">
                        
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        <?php echo '<input id="name" type="text" class="form-control" name="name" value='.$prop->nombre.'>';
                                            echo '<input id="id" type="hidden" class="form-control" name="id" value='.$prop->id.'>'; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="estado" class="col-md-4 control-label">Estado</label>
                                    <div class="col-md-6">
                                        <select name="estado" class="form-control">
                                            <option>Activo</option>
                                            <option>Inactivo</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="monto" class="col-md-4 control-label">Monto</label>
                                    <div class="col-md-6">
                                        <?php echo '<input id="monto" type="number" step="0.01" class="form-control" name="monto" value='.$prop->monto.'>'; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../js/app.js"></script>
</body>
</html>
<?
    $_POST['id'];
    $_POST['name'];
    $_POST['estado'];
    $_POST['monto'];
?>