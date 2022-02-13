<?php

namespace App\Controller;
use App\Entity\Product;
use App\Repository\PostRepository;
use App\Repository\ProductRepository;
use App\Service\cart\CartService;
use App\Service\favorite\FavService;
use App\Service\LastPath;
use App\Service\product\FilterService;
use App\Service\product\Pagination;
use App\Service\product\PaginationService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyController extends AbstractController
{

    public function repProducts(){
        return $this->getDoctrine()->getRepository(Product::class);
    }
    public function listePCFOO():array{
        return $this->repProducts()->getPrimaryCategories();
    }

    public function  listePCC():array{
        $arrPCC=array();
        $pc=$this->listePCFOO();
        foreach ($pc as $p){
            $arrPCC[$p["pcat"]]=$this->repProducts()->getCategories($p["pcat"]);
        }
        arsort($arrPCC);

        return $arrPCC;
    }


    /**
         * @Route("/", name="home")
         */
    public function index(ProductRepository $repProd,PostRepository $prodPost,CartService $cartService,FavService $favService): Response
    {
        $tt=$cartService->TPrice_Items();
        $totalItems=$tt["totalItems"];
        $totalPrice=$tt["totalPrice"];
        $posts=$prodPost->findAll();
        return $this->render('index.html.twig',["searchCat"=>$repProd->getAllcat(),"posts"=>$posts,"pc"=>$this->listePCFOO(),"hehi"=>$this->listePCC(),
            "cart"=>$cartService->getFullCart(),"nbItems"=>$totalItems,
            "totalPrice"=>$totalPrice,"computers"=>$repProd->getProductsPCCLimit("Computers",9),
            "tvs"=>$repProd->getProductsPCCLimit("tvs",9),
            "headphones"=>$repProd->getProductsPCCLimit("Headphones,Bluetooth Headphones",9),
            "computersAcc"=>$repProd->getProductsPCCLimit("Computer accessories",9),
            "scameras"=>$repProd->getProductsPCCLimit("Security Cameras",9),
            "fav"=>$favService->getFullFav()]);
    }

    /**
    * @Route ("/products",name="products",methods={"POST","GET"})
     */
    public function  products(Request $request,FavService $favService,PaginationService $paginationService,LastPath $lastPath,ProductRepository $rep,CartService $cartService,FilterService $filterService):Response{


        if ($request->query->get("limit")!=""){
            $limit=$request->query->get("limit");
        }else{
            $limit=18;
        }if ($request->query->get('sort')==""){
            $data=$rep->getAllDistint();
        }else{
            if ($request->query->get('sort')=="name"){
                $data=$rep->getAllFilter("p.name");
            }
            if ($request->query->get('sort')=="price"){
                $data=$rep->getAllFilter("min");
            }
            $brands=[];
            $newData=[];
            foreach ($request->query->all() as $val=>$brand){
                if (str_starts_with($val,"brands")){
                    $brands[] = $brand;
                }
            }
            foreach ($data as $val=>$item){
                if(in_array($item['brand'],$brands)){
                    $newData[$val]=$item;
                }
            }
            if (!empty($newData)){
                $data=$newData;
            }

        }

        $tt=$cartService->TPrice_Items();
        $totalItems=$tt["totalItems"];
        $totalPrice=$tt["totalPrice"];

        $brands=$rep->getAllManfucters();

        $allProds=$paginationService->paginate($data,$limit);
        return $this->render('shop-grid.html.twig',["searchCat"=>$rep->getAllcat(),"pc"=>$this->listePCFOO(),"prods"=>$allProds,"brands"=>$brands,
            "prange"=>$filterService->pricesRange(),"hehi"=>$this->listePCC(),
            "cart"=>$cartService->getFullCart(),"nbItems"=>$totalItems,"totalPrice"=>$totalPrice,
            "lastURL"=> $lastPath->lastPath(),"fav"=>$favService->getFullFav()]);
    }

    /**
     * @Route ("/search",name="search",methods={"POST","GET"})
     */
    public function  search(Request $request,FavService $favService,PaginationService $paginationService,LastPath $lastPath,ProductRepository $rep,CartService $cartService,FilterService $filterService):Response{
        $limit=18;
       $data=$rep->searchProds($request->query->get("search"),$request->query->get("cat"));
       $brands=[];
       foreach ($data as $val=>$item){
           if (!in_array($item['brand'],$brands))
           $brands[]=$item['brand'];
       }


            $brandsin=[];
            $newData=[];
            foreach ($request->query->all() as $val=>$brand){
                if (str_starts_with($val,"brands")){
                    $brandsin[] = $brand;
                }
            }
            foreach ($data as $val=>$item){

                if(in_array($item['brand'],$brandsin)){

                    $newData[$val]=$item;
                }
            }
            if (!empty($newData)){
                $data=$newData;
            }




        $tt=$cartService->TPrice_Items();
        $totalItems=$tt["totalItems"];
        $totalPrice=$tt["totalPrice"];



        $allProds=$paginationService->paginate($data,$limit);
        return $this->render('search.twig',["searchCat"=>$rep->getAllcat(),"pc"=>$this->listePCFOO(),"prods"=>$allProds,"brands"=>$brands,
            "prange"=>$filterService->pricesRange(),"hehi"=>$this->listePCC(),
            "cart"=>$cartService->getFullCart(),"nbItems"=>$totalItems,"totalPrice"=>$totalPrice,
            "lastURL"=> $lastPath->lastPath(),"fav"=>$favService->getFullFav()]);
    }
    /**
    * @Route ("/products/{cat}",name="productsCat")
     */
    public  function  productsCat($cat,FavService $favService,LastPath $lastPath,PaginationService $paginationService,ProductRepository $rep,CartService $cartService,FilterService $filterService):Response{

        $cat=str_replace("-"," ",$cat);
        $tt=$cartService->TPrice_Items();
        $totalItems=$tt["totalItems"];
        $totalPrice=$tt["totalPrice"];
        $data=$rep->getProductsPC($cat);
        $prods=$paginationService->paginate($data,18);
        $brands=$rep->getAllManfuctersPC($cat);
        return $this->render("shop-cat.html.twig",["searchCat"=>$rep->getAllcat(),"pc"=>$this->listePCFOO(),"prods"=>$prods,"brands"=>$brands,
            "prange"=>$filterService->pricesRangePC($cat),"cName"=>$cat,"hehi"=>$this->listePCC(),
            "cart"=>$cartService->getFullCart(),"nbItems"=>$totalItems,"totalPrice"=>$totalPrice,
            "lastURL"=> $lastPath->lastPath(),"fav"=>$favService->getFullFav()]);
    }
    /**
     * @Route ("/products/{pc}/{c}",name="productsPCC")
     */
    public  function  productsPCC($pc,$c,FavService $favService,LastPath $lastPath,PaginationService $paginationService,ProductRepository $rep,CartService $cartService,FilterService $filterService):Response{
        $c=str_replace("-"," ",$c);

        $tt=$cartService->TPrice_Items();
        $totalItems=$tt["totalItems"];
        $totalPrice=$tt["totalPrice"];

        $data=$rep->getProductsPCC($c);
        $prods=$paginationService->paginate($data,18);
        $brands=$rep->getAllManfuctersPCC($c);
        return $this->render("shop-pcc.html.twig",["searchCat"=>$rep->getAllcat(),"pc"=>$this->listePCFOO(),"prods"=>$prods,"brands"=>$brands,
            "prange"=>$filterService->pricesRangePCC($c),"cName"=>$pc,"cName2"=>$c,"hehi"=>$this->listePCC(),
            "cart"=>$cartService->getFullCart(),"nbItems"=>$totalItems,"totalPrice"=>$totalPrice,
            "lastURL"=> $lastPath->lastPath(),"fav"=>$favService->getFullFav()]);
    }


    /**
     * @Route ("/p/{idProd}",name="pId")
     */
    public function productDetails($idProd,FavService $favService,LastPath $lastPath,ProductRepository $rep,CartService $cartService){
        $tt=$cartService->TPrice_Items();
        $totalItems=$tt["totalItems"];
        $totalPrice=$tt["totalPrice"];

        $product=$rep->findBy(
            ["idProds"=>$idProd,],
            ["amountMin"=>"asc"]);

        $sug=$rep->getProductsPCCLimitNotIn($product[0]->getCategories(), 20,$idProd);
        shuffle($sug);
        $sug=array_slice($sug,0,6);


        return $this->render("blog-single-sidebar.html.twig",["searchCat"=>$rep->getAllcat(),"lastURL"=> $lastPath->lastPath(),"prod"=>$product,
            "cart"=>$cartService->getFullCart(),"nbItems"=>$totalItems,
            "totalPrice"=>$totalPrice,"fav"=>$favService->getFullFav(),
            "sug"=>$sug
        ]);
    }



    /**
     * @Route("/cart/add/{id}",name="cart_add",methods={"POST","GET"})
     */
    public function addProd($id,CartService $cartService,Request $request,ProductRepository $rep){
        $cartService->add($id);
        return $this->redirectToRoute("pId",array("idProd"=>$rep->find($id)->getIdProds()));

    }
    /**
     * @Route("/fav/add/{id}",name="fav_add")
     */
    public function addFav($id,FavService $favService,LastPath $lastPath){
        $favService->add($id);
        return $this->redirect($lastPath->lastPath());
    }
    /**
     * @Route("/fav/remove/{id}",name="fav_remove")
     */
    public function removeFav($id,FavService $favService,LastPath $lastPath){
        $favService->remove($id);
        return $this->redirect($lastPath->lastPath());
    }

    /**
     * @Route("/p_cart/add/{id}",name="cart_add_page")
     */
    public function addProdCartPage($id,CartService $cartService){
        $cartService->add($id);
        return $this->redirectToRoute("cart_page");
    }

    /**
     * @Route("/p_cart/dec/{id}",name="cart_dec_page")
     */
    public function decProd($id,CartService $cartService){
        $cartService->decrement($id);
        return $this->redirectToRoute("cart_page");


    }
    /**
     * @Route("/p_cart/remove/{id}",name="cart_remove_page")
     */
    public function removeProd($id,CartService $cartService,LastPath $lastPath){

        $cartService->remove($id);
        return $this->redirect($lastPath->lastPath());


    }

    /**
     * @Route ("/p_cart/set/{id}/{qtity}",name="cat_page")
     */
    public function  setProd($id,$qtity,CartService $cartService){
        $cartService->set($id,$qtity);
        return $this->redirectToRoute("cart_page");

    }

    /**
    * @Route ("/cart",name="cart_page")
     **/
    public  function cart(ProductRepository $rep,CartService $cartService,FavService $favService):Response{
        $tt=$cartService->TPrice_Items();
        $totalItems=$tt["totalItems"];
        $totalPrice=$tt["totalPrice"];

        return $this->render("cart.html.twig",["searchCat"=>$rep->getAllcat(),"cart"=>$cartService->getFullCart(),"nbItems"=>$totalItems,
            "totalPrice"=>$totalPrice, "fav"=>$favService->getFullFav()]);
    }

    /**
     * @Route ("/cart/checkout",name="chekout")
     */
    public  function  checkout(FavService $favService,CartService $cartService,ProductRepository $rep){
        $tt=$cartService->TPrice_Items();
        $totalItems=$tt["totalItems"];
        $totalPrice=$tt["totalPrice"];
        return $this->render("checkout.html.twig",["searchCat"=>$rep->getAllcat(),"fav"=>$favService->getFullFav(),"cart"=>$cartService->getFullCart(),"nbItems"=>$totalItems,
            "totalPrice"=>$totalPrice,]);
    }


}