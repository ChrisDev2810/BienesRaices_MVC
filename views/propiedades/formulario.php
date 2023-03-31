<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo De La Propiedad" value="<?php
                                                                                                        echo sanitizar($propiedad->titulo); //$propiedad es la variable en clase de actualizar y crear con la que llamo  el metodo que conecta la base de datos para obtener los valores de los objetos 
                                                                                                        ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo sanitizar($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if ($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php }; ?>

    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion De La Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min='1' max='9' value="<?php echo sanitizar($propiedad->habitaciones); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min='1' max='9' value="<?php echo sanitizar($propiedad->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3" min='1' max='9' value="<?php echo sanitizar($propiedad->estacionamiento); ?>">

</fieldset>

<fieldset>
    <legend>Vendedores</legend>

    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedor_id]" id="vendedor">
        <option selected value="">--Seleccione--</option>
        <?php foreach($vendedor as $vendedor) : ?>
            <option
            <?php echo $propiedad->vendedor_id === $vendedor->id ? 'selected' : ''; ?> 
            value="<?php echo sanitizar($vendedor->id); ?>"> <?php echo sanitizar($vendedor->nombre) . " " . sanitizar($vendedor->apellido); ?>
            </option>
        <?php endforeach; ?>
    </select>
</fieldset>