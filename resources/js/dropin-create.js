const CLIENT_TOKEN_FROM_SERVER = env("CLIENT_TOKEN_FROM_SERVER");

// create a dropin instance using the container (or a string)
//   that functions as a query selector such as '#dropin-container')
braintree.dropin.create(
    {
        container: document.getElementById("dropin-container"),

        // get client token from your server, such as via
        //    templates or async http request
        authorization: CLIENT_TOKEN_FROM_SERVER,
        container: "#dropin-container",
    },
    (error, dropinInstance) => {
        // Use 'dropinInstance' here
        // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
    }
);
