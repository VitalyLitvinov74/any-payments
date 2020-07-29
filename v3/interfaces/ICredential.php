<?php


namespace AnyPayments\v3\interfaces;


interface ICredential
{
    public function valueOf(string $name_secret): string;

    public function values(): array;
}