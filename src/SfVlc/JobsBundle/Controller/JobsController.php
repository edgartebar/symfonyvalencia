<?php
namespace SfVlc\JobsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class JobsController extends Controller
{

    /**
     * @Template()
     */
    public function jobsAction($tag = null)
    {
        $jobs = $this->get('sfvlc.jobsmanager')->getAllJobs($tag);

        return array(
            'jobs' => $jobs,
            'tag' => $tag
        );
    }

     /**
     * @Template()
     */
    public function jobAction($url)
    {
        $job = $this->get('sfvlc.jobsmanager')->getJobByUrl($url);

        return array('job' => $job);
    }
}
 