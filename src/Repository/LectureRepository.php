<?php
/**
 * Created by PhpStorm.
 * User: Roma
 * Date: 03/05/2018
 * Time: 13:03
 */

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class LectureRepository extends EntityRepository
{
        public function createLectureQueryBuilder()
        {
            return $this->createQueryBuilder('lecture')
                ->orderBy('lecture.lectureName', 'ASC');
        }
}