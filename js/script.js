// Definiamo le costanti per il menù
const menuToggle = document.querySelector('.menuToggle');
const navigation = document.querySelector('.navigation');
const box = document.querySelector('.box');
const box2 = document.querySelector('.box2');
const box3 = document.querySelector('.transparent-box');
const title = document.querySelector('.box-title');
const title2 = document.querySelector('.box-title2');
const formTitle = document.querySelector('.form-set');
const formTitle2 = document.querySelector('.form-set2');
const form = document.querySelector('.box-form');
const welcome = document.querySelector('.welcome-message');

// Definiamo la funzione che al click del menù a barra laterale, compaia una classe del menù open per poi assegnare ai discendenti per avere l'effetto che spostino
menuToggle.onclick = function() {
    navigation.classList.toggle('open');
    box.classList.toggle('open');
    box2.classList.toggle('open');
    box3.classList.toggle('open');
    title.classList.toggle('open');
    title2.classList.toggle('open');
    formTitle.classList.toggle('open');
    formTitle2.classList.toggle('open');
    form.classList.toggle('open');
    welcome.classList.toggle('open');
};

const list = document.querySelectorAll('.list');

function activeLink() {
    list.forEach((item) => item.classList.remove('active'));
    this.classList.add('active');
}

list.forEach((item) => item.addEventListener('click', activeLink));

function showImage(imageSrc) { // Questa funzione è importante per visualizzare l'immagine in una modalità di visualizzazione intera di un'immagine
    var modal = document.getElementById("imageModal"); 
    var img = document.getElementById("fullImage");
    // Prendiamo gli id delle immagini
    
    img.src = imageSrc; // Prendiamo il path dell'immagine che viene poi passato al param
    modal.style.display = "block"; // La modalità di visualizzazione è di tipo "blocco", visualizzazione standard in sintesi
    
    setTimeout(function() { // Alla funzione setTimeout
        modal.querySelector('.modal-content').style.opacity = 1; // Viene impostato l'opacità a 1, quindi 100%
        modal.querySelector('.modal-content').style.animation = "zoomIn 0.3s ease-in-out"; // E un'animazione base per avere effetto
    }, 50);
}

function closeImageModal() { // Questa funzione invece è per chiudere la modalità di visualizzazione
    var modal = document.getElementById("imageModal"); // Questa var prende lo stesso id della modalità di visualizzazione
    modal.querySelector('.modal-content').style.animation = "fadeOut 0.3s ease-in-out"; // Un animazione base per avere effetto

    setTimeout(function() { // Alla funzione setTimeout
        modal.querySelector('.modal-content').style.opacity = 0; // Mettiamo l'opacità a 0, a 0% 
        modal.style.display = "none"; // La visualizzazione della modalità diventa invisibile
        modal.querySelector('.modal-content').style.animation = ""; // E non avrà effetto
    }, 300); // Attendiamo 3 secondi (durata dell'animazione) prima di nascondere definitivamente il modal
}


document.addEventListener('keydown', function(event) { // Ho aggiunto una funzione per comodità
    if (event.key === "Escape") { // Se il tasto pressato è Esc
        closeImageModal(); // Sfrutta la funzione di chiusura
    }
});

