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
        $this->assertTrue($this->cnpjValidator->validate('00776574000660'));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\EmptyArgumentException
     */
    public function testEmptyStringCnpj()
    {
        $this->assertTrue($this->cnpjValidator->validate(''));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\EmptyArgumentException
     */
    public function testNullCnpj()
    {
        $this->assertTrue($this->cnpjValidator->validate(null));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\EmptyArgumentException
     */
    public function testEmptyArrayCnpj()
    {
        $this->assertTrue($this->cnpjValidator->validate(array()));
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
        $this->assertTrue($this->cnpjValidator->validate($arr));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\InvalidLengthException
     */
    public function testMinorLength()
    {
        $this->assertTrue($this->cnpjValidator->validate('0077657400066'));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\InvalidLengthException
     */
    public function testMajorLength()
    {
        $this->assertTrue($this->cnpjValidator->validate('007765740006600'));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\NotOnlyDigitsException
     */
    public function testFailWithMask()
    {
        $this->assertTrue($this->cnpjValidator->validate('00.776.574/0006-60'));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\NotOnlyDigitsException
     */
    public function testNotOnlyDigits()
    {
        $this->assertTrue($this->cnpjValidator->validate('OO776574OOO66O'));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\NotStringException
     */
    public function testFailIfNumber()
    {
        $this->assertTrue($this->cnpjValidator->validate(00776574000660));
    }



}