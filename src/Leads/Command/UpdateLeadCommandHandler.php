<?php

declare(strict_types=1);

namespace Cal\Leads\Command;

use Cal\Leads\Domain\Lead;
use Cal\Leads\Domain\ValueObject\LeadEmail;
use Cal\Leads\Domain\ValueObject\LeadName;
use Cal\Leads\Domain\ValueObject\LeadUuid;
use Cal\Leads\Repository\LeadRepository;
use Cal\Shared\Domain\Bus\Command\CommandHandler;
use Cal\Shared\Domain\Bus\Event\EventBus;
use Cal\Shared\Domain\ValueObject\Uuid;

final class UpdateLeadCommandHandler implements CommandHandler
{
    private LeadRepository $repository;
    private EventBus $eventBus;

    public function __construct(
        LeadRepository $repository,
        EventBus $eventBus
    ) {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(UpdateLeadCommand $command): Lead
    {

        $lead = $this->repository->find(new LeadUuid($command->id()));

        $lead->update(new LeadName($command->name()), new LeadEmail($command->email()));

        $this->repository->save($lead);

        $this->eventBus->publish(...$lead->pullEvents());

        return $lead;
    }
}
