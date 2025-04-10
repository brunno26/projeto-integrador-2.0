<!doctype html>
<html lang="pt-br">
    <head>
        <title>Cadastro de lançamentos</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- Bootstrap CSS v5.3.3 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- meu css estilizdo -->
        <link rel="stylesheet" href="static/style.css">
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="container d-flex justify-content-center mt-3">
                <form class="row p-3 border shadow-lg" method="post" action="index.php">
                    <div class="container text-center pb-2">
                        <h6>LANÇAMENTOS DE RECEBIMENTOS E PAGAMENTOS</h6>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <?php $this->selectTipo(); ?>
                        </div>
                        <div class="mb-3">
                            <?php $this->selectPlano(); ?>
                        </div>
                        <div class="mb-3">
                            <label for="desc_lanc" class="form-label">Descrição do lançamento:</label>
                            <input type="text" required name="desc_lanc" class="form-control" id="desc_lanc" placeholder="Digite a descrição do recebimento ou pagamento...">
                        </div>
                        <div class="mb-3">
                            <label for="data_venc" class="form-label">Data de vencimento:</label>
                            <input type="date" name="data_venc" class="form-control" id="data_venc" placeholder="Digite a data do vencimento...">
                        </div>
                        <div class="mb-3">
                            <label for="valor_lanc" class="form-label">Valor do lançamento:</label>
                            <input type="number" name="valor_lanc" class="form-control" id="valor_lanc" placeholder="Digite o valor do lançamento...">
                        </div>
                        <div class="mb-3">
                            <?php $this->selectForma(); ?>
                        </div>
                        <div class="mb-3">
                            <?php $this->selectBanco(); ?>
                        </div>
                        <div class="mb-3">
                            <?php $this->selectCartao(); ?>
                        </div>
                        <div class="mb-3">
                            <label for="data_rec_pag" class="form-label">Data de Rec/Pag:</label>
                            <input type="date" name="data_rec_pag" class="form-control" id="data_rec_pag" placeholder="Digite a data do rec/pag...">
                        </div>
                    </div>
                    <div>
                        <button type="reset" class="btn btn-danger"><i class="bi bi-x-circle"></i> Apagar</button>
                        <button type="submit" name="inserir_lancamento" class="btn btn-success"><i class="bi bi-floppy"></i> Salvar</button>
                    </div>
                </form>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
