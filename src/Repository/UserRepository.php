<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }
    public function loadFriends(User $user) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT u.nickname
            FROM friends f, user u
            WHERE f.user_id = :query and
            f.friend_user_id = u.id
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['query' => $user->getId()]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
    public function loadUserByUsername($username)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT u.id FROM user u
            WHERE u.nickname = :query
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['query' => $username]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    /**
     * @return User[] Returns an array of User objects
     */
 
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.nickname = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
