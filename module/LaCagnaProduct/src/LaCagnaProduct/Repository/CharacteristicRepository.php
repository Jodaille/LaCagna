<?php

namespace LaCagnaProduct\Repository;

use Doctrine\ORM\EntityRepository;

class CharacteristicRepository extends EntityRepository
{
    public function getCharacteristicValue($abbreviation, $value)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->add('select', 'c')
            ->add('from', 'LaCagnaProduct\Entity\Characteristic c')
            ->leftJoin('c.characteristicsvalues', 'values');

        $qb->andWhere('c.abbreviation = :abbreviation');
        $qb->andWhere('values.value = :value')

        ->setParameter(':abbreviation', $abbreviation)
        ->setParameter(':value', $value);

        $query = $qb->getQuery();
        $results = $query->getOneOrNullResult();

        return $results;
    }

}
