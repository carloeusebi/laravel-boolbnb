const form = document.getElementById("apartment-form");

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
    const name = form["name"].value.trim();
    const description = form["description"].value.trim();
    const address = form["address"].value.trim();
    const rooms = form["rooms"].value.trim();
    const bedrooms = form["bedrooms"].value.trim();
    const bathrooms = form["bathrooms"].value.trim();
    const square_meters = form["square_meters"].value.trim();

    const errors = {};

    if (!name) errors.name = "Il Titolo è obbligatorio";
    if (name.length > 80)
        errors.name = "Il nome non può essere piu' lungo di 80 caratteri";
    if (!description) errors.description = "La descrizione è obbligatoria";
    if (isNaN(rooms) || rooms < 0 || rooms > 100)
        errors.rooms =
            "Il numero di stanze deve essere un numero compreso tra 0 e 100";
    if (isNaN(bedrooms) || bedrooms < 0 || bedrooms > 100)
        errors.bedrooms =
            "Il numero di camere da letto deve essere un numero compreso tra 0 e 100";
    if (isNaN(bathrooms) || bathrooms < 0 || bathrooms > 100)
        errors.bathrooms =
            "Il numero di bagni deve essere un numero compreso tra 0 e 999";
    if (isNaN(square_meters) || square_meters < 0 || square_meters > 999)
        errors.square_meters =
            "Il numero di stanze deve essere un numero compreso tra 0 e 100";

    //todo validate address

    console.log(errors);
    return errors;
};

/**
 * Display the errors, if Any
 * @param {Object} errors The errors
 */
const displayErrors = (errors) => {
    if (!thereAreErrors(errors)) return;

    // TODO
    alert("there are errors, go figure which :D");
};

form.addEventListener("submit", (e) => {
    e.preventDefault();

    const errors = validateForm(form);

    if (thereAreErrors(errors)) {
        displayErrors(errors);
    } else {
        form.submit();
    }
});
