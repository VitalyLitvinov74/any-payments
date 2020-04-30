<?php


namespace AnyPayments\v3\interfaces;


interface IRequestData
{
    /**
     * @return array|string|int|float - fields from request as it is
    */
    public function fields();

    /**
     * @return array|string|int|float - headers from request as it is
    */
    public function headers();
}