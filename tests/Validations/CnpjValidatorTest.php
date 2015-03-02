<?php

namespace Websix\BrValidations\Validations;

class CpnjValidatorTest extends \PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->cnpjValidator = new CnpjValidator();
    }

    public function tearDown()
    {
        unset($this->cnpjValidator);
    }

    public function testValidCnpj()
    {
        $this->assertTrue($this->cnpjValidator->validate('11222333000181'));
        $this->assertTrue($this->cnpjValidator->validate('00776574000660'));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\EmptyArgumentException
     */
    public function testEmptyStringCnpj()
    {
        $this->cnpjValidator->validate('');
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\EmptyArgumentException
     */
    public function testNullCnpj()
    {
        $this->cnpjValidator->validate(null);
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\EmptyArgumentException
     */
    public function testEmptyArrayCnpj()
    {
        $this->cnpjValidator->validate(array());
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\NotStringException
     */
    public function testArrayCnpj()
    {
        $arr = [
            '00.776.574/0006-60',
            0077657400066,
            '0077657400066'
        ];
        $this->cnpjValidator->validate($arr);
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\InvalidLengthException
     */
    public function testMinorLength()
    {
        $this->cnpjValidator->validate('0077657400066');
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\InvalidLengthException
     */
    public function testMajorLength()
    {
        $this->cnpjValidator->validate('007765740006600');
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\NotOnlyDigitsException
     */
    public function testFailWithMask()
    {
        $this->cnpjValidator->validate('00.776.574/0006-60');
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\NotOnlyDigitsException
     */
    public function testNotOnlyDigits()
    {
        $this->cnpjValidator->validate('OO776574OOO66O');
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\NotStringException
     */
    public function testFailIfNumber()
    {
        $this->cnpjValidator->validate(00776574000660);
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\InvalidCnpjException
     */
    public function testInvalidCnpj()
    {
        try {
            $this->cnpjValidator->validate('00000000000000');
            $this->cnpjValidator->validate('11111111111111');
            $this->cnpjValidator->validate('22222222222222');
            $this->cnpjValidator->validate('33333333333333');
            $this->cnpjValidator->validate('44444444444444');
            $this->cnpjValidator->validate('55555555555555');
            $this->cnpjValidator->validate('66666666666666');
            $this->cnpjValidator->validate('77777777777777');
            $this->cnpjValidator->validate('00776574100660');
            $this->cnpjValidator->validate('00776574000661');
        } catch (InvalidCnpjException $e) {
            throw $e;
        }
    }
}