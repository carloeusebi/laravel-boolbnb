const form = document.getElementById("apartment-form");

const SEARCH_ENDPOINT = "https://api.tomtom.com/search/2/search";
const GEOCODE_ENDPOINT = "https://api.tomtom.com/search/2/geocode";
const TOM_TOM_KEY = import.meta.env.VITE_TOM_TOM_KEY;

const params = {
    key: TOM_TOM_KEY,
    language: "it-IT",
    countrySet: "IT",
};

const addressInput = document.getElementById("address");
const suggestedAddressesDatalist = document.getElementById(
    "suggested-addresses"
);

let fetchingCoordinates = false;

/**
 * Fetches the apartments lat and lon
 */
const getApartmentCoordinates = async () => {
    const address = form["address"].value.trim();

    if (!address) {
        form["lat"].value = "";
        form["lon"].value = "";
        return;
    }

    try {
        fetchingCoordinates = true;
        const res = await axios.get(`${GEOCODE_ENDPOINT}/${address}.json`, {
            params,
        });

        const results = res.data.results;
        console.log(results);

        if (results.length < 1 || results[0].score < 9) {
            form["address"].classList.add("is-invalid");
            document.getElementById("addressFeedback").innerText =
                "Indirizzo non valido";
        } else {
            form["address"].classList.remove("is-invalid");
            const { lat, lon } = results[0].position;
            form["lat"].value = lat;
            form["lon"].value = lon;
        }
    } catch (error) {
    } finally {
        fetchingCoordinates = false;
    }
};

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
    const lat = form["lat"].value.trim();
    const lon = form["lon"].value.trim();

    const errors = {};

    if (!name) errors.name = "Il Titolo è obbligatorio";
    if (name.length > 80)
        errors.name = "Il nome non può essere piu' lungo di 80 caratteri";
    if (!description) errors.description = "La descrizione è obbligatoria";
    if (!rooms) errors.rooms = "Il numero di stanze è obbligatorio";
    if (isNaN(rooms) || rooms < 0 || rooms > 100)
        errors.rooms =
            "Il numero di stanze deve essere un numero compreso tra 0 e 100";
    if (!bedrooms)
        errors.bedrooms = "Il numero di camere da letto è obbligatorio";
    if (isNaN(bedrooms) || bedrooms < 0 || bedrooms > 100)
        errors.bedrooms =
            "Il numero di camere da letto deve essere un numero compreso tra 0 e 100";
    if (!bathrooms) errors.bathrooms = "Il numero di bagni è obbligatorio";
    if (isNaN(bathrooms) || bathrooms < 0 || bathrooms > 100)
        errors.bathrooms =
            "Il numero di bagni deve essere un numero compreso tra 0 e 999";
    if (!square_meters)
        errors.square_meters = "Il numero di metri quadri è obbligatorio";
    if (isNaN(square_meters) || square_meters < 0 || square_meters > 999)
        errors.square_meters =
            "Il numero di stanze deve essere un numero compreso tra 0 e 100";
    if (!lat || !lon || lat === "/" || lon === "/")
        errors.address = "Indirizzo non valido";

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

        document.getElementById(`${field}Feedback`).innerText = errors[field];
    }
};

const clearErrors = () => {
    form.querySelectorAll("input").forEach((inputElement) => {
        inputElement.classList.remove("is-invalid");
    });
};

const handleFormSubmission = (e) => {
    e.preventDefault();

    if (fetchingCoordinates) {
        setTimeout(() => {
            console.log("waiting...");
            handleFormSubmission(e);
        }, 100);
    } else {
        clearErrors();
        const errors = validateForm(form);

        if (thereAreErrors(errors)) {
            displayErrors(errors);
        } else {
            form.submit();
        }
    }
};

form.addEventListener("submit", handleFormSubmission);

let addressTimeout = null;

/**
 * After every keypress, if half a second after last keypress has passed, search for similar addresses and provide autocompletion.
 */
addressInput.addEventListener("keyup", () => {
    /**
     * Dinamically add fields to a datalist
     * @param {Node} element The HTML datalist element
     * @param {[string]} options The list of options to mount
     */
    const mountDataList = (element, options) => {
        const optionsHtml = options.reduce(
            (str, option) => (str += `<option>${option}</option>`),
            ""
        );
        element.innerHTML = optionsHtml;
    };

    let suggestedAddresses = [];

    const timeoutDuration = 500;
    // deletes previous timeout
    clearTimeout(addressTimeout);
    // sets a new timeout
    addressTimeout = setTimeout(async () => {
        // if address is empty, skip
        if (!addressInput.value) return;
        try {
            const res = await axios.get(
                `${SEARCH_ENDPOINT}/${addressInput.value}.json`,
                { params }
            );
            const addresses = res.data.results;
            suggestedAddresses = addresses.map(
                (address) => address.address.freeformAddress
            );
            mountDataList(suggestedAddressesDatalist, suggestedAddresses);
        } catch (err) {
            console.error(err);
        }
    }, timeoutDuration);
});

addressInput.addEventListener("blur", getApartmentCoordinates);
