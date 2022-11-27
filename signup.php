<?php 
$title="Форма регистрации"; 
require __DIR__ . '/header.php';
require "db.php"; 

$data = $_POST; //переменная для сбора данных от пользователя по методу POST

// после нажатия на кнопку...	
if(isset($data['do_signup'])) {

	$errors = array(); //массив для сбора ошибок

	if(trim($data['login']) == '') {

		$errors[] = "Enter login";
	}

	if(trim($data['email']) == '') {

		$errors[] = "Enter Email";
	}


	if(trim($data['name']) == '') {

		$errors[] = "Enter your name";
	}

	if(trim($data['family']) == '') {

		$errors[] = "Enter last name";
	}

	if($data['password'] == '') {

		$errors[] = "Enter password";
	}

	if($data['password_2'] != $data['password']) {

		$errors[] = "Repeated password entered incorrectly!";
	}
 
	if(mb_strlen($data['login']) < 5 || mb_strlen($data['login']) > 90) {

	    $errors[] = "Invalid login length";

    }

    if (mb_strlen($data['name']) < 3 || mb_strlen($data['name']) > 50){
	    
	    $errors[] = "Invalid name length";

    }

    if (mb_strlen($data['family']) < 1 || mb_strlen($data['family']) > 50){
	    
	    $errors[] = "Invalid last name length";

    }

    if (mb_strlen($data['password']) < 2 || mb_strlen($data['password']) > 8){
	
	    $errors[] = "Invalid password length (2 to 8 characters)";

    }

    // проверка на правильность написания Email
    if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $data['email'])) {

	    $errors[] = 'Email entered incorrectly';
    
    }

	// Проверка на уникальность логина
	if(R::count('users', "login = ?", array($data['login'])) > 0) {

		$errors[] = "The user with such login exists!";
	}

	// Проверка на уникальность email

	if(R::count('users', "email = ?", array($data['email'])) > 0) {

		$errors[] = "The user with such Email exists!";
	}


	if(empty($errors)) {

		// Если ошибок нет то создаем таблицу users
		$user = R::dispense('users');

		$user->login = $data['login'];
		$user->email = $data['email'];
		$user->name = $data['name'];
		$user->family = $data['family'];

		// хеширование пароля
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);

		// сохраняем таблицу
		R::store($user);
        echo '<div style="color: green; ">You have successfully registered! <a href="login.php">log in</a>.</div><hr>';

	} else { 
		echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>'; // array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
	}
}
?>
<div class="register">
<div class="container">
		<h2>Sign up</h2>
		<form action="signup.php" method="post">
			<input type="text" class="form-control" name="login" id="login" placeholder="Login (at 5 symbols)"><br>
			<input type="email" class="form-control" name="email" id="email" placeholder="Email"><br>
			<input type="text" class="form-control" name="name" id="name" placeholder="Name" required><br>
			<input type="text" class="form-control" name="family" id="family" placeholder="Surname" required><br>
			<input type="password" class="form-control" name="password" id="password" placeholder="Password (at 2 symbols)"><br>
			<input type="password" class="form-control" name="password_2" id="password_2" placeholder="Repeat password"><br>
			<button class="btn btn-success reg__btn" name="do_signup" type="submit">Sign up</button>
		</form>
		<br>
		<p>If you already have an account click <a href="login.php">here</a>.</p>
		<p>Back to <a href="index.php">home</a>.</p>
	</div>
	</div>
<?php require __DIR__ . '/footer.php'; ?>