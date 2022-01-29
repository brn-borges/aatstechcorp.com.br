const listConta = document.querySelector(".listar-Conta");
const cadForm = document.getElementById("cad-conta-form");
const editForm = document.getElementById("edit-conta-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("criarContaModal"));

const listarConta = async (pagina) => {
    const dados = await fetch("contas/exibir-conta.php?pagina=" + pagina);
    const resposta = await dados.text();
    listConta.innerHTML = resposta;
}

listarConta(1);

cadForm.addEventListener("submit", async (e) => {
     e.preventDefault();

     document.getElementById("cad-conta-btn").value = "Salvou";
   
     if (document.getElementById("nome_user").value === "") {
         msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nome!</div>";
         setTimeout(() => {
             msgAlertaErroCad.innerHTML = "";
         }, 5000)
     } else if (document.getElementById("telefone_user").value === "") {
         msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Telefone!</div>";
         setTimeout(() => {
             msgAlertaErroCad.innerHTML = "";
         }, 5000)
     } else if (document.getElementById("email_user").value === "") {
         msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo E-mail!</div>";
         setTimeout(() => {
             msgAlertaErroCad.innerHTML = "";
         }, 5000)
     } else if (document.getElementById("senha_user").value === "") {
         msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Senha!</div>";
         setTimeout(() => {
             msgAlertaErroCad.innerHTML = "";
         }, 5000)
    } else if (document.getElementById("senha_repetir").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Repetir Senha!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)

    } else if (document.getElementById("senha_repetir").value !== document.getElementById("senha_user").value) {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário que o campo Senha e Repetir Senha seja Iguais!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else {
         const dadosForm = new FormData(cadForm);
         dadosForm.append("add", 1);

         const dados = await fetch("contas/criar-conta.php", {
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
             listarConta(1);
         }
     }

     document.getElementById("cad-conta-btn").value = "Cadastrar";
 });

 async function visConta(id_user) {
    
     const dados = await fetch('contas/ver-conta.php?id_user=' + id_user);
     const resposta = await dados.json();
    

     if (resposta['erro']) {
         msgAlerta.innerHTML = resposta['msg'];
         setTimeout(() => {
             msgAlerta.innerHTML = "";
         }, 5000)
     } else {
         const visModal = new bootstrap.Modal(document.getElementById("visContaModal"));
         visModal.show();

         document.getElementById("idConta").innerHTML = resposta['dados'].id_user;
         document.getElementById("nomeConta").innerHTML = resposta['dados'].nome_user;
         document.getElementById("telefoneConta").innerHTML = resposta['dados'].telefone_user;
         document.getElementById("emailConta").innerHTML = resposta['dados'].email_user;
         
     }

}

 async function editConta(id_user) {
     msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('contas/ver-conta.php?id_user=' + id_user);
    const resposta = await dados.json();
     //console.log(resposta);

     if (resposta['erro']) {
         msgAlerta.innerHTML = resposta['msg'];
         setTimeout(() => {
             msgAlerta.innerHTML = "";
         }, 5000)
     } else {
         const editModal = new bootstrap.Modal(document.getElementById("editContaModal"));
         editModal.show();
         document.getElementById("editIdUser").value = resposta['dados'].id_user;
         document.getElementById("editNomeUser").value  = resposta['dados'].nome_user;
         document.getElementById("editTelefoneUser").value  = resposta['dados'].telefone_user;
         document.getElementById("editEmailUser").value  = resposta['dados'].email_user;
         document.getElementById("editSenhaUser").value  = resposta['dados'].senha_user;
         document.getElementById("editSenhaRepetir").value  = resposta['dados'].senha_user;
     }
 }

 editForm.addEventListener("submit", async (e) => {
     e.preventDefault();

     document.getElementById("edit-conta-btn").value = "Salvando...";

     const dadosForm = new FormData(editForm);
     //console.log(dadosForm);
     /*for (var dadosFormEdit of dadosForm.entries()){
         console.log(dadosFormEdit[0] + " - " + dadosFormEdit[1]);
     }*/

     const dados = await fetch("contas/editar-conta.php", {
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
         listarConta(1);
     }

    document.getElementById("edit-conta-btn").value = "Alterar";
 });

async function apagarConta(id_user) {

     var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

     if(confirmar == true){
         const dados = await fetch('contas/apagar-conta.php?id_user=' + id_user);

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
             listarConta(1);
           
         }
     }    

 }

 function mask(o, f) {
    setTimeout(function() {
      var v = mphone(o.value);
      if (v != o.value) {
        o.value = v;
      }
    }, 1);
  }
  
  function mphone(v) {
    var r = v.replace(/\D/g, "");
    r = r.replace(/^0/, "");
    if (r.length > 10) {
      r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (r.length > 5) {
      r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (r.length > 2) {
      r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
      r = r.replace(/^(\d*)/, "($1");
    }
    return r;
  }