const form = document.getElementById("registration-form");

/**
 * Checks if there are Errors, based on the number of the errors Object keys.
 * @param {Object} errors The errors
 * @returns {Boolean}
 */
const thereAreErrors = (errors) => Object.keys(errors).length > 0;

/**
 *Validate the form
 * @param {HTMLFormElement} form The form to validate.
 * @returns {[Object]} The errors, if any.
 */

const validateForm = () => {
    const first_name = form["first_name"].value.trim();
    const lastName = form["last_name"].value.trim();
    const email = form["email"].value.trim();
    const password = form["password"].value.trim();
    const password_confirmation = form["password_confirmation"].value.trim();

    const errors = {};

    if (first_name.length > 80)
        errors.first_name = "Il nome non può essere piu' lungo di 80 caratteri";
    if (/[^a-zA-Z0-9\-\/]/.test(first_name))
        errors.first_name =
            "Il nome non può contenere caratteri speciali o numeri";
    if (lastName.length > 80)
        errors.lastName = "Il nome non può essere piu' lungo di 80 caratteri";
    if (/[^a-zA-Z0-9\-\/]/.test(lastName))
        errors.lastName =
            "Il cognome non può contenere caratteri speciali o numeri";
    if (!email) errors.email = "L'indirizzo email è obbligatiorio";
    if (!email.includes("@") || email.length < 15)
        errors.email = "Indirizzo email non valido";

    if (!password) errors.password = "La password è obbligatioria";

    if (!password_confirmation)
        errors.password_confirmation = "Devi confermare la password";

    if (password.length < 8)
        errors.password = "La password deve essere di almeno 8 caratteri";

    if (password !== password_confirmation)
        errors.password_confirmation = "Le passoword non corrispondono";

    return errors;
};

/**
 * Display the errors, if Any
 * @param {Object} errors The errors
 */

const displayErrors = (errors) => {
    if (!thereAreErrors(errors)) return;

    // invalid input for every error in form with error message
    for (let field in errors) {
        form[field].classList.add("is-invalid");

        document.getElementById(`${field}_feedback`).innerText = errors[field];
    }
};

const clearErrors = () => {
    form.querySelectorAll("input").forEach((inputElement) => {
        inputElement.addEventListener("input", () => {
            inputElement.classList.remove("is-invalid");
        });
    });
};

const handleFormSubmission = (e) => {
    e.preventDefault();

    clearErrors();
    const errors = validateForm(form);

    if (thereAreErrors(errors)) {
        displayErrors(errors);
    } else {
        form.submit();
    }
};

form.addEventListener("submit", handleFormSubmission);
