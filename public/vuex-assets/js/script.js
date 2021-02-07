const btnAuth = document.getElementById('auth-btn');
const divBtnAuth = document.querySelector('.cont-btn-auth');
const divGoogle = document.querySelector('.grecaptcha-container');
const formMain = document.querySelector('.u-form');

btnAuth.addEventListener('click', () => {
    divGoogle.classList.toggle('d-inline-block');
    divGoogle.classList.toggle('d-none');
    divBtnAuth.classList.toggle('d-none');
    //formBody.submit();

    var docSpinner = new DocumentFragment();
    var docElement = document.createElement("div");
    docElement.innerHTML = `
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">...</span>
        </div>
        <br>
        <div class="badge badge-warning d-inline">Estamos procesando tu solicitud...</div>`;
    docSpinner.appendChild(docElement);
    formMain.insertBefore(docSpinner, divGoogle);
});