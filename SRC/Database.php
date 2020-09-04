<?php

define('DB_TYPE', 'mysql');		// Wat voor type database gebruik je?
define('DB_HOST', 'localhost'); // Wat is het IP adres van de server (127.0.0.1 is de lokale machine)
define('DB_NAME', 'verjaardagskalender'); // Wat is de database naam
define('DB_USER', 'birthdaymgr'); 		// Wat is de database gebruiker
define('DB_PASS', 'LsQcmdDLsUgnhWqT');			// Wat is het database wachtwoord
define('DB_CHARSET', 'utf8'); 	// Welke karakterset wordt gebruikt


function createConn() {
    $conn = NULL;
    try {
        $conn = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
    } catch(PDOexception $exception) {
        $_SESSION['errors'] = $exception->getMessage();
        return NULL;
    }
    return $conn;
}

function DBcommand($statement, $args = []) {
    foreach(array_keys($args) as $currentArgKey) {
        if($args[$currentArgKey] == NULL) {
            return ['output' => NULL, 'errorCode' => "NOT ALL THINGS SET! ERROR BACKUP"]; // It should not reach this place!
        }
        $args[$currentArgKey] = htmlspecialchars($args[$currentArgKey]);
    }

	$connection = createConn();
	if($connection != NULL) {
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $output = array(
            'output' => null,
            'errorCode' => null
        );
        try {
            $execStatement = $connection->prepare($statement);
            $execStatement->execute($args);
            $connection = null;
            $output = [
                'output' => $execStatement->fetchAll(),
                'errorCode' => $execStatement->errorCode()
            ];
        } catch(PDOexception $exception) {
            $_SESSION['errors'] = $exception->getMessage();
            // $_SESSION['errors'] = $exception;
        }
		return $output;
	}
}