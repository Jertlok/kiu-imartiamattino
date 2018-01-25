<?php

?>

<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- notifications -->
            <?php
            if(isset($status)) {
                switch ($status) {
                    case 1:
                        $str = <<<HTML
                        <script>toastr.success('Terza Parte aggiunta con successo');</script>
HTML;
                        echo $str;
                        break;
                    case -1:
                        $str = <<<HTML
                        <script>toastr['error']('Errore durante l\'inserimento della Terza Parte')</script>
HTML;
                        echo $str;
                        break;
                    default:
                        break;
                }
            }?>

            <h3>Autorizza Terza Parte</h3>
            <?php echo form_open('Proprietario/autorizzaterzaparte') // send to creation method;?>
            <div class="row">
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="indirizzoIP" placeholder="Indirizzo IP">
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="intervalloTempo" placeholder="Intervallo Tempo">
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="impianto">
                        <option style="display:none" disabled selected value>Seleziona un impianto</option>
                        <?php foreach ($impianti as $impianto) { ?>
                            <option value="<?=$impianto['ID']?>"><?=$impianto['nome_imp']?></option>
                        <?php } //end foreach ?>
                    </select>
                </div>

            </div>
            <br>
            <button type="submit" class="btn btn-primary">Aggiungi</button>
            </form>
        </div>
    </div>
</div>