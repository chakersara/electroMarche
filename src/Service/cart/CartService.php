<?php

namespace App\Service\cart;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
    private $repProd;

    public function __construct(SessionInterface $session, ProductRepository $repProd)
    {
        $this->session = $session;
        $this->repProd = $repProd;

    }

    public function add(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->session->set('cart', $cart);
    }

    public function remove(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }

    public function decrement(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]--;
        } else {
            $cart[$id] = 0;
        }

        $this->session->set('cart', $cart);

    }

    public function set(int $id, int $qtity)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            if ($qtity >= 0) {
                $cart[$id] = $qtity;
            } else {
                $cart[$id] = 0;
            }

        }

        $this->session->set('cart', $cart);
    }

    public function getFullCart(): array
    {
        $cart = $this->session->get('cart', []);
        $cartData = [];
        foreach ($cart as $id => $qtity) {
            $cartData[] = [
                "product" => $this->repProd->find($id),
                "quantity" => $qtity
            ];
        };
        return $cartData;
    }

    public function TPrice_Items()
    {
        $totalPrice = 0;
        $totalItems = 0;
        foreach ($this->getFullCart() as $item) {
            $totalItems += $item['quantity'];
            $totalPrice += $item['quantity'] * $item['product']->getAmountMin();
        }
        return ["totalPrice" => $totalPrice, "totalItems" => $totalItems];
    }

}
