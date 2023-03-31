<main class="contenedor seccion">
    <h1>Administrador De Bienes Raices</h1>

    <?php
    if ($resultado) :
        $mensaje = mostrarNotificacion(intval($resultado)); //Intval toma el entero de un String

        if ($mensaje) : ?>
            <p class="alerta exito"> <?php echo sanitizar($mensaje); ?> </p>

        <?php endif; ?>

    <?php endif; ?>



    <a href="/propiedades/crear" class="boton boton-verde-inline">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo-inline">Nuevo(a) Vendedor(a)</a>


    <h2>Propiedades</h2>

    <table class="propiedades contenedor">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--Mostrar los resultados-->
            <?php foreach ($propiedades as $propiedad) : //Sintaxis para el arreglo de objetos
            ?>
                <tr>
                    <td> <?php echo $propiedad->id; ?> </td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"> </td>
                    <td><?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="eliminar" action="/propiedades/eliminar">
                            <input name="id" type="hidden" value="<?php echo $propiedad->id ?>">
                            <input name="tipo" type="hidden" value="propiedad">
                            <input class="botonRojo-block" type="submit" value="Eliminar">
                        </form>
                        <a class="boton-amarillo-block" href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades contenedor">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--Mostrar los resultados-->
            <?php foreach($vendedores as $vendedor): //Sintaxis para el arreglo de objetos?>
                <tr>
                    <td> <?php echo $vendedor->id; ?> </td>
                    <td><?php echo $vendedor->nombre; ?></td>
                    <td><?php echo $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="eliminar" action="/vendedores/eliminar">
                            <input name="id" type="hidden" value="<?php echo $vendedor->id?>">
                            <input name="tipo" type="hidden" value=vendedor>
                            <input class="botonRojo-block" type="submit" value="Eliminar">
                        </form>
                        <a class="boton-amarillo-block" href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</main>