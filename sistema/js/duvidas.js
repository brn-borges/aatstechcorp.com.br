const listDuvida = document.querySelector(".listar-Duvida");
const msgAlerta = document.getElementById("msgAlerta");

const listarDuvida = async (pagina) => {
    const dados = await fetch("duvidas/exibir-duvida.php?pagina=" + pagina);
    const resposta = await dados.text();
    listDuvida.innerHTML = resposta;
    
}

listarDuvida(1);



async function visDuvida(id_form) {
     //console.log("Acessou: " + id_form);
     const dados = await fetch('duvidas/ver-duvida.php?id_form=' + id_form);
     const resposta = await dados.json();
     //console.log(resposta);

     if (resposta['erro']) {
         msgAlerta.innerHTML = resposta['msg'];
         setTimeout(() => {
             msgAlerta.innerHTML = "";
         }, 5000)
     } else {
         const visModal = new bootstrap.Modal(document.getElementById("visDuvidaModal"));
         visModal.show();

        document.getElementById("idDuvida").innerHTML = resposta['dados'].id_form;
         document.getElementById("nomeDuvida").innerHTML = resposta['dados'].nome_form;
         document.getElementById("emailDuvida").innerHTML = resposta['dados'].email_form;
         document.getElementById("telefoneDuvida").innerHTML = resposta['dados'].telefone_form;
         document.getElementById("duvidaDuvida").innerHTML = resposta['dados'].duvida_form;
     }
}



 async function apagarDuvida(id_form) {

    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if(confirmar == true){
         const dados = await fetch('duvidas/apagar-duvida.php?id_form=' + id_form);

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
            listarDuvida(1);
        }
    }    

 }
