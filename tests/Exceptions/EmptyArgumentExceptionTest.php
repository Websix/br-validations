<?php

namespace Websix\BrValidations\Exceptions;

class EmptyArgumentExceptionTest extends \PHPUnit_Framework_TestCase {

    public function testClassExists()
    {
        $this->assertTrue(class_exists('EmptyArgumentException'));
    }

}