function linkToAnmeldung() {
    window.location = "../account/anmeldung.php";
}

const form = document.querySelector('#inserieren')
form.addEventListener("submit", (e) => {
    const start = document.querySelector('#beginndatum').value
    const ende = document.querySelector('#endedatum').value
    if (start > ende){
        alert("Bitte geben Sie ein gültiges Datum ein.")
        e.preventDefault()
    } 

})

