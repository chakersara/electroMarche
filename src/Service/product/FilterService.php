<?php

namespace App\Service\product;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FilterService
{
    private $rep;

    public function __construct(ProductRepository $rep)
    {
        $this->rep= $rep;

    }

    public function pricesRange():array{
        $pricesRange=array();
        $pricesRange["50"]=count($this->rep->findLessPrice(50));
        $pricesRange["50-100"]=count($this->rep->findBetweenPrices(50,100));
        $pricesRange["100-250"]=count($this->rep->findBetweenPrices(100,250));
        $pricesRange["250-500"]=count($this->rep->findBetweenPrices(250,500));
        $pricesRange["500-1000"]=count($this->rep->findBetweenPrices(500,1000));
        $pricesRange["1000-2000"]=count($this->rep->findBetweenPrices(1000,2000));
        $pricesRange["2000-3000"]=count($this->rep->findBetweenPrices(2000,3000));
        $pricesRange["3000-4000"]=count($this->rep->findBetweenPrices(3000,4000));
        $pricesRange["4000"]=count($this->rep->findGreaterPrice(4000));
        return $pricesRange;
    }
    public function pricesRangePC($pc):array{
        $pricesRange=array();
        $pricesRange["50"]=count($this->rep->findLessPricePC(50,$pc));
        $pricesRange["50-100"]=count($this->rep->findBetweenPricesPC(50,100,$pc));
        $pricesRange["100-250"]=count($this->rep->findBetweenPricesPC(100,250,$pc));
        $pricesRange["250-500"]=count($this->rep->findBetweenPricesPC(250,500,$pc));
        $pricesRange["500-1000"]=count($this->rep->findBetweenPricesPC(500,1000,$pc));
        $pricesRange["1000-2000"]=count($this->rep->findBetweenPricesPC(1000,2000,$pc));
        $pricesRange["2000-3000"]=count($this->rep->findBetweenPricesPC(2000,3000,$pc));
        $pricesRange["3000-4000"]=count($this->rep->findBetweenPricesPC(3000,4000,$pc));
        $pricesRange["4000"]=count($this->rep->findGreaterPricePC(4000,$pc));
        return $pricesRange;
    }
    public function pricesRangePCC($pcc):array{
        $pricesRange=array();
        $pricesRange["50"]=count($this->rep->findLessPricePCC(50,$pcc));
        $pricesRange["50-100"]=count($this->rep->findBetweenPricesPCC(50,100,$pcc));
        $pricesRange["100-250"]=count($this->rep->findBetweenPricesPCC(100,250,$pcc));
        $pricesRange["250-500"]=count($this->rep->findBetweenPricesPCC(250,500,$pcc));
        $pricesRange["500-1000"]=count($this->rep->findBetweenPricesPCC(500,1000,$pcc));
        $pricesRange["1000-2000"]=count($this->rep->findBetweenPricesPCC(1000,2000,$pcc));
        $pricesRange["2000-3000"]=count($this->rep->findBetweenPricesPCC(2000,3000,$pcc));
        $pricesRange["3000-4000"]=count($this->rep->findBetweenPricesPCC(3000,4000,$pcc));
        $pricesRange["4000"]=count($this->rep->findGreaterPricePCC(4000,$pcc));
        return $pricesRange;
    }
}