<?php

namespace App\Controller\Leads;

use Cal\Leads\Command\UpdateLeadCommand;
use Cal\Leads\Domain\Exception\NonExistLeadException;
use Cal\Shared\Domain\Bus\Command\CommandBus;
use Cal\Shared\Infrastructure\Http\ErrorResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeadsPutController
{
    private CommandBus $commandBus;
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke($id, Request $request): Response
    {
        $name = $request->get('name');
        $email = $request->get('email');

        try {
            $this->commandBus->dispatch(new UpdateLeadCommand($id, $name, $email));

            return new Response(null, Response::HTTP_CREATED);
        } catch (NonExistLeadException $e) {
            return new ErrorResponse($e, Response::HTTP_BAD_REQUEST);
        }
    }
}