<?php


namespace AnyPayments\v3\handlers;


use AnyPayments\v3\interfaces\IFromCommandOfNotification;
use AnyPayments\v3\interfaces\IHandlerOfNotification;

/**@property  IFromCommandOfNotification $psp
 * @property array $db_connection
 */
class NotificationOf implements IHandlerOfNotification
{
    private $psp;
    private $db_connection;

    public function __construct(IFromCommandOfNotification $psp, array $db_connection)
    {
        $this->psp = $psp;
    }
}