<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            Control de Restaurante
        </title>
        <?php
            if(isset($this->carabiner)){
                $this->carabiner->display('css');
            }
        ?>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <a class="navbar-brand" href="<?php echo(base_url()); ?>Usuario">
                <?php echo($this->session->userdata('user')['nombre']); ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo(base_url()); ?>Ingrediente">
                            Ingredientes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo(base_url()); ?>TipoComida/Listado">
                            Tipos Comidas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo(base_url()); ?>Platillo">
                            Platillos
                        </a>
                    </li>
                </ul>
                <div>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo(base_url()); ?>Usuario/CerrarSesion">
                                Salir
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main role="main" class="container">