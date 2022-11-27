<?php 
$title="Форма авторизации";
require __DIR__ . '/header.php';
require "db.php";

$data = $_POST;  //переменная для сбора данных от пользователя по методу POST

if(isset($data['do_login'])) {  // после нажатия на кнопку...

 $errors = array(); // массив для сбора ошибок

 $user = R::findOne('users', 'login = ?', array($data['login']));  // Проводим поиск пользователей в таблице users

 if($user) {

 	if(password_verify($data['password'], $user->password)) { // Если логин существует, тогда проверяем пароль

 		$_SESSION['logged_user'] = $user; // Все верно, пускаем пользователя
 		
                header('Location: index.php'); // кидает на главную

 	} else {
    
    $errors[] = 'Пароль неверно введен!';

 	}

 } else {
 	$errors[] = 'Пользователь с таким логином не найден!';
 }

if(!empty($errors)) {

		echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';

	}

}
?>
<div class="login">
<div class="container">
		<h2>Log in</h2>
		<form action="login.php" method="post">
			<input type="text" class="form-control" name="login" id="login" placeholder="Login" required><br>
			<input type="password" class="form-control" name="password" id="pass" placeholder="Password" required><br>
			<button class="btn btn-success login__btn" name="do_login" type="submit">Log in</button>
		</form>
		<br>
		<p class="login__reg__a">If you already have an account click <a href="signup.php">here</a>.</p>
		<p>Back to <a href="index.php">home</a>.</p>
	</div>
</div>
<?php require __DIR__ . '/footer.php'; ?>