BrValidations
==============

Common validations for Brazillian numbers, such as CPF, CNPJ and others

[![Build Status](https://travis-ci.org/Websix/br-validations.svg)](https://travis-ci.org/Websix/br-validations)

Validators
----------

#### CnpjValidator

Validates a CNPJ number against his validation digits
  
  Usage:
  
  ```php
  /**
   * Somewere calling an autoloader and opening php
   */
  use Websix\BrValidations\Validators\CnpjValidator,
      Websix\BrValidations\Exceptions;
  
  // ...
  
  $validator = new CnpjValidator();
  
  try {
    $isValid = $validator->validate($aCnpj);
  } catch (\InvalidArgumentException $e) {
    // Has exceptions that can tell you what failed
    switch (true) {
      case $e instanceof Exceptions\InvalidCnpjException:
        // Is really a invalid CNPJ
        // ...
      case $e instanceof Exceptions\EmptyArgumentException;
        // If the CNPJ is an empty string or something like that
        // ...
      case $e instanceof Exceptions\InvalidLengthException
        // If the CNPJ do not have his correct length
        // ...
      case $e instanceof Exceptions\NotOnlyDigitsException;
        // If the passed CNPJ has something other than digits in the string
        // ...
      case $e instanceof Exceptions\NotStringException;
        // if the passed CNPJ not is a string
        // ...
    }
  }
  ```

Numbers planned to be added
+ CPF
+ State Inscription Number (Inscrição estadual)
+ OAB
+ CRM
+ CREA
+ PIS/PASEP
+ Passports

Usage
-----

Shortly it will be on composer so then you will be able to install from there

License
-------

MIT License
