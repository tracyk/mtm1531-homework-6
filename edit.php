<?php

require_once 'includes/filter-wrapper.php';

$errors = array();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);



if (empty($id)) {
	header('Location index.php');
	exit;
}

if  ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($Title)) {
		$errors['Title'] = true;
	}
	if(empty($period)) {
		$errors['Date'] = true;
	}
	
		if(empty($period)) {
		$errors['Director'] = true;
	}
	
	if (empty($errors)) {
		require_once 'includes/db.php'; 
	
		
		$sql = $db->prepare('
			INSERT INTO Movies (Title, Date, Director)
			VALUES (:Title, :Date, :Director)
		');
		 $sql->bindValue(':Title', $Title, PDO::PARAM_STR);
		 $sql->bindValue(':Date', $Date, PDO::PARAM_STR);
		 $sql->bindValue(':Director', $Director, PDO::PARAM_STR);
		 $sql->bindValue(':id', $id, PDO::PARAM_STR);
		 $sql->execute();
		 
	header('Location index.php');
	exit;
}
	


} else {
	require_once 'includes/db.php';
	$sql = $db->prepare('
	SELECT id, Title, Date, Director
	FROM Movies
	WHERE id = :id
	');
	
	$sql->bindValue(':id', $id, PDO::PARAM_INT);
	$sql->execute();
	$results =$sql->fetch();
	
	$dino_name = $results['Title'];
	$period = $results['Date'];
	$period = $results['Director'];
}


?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Add a Movie</title>
</head>

<body>


	<form method="post" action="edit.php?id=<?php echo $id; ?>">
    	</div>
        	<label for="Title">Title<?php if (isset($errors['Title'])): ?> <strong> is required </strong> <?php endif; ?> </label>
            <input id="Title" name="Title" value="<?php echo $Title; ?>" >
        </div>
        
       </div>
        	<label for="Date">Date<?php if (isset($errors['Date'])): ?> <strong> is required </strong> <?php endif; ?> </label>
            <input id="Date" name="Date" value="<?php echo $Date; ?>" >
        </div>
       
	    </div>
        	<label for="Director">Director<?php if (isset($errors['Director'])): ?> <strong> is required </strong> <?php endif; ?> </label>
            <input id="Director" name="Director" value="<?php echo $Director; ?>" >
        </div>
	   
       <button type="submit"> Add</button>
     </form>           	






</body>
</html>