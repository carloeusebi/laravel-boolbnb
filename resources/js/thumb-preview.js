const placeholder = "https://marcolanci.it/utils/placeholder.jpg";
const thumbInput = document.getElementById('thumbnail');
const thumbPreview = document.getElementById('thumb-preview');


let blobUrl = null;

thumbInput.addEventListener('change', () => {
    if(thumbInput.files && thumbInput.files[0]) {
        const file = thumbInput.files[0];

        blobUrl = URL.createObjectURL(file);

        thumbPreview.src = blobUrl;
    } else {
        thumbPreview.src = placeholder;
    }
})

