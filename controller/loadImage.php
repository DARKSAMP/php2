<?php
class LoadImage {

	public function __construct() {

		if ($_POST['load_file']) {
			$this->loadFile();
		}

		Route::start();
		
	}
	
	private function loadFile() {

		if (!$_FILES['new_file']['error']){

			//проверка размера файла
			if ($_FILES['new_file']['size'] > MAX_SIZE_UPLOAD_FILES){
				return;
			}

			$types = ['image/gif', 'image/png', 'image/jpeg'];

			if (!in_array($_FILES['new_file']['type'], $types)) {
				return;
			}

			date_default_timezone_set('UTC');
			
			$uploaddir = DIR_IMAGES . '/';
			$name = explode('.', $_FILES['new_file']['name']);
			$name[0] .= '-' . date(U);
			$new_name = implode('.', $name);
			$destination  = $uploaddir . $new_name;
			$size = (int) $_FILES['new_file']['size'];

			if (move_uploaded_file($_FILES['new_file']['tmp_name'],$destination)){

				$model = Model::loadModel('home');
				$model->addPicture($new_name, $size);

			} else {
				return;
			}
		}
		
	}

}
