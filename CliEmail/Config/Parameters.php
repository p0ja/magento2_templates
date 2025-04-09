<?php

declare(strict_types=1);

namespace M2\CliEmail\Config;

class Parameters
{
    public const EMAIL_SERVICE_ENABLE = 'email_section/sendmail/enabled';
    public const EMAIL_TEMPLATE = 'email_section/sendmail/email_template';
    public const EMAIL_SENDER = 'email_section/sendmail/sender';
    public const EMAIL_RECEIVER = 'receiver@example.com';
    public const EMAIL_RECEIVERS_BCC = [
        'receiver2@example.com',
        'receiver3@example.com'
    ];

    public const CUSTOM_MESSAGE_1 = 'Custom message 1';
    public const CUSTOM_MESSAGE_2 = 'Custom message 2';
}
