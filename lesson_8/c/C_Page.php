<?php
//
// ??????????? ????.
//
include_once('m/model.php');
include_once('m/Good.php');

class C_Page extends C_Base
{
	//
	// ??????
	//
	
	public function action_index(){
		$this->title .= '::Главная';
		$get_good = new Good();
		$good_array = $get_good->goodgetindex();
		$text .= "<div class='good__row_main'>";
		foreach ($good_array as $id) {
			 $text .= "<div class='good__main'><h2>".$id['name'].'</h2><img src="img/'.$id['image'].'" alt="'.$id['name'].'"><p>'.$id['price']."<form method='post' action='index.php?c=good&act=view'><div class='form-group'> <button class='btn btn-primary' type='submit'>Перейти в Каталог</button></div></form></div>" ;
		}
		$this->content = $this->Template('v/v_index.php', array('text' => $text));	
	}
	
	public function action_edit(){
		$this->title .= '::Редактирование';
		
		if($this->isPost())
		{
			text_set($_POST['text']);
			header('location: index.php');
			exit();
		}
		
		$text = text_get();
		$this->content = $this->Template('v/v_edit.php', array('text' => $text));		
	}
}
