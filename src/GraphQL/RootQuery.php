<?php

namespace App\GraphQL;
use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * Class RootQuery
 * @package App\GraphQL
 * @GQL\Type
 */
class RootQuery
{

    /**
     * @GQL\Field(name="something", type="String!")
     */
    public function getSomething()
    {
        return "Hello world!";
    }
}
