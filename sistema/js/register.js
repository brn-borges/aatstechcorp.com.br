
const cadForm = document.getElementById("cad-usuario-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlerta = document.getElementById("msgAlerta");

cadForm.addEventListener("submit", async (e) => {
     e.preventDefault();

     document.getElementById("cad-usuario-btn").value = "Salvando...";
   
     if (document.getElementById("nome_user").value === "") {
         msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'> Preencha o campo Nome!</div>";
         setTimeout(() => {
             msgAlertaErroCad.innerHTML = "";
         }, 5000)
     } else if (document.getElementById("telefone_user").value === "") {
         msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Preencha o campo Telefone!</div>";
         setTimeout(() => {
             msgAlertaErroCad.innerHTML = "";
         }, 5000)
     } else if (document.getElementById("email_user").value === "") {
         msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Preencha o campo E-mail!</div>";
         setTimeout(() => {
             msgAlertaErroCad.innerHTML = "";
         }, 5000)
     } else if (document.getElementById("senha_user").value === "") {
         msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Preencha o campo Senha!</div>";
         setTimeout(() => {
             msgAlertaErroCad.innerHTML = "";
         }, 5000)
    } else if (document.getElementById("senha_repetir").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Preencha o campo Repetir Senha!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)

    } else if (document.getElementById("senha_repetir").value !== document.getElementById("senha_user").value) {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Preencha o campo Senha e Repetir Senha com a mesma senha!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else {
         const dadosForm = new FormData(cadForm);
         dadosForm.append("add", 1);

         const dados = await fetch("registrar/registrar.php", {
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
             document.getElementById("cad-usuario-btn").value = "Cadastrar";
             cadForm.reset();
             cadModal.hide();

         }
     }

     document.getElementById("cad-usuario-btn").value = "Cadastrar";
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