eContainer = document.querySelector(".main-container");
eForm = document.querySelector(".form-main");

document.addEventListener("load", () => {
    alert("hola");
});

eForm.addEventListener("submit", () => {
    eContainer.innerhtml = `
        Obteniendo Auth
    `;
});