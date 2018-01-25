<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">



            <h4>Eccezioni rilevate</h4>

            <?php //echo validation_errors(); ?>
            <?php echo form_open('amministratore/perform_visualizza_eccezioni') // send to creation method;?>


            <?php if(count($eccezioni)>0) { ?>
                <div class="table-responsive">
                    <table class="table table-striped" id="dynamic">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>ID Sensore</th>
                            <th>ID Impianto</th>
                            <th>Messaggio</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($eccezioni as $eccezione) {
                            $idimpianto = $eccezione['ImpiantoID'];?>
                            <tr>
                                <td><a href="<?php echo site_url('Amministratore/update_impianto/'.$idimpianto)?>" class=""><?=$eccezione['ID']?></a></td>
                                <td><?=$eccezione['Data']?></td>
                                <td><?=$eccezione['SensoreID']?></td>
                                <td><?=$eccezione['ImpiantoID']?></td>
                                <td><?=$eccezione['Messaggio']?></td>
                            </tr>
                        <?php } // end foreach?>
                        </tbody>
                    </table>
                </div>
            <?php } // end if
            else { ?>
                <!-- no records available -->
                <script>toastr.info("Nessuna eccezione rilevata");</script>
            <?php } //end else ?>


        </div>
    </div>
</div>





