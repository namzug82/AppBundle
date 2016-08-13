<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UsersMaterialsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsersMaterialsRepository extends EntityRepository
{
	public function getUsersByMaterialIds($arrayOfMaterialIds)
	{
		$query = $this->getEntityManager()
	        ->createQueryBuilder();
	    $query
	    	->select('u')
	    	->from('AppBundle\Entity\User', 'u')
	    	->innerJoin('AppBundle:UsersMaterials', 'um', 'WITH', 'u.id = um.userId')
	    	->andWhere('um.materialId IN (:materialIds)')
	    	->setParameter('materialIds', $arrayOfMaterialIds)
	    ;

	    try {
	        return $query->getQuery()->getResult();
	    } catch (\Doctrine\ORM\NoResultException $e) {
	        return null;
	    }
	}
}