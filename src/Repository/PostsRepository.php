<?php

namespace App\Repository;

use App\Entity\Posts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Posts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Posts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Posts[]    findAll()
 * @method Posts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class PostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Posts::class);
    }
    /*
        Función para buscar posts
    */
    public function buscaPosts()
    {
        return $this->getEntityManager()
                ->createQuery('SELECT post.id, post.titulo, post.foto, post.fecha, user.nickname From App:Posts post JOIN post.user user');
    }
    /*
        Función para eliminar posts
    */
    public function eliminarPost($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            delete from posts where posts.id = :id
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
    /*
        Función para crear el rss
    */
    public function getRSS(){
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT titulo, likes, fecha, contenido, user_id FROM posts order by fecha desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        $rows = $stmt->fetchAll();
        $data = '';
        $data .= '<?xml version="1.0 encoding="UTF-8"?>';
        $data .= '<rss version="2.0">';
        $data .= '<channel>';
        $data .= '<title>Parchís Mg98</title>';
        $data .= '<link>http://localhost:8000/foro</link>';
        $data .= '<description>Foro de la aplicación web Parchis Mg98</description>';

        if (count($rows) > 0) {
            for ($i=0; $i < count($rows); $i++) {
                $data .= '<item>';
                foreach ($rows[$i] as $propiedad => $valor) {
                    $data .= "<$propiedad>$valor</$propiedad>";
                }
                $data .= '</item>';
            }
        }				
        $data .= '</channel></rss>';
        return $data;
    }
    // /**
    //  * @return Posts[] Returns an array of Posts objects
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
    public function findOneBySomeField($value): ?Posts
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
