<?php

namespace App\Mutation;


use App\Entity\Agent;
use App\Form\AgentType;
use App\GraphQL\Input\AgentInput;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\UserError;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class AgentMutation implements MutationInterface, AliasedInterface
{

    /**
     * @EntityManager
     */
    protected $entityManager;
    /**
     * @ValidatorInterface
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

    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface  $formFactory, ValidatorInterface $validator, AgentRepository $agentRepository)
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
     */
    public function createAgent(Argument $args)
    {
        // Insert your business logic
        $agent = new Agent();

        $form = $this->formFactory->create(AgentType::class, $agent);
        $form->submit($args['input']);

        if(!$form->isValid()) {
            throw new UserError("form error");
        }

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
