<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <?php
            if(isset($status)=== true) {
                switch ($status) {
                    case 1:
                        $str = <<<HTML
                        <script>toastr.success('Proprietario rimosso con successo');</script>
HTML;
                        echo $str;
                        break;
                    case -1:
                        $str = <<<HTML
                        <script>toastr['error']('Errore durante la rimozione del proprietario')</script>
HTML;
                        echo $str;
                        break;
                    default:
                        break;
                }
            }
            ?>
            <!--
            <pre>
                <?=print_r($proprietari);?>
            </pre>
            -->

            <h4>Elenco proprietari</h4>

            <?php //echo validation_errors(); ?>
            <?php echo form_open('venditore/perform_visualizza_proprietari') // send to creation method;?>


            <?php if(count($proprietari)>0) { ?>
                <div class="table-responsive">
                    <table class="table table-striped" id="dynamic">
                        <thead>
                        <tr>
                            <th>Nome proprietario</th>
                            <th>Cogmome proprietario</th>
                            <th>ID proprietario</th>
                            <th>Azione</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($proprietari as $proprietario) { ?>
                            <tr>
                                <td><?=$proprietario['Nome']?></td>
                                <td><?=$proprietario['Cognome']?></td>
                                <td><?=$proprietario['ID']?></td>
                                <td>
                                    <a href="<?=site_url('/venditore/rimuovi_proprietario/'.$proprietario['ID'])?>"<i class="lnr lnr-trash"></i>
                                </td>
                            </tr>
                        <?php } // end foreach?>
                        </tbody>
                    </table>
                </div>
            <?php } // end if
            else { ?>
                <!-- no records available -->
                <script>toastr.info("Hey, non hai registrato nemmeno un proprietario! Che cosa stai aspettando?");</script>
            <?php } //end else ?>


        </div>
    </div>
</div>





