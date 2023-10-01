const form = document.getElementById("apartment-form");

const validateForm = (form) => {};

form.addEventListener("submit", (e) => {
    const thereAreErrors = (errors) => Object.keys(errors).length > 0;

    e.preventDefault();

    const errors = validateForm(this);

    if (thereAreErrors) {
        // display errors
    } else {
        this.submit();
    }
});
