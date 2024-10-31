<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Listeners;

use App\Products\Domain\Events\ProductCreated;
use App\Shared\Application\Services\EmailService;

class SendProductCreatedEmailListener
{
    private EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function handle(ProductCreated $event): void
    {
        $product = $event->getProduct();
        $data = [
            'name' => $product->getName(),
        ];

        $subject = __('messages.product_created_subject');
        
        if (!is_string($subject)) {
            throw new \InvalidArgumentException('Subject must be a string');
        }

        $this->emailService->send(
            'emails.product_created', 
            $data,                   
            'recipient@example.com', 
            sprintf('%s:%s', $subject, $data['name']), 
            []
        );
    }
}
