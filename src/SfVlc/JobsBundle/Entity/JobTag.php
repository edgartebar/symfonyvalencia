<?php
namespace SfVlc\JobsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tags")
 *
 */
class JobTag
{
	/**
	 * @ORM\Column(name="ID", type="integer", nullable=true)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;

	/**
	 * @ORM\Column(name="Tag", type="string", length=100, unique=true)
	 */
	protected $tag;

    /**
	 * @ORM\Column(name="Url", type="string", length=100)
	 */
	protected $url;

	/**
	 * @ORM\ManyToMany(targetEntity="Job", fetch="LAZY", mappedBy="tags")
	 */
	protected $jobs;

	function __construct()
	{
		$this->jobs = new ArrayCollection;
	}

	public function __toString()
	{
		return $this->tag;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param $tag
	 */
	public function setTag($tag)
	{
		$this->tag = trim($tag);
	}

	public function getTag()
	{
		return $this->tag;
	}

	public function addJob(Job $job)
	{
		if(!$this->jobs->contains($job))
			$this->jobs->add($job);
	}

	public function setJobs($jobs)
	{
        foreach ($jobs as $job) {
            $this->addJob($job);
        }
    }

	public function getJobs()
	{
		return $this->jobs;
	}

	public function removeJob(Job $job)
	{
		if($this->jobs->contains($job))
			$this->jobs->removeElement($job);
	}

	public function createFromString($input)
	{
		$instance = new self;
		$instance->setTag($input);
		$instance->setUrl($this->cleanStringToUrl($input));

		return $instance;
	}

    private function cleanStringToUrl($input)
    {
        $string = trim($input);

        $string = preg_replace("`\[.*\]`U", "", $string);
        $string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace(
            "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i", "\\1", $string
        );
        $string = preg_replace(array("`[^a-z0-9]`i", "`[-]+`"), '-', $string);

        $string = strtolower(trim($string, '-'));

        return $string;
    }

	public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }
}