const listProd = document.querySelector(".listar-Produtos");
const cadForm = document.getElementById("cad-produto-form");
const editForm = document.getElementById("edit-produto-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
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
            msgAlerta.innerHTML = resposta['msg'];
            setTimeout(() => {
                msgAlerta.innerHTML = "";
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
        msgAlerta.innerHTML = resposta['msg'];
        setTimeout(() => {
            msgAlerta.innerHTML = "";
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
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('produto/ver-produto.php?id_produt=' + id_produt);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlerta.innerHTML = resposta['msg'];
        setTimeout(() => {
            msgAlerta.innerHTML = "";
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
    //console.log(resposta);

    if (resposta['erro']) {
        msgAlertaErroEdit.innerHTML = resposta['msg'];
        setTimeout(() => {
            msgAlertaErroEdit.innerHTML = "";
        }, 5000)
    } else {
        msgAlertaErroEdit.innerHTML = resposta['msg'];
        setTimeout(() => {
            msgAlertaErroEdit.innerHTML = "";
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
            msgAlerta.innerHTML = resposta['msg'];
            setTimeout(() => {
                msgAlerta.innerHTML = "";
            }, 5000)
        } else {
            msgAlerta.innerHTML = resposta['msg'];
            setTimeout(() => {
                msgAlerta.innerHTML = "";
            }, 5000)
            listarProdutos(1);
           
        }
    }    

}

function moeda(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a.value = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u)
    }
    return !1
}

function somenteNumeros(num) {
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
      campo.value = "";
    }
}