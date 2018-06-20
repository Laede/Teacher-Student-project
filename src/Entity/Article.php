<?php
/**
 * Created by PhpStorm.
 * User: Roma
 * Date: 03/05/2018
 * Time: 11:40
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="articles")
 */
class Article
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
    private $articleName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teacher", inversedBy="articles")
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lecture", inversedBy="lectureArticles")
     */
    private $lecture;

///////////////////////////<- getter & setters ->//////////////////////////////

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getArticleName()
    {
        return $this->articleName;
    }

    /**
     * @param mixed $articleName
     */
    public function setArticleName($articleName): void
    {
        $this->articleName = $articleName;
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
    public function getLecture()
    {
        return $this->lecture;
    }

    /**
     * @param mixed $lecture
     */
    public function setLecture($lecture): void
    {
        $this->lecture = $lecture;
    }





}