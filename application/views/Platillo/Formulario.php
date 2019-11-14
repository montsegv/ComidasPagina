<div class="row mb-5">
    <div class="col-12 col-md-8">
        <h2>
            <?php echo($platillo->pa_id != 0 ? 'Modificar' : 'Crear'); ?> Platillo
        </h2>
        <span>
            Llena toda la información que se solicita
        </span>
    </div>
    <div class="col-12 col-md-4">
        <div class="btn-group">
            <a href="<?php echo base_url() ?>Platillo/Index" class="btn btn-secondary btn-sm">
                <span class="fas fa-backspace"></span>
                Regresar
            </a>
        </div>
    </div>
</div>
<div class="row">
    <?php
        if(isset($response)):
    ?>  
        <div class="alert alert-danger text-center col-12">
            <?php echo($response['message']); ?>
        </div>
    <?php
        endif;
    ?>
</div>
<div class="row">
    <form method="POST" action="<?php echo(base_url('Platillo/Guardar')); ?>" class="col">
        <div class="form-group row">
            <div class="col-12">
                <label for="platillo" class="">
                    Nombre de platillo
                </label>
            </div>
            <div class="col-12">
                <input type="text" class="form-control" id="platillo" placeholder="Hamburguesa" required name="pa_nombre" value="<?php echo($platillo->pa_nombre); ?>" autocomplete="off">
                <input type="hidden" readonly="readonly" name="pa_id"  value="<?php echo($platillo->pa_id); ?>">
                <small class="form-text text-muted">
                    Obligatorio
                </small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <label for="descripcion" class="">
                   Descripción
                </label>
            </div>
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" id="descripcion" placeholder="Poner carne en un pan" required name="pa_precio" value="<?php echo($platillo->pa_descripcion); ?>">
                <small class="form-text text-muted">
                    Obligatorio
                </small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <label for="precio" class="">
                   Precio
                </label>
            </div>
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" id="precio" placeholder="$0.00" required name="pa_precio" value="<?php echo($platillo->pa_precio); ?>">
                <small class="form-text text-muted">
                    Obligatorio
                </small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <label for="tipo_comida" class="">
                   Tipo de comida
                </label>
            </div>
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" id="tipo_comida" placeholder="2" required name="pa_id_tipo_comida" value="<?php echo($platillo->pa_id_tipo_comida); ?>">
                <small class="form-text text-muted">
                    Obligatorio
                </small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </div>
    </form>
</div>