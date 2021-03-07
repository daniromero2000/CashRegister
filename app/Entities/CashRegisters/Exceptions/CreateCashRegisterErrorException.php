<?php

namespace App\Entities\CashRegisters\Exceptions;

/**
 * Class CreateCashRegisterErrorException
 * @package App\Entities\CashRegisters\Exceptions
 */
class CreateCashRegisterErrorException extends \Exception
{
    /**
     * @var
     */
    protected $details;

    /**
     * CreateCashRegisterErrorException constructor.
     * @param $details
     */
    public function __construct($details) {
        $this->details = $details;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'These are the details of the error: ' . $this->details;
    }
}
