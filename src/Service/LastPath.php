<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class LastPath
{
    private $request;

    public function  __construct(RequestStack $request ){
        $this->request=$request;
    }
    public function lastPath(){
        $request=$this->request->getCurrentRequest();
        return $request->headers->get('referer');
    }
}