<?php

namespace SfVlc\JobsBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\QueryBuilder;

class JobsManager
{
    protected $manager;
    protected $entity_repository;

    function __construct(ObjectManager $manager){
        $this->manager = $manager;
        $this->entity_repository = $manager->getRepository('SfVlcJobsBundle:Job');
    }

    public function getAllJobs($tagUrl = null){
        $jobs = $tagUrl ? $this->entity_repository->findJobsByTag($tagUrl) : $this->entity_repository->findAll();

        return $jobs;
    }

    public function getJobByUrl($url)
    {
        $job = $this->entity_repository->findOneByUrl($url);

        return $job;
    }
}
 