<?php

require_once 'includes/filter-wrapper.php';

// `->exec()` allows us to perform SQL and NOT expect results
// `->query()` allows us to perform SQL and expect results
require_once 'includes/db.php'; 
$results = $db->query('
	SELECT id, Title, Date, Director
	FROM Movies
	ORDER BY Title ASC
');
?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Awesome Movies</title>
</head>
<body>

<a href="add.php"> Add a Movie</a>
	
	<ul>
	<?php
	/*
		foreach ($results as $movies) {
			echo '<li>' . $movies['Title'] . '</li>';
		}
	*/
	?>
	
	<?php foreach ($results as $movies) : ?>
		<li>
			<a href="single.php?id=<?php echo $movies['id']; ?>"><?php echo $movies['Title']; ?></a>
			&bull;
			<a href="edit.php?id=<?php echo $movies['id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $movies['id']; ?>">Delete</a>
		</li>
	<?php endforeach; ?>
	</ul>
	
</body>
</html>

















