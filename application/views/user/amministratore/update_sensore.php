<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 22/01/2018
 * Time: 00:40
 */


?>

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
                <?php
                $sensore['ID'] = 'int';
                $sensore['Tipo'] = 'string';
                $Sensore['Marca'] = 'string';
                $id_impianto = "int";
                echo form_open('amministratore/perform_update_sensore');?>
                <div class="form-group">
                    <label for="sensore">Tipo sensore</label>
                    <select class="form-control" name="Tipo">
                        <option <?php if(strcmp($sensore['Tipo'], 'Temperatura') === 0) echo 'selected';?>>Temperatura</option>
                        <option <?php if(strcmp($sensore['Tipo'], 'Pressione') === 0) echo 'selected';?>>Pressione</option>
                        <option <?php if(strcmp($sensore['Tipo'], 'pH') === 0) echo 'selected';?>>pH</option>
                        <option <?php if(strcmp($sensore['Tipo'], 'Umidità') === 0) echo 'selected';?>>Umidità</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="impianto">Marca sensore</label>
                    <input type="text" class="form-control" name="Marca" placeholder="Marca sensore" value="<?= $sensore['Marca']?>">
                </div>
                    <input type="hidden" name="id_sensore" value="<?=$sensore['ID']?>">
                    <input type="hidden" name="id_impianto" value="<?=$id_impianto?>">
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                </form>
            </pre>
        </div>
    </div>
</div>


