let activeForm = null;
const modal = document.getElementById("modal");
const modalTitle = modal.querySelector(".modal-body");
const modalBody = modal.querySelector(".modal-title");
const modalConfirmButton = modal.querySelector(".confirmation-button");

const deleteForms = document.querySelectorAll(".delete-form");
deleteForms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        modalConfirmButton.innerText = "Conferma";
        modalConfirmButton.classList.add("btn-danger");
        modalTitle.innerText = `L'Appartamento selezionato verrà eliminato`;
        modalBody.innerText = "Eliminazione appartamento";

        activeForm = form;
    });
});

modalConfirmButton.addEventListener("click", () => {
    if (activeForm) activeForm.submit();
});

modal.addEventListener("hidden.bs.modal", () => {
    activeForm = null;
});
