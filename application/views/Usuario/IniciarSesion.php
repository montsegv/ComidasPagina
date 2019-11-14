
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Iniciar Sesión</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/libs/bootstrap/bootstrap.css') ?>">
    </head>
    <body>
        <div class="container-fluid vh-100">
            <div class="row h-100">
                <div class="col-12 col-md-5 col-lg-4 col-xl-3 text-center mx-auto my-auto">
                    <div class="">
                        <form class="form-signin" action="<?php echo(base_url()) ?>Usuario/IniciarSesion" method="POST">
                            <img class="mb-4" src="<?php echo base_url('assets/images/logo/2085075.svg') ?>" alt="" width="72" height="72">
                            <h1 class="h3 mb-3 font-weight-normal">
                                Inicio de Sesión
                            </h1>
                            <?php
                                if(isset($response)):
                            ?>  
                                <div class="alert alert-danger text-center">
                                    <?php echo($response['message']); ?>
                                </div>
                            <?php
                                endif;
                            ?>
                            <div class="form-group">
                                <label for="correo" class="sr-only">Correo Electrónico</label>
                                <input type="email" id="usuario" name="correo" class="form-control" placeholder="edgar@gmail.com" required autofocus autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="clave" class="sr-only">Contraseña</label>
                                <input type="password" id="clave" name="clave" class="form-control" placeholder="Contraseña" maxlength="10" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-lg btn-primary btn-block" type="submit">
                                    Iniciar Sesión
                                </button>
                            </div>
                            <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>