<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Practica</title>

        <!-- Styles -->
        <link href="css/app.css" rel="stylesheet">
    </head>
    <body>
        <form class="form-horizontal" role="form" method="POST" action="actualizar.php">
            <div id="app">
                <nav class="navbar navbar-default navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <!-- Branding Image -->
                            <a href="index.php" class="navbar-brand">Home</a>
                        </div>
                    </div>
                </nav>
                <div class="container">
                    <div class="input-group-lg">
                        <?php
                        try {
                            $wsdl_url = 'http://localhost:8000/WSDatosBD/WSDDatosSOAP?WSDL';
                            $client = new SOAPClient($wsdl_url);
                            $datos = $client->consulta()->return;
                            $datosdecode = json_decode($datos);
                            if(count($datosdecode) != 0){
                                for ($index = 0; $index < count($datosdecode); $index++) {
                                    $obj_dato = $datosdecode[$index];
                                    if($obj_dato->estado != 'Inactivo'){
                                        echo '<div class="dropdown">';
                                            echo '<button class="btn btn-default btn-lg list-group-item dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'.$obj_dato->nombre.'<span class="caret pull-right"></span></button>';
                                            echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
                                                echo '<li><a href="detalles.php?id='.$obj_dato->id.'">Ver detalle</a></li>';
                                                echo '<li><a href="eliminar.php?id='.$obj_dato->id.'">Eliminar</a></li>';
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                }
                            } else {
                                echo '<div class="title m-b-md">No hay Propietarios</div>';
                            }
                        } catch (Exception $e) {
                            echo "Exception occured: " . $e;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </form>

        <!-- Scripts -->
        <script src="js/app.js"></script>
    </body>
</html>