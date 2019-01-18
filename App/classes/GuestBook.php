<?php

include __DIR__ . '/TextFile.php';

class GuestBook extends TextFile
{
    public $text;

	/**
	 * @param $text
	 * @return $this
	 */
    public function append(string $text) : GuestBook
    {
        $this->text = $text;
        return $this;
    }

	/**
	 * Сохранение записи в файл.
	 * @return $this
	 */
    public function save() : GuestBook
    {
        $data = implode(PHP_EOL, $this->getData());
        $data .= $data == '' ?  $this->text : PHP_EOL . $this->text;
        file_put_contents($this->path, $data);
        return $this;
    }
}