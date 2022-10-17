const Perfil = document.querySelector(".perfil");
let userId = (document.querySelector('#userId').attributes[2].name).slice(0,2)

const PerfilAtual = async (id_user) => {
  const dados = await fetch('perfil/ver-conta.php?id_user=' + id_user);
  const resposta = await dados.json()
  //console.log(resposta.dados)
  Perfil.innerHTML = resposta['dados'].nome_user;
  
}

PerfilAtual(userId);
 
 
 async function editPerfil(id_user) {
   
    const msgAlertaErroPerfil = document.getElementById("msgAlertaErroPerfil");
    const msgAlerta = document.getElementById("msgAlerta");
    msgAlertaErroPerfil.innerHTML = "";

    const dados = await fetch('perfil/ver-conta.php?id_user=' + id_user);
    const resposta = await dados.json();
     //console.log(resposta['dados'].senha_user);

     if (resposta['erro']) {
         msgAlerta.innerHTML = resposta['msg'];
         setTimeout(() => {
             msgAlerta.innerHTML = "";
         }, 5000)
     } else {
         const editModal = new bootstrap.Modal(document.getElementById("editPerfilModal"));
         editModal.show();
         document.getElementById("editIdPerfil").value = resposta['dados'].id_user;
         document.getElementById("editNomePerfil").value  = resposta['dados'].nome_user;
         document.getElementById("editSenhaPerfil").value  = (!resposta['dados'].senha_user && '');
         document.getElementById("editSenhaRepetirPerfil").value  = (!resposta['dados'].senha_user && '');
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

     const dados = await fetch("perfil/editar-conta.php", {
         method: "POST",
         body: dadosForm
     });

     const resposta = await dados.json();
     //console.log(resposta);

     if (resposta['erro']) {
      msgAlertaErroPerfil.innerHTML = resposta['msg'];
         setTimeout(() => {
          msgAlertaErroPerfil.innerHTML = "";
         }, 5000)
     } else {
      msgAlertaErroPerfil.innerHTML = resposta['msg'];
         setTimeout(() => {
             msgAlertaErroPerfil.innerHTML = "";
         }, 5000)
         PerfilAtual(userId)
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