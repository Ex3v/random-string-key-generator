<?php
/**
 * Author: Maciej Szkamruk <maciej.szkamruk@gmail.com>
 * Date: 2019-06-17 13:28
 */

declare(strict_types=1);

namespace Ex3v\RandomStringKeyGenerator\Exception;


use Ex3v\RandomStringKeyGenerator\GeneratorInterface;

final class GeneratorFactoryException extends RandomStringKeyGeneratorException
{

    public static function fromClassThatDoesNotImplementGeneratorInterface(string $class)
    {
        $msg = sprintf(
            'Provided class %s is not a valid class or it does not implement %s interface',
            $class,
            GeneratorInterface::class
        );

        return new static($msg);
    }

}
