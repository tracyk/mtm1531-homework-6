<?php

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

// Only connect to the database if there is an ID, becuse this is after the above if-statement
// Without an ID there is no point connecting to the database
require_once 'includes/db.php';

// ->prepare() allows us to execute SQL with user input
$sql = $db->prepare('
	SELECT id, Titles, Dates, Director
	FROM Movies
	WHERE id = :id
');

// ->bindValue() lets us fill in placeholders in our prepared statement
// :id is a placeholder for us to SECURELY put information from the user
$sql->bindValue(':id', $id, PDO::PARAM_INT);

// Performs the SQL query on the database
$sql->execute();

// Gets the results from the SQL query and stores them in a variable
// ->fetch() gets a single result
// ->fetchAll() gets all the possible results
$results = $sql->fetch();

// Redirect the user back to the homepage if there are no database results
// No results will happen if they change the ?id=4 to include an ID that doesn't exist
if (empty($results)) {
	header('Location: index.php');
	exit; // Stop the PHP compiler right here and immediately redirect the user
}

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $results['Title']; ?> &middot; Movies</title>
</head>
<body>
	
	<h1><?php echo $results['Title']; ?></h1>
	<p>Date: <?php echo $results['Date']; ?></p>
	<p>Director: <?php echo $results['Director']; ?></p>
	
	
</body>
</html>













