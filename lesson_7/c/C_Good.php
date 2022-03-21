<?php
//
// ??????????? ????.
//
include_once 'm/Good.php';

class C_Good extends C_Base
{
	//
	// ??????
	//
	
	public function action_view()	{
		$get_good = new Good();
		$this->title .= '::Каталог Товаров';
		$good_array = $get_good->goodget();
		$text .= "<div class='good__row'>";
		foreach ($good_array as $id) {
			 $text .= "<div class='good'><h2>".$id['name'].'</h2><img src="img/'.$id['image'].'" alt="'.$id['name'].'"><p>'.$id['price']."<form method='post' action='index.php?c=basket&act=add'><div class='form-group'> <label for='points'>Количество</label> <input class='form-control' type='number' name='counts' value='1'><button class='btn btn-primary' type='submit' name='idgoods' value=".$id['id'].">Купить</button></div></form></div>" ;
		}
		$text .= "</div>";

		$this->content = $this->Template('v/v_goodview.php', array('text' => $text));	
	}

}
