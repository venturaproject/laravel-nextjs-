<?php

declare(strict_types=1);

namespace App\Shared\Application\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

/**
 * Class EmailService
 * @package App\Shared\Services
 */
class EmailService
{
    /**
     * Send an email using the specified template and data, with optional attachments.
     *
     * @param string $template The email template to use.
     * @param array<string, mixed> $data The data to pass to the template.
     * @param string $recipient The email address of the recipient.
     * @param string $subject The subject of the email.
     * @param array<string> $attachments Paths to files to attach to the email.
     * @return void
     */
    public function send(string $template, array $data, string $recipient, string $subject, array $attachments = []): void
    {
        Mail::send($template, $data, function (Message $message) use ($recipient, $subject, $attachments) {
            $message->to($recipient)
                    ->subject($subject);

            foreach ($attachments as $filePath) {
                $message->attach($filePath);
            }
        });
    }
}
