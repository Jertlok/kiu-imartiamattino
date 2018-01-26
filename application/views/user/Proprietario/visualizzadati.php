<?php


if((count($labels) > 0) and (count($series) > 0)) {
    $valuesOk = true;
    $json_labels = new ArrayObject();
    $json_series = new ArrayObject();

    foreach ($labels as $inner)
        foreach ($inner as $value)
            $json_labels->append($value);

    foreach ($series as $inner)
        foreach ($inner as $value)
            $json_series->append($value);

    $json_labels = json_encode(array_values($json_labels->getArrayCopy()));
    $json_series = json_encode(array_values($json_series->getArrayCopy()));
    }

    ?>

<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div id="chart" class="container-fluid">
            <?php echo form_open('proprietario/visualizza_dati_impianto', 'class = "form-inline"'); // send to creation method;?>
                <div class="form-group">
                    <label for="daterange">Range date</label>
                    <input id ="date" class = "form-control" type="text" name="daterange" placeholder="Data range" value="<?php if (isset($date_range)=== true) echo $date_range;
                    if(isset($initial_date)=== true) echo $initial_date," - ",date('Y-m-d');?>" />
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo sensore</label>
                    <select class="form-control" name="tipo">
                        <option style="display:none" disabled selected value>Seleziona un tipo di sensore</option>
                        <option <?php if(strcmp($tipo, 'Temperatura') === 0) echo 'selected';?>>Temperatura</option>
                        <option <?php if(strcmp($tipo, 'Pressione') === 0) echo 'selected';?>>Pressione</option>
                        <option <?php if(strcmp($tipo, 'pH') === 0) echo 'selected';?>>pH</option>
                        <option <?php if(strcmp($tipo, 'Umidità') === 0) echo 'selected';?>>Umidità</option>
                    </select>
                </div>
                <input type="hidden" name="id_impianto" value="<?=$id_impianto?>">
                <button type="submit" class="btn btn-primary">Aggiorna</button>
            </form>
        </div>
    </div>
</div>




<script>


    <?php if(isset($valuesOk)=== false ) {
        echo "    $(function() {
        $('#date').daterangepicker(
            {
                locale: {
                    format: \'YYYY-MM-DD\'
                }
            },
            function (start, end, label) {

            }); toastr.info('Non sono presenti dati con i filtri inseriti.')
    });";} else {?>

    $(function() {
        // post to controller method
        $('#date').daterangepicker(
            {
                locale: {
                    format: 'YYYY-MM-DD'
                }
            },
            function(start, end, label) {

            });

        var options;
        var data = {
            labels: <?=$json_labels?>,
            series: [
                <?=$json_series?>,
            ]
        };

        // line chart
        options = {
            height: "300px",
            showPoint: true,
            axisX: {
                showGrid: false
            },
            lineSmooth: false,
            showArea: true
        };

        new Chartist.Line('#chart', data, options);
    });
    <?php } ?>
</script>