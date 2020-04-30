<?php


namespace AnyPayments\v3\interfaces;


interface IHandlerNotification
{
    /**
     * Generating action on handling notification from payment system
     */
    public function accept_notification(): void;
}