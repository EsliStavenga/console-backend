<?php

namespace App\GraphQL;
use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * Class RootQuery
 * @package App\GraphQL
 * @GQL\Type
 */
class RootMutation
{

    /**
     * @GQL\Mutation(name="test", type="Boolean!")
     */
    function test() {
        return false;
    }
}
