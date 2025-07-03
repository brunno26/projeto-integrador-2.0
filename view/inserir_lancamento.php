<!doctype html>
<html lang="pt-br">

<head>
    <title>Cadastro de Lançamentos</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="static/style.css">
</head>

<body>
    <header>
    </header>
    <main>
        <div class="container d-flex justify-content-center mt-3">
            <div class="d-flex justify-content-center gap-4">
                <?php
                // Este $this->selectTipo() está gerando os seus botões de imagem
                // (com data-type="1" e data-type="2") diretamente na página.
                $this->selectTipo();
                ?>
            </div>
        </div>

        <div class="modal fade" id="lancamentoModal" tabindex="-1" aria-labelledby="lancamentoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lancamentoModalLabel">Cadastro de Lançamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formLancamento" class="row p-3 m-3" method="post" action="index.php">
                            <div class="container text-center pb-2">
                                <h6 id="modalFormTitle">LANÇAMENTOS DE RECEBIMENTOS E PAGAMENTOS</h6>
                            </div>

                            <input type="hidden" name="id_cad_tipo" id="idCadTipoInput" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <?php $this->selectPlano(); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="desc_lanc" class="form-label">Descrição do lançamento:</label>
                                        <input type="text" required name="desc_lanc" class="form-control" id="desc_lanc" placeholder="Digite a descrição do recebimento ou pagamento...">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="data_venc" class="form-label">Data de vencimento:</label>
                                        <input type="date" required name="data_venc" class="form-control" id="data_venc" placeholder="Digite a data do vencimento...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="valor_lanc" class="form-label">Valor do lançamento:</label>
                                        <input type="text" required name="valor_lanc" class="form-control" id="valor_lanc" placeholder="Digite o valor do lançamento...">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <?php $this->selectForma(); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <?php $this->selectBanco(); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <?php $this->selectCartao(); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="data_rec_pag" class="form-label">Data de Rec/Pag:</label>
                                        <input type="date" name="data_rec_pag" class="form-control" id="data_rec_pag" placeholder="Digite a data do rec/pag...">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <button type="reset" class="btn btn-outline-info"><i class="bi bi-eraser"></i> Apagar</button>
                                <button type="submit" name="inserir_lancamento" class="btn btn-outline-info"><i class="bi bi-check-lg"></i> Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        console.log('Script de Modais Carregado.');

        // Referência à instância do Modal do Bootstrap para o formulário
        const lancamentoModalElement = document.getElementById('lancamentoModal');
        const lancamentoModalInstance = new bootstrap.Modal(lancamentoModalElement);

        // Seleciona todos os botões de imagem que definem o tipo
        const botoesTipo = document.querySelectorAll('.btn-select-type'); // Agora procura em toda a página

        if (botoesTipo.length === 0) {
            console.error('Erro: Nenhum botão com a classe .btn-select-type encontrado na página.');
        } else {
            console.log(`Encontrados ${botoesTipo.length} botões de tipo na página.`);
        }

        // Adiciona um listener de clique a cada botão de tipo (Receita/Despesa)
        botoesTipo.forEach(button => {
            button.addEventListener('click', function() {
                const tipoId = this.getAttribute('data-type'); // Pega o ID numérico (1 ou 2)

                console.log('--- Botão de Tipo Clicado ---');
                console.log('ID do Tipo selecionado:', tipoId);

                const idCadTipoInput = document.getElementById('idCadTipoInput'); // ID do input hidden no formulário

                if (idCadTipoInput) {
                    idCadTipoInput.value = tipoId; // Preenche o input hidden com o ID numérico
                    console.log('Input hidden #idCadTipoInput PREENCHIDO com ID:', idCadTipoInput.value);
                } else {
                    console.error('ERRO GRAVE: Input hidden #idCadTipoInput NÃO ENCONTRADO no formulário!');
                }

                // Abre o modal de lançamento (o formulário)
                lancamentoModalInstance.show();
                console.log('Modal de Lançamento (formulário) ABERTO.');

                // Opcional: Atualiza o título do modal do formulário
                const modalFormTitle = lancamentoModalElement.querySelector('#modalFormTitle');
                if (modalFormTitle) {
                    let tituloTexto = 'NOVO LANÇAMENTO';
                    if (tipoId === '1') {
                        tituloTexto = 'NOVO LANÇAMENTO DE RECEBIMENTO';
                    } else if (tipoId === '2') {
                        tituloTexto = 'NOVO LANÇAMENTO DE PAGAMENTO';
                    }
                    modalFormTitle.textContent = tituloTexto;
                    console.log('Título do modal de formulário atualizado.');
                }
            });
        });

        // Opcional: Listener para quando o modal do formulário for exibido
        lancamentoModalElement.addEventListener('show.bs.modal', function(event) {
            console.log('--- Evento show.bs.modal do Modal de Lançamento disparado ---');

            const idCadTipoInput = document.getElementById('idCadTipoInput');
            let tipoLancamentoId = '';
            if (idCadTipoInput) {
                tipoLancamentoId = idCadTipoInput.value;
            } else {
                console.error('ERRO: Input hidden #idCadTipoInput não encontrado no listener show.bs.modal!');
            }

            // Atualiza o título do modal com base no ID
            const modalFormTitle = lancamentoModalElement.querySelector('#modalFormTitle');
            if (modalFormTitle && tipoLancamentoId) {
                let tituloTexto = 'LANÇAMENTOS';
                if (tipoLancamentoId === '1') {
                    tituloTexto = 'NOVO LANÇAMENTO DE RECEBIMENTO';
                } else if (tipoLancamentoId === '2') {
                    tituloTexto = 'NOVO LANÇAMENTO DE PAGAMENTO';
                }
                modalFormTitle.textContent = tituloTexto;
            }
            console.log('ID final do tipoLancamentoInput no show.bs.modal:', tipoLancamentoId);
        });

        // Opcional: Limpar o input hidden ao fechar o modal de lançamento
        lancamentoModalElement.addEventListener('hidden.bs.modal', function() {
            const idCadTipoInput = document.getElementById('idCadTipoInput');
            if (idCadTipoInput) {
                idCadTipoInput.value = ''; // Limpa o valor para evitar persistência
                console.log('Input hidden #idCadTipoInput LIMPO ao fechar modal de lançamento.');
            }
            // Opcional: Restaurar título padrão, se necessário
            // const modalFormTitle = lancamentoModalElement.querySelector('#modalFormTitle');
            // if (modalFormTitle) {
            //     modalFormTitle.textContent = 'LANÇAMENTOS DE RECEBIMENTOS E PAGAMENTOS';
            // }
        });
    </script>
</body>

</html>