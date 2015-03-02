<?php

namespace Websix\BrValidations\Validations;

use Websix\BrValidations\Exceptions;

class CnpjValidator {

    public function validate($cnpj) {
        $this->assertNotEmpty($cnpj);
        $this->assertOnlyDigits($cnpj);
        $this->assertLength($cnpj, 14);


        $len = strlen($cnpj) - 2;
        $num = substr($cnpj, 0, $len);
        $dig = substr($cnpj, $len);
    }

    private function assertNotEmpty($cnpj)
    {
        if(empty($cnpj))
            throw new Exceptions\EmptyArgumentException('Empty CNPJ');
        else
            return true;
    }

    private function assertLength($cnpj, $length)
    {
        if(strlen($cnpj) !== $length)
            throw new Exceptions\InvalidLengthException(sprintf('Length different from %d', $length));
        else
            return true;
    }

    private function assertOnlyDigits($cnpj)
    {
        if(!preg_match('/^\d+$/', $cnpj))
            throw new Exceptions\NotOnlyDigitsException('Must be only digits');
        else
            return true;
    }

}