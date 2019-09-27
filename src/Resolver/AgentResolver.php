<?php

namespace App\Resolver;


use App\Entity\Agent;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class AgentResolver implements ResolverInterface, AliasedInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $agentRepository;

    /**
     * AgentResolver constructor.
     *
     * @param AgentRepository $agentRepository
     */
    public function __construct(AgentRepository $agentRepository)
    {
        $this->agentRepository = $agentRepository;
    }

    /**
     * @return Agent[]
     */
    public function getAgents() {
        return $this->agentRepository->findAll();
    }

    /**
     * Returns methods aliases.
     *
     * For instance:
     * array('myMethod' => 'myAlias')
     *
     * @return array
     */
    public static function getAliases(): array
    {
        return [
            'getAgents' => 'get_agents',
        ];
    }
}
