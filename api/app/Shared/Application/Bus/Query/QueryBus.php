<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus\Query;

use Exception;

class QueryBus implements QueryBusInterface 
{
    /**
     * @var array<string, callable>
     */
    private array $handlers = []; 

    public function registerHandler(string $queryClass, callable $handler): void
    {
        $this->handlers[$queryClass] = $handler; 
    }

    // Method to handle a query
    public function handle(object $query): mixed
    {
              
        $queryClass = get_class($query); 

        if (!isset($this->handlers[$queryClass])) {
            throw new Exception("No handler registered for query: {$queryClass}");
        }

        return ($this->handlers[$queryClass])($query); 
    }
}

