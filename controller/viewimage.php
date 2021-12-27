<?php
class ViewImage {

	private $data;
	private $parameters;

	public function __construct() {

		if ($_GET && isset($_GET['picture_id'])) {

			$this->parameters = $_GET;
			$this->getData();
			$view = new View();
			$view->render('viewimage', $this->data);

		} else {
			Route::start();
		}
	}
	
	private function getData() {

		$model = Model::loadModel('home');
		$picture = $model->getPicture($this->parameters['picture_id']);
		$model->incReview($this->parameters['picture_id']);
		
		$data = array();

		if ($picture) {

			$data['picture'] = array(
				'id'        => $picture['id'],
				'img'       => 'pictures/' . $picture['file'],
				'date'      => $picture['date'],
				'review'    => $picture['review']
			);
		}

		$data['title'] = 'Изображение';

		$this->data = $data;

	}

}
