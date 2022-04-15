<?php
    $sNomeArquivo = isset($_POST['nomeArquivo']) ? $_POST['nomeArquivo'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/general-style.css">
        <link rel="stylesheet" href="css/pagina-2-style.css">
        <title>Página 2</title>
    </head>
    <body>
    <hr>
        <a href="index.php">Home</a>
        <a href="pagina-1.php">Página 1 - Gerar arquivo</a>
        <a href="pagina-3.php">Página 3 - Abrir arquivo e gerar gráfico</a>
        <hr>
        <h1>Página 2 - Abrir arquivo e gerar cálculos</h1>
        <hr>
        <form method="post">
            <fieldset class="fieldCampo">
                <legend>Informe o nome do arquivo a ser aberto</legend>
                <input type="text" name="nomeArquivo" required value=<?= isset($_POST['nomeArquivo']) ? $_POST['nomeArquivo'] : ''?>>
            </fieldset>
            <br>
            <button type="submit">Abrir arquivo</button>
        </form>
        <?php
            if ($sNomeArquivo != '') {
                try {
                    $oConteudo = file_get_contents($sNomeArquivo.'.json');
                    if ($oConteudo) {

                    }
                    else {
                        mensagemErro('Ocorreu um erro ao tentar ler o arquivo '.$sNomeArquivo.'.json');
                    }
                    // $aValores  = json_decode($oConteudo);
                    // echo resultado('Maior Número'               , maiorNumero($aValores));
                    // echo resultado('Menor Número'               , menorNumero($aValores));
                    // echo resultado('Números Pares'              , pares($aValores));
                    // echo resultado('Números Ímpares'            , impares($aValores));
                    // echo resultado('Soma'                       , soma($aValores));
                    // echo resultado('Média'                      , media($aValores));
                    // echo resultado('Elementos acima da média'   , acimaMedia($aValores));
                    // echo resultado('Elementos abaixo da média'  , abaixoMedia($aValores));
                    // echo resultado('Números Primos'             , primos($aValores));
                    // echo resultado('Mediana'                    , mediana($aValores));
                } catch (Exception $eException) {
                    mensagemErro('Um erro inesperado aconteceu.');
                }
            }

            function resultado($sMensagem, $xValor) {
                $sStringValor = $xValor;
                if (is_array($xValor)) {
                    $sStringValor = '';
                    foreach ($xValor as $iValor) {
                        $sStringValor .= $iValor.' ';
                    }
                }
                return '<h2>'.$sMensagem.': '.$sStringValor.'</h2><br>';
            }

            function maiorNumero($aValores) {
                $iMaior = $aValores[0];
                foreach ($aValores as $iValor) {
                    if ($iValor > $iMaior) {
                        $iMaior = $iValor;
                    }
                }
                return $iMaior;
            }

            function menorNumero($aValores) {
                $iMenor = $aValores[0];
                foreach ($aValores as $iValor) {
                    if ($iValor < $iMenor) {
                        $iMenor = $iValor;
                    }
                }
                return $iMenor;
            }

            function pares($aValores) {
                $aPares = [];
                foreach ($aValores as $iValor) {
                    if ($iValor % 2 == 0) {
                        $aPares[] = $iValor;
                    }
                }
                return $aPares;
            }

            function impares($aValores) {
                $aImpares = [];
                foreach ($aValores as $iValor) {
                    if ($iValor % 2 != 0) {
                        $aImpares[] = $iValor;
                    }
                }
                return $aImpares;
            }

            function soma($aValores) {
                $iSoma = 0;
                foreach ($aValores as $iValor) {
                    $iSoma += $iValor;
                }
                return $iSoma;
            }

            function media($aValores) {
                return soma($aValores)/count($aValores);
            }

            function acimaMedia($aValores) {
                $iMedia      = media($aValores);
                $aAcimaMedia = [];
                foreach ($aValores as $iValor) {
                    if ($iValor > $iMedia) {
                        $aAcimaMedia[] = $iValor;
                    }
                }
                return $aAcimaMedia;
            }

            function abaixoMedia($aValores) {
                $iMedia      = media($aValores);
                $aAbaixoMedia = [];
                foreach ($aValores as $iValor) {
                    if ($iValor < $iMedia) {
                        $aAbaixoMedia[] = $iValor;
                    }
                }
                return $aAbaixoMedia;
            }

            function divisores($iValor) {
                $aDivisores = [];
                for ($i = $iValor; $i > 0; $i--) {
                    if ($iValor % $i == 0) {
                        $aDivisores[] = $i;
                    }
                }
                return $aDivisores;
            }

            function primos($aValores) {
                $aPrimos = [];
                foreach ($aValores as $iValor) {
                    if (count(divisores($iValor)) <= 2) {
                        $aPrimos[] = $iValor;
                    }
                }
                return $aPrimos;
            }

            function mediana($aValores) {
                $aNumeros   = $aValores;
                $iMeioArray = ceil(count($aNumeros) / 2);
                sort($aNumeros);
                if (count($aNumeros) % 2 != 0) {
                    return $aNumeros[$iMeioArray];
                }
                return ($aNumeros[$iMeioArray - 1] + $aNumeros[$iMeioArray]) / 2;
            }

            function mensagemErro($sConteudo) {
                echo   '<div class="msg">
                            <fieldset>
                                <h2>'.$sConteudo.'</h2>
                            </fieldset>
                        </div>';
            }
        ?>
    </body>
</html>