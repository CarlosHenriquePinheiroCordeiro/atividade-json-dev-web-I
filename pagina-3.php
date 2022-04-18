<?php
    $sNomeArquivo = isset($_POST['nomeArquivo']) ? $_POST['nomeArquivo'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/general-style.css">
        <link rel="stylesheet" href="css/pagina-3-style.css">
        <title>Página 3</title>
    </head>
    <body>
    <hr>
        <a href="index.php">Home</a>
        <a href="pagina-1.php">Página 1 - Gerar arquivo</a>
        <a href="pagina-2.php">Página 2 - Abrir arquivo e gerar cálculos</a>
        <hr>
        <h1>Página 3 - Abrir arquivo e gerar gráfico</h1>
        <hr>
        <form method="post">
            <fieldset class="fieldCampo">
                <legend>Informe o nome do arquivo a ser aberto</legend>
                <input type="text" name="nomeArquivo" required value=<?= isset($_POST['nomeArquivo']) ? $_POST['nomeArquivo'] : ''?>>
            </fieldset>
            <br>
            <button type="submit">Gerar gráfico</button>
        </form>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(
            <?php
                if ($sNomeArquivo != '') {
                    try {
                        $oConteudo       = file_get_contents($sNomeArquivo.'.json');
                        $aValores        = json_decode($oConteudo);
                        $aValoresGrafico = '[[\'Índice\', \'Valor\']';
                        for ($i = 0; $i < count($aValores); $i++) {
                            $aValoresGrafico .= ',['.($i + 1).', '.$aValores[$i].']';
                        }
                        $aValoresGrafico .= ']';
                        echo $aValoresGrafico;
                    } catch (Exception $eException) {}
                }
            ?>
            );

            var options = {
            title: 'Valores JSON',
            curveType: 'function',
            legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('graficoValores'));

            chart.draw(data, options);
        }
        </script>
        <?php
            if ($sNomeArquivo != '') {
                echo '<div id="graficoValores" style="width: 900px; height: 500px"></div>';
            }
        ?>
    </body>
</html>