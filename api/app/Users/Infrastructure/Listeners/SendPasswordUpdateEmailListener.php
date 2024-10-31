<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Listeners;

use App\Users\Domain\Events\PasswordUpdate;
use App\Shared\Application\Services\EmailService;

class SendPasswordUpdateEmailListener
{
    private EmailService $emailService; 

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService; 
    }

    public function handle(PasswordUpdate $event): void
    {
        $user = $event->getUser(); 
        $newPassword = $event->getNewPassword(); 
    
        $data = [
            'name' => $user->getName(), 
            'email' => $user->getEmail(), 
            'newPassword' => $newPassword, 
        ];
    
        $subject = __('messages.password_updated');
        
        if (!is_string($subject)) {
            throw new \InvalidArgumentException('Subject must be a string');
        }
    
        $this->emailService->send(
            'emails.password_update',  
            $data,                    
            $user->getEmail(),     
            $subject,                
            []                   
        );   
    
    }
}
