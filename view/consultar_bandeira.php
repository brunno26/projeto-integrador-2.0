<!doctype html>
<html lang="pt-br">
    <head>
        <title>Consulta de bandeiras de cartões</title>
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
            <div class="container-fluid">
                <form method="post" action="index.php">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="nome_bandeira" class="form-label">Bandeira</label>
                                <input type="text" name="nome_bandeira" class="form-control" id="nome_bandeira" placeholder="Digite o nome da bandeira de cartão...">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button button type="submit" name="consultar_bandeira" class="btn btn-primary"><i class="bi bi-search"></i> Consultar</button>
                    </div>
                </form>
            </div>
            <div class="container-fluid">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>CÓDIGO</th>
                            <th>NOME DA BANDEIRA</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //mostrar os resultados
                            foreach ($resultado as $key => $valor) {
                                echo '<tr>';
                                echo '  <th scope="row">' . $valor->id_cad_band . '</th>';
                                echo '  <td>' . $valor->nome_band . '</td>';
                                echo '  <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alterar_bandeira' . $valor->id_cad_band . '"><i class="bi bi-pencil-square"></i> Alterar</button>
                                            <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#excluir_bandeira' . $valor->id_cad_band . '"><i class="bi bi-x-square-fill"></i> Excluir</button>
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
                    $this->modal_excluir_bandeira($valor->id_cad_band, $valor->nome_band);
                    $this->modal_alterar_bandeira($valor->id_cad_band, $valor->nome_band);
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