function validateAuthenticated() { // Funzione per validare il form
    // Variabili con ID
    var titleMsg = document.getElementById('title-msg').value.trim();
    var msg = document.getElementById('msg').value.trim();
    var gdprCheckbox = document.getElementById('gdpr');
    // E quelli d'errore
    var errorTitle = document.querySelector('.error-title');
    var errorMsg = document.querySelector('.error-msg');
    var errorMessage = document.getElementById('error-message');
    var errorCount = 0;

    document.querySelectorAll('.form-group').forEach(function(element) { // Ogni label e input, che ha come l'elemento completo (form-group)
        element.classList.remove('error'); // Rimuove la classe error per evitare comportamenti indesiderati
    });

    errorTitle.textContent = '';
    errorMsg.textContent = '';
    errorMessage.textContent = '';

    // E ogni var ha un valore vuoto per iniziare

    // E ciascuna condizione verifica se è letteralmente vuoto il campo, se è true ha:
    /**
     * - Un testo che avvisa all'utente,
     * - Viene aggiunta la classe error all'elemento più vicino,
     * - E tiene traccia il conteggio di quanti errori sono presenti nei campi (ovvero quanti sono di vuoti)
     */
    if (titleMsg === '') {
        errorTitle.innerHTML = "<p style=\"color:red; margin-bottom: 20px;\">The field \"Title\" - Message must be complete.</p>";
        document.getElementById('title-msg').closest('.form-group').classList.add('error');
        errorCount++;
    }
    if (msg === '') {
        errorMsg.innerHTML = "<p style=\"color:red; margin-bottom: 20px;\">The field \"Message\" must be complete.</p>";
        document.getElementById('msg').closest('.form-group').classList.add('error');
        errorCount++;
    }

    if (!gdprCheckbox.checked) { // Verifichiamo se il check del GDPR è diverso da TRUE
        // Se sì stampa il messaggio e tiene traccia il conteggio
        errorMessage.innerHTML = 'Please fill all present fields.';
        errorCount++;
    }

    // E poi se ha errori, impedisce l'invio
    if (errorCount > 0) {
        return false;
    }

    // Se tutto va bene, torna true
    return true;
}



function updateCharacterCount() { // Questa funzione visualizza all'utente di quanti caratteri gli rimangono alla dicitura del messaggio
    var maxChars = 200; // Inizializziamo la var
    var msg = document.getElementById('msg').value; // Prendiamo l'id e il suo valore
    var remainingChars = maxChars - msg.length; // Facciamo una semplice sottrazione in base a quanti testi sono stati scritti dall'utente
    var charCountElement = document.getElementById('charCount'); // Utilizziamo una var importante che tiene traccia il conteggio
    charCountElement.innerHTML = '<p>Characters remaining: ' + remainingChars + '</p>'; // Gli facciamo vedere il messaggio di quanti ne rimangono, e viene spesso aggiornato per via di inserimento di testi

    if (remainingChars < 30) { // Se è a minore di 30
        charCountElement.innerHTML = '<p style=\"transition: 1.5s; color: red;\">Characters remaining: ' + remainingChars + '</p>'; // Il testo diverrà rosso
    }
}

document.addEventListener('DOMContentLoaded', function() { // Questo frammento gestisce l'invio del modulo
    document.getElementById("registrationForm").addEventListener("submit", function(event) { // Prendiamo l'id, gli aggiungiamo l'event listener che accade se è di tipo submit, e una funzione con il param dell'evento
        event.preventDefault(); // Innanzitutto impediamo il comportamento predefinito del form

        if (validateAuthenticated()) { // Se la funzione è true
            // Memorizziamo in una var i dati inseriti nel modulo, this è il modulo stesso
            var formData = new FormData(this);
            var xhr = new XMLHttpRequest(); // E in questa var ha come valore la creazione dell'istanza della classe XMLHttpRequest che consente di effettuare l'invio di richieste HTTP asincrone
            xhr.open("POST", "process_form.php", true); // Viene aperta una richiesta POST verso il file di destinazione che diverrà responsabile di elaborare i dati del modulo di registrazione. Il terzo param indica che è di tipo asincrona, quindi TRUE.
            xhr.onreadystatechange = function() { // Definiamo una funzione che gestirà la richiesta
                if (xhr.readyState === XMLHttpRequest.DONE) { // Questa condizione verifica se è stata completata la richiesta
                    if (xhr.status === 200) { // Verifichiamo se è realmente completata con successo (status 200)
                        alert("Data inserted correctly and sumbitted with success!"); // Allertiamo l'utente
                        document.getElementById("registrationForm").reset(); // E poi viene resettato per pulizia
                        window.location.href = "success_page.html"; // Reindirizziamo alla pagina del successo per assicurare l'utente che tutto è andato a buon fine
                    } else {
                        alert("Errore durante l'invio del feedback: " + xhr.status); // Se va male, stampa il messaggio di errore generico
                    }
                }
            };
            xhr.send(formData); // Viene poi inviata la richiesta HTTP POST con i dati del modulo di registrazione attraverso il metodo send().
        }
    });
});

function confirmAction() {
    return confirm("That you choose is the button of delete, deletes your data but starts to act if pressed OK, if pressed cancel, nothing happen. Are you sure? The action is irreversible.");
}

// Aggiunta una funzione d'avviso