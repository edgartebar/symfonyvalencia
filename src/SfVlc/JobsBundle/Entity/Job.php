<?php

namespace SfVlc\JobsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use SfVlc\JobsBundle\Entity\JobTag as Tag;
/**
 * Job
 *
 * @ORM\Entity
 * @ORM\Table(name="jobs")
  */
class Job
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=255)
     * @Assert\NotBlank(message="Este valor no debe estar vacío")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Url", type="string", length=255)
     * @Assert\NotBlank(message="Este valor no debe estar vacío")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="Link", type="string", length=255)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="Content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Created", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="Company", type="string", length=100)
     */
    private $company;

    /**
     * @ORM\ManyToMany(targetEntity="JobTag", cascade={"persist"}, inversedBy="jobs", fetch="LAZY")
     *
     * @ORM\JoinTable(name="jobs_tags",
     *   joinColumns={@ORM\JoinColumn(name="Job_ID", referencedColumnName="id", onDelete="CASCADE")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="Tag_ID", referencedColumnName="id", onDelete="CASCADE")}
     * )
     *
     * @var ArrayCollection
     */
    protected $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $title
     * @return Job
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Job
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Job
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Job
     */
    public function setDateCreated($date)
    {
        $this->dateCreated = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Job
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        if(!$this->tags->contains($tag))
        {
            $tag->addJob($this);
            $this->tags[] = $tag;
        }
    }

    public function removeTag(Tag $tag)
    {
        if($this->tags->contains($tag))
        {
            $this->tags->removeElement($tag);
            $tag->removeJob($this);
        }
    }

    public function hasTag($tag)
    {
        $checkJobTag = function($tagString){
            return function($key, Tag $tag) use ($tagString){
                return $tag->getTag() == $tagString;
            };
        };

        $this->tags->exists($checkJobTag($tag));
    }

    /**
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
