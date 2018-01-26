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
                $id = $sensore['ID'] = 'int';
                $tipo = $sensore['Tipo'] = 'string';
                $marca = $Sensore['Marca'] = 'string';
                $id_impianto = "int";
                echo form_open('amministratore/perform_update_sensore');?>
                <div class="form-group">
                    <label for="sensore">Tipo sensore</label>
                    <select class="form-control" name="Tipo">
                        <option <?php if(strcmp($tipo, 'Temperatura') === 0) echo 'selected';?>>Temperatura</option>
                        <option <?php if(strcmp($tipo, 'Pressione') === 0) echo 'selected';?>>Pressione</option>
                        <option <?php if(strcmp($tipo, 'pH') === 0) echo 'selected';?>>pH</option>
                        <option <?php if(strcmp($tipo, 'Umidità') === 0) echo 'selected';?>>Umidità</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="impianto">Marca sensore</label>
                    <input type="text" class="form-control" name="Marca" placeholder="Marca sensore" value="<?= $marca ?>">
                </div>
                    <input type="hidden" name="id_sensore" value="<?=$id?>">
                    <input type="hidden" name="id_impianto" value="<?=$id_impianto?>">
                    <button type="submit" class="btn btn-primary">Aggiorna</button>
                </form>
            </pre>
        </div>
    </div>
</div>


