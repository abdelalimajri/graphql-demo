<?php

namespace App\GraphQL\Input;


use App\Entity\Agent;
use AssoConnect\GraphQLMutationValidatorBundle\Input\RequestObject;
use Symfony\Component\Validator\Constraints as Assert;
use AssoConnect\GraphQLMutationValidatorBundle\Validator\Constraints as AssoConnectAssert;


/**
 * @AssoConnectAssert\GraphQLRequestObject()
 */
class AgentInput extends RequestObject
{
    /**
     * @see Agent::$firstname
     */
    public $firstname;

    /**
     * @see Agent::$lastname
     */
    public $lastname;

    /**
     * @see Agent::$birthDate
     */
    public $birthDate;

    /**
     * @see Agent::$email
     */
    public $email;
}
