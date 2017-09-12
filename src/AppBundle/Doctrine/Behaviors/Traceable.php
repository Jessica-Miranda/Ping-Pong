<?php

namespace AppBundle\Doctrine\Behaviors;

use Doctrine\ORM\Mapping as ORM;

/**
 * Traceable trait.
 *
 */
trait Traceable
{
    use \Knp\DoctrineBehaviors\Model\Timestampable\Timestampable,
        \Knp\DoctrineBehaviors\Model\Blameable\Blameable,
        \Knp\DoctrineBehaviors\Model\Loggable\Loggable
    ;
}
