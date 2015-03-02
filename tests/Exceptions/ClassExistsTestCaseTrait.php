<?php

namespace Websix\BrValidations\Exceptions;

trait ClassExistsTestCaseTrait {

    public function testClassExists()
    {
        $this->assertTrue(class_exists(__NAMESPACE__ . '\\' . str_replace('Test','', __CLASS__)));
    }

}
