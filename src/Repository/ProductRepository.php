<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getPrimaryCategories()
    {
        return $this->createQueryBuilder('p')
            ->select('trim(p.primaryCategories) as pcat')
            ->distinct()
            ->getQuery()
            ->getResult()
            ;
    }

    public  function getAllcat(){
       return $this->createQueryBuilder('p')
           ->select("p.categories")
           ->distinct()
           ->getQuery()
           ->getResult();
    }
    public function searchProds($name,$cat){
        if ($cat=="allcat"){
            return
            $this->createQueryBuilder('p')
                ->select("p.name,p.imageURLs,p.idProds,min(p.amountMin) as min,max(p.amountMin) as max,count(p) as  count,p.brand")
                ->where("p.name like :name")
                ->groupBy("p.idProds,p.name,p.imageURLs,p.brand")
                ->setParameter('name','%'.$name.'%')
                ->getQuery()
                ->getResult()
                ;
        } return
            $this->createQueryBuilder('p')
                ->select("p.name,p.imageURLs,p.idProds,min(p.amountMin) as min,max(p.amountMin) as max,count(p) as  count,p.brand")
                ->where("p.name like :name")
                ->andWhere("p.categories= :cat")
                ->setParameter("cat",$cat)
                ->groupBy("p.idProds,p.name,p.imageURLs,p.brand")
                ->setParameter('name','%'.$name.'%')
                ->getQuery()
                ->getResult()
            ;
    }
    public function getCategories($cat){
    return $this->createQueryBuilder('p')
        ->select('trim(p.categories) as ctg')
        ->where("p.primaryCategories= :cat")
        ->setParameter("cat",$cat)
        ->distinct()
        ->getQuery()
        ->getResult()
        ;
}
    public function getProductsPC($pc)
    {
        return $this->createQueryBuilder('p')
            ->select("p.name,p.imageURLs,p.idProds,min(p.amountMin) as min,max(p.amountMin) as max,count(p) as  count")
            ->where("trim(p.primaryCategories)= :pc")
            ->groupBy("p.idProds,p.name,p.imageURLs")
            ->setParameter('pc',$pc)
            ->getQuery()
            ->getResult()
            ;
    }

    public function getProductsPCC($pc)
    {
        return $this->createQueryBuilder('p')
            ->select("p.name,p.imageURLs,p.idProds,min(p.amountMin) as min,max(p.amountMin) as max,count(p) as  count")
            ->where("trim(p.categories)= :pc")
            ->groupBy("p.idProds,p.name,p.imageURLs")
            ->setParameter('pc',$pc)
            ->getQuery()
            ->getResult()
            ;
    }
    public function getProductsPCCLimit($pc,$limit)
    {
        return $this->createQueryBuilder('p')
            ->select("p.name,p.imageURLs,p.idProds,min(p.amountMin) as min,max(p.amountMin) as max,count(p) as  count")
            ->where("trim(p.categories)= :pc")
            ->groupBy("p.idProds,p.name,p.imageURLs")
            ->setParameter('pc',$pc)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    public function getProductsPCCLimitNotIn($pc,$limit,$id)
    {
        return $this->createQueryBuilder('p')
            ->select("p.name,p.imageURLs,p.idProds,min(p.amountMin) as min,max(p.amountMin) as max,count(p) as  count")
            ->where("trim(p.categories)= :pc")
            ->andWhere("p.idProds <> :id")
            ->setParameter('id',$id)
            ->groupBy("p.idProds,p.name,p.imageURLs")
            ->setParameter('pc',$pc)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }

    public  function getAllDistint(){
        return $this->createQueryBuilder('p')
            ->select("p.name,p.imageURLs,p.idProds,min(p.amountMin) as min,max(p.amountMin) as max,count(p) as  count,p.brand")
            ->groupBy("p.idProds,p.name,p.imageURLs,p.brand")
            ->getQuery()
            ->getResult(); }
    public  function getAllFilter($order="name"){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p.name,p.imageURLs,p.idProds,min(p.amountMin) as min,max(p.amountMin) as max,count(p) as  count,p.brand
            FROM App\Entity\Product p
            group by p.idProds,p.name,p.imageURLs,p.brand
            ORDER BY ' .$order.' DESC '
        );

        // returns an array of Product objects
        return $query->getResult();}

    public function getAllManfucters(){
        return $this->createQueryBuilder('p')
            ->select("p.brand")
            ->orderBy("p.brand")
            ->distinct()
            ->getQuery()
            ->getResult();
}



    public function getAllManfuctersPC($pc){
        return $this->createQueryBuilder('p')
            ->select("p.brand")
            ->where("trim(p.primaryCategories)= :pc")
            ->setParameter("pc",$pc)
            ->orderBy("p.brand")
            ->distinct()
            ->getQuery()
            ->getResult();
    }

    public function getAllManfuctersPCC($pc){
        return $this->createQueryBuilder('p')
            ->select("p.brand")
            ->where("trim(p.categories)= :pc")
            ->setParameter("pc",$pc)
            ->orderBy("p.brand")
            ->distinct()
            ->getQuery()
            ->getResult();
    }

    public function findLessPrice($price)
    {
        return $this->createQueryBuilder('p')
            ->select("p.name,min(p.amountMin)")
            ->groupBy("p.name")
            ->andHaving("min(p.amountMin) <= :val")
            ->setParameter('val', $price)
            ->getQuery()
            ->getResult();
    }
    public function findLessPricePC($price,$pc)
    {
        return $this->createQueryBuilder('p')
            ->select("p.name,min(p.amountMin)")
            ->where('trim(p.primaryCategories)= :pc')
            ->setParameter("pc",$pc)
            ->groupBy("p.name")
            ->andHaving("min(p.amountMin) <= :val")
            ->setParameter('val', $price)
            ->getQuery()
            ->getResult();
    }
    public function findLessPricePCC($price,$pcc)
    {
        return $this->createQueryBuilder('p')
            ->select("p.name,min(p.amountMin)")
            ->where('trim(p.categories)= :pcc')
            ->setParameter("pcc",$pcc)
            ->groupBy("p.name")
            ->andHaving("min(p.amountMin) <= :val")
            ->setParameter('val', $price)
            ->getQuery()
            ->getResult();
    }

    public function findBetweenPrices($priceM,$priceL)
    {

        return $this->createQueryBuilder('p')
            ->select("p.name,min(p.amountMin)")
            ->groupBy("p.name")
            ->andHaving("min(p.amountMin)> :val or max(p.amountMin)> :val")
            ->setParameter('val', $priceM)
            ->andHaving("min(p.amountMin)<= :val2")
            ->setParameter('val2', $priceL)
            ->getQuery()
            ->getResult();
    }
    public function findBetweenPricesPC($priceM,$priceL,$pc)
    {

        return $this->createQueryBuilder('p')
            ->select("p.name,min(p.amountMin)")
            ->where('trim(p.primaryCategories)= :pc')
            ->setParameter("pc",$pc)
            ->groupBy("p.name")
            ->andHaving("min(p.amountMin)> :val or max(p.amountMin)> :val")
            ->setParameter('val', $priceM)
            ->andHaving("min(p.amountMin)<= :val2")
            ->setParameter('val2', $priceL)
            ->getQuery()
            ->getResult();
    }
    public function findBetweenPricesPCC($priceM,$priceL,$pcc)
    {

        return $this->createQueryBuilder('p')
            ->select("p.name,min(p.amountMin)")
            ->where('trim(p.categories)= :pcc')
            ->setParameter("pcc",$pcc)
            ->groupBy("p.name")
            ->andHaving("min(p.amountMin)> :val or max(p.amountMin)> :val")
            ->setParameter('val', $priceM)
            ->andHaving("min(p.amountMin)<= :val2")
            ->setParameter('val2', $priceL)
            ->getQuery()
            ->getResult();
    }

    public function findGreaterPrice($price)
    {
        return $this->createQueryBuilder('p')
            ->select("p.name,min(p.amountMin)")
            ->groupBy("p.name")
            ->andHaving("min(p.amountMin)> :val")
            ->setParameter('val',$price)
            ->getQuery()
            ->getResult();
    }

    public function findGreaterPricePC($price,$pc)
    {

        return $this->createQueryBuilder('p')
            ->select("p.name,min(p.amountMin)")
            ->andWhere('trim(p.primaryCategories)= :pc')
            ->setParameter("pc",$pc)
            ->groupBy("p.name")
            ->andHaving("min(p.amountMin)> :val")
            ->setParameter('val',$price)
            ->getQuery()
            ->getResult();
    }
    public function findGreaterPricePCC($price,$pcc)
    {

        return $this->createQueryBuilder('p')
            ->select("p.name,min(p.amountMin)")
            ->andWhere('trim(p.primaryCategories)= :pcc')
            ->setParameter("pcc",$pcc)
            ->groupBy("p.name")
            ->andHaving("min(p.amountMin)> :val")
            ->setParameter('val',$price)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
