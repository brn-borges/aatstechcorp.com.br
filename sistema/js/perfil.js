 async function editPerfil(id_user) {
   
    const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
    const msgAlerta = document.getElementById("msgAlerta");
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
         const editModal = new bootstrap.Modal(document.getElementById("editPerfilModal"));
         editModal.show();
         document.getElementById("editIdUser").value = resposta['dados'].id_user;
         document.getElementById("editNomeUser").value  = resposta['dados'].nome_user;
         document.getElementById("editTelefoneUser").value  = resposta['dados'].telefone_user;
         document.getElementById("editEmailUser").value  = resposta['dados'].email_user;
         document.getElementById("editSenhaUser").value  = resposta['dados'].senha_user;
         document.getElementById("editSenhaRepetir").value  = resposta['dados'].senha_user;
     }
 }

document.getElementById("edit-perfil-form").addEventListener("submit", async (e) => {
     e.preventDefault();
     
     const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
     document.getElementById("edit-conta-btn").value = "Salvando...";

     const dadosForm = new FormData(document.getElementById("edit-perfil-form"));
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
     }

    document.getElementById("edit-conta-btn").value = "Alterar";
 });


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