<?php

namespace AppBundle\Entity;

use Algolia\AlgoliaSearchBundle\Mapping\Annotation as Algolia;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="assessor_managed_areas")
 * @ORM\Entity
 *
 * @Algolia\Index(autoIndex=false)
 */
class AssessorManagedArea extends ManagedArea
{
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Adherent", inversedBy="assessorManagedArea")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $adherent;
}
