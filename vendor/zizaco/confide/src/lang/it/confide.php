<?php

return array(

    'username' => 'Username',
    'password' => 'Password',
    'password_confirmation' => 'Conferma Password',
    'e_mail' => 'Email',
    'username_e_mail' => 'Username o Email',

    'signup' => array(
        'title' => 'Registrati',
        'desc' => 'Registrati per un nuovo account',
        'confirmation_required' => 'Conferma richiesta',
        'submit' => 'Crea un nuovo account',
    ),

    'login' => array(
        'title' => 'Login',
        'desc' => 'Inserisci le tue credenziali',
        'forgot_password' => '(password dimenticata)',
        'remember' => 'Ricordami',
        'submit' => 'Login',
    ),

    'forgot' => array(
        'title' => 'Password dimenticata',
        'submit' => 'Continua',
    ),

    'alerts' => array(
        'account_created' => 'Il tuo account è stato correttaemnte creato.',
        'instructions_sent'       => 'COntrolla la tua casella email per le istruzioni su come attivare il tuo account.',
        'too_many_attempts' => 'Troppi tentativi. Riprova tra qualche minuto.',
        'wrong_credentials' => 'Unsername, email o password non corretti.',
        'not_confirmed' => 'Il tuo account non risulta confermato. Controlla la tua casella di posta',
        'confirmation' => 'Il tuo account è stato confermato! Ora puoi effettuare il login.',
        'wrong_confirmation' => 'Codice di conferma sbagliato.',
        'password_forgot' => 'Le informazioni riguardati la procedura di reset sono state inviate alla tua casella di posta.',
        'wrong_password_forgot' => 'User non trovato.',
        'password_reset' => 'Password cambiata correttamente.',
        'wrong_password_reset' => 'Password non valida. Tenta di nuovo',
        'wrong_token' => 'La chiave relativa al reset della tua password non è valido.',
        'duplicated_credentials' => 'Le credenziali inserite sono già in uso. Usa credenziali diverse.',
    ),

    'email' => array(
        'account_confirmation' => array(
            'subject' => 'Conferma Account',
            'greetings' => 'Ciao :name',
            'body' => 'Per favore clicca il link seguente per confermare il tuo account.',
            'farewell' => 'Grazie',
        ),

        'password_reset' => array(
            'subject' => 'Password Reset',
            'greetings' => 'Ciao :name',
            'body' => 'APer favore clicca il link seguente per cambiare la tua password',
            'farewell' => 'Grazie',
        ),
    ),

);
