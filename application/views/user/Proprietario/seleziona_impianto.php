<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 21/01/2018
 * Time: 17:49
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">


            <?php if(count($impianti)>0) { ?>
                <div class="table-responsive">
                    <table class="table table-striped" id="dynamic">
                        <thead>
                        <tr>
                            <th>Nome impianto</th>
                            <th>Nome proprietario</th>
                            <th>Nome Amministratore</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($impianti as $impianto) { ?>
                            <tr>
                                <td><?=$impianto['nome_imp']?></td>
                                <td><?=$impianto['nome_prop']?></td>
                                <td><?=$impianto['nome_amm']?></td>
                                <td>
                                    <a href="<?=site_url('/proprietario/visualizza_dati_impianto/'.$impianto['ID'])?>"><i class="lnr lnr-eye"></i></a>
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