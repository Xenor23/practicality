document.addEventListener("DOMContentLoaded", function () {
    const password = document.getElementById("password_hash");
    const confirmPassword = document.getElementById("confirm_password");
    const lengthError = document.getElementById("length");
    const uppercaseError = document.getElementById("uppercase");
    const lowercaseError = document.getElementById("lowercase");
    const numberError = document.getElementById("number");
    const specialError = document.getElementById("special");
    const submitButton = document.getElementById("submit_button");

    function validatePassword() {
        lengthError.style.color = password.value.length >= 8 ? 'green' : 'red';
        lowercaseError.style.color = /[a-z]/.test(password.value) ? 'green' : 'red';
        uppercaseError.style.color = /[A-Z]/.test(password.value) ? 'green' : 'red';
        numberError.style.color = /[0-9]/.test(password.value) ? 'green' : 'red';
        specialError.style.color = /[\W_]/.test(password.value) ? 'green' : 'red';

        confirmPassword.style.borderColor = password.value === confirmPassword.value ? 'green' : 'red';
        const allGreen = ['length', 'lowercase', 'uppercase', 'number', 'special'].every(id => document.getElementById(id).style.color === 'green');
        submitButton.disabled = !allGreen || password.value !== confirmPassword.value;
    }
    password.addEventListener("input", validatePassword);
    confirmPassword.addEventListener("input", validatePassword);
});

const selectAge = document.getElementById("age");

for (let i = 13; i <= 120; i++) {
    const option = document.createElement("option");
    option.value = i;
    option.textContent = i;
    selectAge.appendChild(option);
}

document.addEventListener('DOMContentLoaded', () => {
    fetchCountries();

    function fetchCountries() {
        fetch('https://restcountries.com/v3.1/all')
            .then(response =>{
                if (!response.ok){
                    throw new Error("Données non récupérées")
                }
                return response.json()})
            .then(data => populateCountries(data))
            .catch(error => console.error('Error fetch des pays:', error));
    }

    function populateCountries(countries) {
        const countrySelect = document.getElementById('country');
        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country.cca2.toLowerCase();
            option.textContent = country.translations.fra.common;
            countrySelect.appendChild(option);
        });
    }
});
