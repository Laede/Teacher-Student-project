<?php
/**
 * Created by PhpStorm.
 * User: Roma
 * Date: 03/05/2018
 * Time: 12:17
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LectureRepository")
 * @ORM\Table(name="lectures")
 *
 */
class Lecture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $lectureName;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teacher", inversedBy="lectures")
     */
    private $teacher;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="lecture")
     */
    private $lectureArticles;

//////////////////////////////<- getters & setters ->////////////////////////////////////
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLectureName()
    {
        return $this->lectureName;
    }

    /**
     * @param mixed $lectureName
     */
    public function setLectureName($lectureName): void
    {
        $this->lectureName = $lectureName;
    }

    /**
     * @return mixed
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param mixed $teacher
     */
    public function setTeacher($teacher): void
    {
        $this->teacher = $teacher;
    }

    /**
     * @return mixed
     */
    public function getLectureArticles()
    {
        return $this->lectureArticles;
    }

    /**
     * @param mixed $lectureArticles
     */
    public function setLectureArticles($lectureArticles): void
    {
        $this->lectureArticles = $lectureArticles;
    }

/////////////////////////////<- custom functions ->//////////////////////////////////////////

    public function __construct()
    {
        $this->lectureArticles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->lectureName;
    }
}