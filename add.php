<?php

require_once 'includes/filter-wrapper.php';

$errors = array();

$Title = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_STRING);
$Date = filter_input(INPUT_POST, 'Date', FILTER_SANITIZE_STRING);
$Director = filter_input(INPUT_POST, 'Director', FILTER_SANITIZE_STRING);


if  ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($movies)) {
		$errors['Title'] = true;
	}
	if(empty($date)) {
		$errors['Date'] = true;
	}
	
	if(empty($director)) {
		$errors['Director'] = true;
	}
	
	if (empty($errors)) {
			require_once 'includes/db.php'; 
	}
		
		$sql = $db->prepare('
			INSERT INTO Movies (Title, Date, Director)
			VALUES (:Title, :Date, :Director)
		');
		 $sql->bindValue(':Title', $movies, PDO::PARAM_STR);
		 $sql->bindValue(':Date', $date, PDO::PARAM_STR);
		 $sql->bindValue(':Director', $director, PDO::PARAM_STR);
		 $sql->execute();
		 
		 header('Location: index.php');
		 exit;
	}
	


?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Add a Movie</title>
</head>

<body>


	<form method="post" action="add.php">
    	</div>
        	<label for="Title">Title<?php if (isset($errors['Title'])): ?> <strong> is required </strong> <?php endif; ?> </label>
            <input id="Title" name="Title" value="<?php echo $movies; ?>" >
        </div>
        
       </div>
        	<label for="Date">Date<?php if (isset($errors['Date'])): ?> <strong> is required </strong> <?php endif; ?> </label>
            <input id="Date" name="Date" value="<?php echo $date; ?>" >
        </div>
		
		 </div>
        	<label for="Director">Director<?php if (isset($errors['Director'])): ?> <strong> is required </strong> <?php endif; ?> </label>
            <input id="Director" name="Director" value="<?php echo $director; ?>" >
        </div>
       
       <button type="submit"> Add</button>
     </form>           	






</body>
</html>