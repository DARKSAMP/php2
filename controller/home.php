<?php
class Home {

	private $data;

	public function __construct() {

		$this->getData();
		if (isset($this->data['ajax']) && $this->data['ajax']) {
			header('Content-Type: application/json');
			echo json_encode($this->data);
		} else {
			$view = new View();
			$view->render('home', $this->data);
		}

	}
	
	private function getData() {

		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}

		if (isset($_GET['limit'])) {
			$limit = $_GET['limit'];
		} else {
			$limit = 5;
		}

		$filter = array(
			'limit' => $limit,
			'start' => $limit*($page-1)
		);

		$model = Model::loadModel('home');
		$pictures = $model->getPictures($filter);

		$total = $model->getTotalPictures();
		$next_page = ($page*$limit < $total) ? ++$page : false;

		$data = array();

		foreach ($pictures as $picture) {

			$data['pictures'][] = array(
				'id'        => $pictures['id'],
				'thumb'     => $this->getThumb($picture['file']),
				'date'      => $picture['date'],
				'review'    => $picture['review'],
				'href'      => 'viewImage?picture_id=' . $picture['id']
			);
			
		}

		if (isset($_GET['ajax']) && $_GET['ajax']) {
			$data['ajax'] = TRUE;
		} else {
			$data['ajax'] = FALSE;
		}

		$data['next_page'] = $next_page;
		$data['title'] = 'Галлерея Изображений';

		$this->data = $data;

	}
	
	private function getThumb($file) {

		$file_thumb = DIR_CACHE . DIRECTORY_SEPARATOR . $file;

		if (!file_exists($file_thumb)) {
			$result = $this->imageResize($file_thumb, DIR_IMAGES . DIRECTORY_SEPARATOR . $file);

			if (!$result) return false;
		}

		return 'pictures/cache/' . $file;
	}

	private function imageResize($outfile,$infile,$neww=300, $quality=50) {

		if (file_exists($infile)) {

			$info = getimagesize($infile);

			$mime = isset($info['mime']) ? $info['mime'] : '';

			$im = '';

			if ($mime == 'image/gif') {
				$im = imagecreatefromgif($infile);
			} elseif ($mime == 'image/png') {
				$im = imagecreatefrompng($infile);
			} elseif ($mime == 'image/jpeg') {
				$im = imagecreatefromjpeg($infile);
			}

			if (!$im) return false;

			$k = $neww / imagesx($im);
			if ($k > 1) {
				$k = 1;
			}

			$w = intval(imagesx($im) * $k);
			$h = intval(imagesy($im) * $k);

			$im1 = imagecreatetruecolor($w, $h);
			imagecopyresampled($im1, $im, 0, 0, 0, 0, $w, $h, imagesx($im), imagesy($im));

			imagejpeg($im1, $outfile, $quality);
			imagedestroy($im);
			imagedestroy($im1);

			return TRUE;
		} else {
			return false;
		}
	}
}
