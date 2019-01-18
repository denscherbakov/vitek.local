<?php
session_start();
include __DIR__ . '/../App/classes/GuestBook.php';
include __DIR__ . '/../App/classes/User.php';

$user = new User();

if (is_null($user->getCurrent())){
	header('Location: /');
	exit;
}

$guestBook = new GuestBook(__DIR__ . '/data.txt');

$records = $guestBook->getData();

//Если была отправка формы - добавляем запись и обновляем страницу.
if (count($_POST) > 0){
	if (isset($_POST['message'])){
		$text = trim(htmlspecialchars($_POST['message']));
		$guestBook->append($text)->save();
	}

	header('Location: /guestbook/book.php');
	exit;
}

?>

<!doctype html>
<html lang="ru">
	<body>
		<p><a href="/gallery/index.php">В галерею</a></p>
		<p><a href="/index.php?logout">Выход</a></p>

		<?php if (count($records) > 0): ?>
			<ul>
				<?php foreach ($records as $record): ?>
					<li><?= $record; ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<form action="/guestbook/book.php" method="post">
		    <textarea name="message"></textarea>
		    <button type="submit">Отправить</button>
		</form>

	</body>
</html>