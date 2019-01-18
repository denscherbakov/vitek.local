<?php
session_start();

require_once __DIR__ . '/App/classes/User.php';

$user = new User();
$login = null;
$password = null;

$errors = [];

//Выход пользователя из системы.
if (isset($_GET['logout'])){
	session_destroy();
	header('Location: /');
	exit;
}

//Если существует сессия пользователя то редиректим на главную.
if (!is_null($user->getCurrent())){
	header('Location: /guestbook/book.php');
	exit;
}

//Обработка данных логина и пароля введенных пользователем.
if (isset($_POST['login']) && isset($_POST['password'])){

	$login = trim($_POST['login']);
	$password = trim($_POST['password']);

	if ($login == '' && $password == ''){

		$errors[] = 'Заполните поля логин и пароль.';

	} else {
		if ($user->check($login, $password)){
			$_SESSION['login'] = $login;
			header('Location: /guestbook/book.php');
			exit;
		}

		$errors[] = 'Неверная пара логин-пароль';
	}
}

?>

<!doctype html>
<html lang="ru">
	<body>

		<?php if (count($errors) > 0): ?>
			<?php foreach ($errors as $error): ?>
				<p><?= $error; ?></p>
			<?php endforeach; ?>
		<?php endif; ?>

		<form action="/" method="post">
			<label for="loginField">Введите ваш логин</label>
			<div><input type="text" name="login" id="loginField" value="<?= $login; ?>"></div><br>
			<label for="pwdField">Введите ваш пароль</label>
			<div><input type="password" name="password" id="pwdField" value="<?= $password; ?>"></div>
			<p><button type="submit">Вход</button></p>
		</form>
	</body>
</html>