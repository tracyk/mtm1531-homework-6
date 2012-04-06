<?php

require_once 'includes/filter-wrapper.php';

$errors = array();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location index.php');
	exit;
}

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$director = filter_input(INPUT_POST, 'director', FILTER_SANITIZE_STRING);

if  ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($title)) {
		$errors['title'] = true;
	}
	if(empty($date)) {
		$errors['date'] = true;
	}
	
		if(empty($director)) {
		$errors['director'] = true;
	}
	
	if (empty($errors)) {
		require_once 'includes/db.php'; 
	
		
		$sql = $db->prepare('
			UPDATE Movies
			SET title = :title, date = :date, director = :director
			WHERE id = :id
		');
		 $sql->bindValue(':title', $title, PDO::PARAM_STR);
		 $sql->bindValue(':date', $date, PDO::PARAM_STR);
		 $sql->bindValue(':director', $director, PDO::PARAM_STR);
		 $sql->bindValue(':id', $id, PDO::PARAM_STR);
		 $sql->execute();
		 
		header('Location: index.php');
		exit;
	}
	


	} else {
		require_once 'includes/db.php';
		$sql = $db->prepare('
			SELECT id, title, date, director
			FROM Movies
			WHERE id = :id
		');
	
		$sql->bindValue(':id', $id, PDO::PARAM_INT);
		$sql->execute();
		$results =$sql->fetch();
	
		$title = $results['title'];
		$date = $results['date'];
		$director = $results['director'];
		
		
	}


?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Edit a Movie</title>
<link href="css/general.css" rel="stylesheet">
</head>

<body>
<form method="post" action="edit.php?id=<?php echo $id; ?>">
		</div>
		<label for="title">Title
				<?php if (isset($errors['title'])): ?>
				<strong> is required </strong>
				<?php endif; ?>
		</label>
		<input id="title" name="title" value="<?php echo $title; ?>" >
		</div>
		</div>
		<label for="date">Date
				<?php if (isset($errors['date'])): ?>
				<strong> is required </strong>
				<?php endif; ?>
		</label>
		<input id="date" name="date" value="<?php echo $date; ?>" >
		</div>
		</div>
		<label for="director">Director
				<?php if (isset($errors['director'])): ?>
				<strong> is required </strong>
				<?php endif; ?>
		</label>
		<input id="director" name="director" value="<?php echo $director; ?>" >
		</div>
		<button type="submit"> Edit </button>
</form>
</body>
</html>