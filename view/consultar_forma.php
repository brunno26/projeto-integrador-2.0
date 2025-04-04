<!doctype html>
<html lang="pt-br">
    <head>
        <title>Consultar formas de pagamento</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- Bootstrap CSS v5.3.3 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="container d-flex justify-content-center mt-1">
                <form class="row p-3 m-3 border shadow-lg" method="post" action="index.php">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="desc_forma" class="form-label">Formas de Recebimento</label>
                                <input type="text" name="desc_forma" class="form-control" id="desc_forma" placeholder="Digite a forma de recebimento...">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button button type="submit" name="consultar_forma" class="btn btn-primary"><i class="bi bi-search"></i> Consultar</button>
                    </div>
                </form>
            </div>
            <div class="container table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-secondary">
                        <tr class="text-center">
                            <th>CÓDIGO</th>
                            <th>FORMA REC/PAG</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //mostrar os resultados
                            foreach ($resultado as $key => $valor) {
                                echo '<tr class="text-center">';
                                echo '  <th scope="row">' . $valor->id_cad_forma . '</th>';
                                echo '  <td class="text-start">' . $valor->desc_forma . '</td>';
                                echo '  <td>
                                            <button type="button" class="btn btn-secondary" title = "Alterar" data-bs-toggle="modal" data-bs-target="#alterar_forma' . $valor->id_cad_forma . '"><i class="bi bi-pencil"></i></button>
                                            <button type="button" class="btn btn-secondary" title = "Excluir" data-bs-toggle="modal" data-bs-target="#excluir_forma' . $valor->id_cad_forma . '"><i class="bi bi-trash"></i></button>
                                        </td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
                //criar os Modais de excluir e alterar
                foreach ($resultado as $key => $valor) {
                    $this->modal_excluir_forma($valor->id_cad_forma, $valor->desc_forma);
                    $this->modal_alterar_forma($valor->id_cad_forma, $valor->desc_forma);
                }
            ?>
        </main>
            <footer>
                <!-- place footer here -->
            </footer>
            <!-- Bootstrap JavaScript Libraries -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>