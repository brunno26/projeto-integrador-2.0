console.log('Script de Lançamento Direto Carregado.'); // Mensagem de log atualizada

    // Referência ao elemento e à instância do Modal do Formulário
    const lancamentoModalElement = document.getElementById('lancamentoModal'); 
    const lancamentoModalInstance = new bootstrap.Modal(lancamentoModalElement);

    // Seleciona todos os botões de imagem na página que definem o tipo
    // (Lembre-se que eles são gerados pelo seu $this->selectTipo() agora)
    const botoesTipo = document.querySelectorAll('.btn-select-type'); 
    
    // Verificação de segurança para garantir que os botões foram encontrados
    if (botoesTipo.length === 0) {
        console.error('Erro: Nenhum botão com a classe .btn-select-type encontrado na página. Verifique o HTML gerado pelo PHP.');
    } else {
        console.log(`Encontrados ${botoesTipo.length} botões de tipo.`);
    }

    // Adiciona um listener de clique a cada botão de tipo
    botoesTipo.forEach(button => {
        button.addEventListener('click', function() {
            const tipoId = this.getAttribute('data-type'); // Pega o ID numérico (1 ou 2)

            console.log('--- Botão de Tipo Clicado ---');
            console.log('ID do Tipo selecionado:', tipoId);

            // Seleciona o input hidden dentro do modal do formulário
            // ATENÇÃO: O ID é 'idCadTipoInput' conforme o HTML que te dei por último!
            const idCadTipoInput = document.getElementById('idCadTipoInput'); 
            
            if (idCadTipoInput) {
                idCadTipoInput.value = tipoId; // Preenche o input hidden com o ID numérico
                console.log('Input hidden #idCadTipoInput PREENCHIDO com ID:', idCadTipoInput.value);
            } else {
                console.error('ERRO: Input hidden #idCadTipoInput NÃO ENCONTRADO no formulário!');
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

    // Listener para o evento 'show.bs.modal' do Modal do Formulário
    // (Útil para reconfirmar o título ou para outros setups no futuro)
    lancamentoModalElement.addEventListener('show.bs.modal', function (event) {
        console.log('--- Evento show.bs.modal do Modal de Lançamento disparado ---');
        
        const idCadTipoInput = document.getElementById('idCadTipoInput');
        let tipoLancamentoId = '';
        if (idCadTipoInput) {
            tipoLancamentoId = idCadTipoInput.value; 
        }
        
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
    lancamentoModalElement.addEventListener('hidden.bs.modal', function () {
        const idCadTipoInput = document.getElementById('idCadTipoInput');
        if (idCadTipoInput) {
            idCadTipoInput.value = ''; // Limpa o valor
            console.log('Input hidden #idCadTipoInput LIMPO ao fechar modal de lançamento.');
        }
    });