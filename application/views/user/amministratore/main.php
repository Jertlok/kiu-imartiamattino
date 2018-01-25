<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 20/01/2018
 * Time: 11:00
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Benvenuto, <?=$this->session->username?></h3>
                    <p class="panel-subtitle">Ecco il tuo sommario</p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-server"></i></span>
                                <p>
                                    <span class="number"><?= $summary['n_impianti']?></span>
                                    <span class="title">Impianti installati</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-thermometer"></i></span>
                                <p>
                                    <span class="number"><?= $summary['sensori']['n_sensori']?></span>
                                    <span class="title">Sensori installati</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OVERVIEW -->
        </div>
    </div>
</div>
