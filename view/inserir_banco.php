<!doctype html>
<html lang="pt-br">
    <head>
        <title>SFP-GZ</title>
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
        <div class="container d-flex justify-content-center mt-5">
        <br>
        <form class="row p-3 m-3 border shadow-lg" method="post" action="index.php">
            <div class="col">
                <div class="mb-3">
                    <label for="banco" class="form-label">Bancos:</label>
                    <input type="text" required name="banco" class="form-control" id="banco" placeholder="Cadastre os bancos...">
                </div>
                <div class="mb-3">
                    <label for="agencia" class="form-label">Agências:</label>
                    <input type="text" required name="agencia" class="form-control" id="agencia" placeholder="Cadastre as agências...">
                </div>
                <div class="mb-3">
                    <label for="conta" class="form-label">Contas:</label>
                    <input type="text" required name="conta" class="form-control" id="conta" placeholder="Cadastre as contas...">
                </div>
            </div>
        <br>
        <div>
        <button type="reset" class="btn btn-danger"><i class="bi bi-x-circle"></i> Cancelar</button>
        <button type="submit" name="inserir_editora" class="btn btn-success"><i class="bi bi-floppy"></i> Salvar</button>
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
