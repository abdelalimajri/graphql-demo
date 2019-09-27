<?php

namespace App\Type;

use GraphQL\Language\AST\Node;

class DateType
{
    /**
     * @param \DateTimeInterface $value
     *
     * @return string
     */
    public static function serialize(\DateTimeInterface $value)
    {
        return $value->format('Y-m-d');
    }

    /**
     * @param $value
     *
     * @return \DateTimeImmutable
     * @throws \Exception
     */
    public static function parseValue($value)
    {
        return new \DateTimeImmutable($value);
    }

    /**
     * @param Node $valueNode
     *
     * @return \DateTimeImmutable
     * @throws \Exception
     */
    public static function parseLiteral(Node $valueNode)
    {
        return new \DateTimeImmutable($valueNode->value);
    }
}
