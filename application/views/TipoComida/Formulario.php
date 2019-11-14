<div class="row mb-5">
    <div class="col-12 col-md-8">
        <h2>
            <?php echo($tipo->ti_id != 0 ? 'Modificar' : 'Crear'); ?> Tipo Comida
        </h2>
        <span>
            LLena toda la información que se solicita
        </span>
    </div>
    <div class="col-12 col-md-4">
        <div class="btn-group">
            <a href="<?php echo base_url() ?>TipoComida/Listado" class="btn btn-secondary btn-sm">
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
    <form method="POST" action="<?php echo(base_url('TipoComida/Guardar')); ?>" class="col">
        <div class="form-group row">
            <div class="col-12">
                <label for="ingrediente" class="">
                    Nombre
                </label>
            </div>
            <div class="col-12">
                <input type="text" class="form-control" id="tipo" placeholder="Desayuno" required name="ti_tipo_comida" value="<?php echo($tipo->ti_tipo_comida); ?>" autocomplete="off">
                <input type="hidden" readonly="readonly" name="ti_id"  value="<?php echo($tipo->ti_id); ?>">
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