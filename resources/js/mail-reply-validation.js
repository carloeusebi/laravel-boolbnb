const form = document.getElementById("mail-form");

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
    const email = form["admin_email"].value.trim();
    const subject = form["subject"].value.trim();
    const content = form["content"].value.trim();
    const errors = {};

    if (!email) errors.email = "L'indirizzo è obbligatorio";
    if (!subject) errors.subject = "L'oggetto è obbligatorio";
    if (subject.length > 80)
        errors.subject = "L'oggetto non può essere piu' lungo di 80 caratteri";
    if (email.length > 80)
        errors.email =
            "L'indirizzo email non può essere piu' lungo di 80 caratteri";
    if (!content) errors.content = "Il messaggio è obbligatoria";

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
        inputElement.classList.remove("is-invalid");
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
