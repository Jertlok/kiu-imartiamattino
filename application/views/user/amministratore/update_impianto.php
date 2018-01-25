<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 21/01/2018
 * Time: 22:22
 */

?>

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <?php
            if(isset($status)) {
                switch ($status) {
                    case 1:
                        $str = <<<HTML
                        <script>toastr.success('Impianto modificato con successo');</script>
HTML;
                        echo $str;
                        break;
                    case -1:
                        $str = <<<HTML
                        <script>toastr['error']('Errore durante l\'aggiornamento dell\'impianto')</script>
HTML;
                        echo $str;
                        break;
                    default:
                        break;
                }
            }?>
            <?php echo form_open('amministratore/perform_update_impianto'); ?>
            <div class="form-group">
                <label for="impianto"><h4>Nome impianto</h4></label>
                <input type="text" class="form-control" name="impianto" placeholder="Nome impianto" value="<?= $impianto['impianto']['Nome']?>">
            </div>
            <hr><h4>Sensori</h4>
            <div id="dynamic-fields"></div>
            <div class = "row">
                <div class="col-md-3">
                    <select class="form-control" name="sensore[sens0][Tipo]">
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
                            <input type="text" class="form-control" name="sensore[sens0][Marca]" placeholder="Marca sensore">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="button" id="more-field">+</button>
                            </div>
                        </div><!-- /input-group -->
                    </div>
                </div>
            </div>
                <input type="hidden" id="field_number" name="field_number" value="1">
                <input type="hidden" name="id_impianto" value="<?=$impianto['impianto']['ID']?>">
                <button type="submit" class="btn btn-primary">Aggiorna</button>
            </form>
            <?php if (count($impianto['sensori']) > 0) { ?>
            <!-- Showing sensor table-->
            <hr><h4>Sensori installati</h4>
            <div class="table-responsive">
                <table class="table table-striped" id="dynamic">
                    <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Azione</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($impianto['sensori'] as $sensore) { ?>
                        <tr>
                            <td><?=$sensore['Tipo']?></td>
                            <td><?=$sensore['Marca']?></td>
                            <td>
                                <a href="<?=site_url('/amministratore/update_sensore/'.$sensore['ID'].'/'.$impianto['impianto']['ID'])?>"><i class="lnr lnr-pencil"></i></a>|
                                <a href="<?=site_url('/amministratore/remove_sensore/'.$sensore['ID'].'/'.$impianto['impianto']['ID'])?>"<i class="lnr lnr-trash"></i>
                            </td>
                        </tr>
                    <?php } // end of foreach?>
                    </tbody>
                </table>
                <?php }
                else {?>
                    <script>toastr.info("Hey, forse hai dimenticato di aggiungere qualche sensore ;)");</script>
                <?php } ?>
            </div>
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
                '                            <select class="form-control" name="sensore[sens'+field+'][Tipo]">\n' +
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