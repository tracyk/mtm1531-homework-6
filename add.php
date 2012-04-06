<?php

require_once 'includes/filter-wrapper.php';
require_once 'includes/db.php';

$errors = array();

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
			INSERT INTO Movies (title, date, director)
			VALUES (:title, :date, :director)
		');
		 $sql->bindValue(':title', $title, PDO::PARAM_STR);
		 $sql->bindValue(':date', $date, PDO::PARAM_STR);
		 $sql->bindValue(':director', $director, PDO::PARAM_STR);
		 $sql->execute();
		 
		 header('Location: index.php');
		 exit;
	}
}


?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Add a Movie</title>
	<link href="css/general.css" rel="stylesheet">
</head>

<body>


	<form method="post" action="add.php">
    	</div>
        	<label for="title">Title<?php if (isset($errors['title'])): ?> <strong> is required </strong> <?php endif; ?> </label>
            <input id="title" name="title" value="<?php echo $title; ?>" >
        </div>
        
       </div>
        	<label for="date">Date<?php if (isset($errors['date'])): ?> <strong> is required </strong> <?php endif; ?> </label>
            <input id="date" name="date" value="<?php echo $date; ?>" >
        </div>
		
		 </div>
        	<label for="director">Director<?php if (isset($errors['director'])): ?> <strong> is required </strong> <?php endif; ?> </label>
            <input id="director" name="director" value="<?php echo $director; ?>" >
        </div>
       
       <button type="submit"> Add</button>
     </form>           	






</body>
</html>