<?php


namespace AnyPayments\v3\handlers;


use AnyPayments\v3\interfaces\IFromCommandOfNotification;
use AnyPayments\v3\interfaces\IHandlerOfNotification;

/**@property  IFromCommandOfNotification $psp*/
class NotificationOf implements IHandlerOfNotification
{
    private $psp;

    public function __construct(IFromCommandOfNotification $psp) {
        $this->psp = $psp;
    }
}