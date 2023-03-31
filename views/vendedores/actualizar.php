<main class="contenedor seccion">

    <h1>Actualizar Vendedor(a)</h1>

    <a class="boton boton-verde-inline" href="/admin">Volver</a>

    <?php foreach ($errores as $error):?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach;?>

    <form class="formulario" method="POST"> 
        <?php include __DIR__ . '/formulario.php'; ?>

        <input class="boton boton-verde" type="submit" value="Actualizar Vendedor(a)">
    </form>

</main>