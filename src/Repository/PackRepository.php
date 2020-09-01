<?php

namespace App\Repository;

use App\Entity\Pack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pack|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pack|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pack[]    findAll()
 * @method Pack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pack::class);
    }

    // /**
    //  * @return Pack[] Returns an array of Pack objects
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
    public function findOneBySomeField($value): ?Pack
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /*
        Función para añadir packs
    */
    public function añadirPack($contenido, $precio, $foto){
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            Insert into pack(contenido, precio, foto) values(:conten, :precio, :foto)
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['conten' => $contenido, 'precio' => $precio, 'foto' => $foto]);
    }
    /*
        Función para borrar packs
    */
    public function BorrarPack($id){
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            delete from pack where pack.id = :id
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
    /*
        Función para modificar packs
    */
    public function ModificarPack($id, $contenido, $precio, $foto){
        $conn = $this->getEntityManager()->getConnection();
         $sql = '
            alter table pack where pack.id = :id set pack.contenido = :conten and pack.precio = :precio and pack.foto = :foto
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id, 'conten' => $contenido, 'precio' => $precio, 'foto' => $foto]);
    }
}
