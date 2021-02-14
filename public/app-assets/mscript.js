eContainer = document.querySelector(".main-container");
eForm = document.querySelector(".form-main");
eButton = document.querySelector(".btn-action");

eForm.addEventListener("submit", () => {
    document.querySelector(".cap-container").style.display="none";
    eButton.innerText = "Cargando...";
    eButton.disabled = true;

    var div2 = document.createElement("div");
    div2.classList.add("col-12");
    div2.classList.add("text-center");
    div2.innerHTML = "<span class='badge badge-glow badge-warning'> Autentificando por favor, espera... El proceso puede tardar de 1 a 3 minutos </span>";
    insertAfter(eContainer, div2);
});


function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
  }