<?php

class Uploader
{
    protected $formName;
    protected $file;

    protected $supportMimeTypes = [
    	'image/jpeg',
	    'image/png'
    ];

	/**
	 * Uploader constructor.
	 * @param $formName
	 */
    public function __construct($formName)
    {
        $this->formName = $formName;
    }

	/**
	 * Загрузка файла.
	 * @return array
	 */
    public function upload()
    {
    	$errors = [];

        if ($this->isUploaded()) {

            $file = $_FILES[$this->formName];

            if ($file['error'] == 0) {

                if ($this->isFileSupported($file['type'])){

                    move_uploaded_file($file['tmp_name'], $this->getUploadedPath() . $file['name']);

                    file_put_contents($this->getLogPath(), $this->generateFileName($_SESSION['login'], $file['name']));

                } else {
	                $errors[] = 'Не поддерживаемый тип файла.';
                }
            } else {
	            $errors[] = 'Произошла непредвиденная ошибка.';
            }
        } else {
        	$errors[] = 'Файл не был загружен.';
        }

        return $errors;
    }

	/**
	 * Генерация имени загружаемого файла.
	 * @param $user
	 * @param $fileName
	 * @return string
	 */
    private function generateFileName(string $user, string $fileName) : string
    {
    	return $user .'@-@'. date('m.d.y') .'@-@'. $fileName;
    }

	/**
	 * Получение пути до папки для загрузки файлов.
	 * @return string
	 */
    private function getUploadedPath() : string
    {
    	return __DIR__ . '/../../web/img/';
    }

	/**
	 * Получение пути до папки для записи логов.
	 * @return string
	 */
    private function getLogPath() : string
    {
    	return __DIR__ . '/../../gallery/log.txt';
    }

	/**
	 * Проверка на то загружен ли файл.
	 * @return bool
	 */
	private function isUploaded() : bool
	{
		return isset($_FILES[$this->formName]) ? true : false;
	}

	/**
	 * Проверка поддержки типа файла.
	 * @param $fileType
	 * @return bool
	 */
	private function isFileSupported(string $fileType) : bool
	{
		return in_array($fileType, $this->supportMimeTypes) ? true : false;
	}
}