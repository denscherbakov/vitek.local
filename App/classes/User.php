<?php

class User
{
	private $usersList = [
		'admin' => '$2y$10$3s60pVXe08tp11kQA1wSV.8jzh6XCAU6VRR1hDGl.8SnDJi5uQQb6', //12345
		'user1' => '$2y$10$TQzc7m6F/RsE/if2kbwuKu8I28ZsNpPkb4sXykduu4YYmqsMnqnBW', //56789
		'user2' => '$2y$10$1WB3UeIbLAuRPwpLy6gyQe7iCnEcrcTQwAw6VDdU/bKQNWUgi3RGG' //01234
	];

	/**
	 * Проверка на существование пользователя.
	 * @param $login
	 * @return bool|null
	 */
	public function isExist(string $login) : bool
	{
		return isset($this->usersList[$login]) ? true : false;
	}

	/**
	 * Проверка логина и пароля пользователя.
	 * @param $login
	 * @param $password
	 * @return bool
	 */
	public function check(string $login, string $password) : bool
	{
		$hash = $this->usersList[$login];

		return true == $this->isExist($login) && true == password_verify($password, $hash) ? true : false;
	}

	/**
	 * Получение текущего пользователя.
	 * @return string|null
	 */
	public function getCurrent()
	{
		return isset($_SESSION['login']) && true == $this->isExist($_SESSION['login']) ? $_SESSION['login'] : null;
	}
}