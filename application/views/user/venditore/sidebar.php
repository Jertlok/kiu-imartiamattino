<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 22/01/2018
 * Time: 12:26
 */

/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 20/01/2018
 * Time: 15:36
*/
defined('BASEPATH') OR exit('No direct script access allowed');

/* Sidebar for Venditore */
?>

<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="<? echo site_url ('venditore/index')?>" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="<? echo site_url ('venditore/aggiungi_proprietario')?>" class=""><i class="lnr lnr-plus-circle"></i> <span>Aggiungi Proprietario</span></a></li>
                <li><a href="<? echo site_url ('venditore/visualizza_proprietari')?>" class=""><i class="lnr lnr-eye"></i> <span>Visualizza Proprietari</span></a></li>
            </ul>
        </nav>
    </div>
</div>
