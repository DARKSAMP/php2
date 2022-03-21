<?php

namespace MyApp\Controllers;

use MyApp\Auth;
use MyApp\Basket;
use MyApp\Models\Goods;
use MyApp\Models\History;
use MyApp\Models\Orders;
use MyApp\Models\Users;

class AccountController extends Controller
{
    public function actionOrder()
    {
        $basket = Basket::get();

        if (!$basket['count']) {
            $this->redirect('/catalog');
        }

        if (!($user = Auth::getUser())) {
            $this->redirect('login');
        }

        $orderId = Orders::add($user['id'], $basket['goods']);

        Basket::clear();

        $this->render('account/order.twig', [
            'orderId' => $orderId,
        ]);
    }


    public function actionBasket()
    {
        $basket = Basket::get();

        $goods = [];
        $sum = 0;

        foreach ($basket['goods'] as $id => $count) {
            $good = Goods::getById($id);
            $good['count'] = $count;
            $sum += $good['sum'] = $count * $good['price'];
            $goods[] = $good;
        }

        $this->render('account/basket.twig', [
            'sum' => $sum,
            'goods' => $goods,
        ]);
    }

    public function actionLogin()
    {
        $error = false;

        if (isset($_POST['login'])) {
            if (Users::check($_POST['login'], $_POST['pwd'])) {
                Auth::login($_POST['login']);
                $this->redirect('/account');
            } else {
                $error = true;
            }
        }
        $this->render('account/login.twig', [
            'error' => $error,
        ]);
    }

    public function actionLogout()
    {
        Auth::logout();
        Basket::clear();
        $this->redirect('/');
    }

    public function actionIndex()
    {
        if (!($user = Auth::getUser())) {
            $this->redirect('/login');
        }

        $history = History::getLast($user['id']);

        $this->render('account/index.twig', [
            'history' => $history,
        ]);
    }


    public function actionSettings()
    {
        echo 'Users settings';
    }

    public function actionPassword()
    {
        echo 'Users change pwd page';
    }
}