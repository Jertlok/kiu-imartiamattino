<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 20/01/2018
 * Time: 15:36
*/


/* Sidebar for Proprietario */
?>

<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="<? echo site_url ('proprietario/index')?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="<? echo site_url ('proprietario/visualizza_impianti')?>" class=""><i class="lnr lnr-eye"></i> <span>Visualizza Dati</span></a></li>
                <li><a href="<? echo site_url ('proprietario/nuova_terzaparte')?>" class=""><i class="lnr lnr-plus-circle"></i> <span>Aggiungi Terza Parte</span></a></li>
                <li><a href="<? echo site_url ('proprietario/invia_dati')?>" class=""><i class="lnr lnr-upload"></i> <span>Invia Dati</span></a></li>

            </ul>
        </nav>
    </div>
</div>
