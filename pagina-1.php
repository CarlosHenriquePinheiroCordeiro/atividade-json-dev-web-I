<!DOCTYPE html>
<?php
    $iQtdValores  = isset($_POST['qtdValores'])  ? $_POST['qtdValores']  : 0;
    $iValorMinimo = isset($_POST['min'])         ? $_POST['min']         : 0;
    $iValorMaximo = isset($_POST['max'])         ? $_POST['max']         : 0;
    $sNomeArquivo = isset($_POST['nomeArquivo']) ? $_POST['nomeArquivo'] : '';
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/general-style.css">
        <link rel="stylesheet" href="css/pagina-1-style.css">
        <title>Página 1</title>
    </head>
    <body>
        <hr>
        <a href="index.php">Home</a>
        <a href="pagina-2.php">Página 2 - Abrir arquivo e gerar cálculos</a>
        <a href="pagina-2.php">Página 3 - Abrir arquivo e gerar gráfico</a>
        <hr>
        <h1>Página 1 - Informar valores</h1>
        <hr>
        <form method="post">
            <h2>Informar:</h2>
            <div class="fieldCampo">
                <fieldset>
                    <legend>Quantidade de valores do arquivos:</legend>
                    <input type="number" name="qtdValores" required value=<?= isset($_POST['qtdValores']) ? $_POST['qtdValores'] : ''?>>
                </fieldset>
            </div>
            <div class="fieldCampo">    
                <fieldset>
                    <legend>Menor valor possível:</legend>
                    <input type="number" name="min" required value=<?=isset($_POST['min']) ? $_POST['min'] : ''?>>
                </fieldset>
            </div>
            <div class="fieldCampo">
                <fieldset>
                    <legend>Maior valor possível:</legend>
                    <input type="number" name="max" required value=<?=isset($_POST['max']) ? $_POST['max'] : ''?>>
                </fieldset>
            </div>
            <div class="fieldCampo">
                <fieldset>
                    <legend>Nome do arquivo que será gerado:</legend>
                    <input type="text" name="nomeArquivo" required value=<?=isset($_POST['nomeArquivo']) ? $_POST['nomeArquivo'] : ''?>>
                </fieldset>
            </div>
            <br>
            <button type="submit">Gerar JSON</button>
        </form>
        
        <?php
            if ($iQtdValores > 0 && $iValorMinimo > 0 && $iValorMaximo > 0 && $sNomeArquivo != '') {
                $aValores = [];
                for ($i = 0; $i < $iQtdValores; $i++) {
                    $aValores[] = rand($iValorMinimo, $iValorMaximo);
                }
                try {
                    $aDadosJson = json_encode($aValores);
                    $oArquivo = fopen($sNomeArquivo.'.json', 'w');
                    fwrite($oArquivo, $aDadosJson);
                    fclose($oArquivo);
                    echo   '<div class="msg">
                            <fieldset>
                                <h2>Arquivo gerado com sucesso!</h2>
                            </fieldset>
                        </div>';
                } catch (Exception $eException) {
                    echo   '<div class="msg">
                            <fieldset>
                                <h2>Erro ao gerar o arquivo</h2>
                            </fieldset>
                        </div>';
                }
            }
        ?>
    </body>
</html>