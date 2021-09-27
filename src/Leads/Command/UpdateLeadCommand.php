<?php
declare(strict_types=1);

namespace Cal\Leads\Command;

use Cal\Shared\Domain\Bus\Command\Command;

class UpdateLeadCommand implements Command
{
    private string $id;
    private ?string $name;
    private string $email;

    public function __construct(String $id, ?string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }
}
