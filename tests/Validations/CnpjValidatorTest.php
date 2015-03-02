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
    public function testEmptyCnpj()
    {
        $this->assertTrue($this->cnpjValidator->validate(''));
    }

    /**
     * @expectedException \Websix\BrValidations\Exceptions\InvalidLengthException
     */
    public function testMinorLength()
    {
        $this->assertTrue($this->cnpjValidator->validate('0077657400066'));
    }

}