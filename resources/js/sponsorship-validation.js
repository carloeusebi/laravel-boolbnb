const form = document.getElementById("sponsorship-form");
const sponsorships = form.querySelectorAll('[name="sponsorship');

form.addEventListener("submit", (e) => {
    e.preventDefault();
    let isSponsorshipSelected = false;
    sponsorships.forEach((s) => {
        if (s.checked) isSponsorshipSelected = true;
    });

    if (isSponsorshipSelected) form.submit();
    else alert("Devi selezionare un tipo di sponsorizzazione");
});
