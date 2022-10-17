const listProd = document.querySelector(".listar-Produtos");
const cadForm = document.getElementById("cad-produto-form");
const editForm = document.getElementById("edit-produto-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEditProd = document.getElementById("msgAlertaErroEditProd");
const msgAlertaProd = document.getElementById("msgAlertaProd");
const cadModal = new bootstrap.Modal(document.getElementById("criarProdutoModal"));

const listarProdutos = async (pagina) => {
    const dados = await fetch("produto/exibir-produto.php?pagina=" + pagina);
    const resposta = await dados.text();
    listProd.innerHTML = resposta;
}

listarProdutos(1);

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("cad-produto-btn").value = "Salvou";
    
    if (document.getElementById("nome_produt").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Produto!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else if (document.getElementById("qtde_produt").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Quantidade!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else if (document.getElementById("valor_produt").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Valor Unitário!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else if (document.getElementById("desc_produt").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Descrição!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else {
        const dadosForm = new FormData(cadForm);
        dadosForm.append("add", 1);

        const dados = await fetch("produto/criar-produto.php", {
            method: "POST",
            body: dadosForm,
        });

        const resposta = await dados.json();

        if (resposta['erro']) {
            msgAlertaErroCad.innerHTML = resposta['msg'];
            setTimeout(() => {
                msgAlertaErroCad.innerHTML = "";
            }, 5000)
        } else {
            msgAlertaProd.innerHTML = resposta['msg'];
            setTimeout(() => {
                msgAlertaProd.innerHTML = "";
            }, 5000)
            
            cadForm.reset();
            cadModal.hide();
            listarProdutos(1);
        }
    }

    document.getElementById("cad-produto-btn").value = "Cadastrar";
});

async function visProduto(id_produt) {
    //console.log("Acessou: " + id_form);
    const dados = await fetch('produto/ver-produto.php?id_produt=' + id_produt);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlertaProd.innerHTML = resposta['msg'];
        setTimeout(() => {
            msgAlertaProd.innerHTML = "";
        }, 5000)
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visProdutoModal"));
        visModal.show();

        document.getElementById("idProduto").innerHTML = resposta['dados'].id_produt;
        document.getElementById("nomeProduto").innerHTML = resposta['dados'].nome_produt;
        document.getElementById("qtdeProduto").innerHTML = resposta['dados'].qtde_produt;
        document.getElementById("valorProduto").innerHTML = resposta['dados'].valor_produt;
        document.getElementById("descricaoProduto").innerHTML = resposta['dados'].desc_produt;
    }

}

async function editProduto(id_produt) {
    msgAlertaErroEditProd.innerHTML = "";

    const dados = await fetch('produto/ver-produto.php?id_produt=' + id_produt);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlertaProd.innerHTML = resposta['msg'];
        setTimeout(() => {
            msgAlertaProd.innerHTML = "";
        }, 5000)
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editProdutoModal"));
        editModal.show();
        document.getElementById("editid").value = resposta['dados'].id_produt;
        document.getElementById("editnome").value  = resposta['dados'].nome_produt;
        document.getElementById("editqtde").value  = resposta['dados'].qtde_produt;
        document.getElementById("editvalor").value  = resposta['dados'].valor_produt;
        document.getElementById("editdesc").value  = resposta['dados'].desc_produt;
    }
}

editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-produto-btn").value = "Salvando...";

    const dadosForm = new FormData(editForm);
    //console.log(dadosForm);
    /*for (var dadosFormEdit of dadosForm.entries()){
        console.log(dadosFormEdit[0] + " - " + dadosFormEdit[1]);
    }*/

    const dados = await fetch("produto/editar-produto.php", {
        method: "POST",
        body: dadosForm
    });

    const resposta = await dados.json();
    
    if (resposta['erro']) {
        msgAlertaErroEditProd.innerHTML = resposta['msg'];
        setTimeout(() => {
            msgAlertaErroEditProd.innerHTML = "";
        }, 5000)
    } else {
        msgAlertaErroEditProd.innerHTML = resposta['msg'];
        setTimeout(() => {
            msgAlertaErroEditProd.innerHTML = "";
        }, 5000)
        listarProdutos(1);
    }

    document.getElementById("edit-produto-btn").value = "Salvar";
});

async function apagarProduto(id_produt) {

    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if(confirmar == true){
        const dados = await fetch('produto/apagar-produto.php?id_produt=' + id_produt);

        const resposta = await dados.json();
        if (resposta['erro']) {
            msgAlertaProd.innerHTML = resposta['msg'];
            setTimeout(() => {
                msgAlertaProd.innerHTML = "";
            }, 5000)
        } else {
            msgAlertaErroEditProd.innerHTML = resposta['msg'];
            setTimeout(() => {
                msgAlertaErroEditProd.innerHTML = "";
            }, 5000)
            listarProdutos(1);
           
        }
    }    

}

function formatarMoeda() {
    var elemento = document.getElementById('valor_produt');
    
    var valor = elemento.value;

    valor = valor + '';
    valor = parseInt(valor.replace(/[\D]+/g, ''));
    valor = valor + '';
    valor = valor.replace(/([0-9]{2})$/g, ",$1");

    if (valor.length > 6) {
        valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    }

    elemento.value = valor;
    if(valor == 'NaN') elemento.value = '';
}

function formatarMoedaEdit() {
    var elemento = document.getElementById('editvalor');
    
    var valor = elemento.value;

    valor = valor + '';
    valor = parseInt(valor.replace(/[\D]+/g, ''));
    valor = valor + '';
    valor = valor.replace(/([0-9]{2})$/g, ",$1");

    if (valor.length > 6) {
        valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    }

    elemento.value = valor;
    if(valor == 'NaN') elemento.value = '';
}

function somenteNumeros(num) {
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
      campo.value = "";
    }
}