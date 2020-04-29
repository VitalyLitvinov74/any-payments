<?php
namespace AnyPayments\v2;

use AnyPayments\v2\interfaces\IHandler;
use AnyPayments\v2\psp\PaymentStrategy;

/**
 * @property string $payment_system_name;
 * @property array $config
 * @property PaymentStrategy $strategy;
*/
class EasyPaymentSystem implements IHandler
{
    private $payment_system_name;
    private $config;
    private $strategy;

    public function __construct(string $payment_system_name, array $config = []) {
       $this->payment_system_name = $payment_system_name;
       $this->config = $config;
       $this->strategy = new PaymentStrategy($payment_system_name);
    }

    private function default_config(): array{
        return [
            'notification_url'=>'index.php',
        ];
    }

    private function payment_system(){
        $config = $this->config;
        if (!isset($config['notification_url'])){
            $config['notification_url'] = $this->default_config()['notification_url'];
        }
        $class_name = $this->strategy->payment_system();
        return new PaymentSystem(new $class_name($config));
    }

    public function pay(): void
    {
        $this->payment_system()->pay();
    }

    public function accept_notification(): void
    {
        $this->payment_system()->accept_notification();
    }

    public function fields()
    {
        return $this->payment_system()->fields();
    }

    public function headers()
    {
        $this->payment_system()->headers();
    }
}