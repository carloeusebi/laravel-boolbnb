const deleteForms = document.querySelectorAll(".delete-form");
deleteForms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
    });
});
