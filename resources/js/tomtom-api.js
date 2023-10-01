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

let addressTimeout = null;

let lat = "";
let lon = "";

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
