<?php

namespace MyApp\Controllers;

use MyApp\Models\Goods;

class GoodsController extends Controller
{
    public function actionIndex()
    {
        $goods = Goods::getAll();

        $this->render("goods.twig", [
            'goods' => $goods,
        ]);
    }

    public function actionAdd()
    {
        if (isset($_POST['title'])) {
            Goods::add($_POST['title'], $_POST['price']);
            $this->redirect();
        }

        $this->render("add.twig");
    }
}