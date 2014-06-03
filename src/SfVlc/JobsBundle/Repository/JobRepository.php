<?php

namespace SfVlc\JobsBundle\Repository;

use Doctrine\ORM\EntityRepository;

class JobRepository extends EntityRepository
{
    private function getCommonQueryBuilder(){
        $query = $this->createQueryBuilder('job')
            ->addSelect('tags')
            ->join('job.tags', 'tags')
            ->addGroupBy('job')
            ->orderBy('job.dateCreated', 'DESC');

        return $query;
    }

    private function createQuery($query){
        return $this->_em->createQuery($query);
    }

    public function findAll(){
        $query = $this->getCommonQueryBuilder();

        return $this->createQuery($query)->getResult();
    }

    public function findOneByUrl($url){
        $query = $this->getCommonQueryBuilder()
            ->where('job.url = :url');

        return $this->createQuery($query)
            ->setParameter(':url', $url)
            ->getSingleResult();
    }

    public function findJobsByTag($tagUrl){

        $query = $this->getCommonQueryBuilder()
            ->where('tags.url = :url');

        return $this->createQuery($query)
            ->setParameter(':url', $tagUrl)
            ->getResult();
    }
}
 