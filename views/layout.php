<?php

    if(!isset($_SESSION)){
        session_start();
    }

    $autenticado = $_SESSION['login'] ?? false;

    if(!isset($inicio)){
        $inicio = false;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logo" src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Barras responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Boton Dark Mode">
                    <nav class="navegacion">
                        <?php if ($inicio && !$autenticado) : ?>
                        <a href="/login">Iniciar Sesion</a>
                        <?php endif ?>
                        <a href="/nosotros">Nosotros</a>
                        <a href="propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($autenticado) : ?>
                            <a href="/logout">Cerrar Sesion</a>
                        <?php endif ?>
                    </nav>
                </div>

            </div>
            <?php if ($inicio) { ?>
                <h1>Venta De Casas y Apartamentos De Lujo</h1>
            <?php } ?>
        </div>
    </header>

    <?php echo $contenido;?>

    <footer class="footer seccion">

        <div class="contenedor contenido-footer">

            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>

        <?php
        $fecha = date('d-m-y');
        ?>

        <p class="copyright">Todos los derechos reservados <?php echo date('Y') ?> &copy;</p> <?php // Formato del año segun la fecha del servidor // 
                                                                                                ?>

    </footer>


    <script src="../build/js/bundle.min.js"></script>
</body>

</html>