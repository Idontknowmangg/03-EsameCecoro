// Definiamo delle costanti che prendono gli ID
const form = document.getElementById('register-form');
const nomeInput = document.getElementById('nome');
const cognomeInput = document.getElementById('cognome');
const dataNascitaInput = document.getElementById('data_di_nascita');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
// Anche quelle d'errori per mostrare all'utente cosa manca
const errorLabelName = document.getElementById('error-name');
const errorLabelSurname = document.getElementById('error-surname');
const errorLabelBorn = document.getElementById('error-born');
const errorLabelEmail = document.getElementById('error-email');
const errorLabelPwd = document.getElementById('error-pwd');

const errorLabel = document.getElementById('error-message');

form.addEventListener('submit', function(event) {
    event.preventDefault(); // Evitiamo il comportamento predefinito del form

    if (validateForm()) {
        // Ottieniamo i valori dei campi del form
        const nome = nomeInput.value.trim();
        const cognome = cognomeInput.value.trim();
        const dataNascita = dataNascitaInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;

        // Effettuiamo la chiamata AJAX per registrare l'utente
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'register.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Registrazione riuscita
                    alert('Registration successful!');
                    window.location.href = 'login.php'; // Reindirizziamo alla pagina di login
                } else {
                    // Registrazione fallita
                    alert('Registration failed. Please try again later.');
                }
            }
        };
        
        // Costruiamo il corpo della richiesta
        const requestBody = 'nome=' + nome + '&cognome=' + cognome + '&data_di_nascita=' + dataNascita + '&email=' + email + '&password=' + password;
        xhr.send(requestBody);
    }
});

function validateEmail(email) { // Funzione per validare l'email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Espressione REGEX per verificare correttamente l'email
    return emailPattern.test(email);
}

function validateForm() {
    const nome = nomeInput.value.trim();
    const cognome = cognomeInput.value.trim();
    const dataNascita = dataNascitaInput.value.trim();
    const email = emailInput.value.trim();
    const password = passwordInput.value;

    let isValid = true;

    // Controlliamo se l'email è valida
    if (!validateEmail(email)) {
        // Se l'email non è valida, aggiungi la classe di errore al label dell'email
        document.getElementById('email-label').classList.add('error-label');
        isValid = false;
    } else {
        // Se l'email è valida, rimuovi la classe di errore dal label dell'email
        document.getElementById('email-label').classList.remove('error-label');
    }

    // Controlliamo se tutti i campi sono compilati
    if (nome === '' || cognome === '' || dataNascita === '' || password === '') {
        isValid = false;

        // Aggiungi la classe di errore ai label dei campi mancanti
        if (nome === '') {
            document.getElementById('nome-label').classList.add('error-label');
        } else {
            document.getElementById('nome-label').classList.remove('error-label');
        }

        if (cognome === '') {
            document.getElementById('cognome-label').classList.add('error-label');
        } else {
            document.getElementById('cognome-label').classList.remove('error-label');
        }

        if (dataNascita === '') {
            document.getElementById('data_di_nascita-label').classList.add('error-label');
        } else {
            document.getElementById('data_di_nascita-label').classList.remove('error-label');
        }

        if (password === '') {
            document.getElementById('password-label').classList.add('error-label');
        } else {
            document.getElementById('password-label').classList.remove('error-label');
        }

        // Visualizza il messaggio di errore generico
        errorLabel.style.display = 'block';
        errorLabel.style.color = 'red';
        errorLabel.textContent = 'Please fill all the fields.';
    } else {
        // Rimuovi la classe di errore da tutti i label
        document.getElementById('nome-label').classList.remove('error-label');
        document.getElementById('cognome-label').classList.remove('error-label');
        document.getElementById('data_di_nascita-label').classList.remove('error-label');
        document.getElementById('password-label').classList.remove('error-label');

        // Nascondi il messaggio di errore generico se tutti i campi sono compilati
        errorLabel.style.display = 'none';
        errorLabel.textContent = '';
    }

    return isValid;
}

