<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      collectionOperations={
 *  },
 *  itemOperations={
 *      "get_formateur_id"={ 
 *            "method"="GET", 
 *            "path"="/formateurs/{id}",
 *          },
 *      "put_formateur_id"={ 
 *            "method"="PUT", 
 *            "path"="/formateurs/{id}",
 *          },
 *  },
 *      attributes = {"security"="is_granted('ROLE_Formateur') or is_granted('ROLE_Community Manager'",
 *              "security_message"="Acces non autorisé"})
 * 
 * )
 * )
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
  */
class Formateur extends User
{
   

}