<?php

namespace App\Resolver;


use App\Entity\Agent;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Symfony\Component\Security\Core\Security;

class AgentResolver implements ResolverInterface, AliasedInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $agentRepository;

    /**
     * @var Security
     */
    private $security;

    /**
     * AgentResolver constructor.
     *
     * @param AgentRepository $agentRepository
     * @param Security        $security
     */
    public function __construct(AgentRepository $agentRepository, Security $security)
    {
        $this->agentRepository = $agentRepository;
        $this->security = $security;
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
