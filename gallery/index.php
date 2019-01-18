<?php
session_start();
require_once __DIR__ . '/../App/classes/User.php';
require_once __DIR__ . '/../App/classes/Uploader.php';

$user = new User();

if (is_null($user->getCurrent())){
	header('Location: /');
	exit;
}

if (isset($_GET['upload'])){
	$uploader = new Uploader('image');
	$errors = $uploader->upload();
	if (count($errors) == 0){
		header("Location: /gallery/index.php");
		exit;
	}
}

$files = scandir(__DIR__ . '/../web/img');

?>

<!doctype html>
<html lang="ru">
	<body>
		<p><a href="/guestbook/book.php">Гостевая книга</a></p>
		<p><a href="/index.php?logout">Выход</a></p>

		<?php foreach ($files as $id => $file): ?>
		    <?php if ($file != '.' && $file != '..'): ?>
			    <a href="/gallery/image.php?id=<?= $id; ?>">
			        <img src="/web/img/<?= $file; ?>" width="350" height="250">
			    </a>
			<?php endif; ?>
		<?php endforeach; ?>

		<?php if (count($errors) > 0): ?>
			<?php foreach ($errors as $error): ?>
					<p><?= $error; ?></p>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php if ($user->getCurrent()): ?>
			<form action="/gallery/index.php?upload" method="post" enctype="multipart/form-data">
			    <input type="file" name="image">
			    <button type="submit">Загрузить</button>
			</form>
		<?php endif; ?>

	</body>
</html>