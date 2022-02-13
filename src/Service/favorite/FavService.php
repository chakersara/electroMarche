<?php

namespace App\Service\favorite;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FavService
{
    private $session;
    private $rep;

    public function __construct(SessionInterface $session,ProductRepository $rep){
        $this->session=$session;
        $this->rep=$rep;
    }
    public function add(string $id)
    {
        $fav = $this->session->get('fav', []);

        if (!in_array($id,$fav)) {
            $fav[$id]=$this->rep->findOneBy(['idProds'=>$id]);
        }

        $this->session->set('fav', $fav);
    }

    public function remove(string $id)
    {
        $fav = $this->session->get('fav', []);

        if (array_key_exists($id,$fav)) {

            unset($fav[$id]);
        }

        $this->session->set('fav', $fav);
    }


    public function getFullFav(){
        return $this->session->get('fav', []);
    }

}