function validateUser() { // Funzione per validare i dati
    // Definiamo delle costanti
    const name = document.getElementById('nome').value.trim();
    const surname = document.getElementById('cognome').value.trim();
    const email = document.getElementById('email').value.trim();
    const birth = document.getElementById('nascita').value;
    const pwd = document.getElementById('password').value;
    // E una var che tiene traccia gli errori
    let errorCount = 0;

    // Ogni gruppo (form-user) rimuove la classe error se presente
    document.querySelectorAll('.form-user').forEach(function(element) {
        element.classList.remove('error');
    });

    // E riprendiamo l'error e gli mettiamo l'elemento nullo
    document.querySelectorAll('.error').forEach(function(element) {
        element.innerHTML = '';
    });

    // Ogni condizione verifica se il campo è letteralmente vuoto e, ha come risposta TRUE:

    /**
     * - Aumenta l'errore,
     * - Stampa il messaggio d'errore,
     * - E aggiunge la classe error
     */
    if (name === '') {
        errorCount++;
        document.querySelector('.error-name').innerHTML = "<p style=\"color: red;\">Please fill the field Name</p>";
        document.getElementById('nome').closest('.form-user').classList.add('error');
    }
    if (surname === '') {
        errorCount++;
        document.querySelector('.error-surname').innerHTML = "<p style=\"color: red;\">Please fill the field Surname</p>";
        document.getElementById('cognome').closest('.form-user').classList.add('error');
    }
    if (birth === '') {
        errorCount++;
        document.querySelector('.error-birth').innerHTML = "<p style=\"color: red;\">Please fill the field Date of Birth</p>";
        document.getElementById('nascita').closest('.form-user').classList.add('error');
    }
    if (email === '') {
        errorCount++;
        document.querySelector('.error-email').innerHTML = "<p style=\"color: red;\">Please fill the field Email</p>";
        document.getElementById('email').closest('.form-user').classList.add('error');
    }
    if (pwd === '') {
        errorCount++;
        document.querySelector('.error-pwd').innerHTML = "<p style=\"color: red;\">Please fill the field Password</p>";
        document.getElementById('password').closest('.form-user').classList.add('error');
    }

    if (errorCount > 0) { // Se l'errore è maggiore di 0
        // Impedisce l'invio
        return false;
    }
    // Se tutto è verificato correttamente, possiamo inviare il modulo
    return true;
}

// E questa funzione ripercuote per le altre due. Perché la prima era dedicata per gli user, la seconda le categorie e l'ultima per i progetti o portfolio.

function validateCategory() {
    const name = document.getElementById('category_name').value.trim(); 
    const desc = document.getElementById('category_description').value.trim();
    const pathImg = document.getElementById('category_image').value.trim();
    const pathVideo = document.getElementById('category_video').value.trim();

    let errorCount = 0;

    document.querySelectorAll('.form-category').forEach(function(element) {
        element.classList.remove('error');
    });

    document.querySelectorAll('.error').forEach(function(element) {
        element.innerHTML = '';
    });

    if (name === '') {
        errorCount++;
        document.querySelector('.error-nameCategory').innerHTML = "<p style=\"color: red;\">Please fill the field name of the category</p>";
        document.getElementById('category_name').closest('.form-category').classList.add('error');
    }
    if (desc === '') {
        errorCount++;
        document.querySelector('.error-desc').innerHTML = "<p style=\"color: red;\">Please fill the field description of the category</p>";
        document.getElementById('category_description').closest('.form-category').classList.add('error');
    }
    if (pathImg === '') {
        errorCount++;
        document.querySelector('.error-pathImg').innerHTML = "<p style=\"color: red;\">Please fill the field of the path of the image</p>";
        document.getElementById('category_image').closest('.form-category').classList.add('error');
    }
    if (pathVideo === '') {
        errorCount++;
        document.querySelector('.error-video').innerHTML = "<p style=\"color: red;\">Please fill the field of the path of the video</p>";
        document.getElementById('category_video').closest('.form-category').classList.add('error');
    }

    if (errorCount > 0) {
        return false;
    }

    return true;
}

function validatePortfolio() {
        const title = document.getElementById('titolo').value.trim(); 
        const subtitle = document.getElementById('sottotitolo').value.trim();
        const paragraph = document.getElementById('paragrafo').value.trim();
        const pathImg = document.getElementById('percorsoImmagine').value.trim();
    
        let errorCount = 0;
    
        document.querySelectorAll('.form-portfolio').forEach(function(element) {
            element.classList.remove('error');
        });
    
        document.querySelectorAll('.error').forEach(function(element) {
            element.innerHTML = '';
        });
    
        if (title === '') {
            errorCount++;
            document.querySelector('.error-title').innerHTML = "<p style=\"color: red;\">Please fill the field Title</p>";
            document.getElementById('titolo').closest('.form-portfolio').classList.add('error');
        }
        if (subtitle === '') {
            errorCount++;
            document.querySelector('.error-subtitle').innerHTML = "<p style=\"color: red;\">Please fill the field Subtitle</p>";
            document.getElementById('sottotitolo').closest('.form-portfolio').classList.add('error');
        }
        if (paragraph === '') {
            errorCount++;
            document.querySelector('.error-paragraph').innerHTML = "<p style=\"color: red;\">Please fill the field Paragraph</p>";
            document.getElementById('paragrafo').closest('.form-portfolio').classList.add('error');
        }
        if (pathImg === '') {
            errorCount++;
            document.querySelector('.error-pathImg').innerHTML = "<p style=\"color: red;\">Please fill the field Path Img</p>";
            document.getElementById('percorsoImmagine').closest('.form-portfolio').classList.add('error');
        }
    
        if (errorCount > 0) {
            return false;
        }
    
        return true;
    }
    

function confirmDelete() { // Questa funzione invece, si attiva quando noi premiamo il pulsante Cancella dal form, e ci avvisa il messaggio.
    return confirm("Are you sure that you chose? ONCE PRESSED OK THE ACTION IS IRRIVERSIBLE");
}