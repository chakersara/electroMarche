<?php

namespace App\Service\product;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class PaginationService
{
    private $paginator;
    protected $request;

    public function __construct(PaginatorInterface $paginator,RequestStack $request){
        $this->paginator=$paginator;
        $this->request=$request;
    }

    public function paginate(array $data,int $maxPerPage)
    {
        $request=$this->request->getCurrentRequest();
        $prods= $this->paginator->paginate(
            $data,
            $request->query->getInt("page",1),
            $maxPerPage
        );
        return $prods;
    }
}