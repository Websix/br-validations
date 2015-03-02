<?php

namespace Websix\BrValidations\Validations;

use Websix\BrValidations\Exceptions;

class CnpjValidator {

    const CNPJ_REQUIRED_LENGTH = 14;

    const MULTIPLY_MATRIX = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    private $multiMatrix;

    private $resMatrix;

    public function validate($cnpj) {
        $this->validateInput($cnpj);

        $this->clean();

        $len = strlen($cnpj) - 2;
        $num = str_split(substr($cnpj, 0, $len));
        $dig = substr($cnpj, $len);

        $ver1 = $this->calculateDigit($num);

        array_unshift($this->multiMatrix, $this->multiMatrix[0] + 1);
        array_push($num, $ver1);

        $ver2 = $this->calculateDigit($num);

        var_dump($ver1.$ver2, $dig);

        if(($ver1 . $ver2) === $dig)
            return true;

        throw new Exceptions\InvalidCnpjException('Cnpj matematically invalid');

    }

    private function clean()
    {
        $this->multiMatrix = self::MULTIPLY_MATRIX;
        $this->resMatrix = [];
    }

    protected function validateInput($cnpj)
    {
        $this->assertNotEmpty($cnpj);
        $this->assertString($cnpj);
        $this->assertOnlyDigits($cnpj);
        $this->assertLength($cnpj, self::CNPJ_REQUIRED_LENGTH);
    }

    private function calculateDigit(array $num) {
        $this->resMatrix = [];

        for ($i = 0; $i < count($this->multiMatrix); $i++) {
            $this->resMatrix[] = $this->multiMatrix[$i] * @$num[$i];
        }

        $ver = array_sum($this->resMatrix) % 11;
        $ver = $ver <= 2 ? 0 : 11 - $ver;

        return $ver;
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

    private function assertString($cnpj)
    {
        if(!is_string($cnpj))
            throw new Exceptions\NotStringException('Must be a string');
        else
            return true;
    }

}