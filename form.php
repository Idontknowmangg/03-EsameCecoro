<!-- STRUTTURA DEL FORM -->

<form id="registrationForm" action="process_form.php" method="post" onsubmit="return validateAuthenticated();">

    
    <div class="form-group">
        <label for="title-msg">Title - Message:</label>
        <input type="text" id="title-msg" name="title-msg" minlength="5" maxlength="100" placeholder="Insert your title of message">
    </div>
    <div class="error-title"></div>
    
    <div class="form-group">
        <label for="msg">Message:</label>
        <textarea cols="30" rows="3" id="msg" name="msg" placeholder="Insert your message" minlength="5" maxlength="200" oninput="updateCharacterCount()"></textarea>
        <div id="charCount"></div>
    </div>

    <div class="form-group-gdpr">
        <label for="gdpr" class="gdpr">I consent to <a href="https://gdpr-info.eu/" target="_blank">GDPR and privacy terms.</a></label>
        <input type="checkbox" id="gdpr" name="gdpr">
    </div>

    <div class="error-msg"></div>

    <button type="submit">Submit</button>
    <div id="error-message" class="error-message"></div>
</form>