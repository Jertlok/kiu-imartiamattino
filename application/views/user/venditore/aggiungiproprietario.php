<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <?php
            if(isset($status)) {
                switch ($status) {
                    case 1:
                        $str = <<<HTML
                        <script>toastr.success('Proprietario aggiunto con successo');</script>
HTML;
                        echo $str;
                        break;
                    case -1:
                        $str = <<<HTML
                        <script>toastr['error']('Errore durante l\'aggiunta del\'proprietario')</script>
HTML;
                        echo $str;
                        break;
                    default:
                        break;
                }
            }?>
            <h4>Nuovo proprietario</h4>
            <?php //echo validation_errors(); ?>
            <?php echo form_open('venditore/perform_aggiungi_proprietario') // send to creation method;?>
            <div class="row">
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="cognome" placeholder="Cognome proprietario">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="nome" placeholder="Nome proprietario">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="username" placeholder="Username proprietario">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="password" placeholder="Password proprietario">
                </div>
            </div>
            <br>

            <input type="hidden" id="field_number" name="field_number" value="1">
            <button type="submit" class="btn btn-primary">Aggiungi</button>

        </div>
    </div>
</div>





