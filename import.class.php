<?php

class ImportClass {

	public $file;
	public $file_data;
	public $status;
	
	public function __construct($file) {
		$this->file = $file;

		$this->status = $this->validate();
	}

	private function validate() {
		$arrayAllow = array("txt", "tab");
		$file = explode(".", $this->file["name"]);
		$extension = end($file);

		if (!in_array($extension, $arrayAllow)) {
			return false;
		}

		return true;
	}

	public function separateData() {
		$data = file_get_contents($this->file["tmp_name"]);
		$data = explode("\n", $data);

		$this->file_data = array();

		foreach ($data as $key => $line) {
			$cols = preg_split("/[\t]/", $line);

			$this->file_data[$key] = $cols;
		}

		return $this->file_data;
	} 
}