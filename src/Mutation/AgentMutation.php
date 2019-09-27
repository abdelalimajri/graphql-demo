<?php

namespace App\Mutation;


use App\Entity\Agent;
use App\Form\AgentType;
use App\GraphQL\Input\AgentInput;
use App\Repository\AgentRepository;
use AssoConnect\GraphQLMutationValidatorBundle\Validator\MutationValidator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AgentMutation implements MutationInterface, AliasedInterface
{

    /**
     * @EntityManager
     */
    protected $entityManager;

    /**
     * @var MutationValidator
     */
    protected $validator;

    /**
     * @var AgentRepository
     */
    private $agentRepository;

    /**
     * @var FormFactory
     */
    private $formFactory;

    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface  $formFactory, MutationValidator $validator, AgentRepository $agentRepository)
    {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->validator = $validator;
        $this->agentRepository = $agentRepository;
    }

    /**
     * @param Argument $args
     *
     * @return Agent
     * @throws \AssoConnect\GraphQLMutationValidatorBundle\Exception\UserException
     */
    public function createAgent(Argument $args)
    {
        $input = new AgentInput($args);

        $this->validator->validate($input);

        // Insert your business logic
        $agent = new Agent();
        $form = $this->formFactory->create(AgentType::class, $agent);
        $form->submit($args['input']);

        // Persist in database
        $this->entityManager->persist($agent);
        $this->entityManager->flush();

        // Return
        return $agent;
    }

    /**
     * @return array
     */
    public static function getAliases(): array
    {
        return [
            'createAgent' => 'create_agent',
        ];
    }
}
