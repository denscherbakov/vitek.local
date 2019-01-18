<?php

if (is_null($user->getCurrent())){
	header('Location: /');
	exit;
}

$id = (int)$_GET['id'];

$files = scandir(__DIR__ . '/../web/img');

?>
<!doctype html>
<html lang="ru">
	<body>
		<div>
		    <img src="/web/img/<?php echo $files[$id]; ?>">
		</div>

		<a href="/gallery/index.php">Назад</a>
	</body>
</html>