import { axiosInstance } from "./axios";

const SEARCH_ENDPOINT = "https://api.tomtom.com/search/2/search";
const GEOCODE_ENDPOINT = "https://api.tomtom.com/search/2/geocode";
const TOM_TOM_KEY = import.meta.env.TOM_TOM_KEY;

const params = { key: TOM_TOM_KEY, language: "it-IT", countrySet: "IT", limit: 15 };

const addressInput = document.getElementById('address');

let lat = '';
let lon = '';


/**
		 * After every keypress, if half a second after last keypress has passed, search for similar addresses and provide autocompletion.
		 */
addressInput.addEventListener('change', () => {

    let addressTimeout = null;
    let suggestedAddresses = [];

    const timeoutDuration = 500;
    // deletes previous timeout
    clearTimeout(addressTimeout);
    // sets a new timeout
    addressTimeout = setTimeout(() => {
        // if address is empty, skip
        if (!addressInput.value) return;

        axios.get(`${SEARCH_ENDPOINT}/${addressInput.value}.json`, { params })
            .then(response =>{

                console.log(response);
                /*suggestedAddresses = [];
                const addresses = response.data.results;
                addresses.forEach((address) => {
                    suggestedAddresses.push(address.address.freeformAddress);*/
                })
            .catch(error => {
                console.log(error);
              });
    }, timeoutDuration);
});

		/**
		 * Get Coordinates using TomTom's api.
		 */
		function getCoordinates() {

            let fetchingCoordinates = false;
			
			// if address is empty, skip			
			if (!addressInput)
				return;

			try {
				fetchingCoordinates = true;
                const res = axios.get(`${GEOCODE_ENDPOINT}/${addressInput}.json`, { params });

				// update lat and lon
				const { position } = res.data.results[0];
				lat = position.lat;
				lon = position.lon;
			} catch (err) {
				console.error(err);
			} finally {
				fetchingCoordinates = false;
				return
			}
		};