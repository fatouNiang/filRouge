<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommunityManagerRepository;

/**
 * @ORM\Entity(repositoryClass=CommunityManagerRepository::class)
 */
class CommunityManager extends User
{
}
