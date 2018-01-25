<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 20/01/2018
 * Time: 11:45
 */



/* Sidebar for AmministratoreImpianti */
?>

<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="<?php echo site_url('amministratore')?>" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="<?php echo site_url('amministratore/nuovo_impianto')?>" class=""><i class="lnr lnr-plus-circle"></i> <span>Aggiungi impianto</span></a></li>
                <li><a href="<?php echo site_url('amministratore/modifica_impianto')?>" class=""><i class="lnr lnr-pencil"></i> <span>Modifica impianto</span></a></li>
                <li><a href="<?php echo site_url('amministratore/visualizza_eccezioni')?>" class=""><i class="lnr lnr-eye"></i> <span>Visualizza Eccezioni</span></a></li>
                <li><a href="<?php echo site_url('amministratore/carica_rilevazioni')?>" class=""><i class="lnr lnr-download"></i> <span>Ricevi Stringhe</span></a></li>
            </ul>
        </nav>
    </div>
</div>
