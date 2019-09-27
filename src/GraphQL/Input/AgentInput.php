<?php

namespace App\GraphQL\Input;


use Symfony\Component\Validator\Constraints as Assert;

class AgentInput
{
    /**
     * @Assert\NotBlank()
     */
    public $firstname;

    /**
     * @Assert\NotBlank()
     */
    public $lastname;

    /**
     * @Assert\NotBlank()
     */
    public $birthDate;
}
