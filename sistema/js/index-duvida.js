const cadForm = document.getElementById("cad-duv-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlerta = document.getElementById("msgAlerta");


cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("cad-duv-btn").value = "Enviando...";
    
    if (document.getElementById("nome_form").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nome!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else if (document.getElementById("email_form").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo E-mail!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else if (document.getElementById("telefone_form").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Celular!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else if (document.getElementById("duvida_form").value === "") {
        msgAlertaErroCad.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Dúvida ou Sugestão!</div>";
        setTimeout(() => {
            msgAlertaErroCad.innerHTML = "";
        }, 5000)
    } else {
        const dadosForm = new FormData(cadForm);
        dadosForm.append("add", 1);

        const dados = await fetch("duv/duvida.php", {
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
            document.getElementById("cad-duv-btn").value = "Enviar";
            cadForm.reset();
            cadModal.hide();
        }
    }

    document.getElementById("cad-duv-btn").value = "Enviar";
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