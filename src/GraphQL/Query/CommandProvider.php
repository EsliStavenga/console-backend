<?php

namespace App\GraphQL\Query;

use App\Entity\Response;
use Overblog\GraphQLBundle\Annotation as GQL;
use App\Entity\Command;

/**
 * Class RootQuery
 * @package App\GraphQL
 * @GQL\Provider
 */
class CommandProvider
{


    /**
     * @GQL\Query(type="[Command]", name="commands")
     */
    public function getAllCommands() {
        return [
            $this->a(),
            $this->a(),
            $this->a(),
            $this->a(),
        ];
    }

    private function a() {
        $c = new Command();
        $c->setName('a');
        $c->setResponse(new Response());

        return $c;
    }
}
