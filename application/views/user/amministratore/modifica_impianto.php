<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 21/01/2018
 * Time: 17:49
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
                        echo "<script>toastr.success('Impianto modificato con successo');</script>";
                        break;
                    case -1:
                        echo "<script>toastr['error']('Errore durante l\'aggiornmaneot dell\'impianto')</script>";
                }
            }?>

            <?php if(count($impianti)>0) { ?>
            <div class="table-responsive">
                <table class="table table-striped" id="dynamic">
                    <thead>
                        <tr>
                            <th>Nome impianto</th>
                            <th>Nome proprietario</th>
                            <th>Nome Amministratore</th>
                            <th>Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($impianti as $impianto) { ?>
                        <tr>
                            <td><?=$impianto['nome_imp']?></td>
                            <td><?=$impianto['nome_prop']?></td>
                            <td><?=$impianto['nome_amm']?></td>
                            <td>
                                <a href="<?=site_url('/amministratore/update_impianto/'.$impianto['ID'])?>"><i class="lnr lnr-pencil"></i></a> ---
                                <a href="<?=site_url('/amministratore/remove_impianto/'.$impianto['ID'])?>"<i class="lnr lnr-trash"></i>
                            </td>
                        </tr>
                       <?php } // end foreach?>
                    </tbody>
                </table>
            </div>
            <?php } // end if
            else { ?>
            <!-- no records available -->
                <script>toastr.info("Hey, non hai registrato nemmeno un impianto! Che cosa stai aspettando?");</script>
            <?php } //end else ?>
        </div>
    </div>
</div>

