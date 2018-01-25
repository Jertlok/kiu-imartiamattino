<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 21/01/2018
 * Time: 00:38
 */


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
                        echo "<script>toastr.success('Impianto aggiunto con successo');</script>";
                        break;
                    case -1:
                        echo "<script>toastr['error']('Errore durante l\'inserimento dell\'impianto')</script>";
                }
            }?>
            <h4>Nuovo impianto</h4>
            <?php //echo validation_errors(); ?>
            <?php echo form_open('amministratore/aggiungi_impianto') // send to creation method;?>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="impianto" placeholder="Nome impianto">
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" name="proprietario">
                            <option style="display:none" disabled selected value>Seleziona un proprietario</option>
                            <?php foreach ($proprietari as $proprietario) { ?>
                                <option value="<?=$proprietario['id_propr']?>"><?=$proprietario['nome'].' @'.$proprietario['username']?></option>
                            <?php } //end foreach ?>
                        </select>
                    </div>
                </div>
                <br>

                <hr><h4>Sensori</h4>
                <div id="dynamic-fields"></div>
                <div class = "row">
                    <div class="col-md-3">
                        <select class="form-control" name="sensore[sens0][tipo_sensore]">
                            <option style="display:none" disabled selected value>Seleziona un tipo di sensore</option>
                            <option>Temperatura</option>
                            <option>Pressione</option>
                            <option>pH</option>
                            <option>Umidità</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="sensore[sens0][marca_sensore]" placeholder="Marca sensore">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="more-field">+</button>
                                </div>
                            </div><!-- /input-group -->
                        </div>
                    </div>
                </div>
                <input type="hidden" id="field_number" name="field_number" value="1">
                <button type="submit" class="btn btn-primary">Aggiungi</button>
            </form>
        </div>
    </div>
</div>

<script>
    $('form').attr('autocomplete', 'off');
    $(document).ready(function(){


        var field = 1;
        $("#more-field").click(function(){
            var html = '                <div class = "row" id="removable">\n' +
                '                    <div class="col-md-3">' +
                '                            <select class="form-control" name="sensore[sens'+field+'][tipo_sensore]">\n' +
                '                               <option style="display:none" disabled selected value>Seleziona un tipo di sensore</option>\n' +
                '                               <option>Temperatura</option>\n' +
                '                               <option>Pressione</option>\n' +
                '                               <option>pH</option>\n' +
                '                               <option>Umidità</option>\n' +
                '                           </select>' +
                '                    </div>\n' +
                '                    <div class="col-md-3">\n' +
                '                        <div class="form-group">\n' +
                '                            <div class="input-group">\n' +
                '                              <input type="text" class="form-control" name="sensore[sens'+field+'][marca_sensore]" placeholder="Marca sensore">\n' +
                '                                <div class="input-group-btn">\n' +
                '                                    <button class="btn btn-default" type="button" id="remove-field">-</button>\n' +
                '                                </div>\n' +
                '                            </div><!-- /input-group -->\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div>';

            $(html).appendTo("#dynamic-fields");
            field++;
            $('#field_number').val(field);

        });

        $("#dynamic-fields").on('click', '#remove-field', function(){
            $(this).parents('.row').remove();
            field--;
            $('#field_number').val(field);
        });
    });
</script>
