<div class="row mb-5">
    <div class="col-12 col-md-8">
        <h2>
            <?php echo($ingrediente->in_id != 0 ? 'Modificar' : 'Crear'); ?> Ingrediente
        </h2>
        <span>
            LLena toda la información que se solicita
        </span>
    </div>
    <div class="col-12 col-md-4">
        <div class="btn-group">
            <a href="<?php echo base_url() ?>Ingrediente/Index" class="btn btn-secondary btn-sm">
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
    <form method="POST" action="<?php echo(base_url('Ingrediente/Guardar')); ?>" class="col">
        <div class="form-group row">
            <div class="col-12">
                <label for="ingrediente" class="">
                    Nombre de ingrediente
                </label>
            </div>
            <div class="col-12">
                <input type="text" class="form-control" id="ingrediente" placeholder="Pimienta" required name="in_nombre" value="<?php echo($ingrediente->in_nombre); ?>" autocomplete="off">
                <input type="hidden" readonly="readonly" name="in_id"  value="<?php echo($ingrediente->in_id); ?>">
                <small class="form-text text-muted">
                    Obligatorio
                </small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-12">
                <label for="unidad" class="">
                   Unidad
                </label>
            </div>
            <div class="col-12 col-md-3">
                <input type="text" class="form-control" id="unidad" placeholder="KG" required name="in_unidad" value="<?php echo($ingrediente->in_unidad); ?>">
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