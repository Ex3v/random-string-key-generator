<?php
/**
 * Author: Maciej Szkamruk <maciej.szkamruk@gmail.com>
 * Date: 2019-06-17 13:18
 */

declare(strict_types=1);

namespace Ex3v\RandomStringKeyGenerator;

use Ex3v\RandomStringKeyGenerator\Exception\GeneratorFactoryException;
use Ex3v\RandomStringKeyGenerator\Generators\UniqIdBasedGenerator;

final class GeneratorFactory
{

    private static $defaultStrategy = UniqIdBasedGenerator::class;

    private static $defaultOptions = [
        GeneratorInterface::KEY_LENGTH => 8,
    ];
    public function getGenerator(?string $generatorClass = null, ?array $options = null): GeneratorInterface
    {
        $class   = $generatorClass ?? self::$defaultStrategy;
        $options = $options ?? self::$defaultOptions ?? [];

        self::isClassAGenerator($class);

        return new $class($options);
    }

    public static function setDefaultStrategy(string $generatorClass, array $options = [])
    {
        self::isClassAGenerator($generatorClass);

        self::$defaultStrategy = $generatorClass;

        self::$defaultOptions = $options;
    }


    private static function isClassAGenerator(string $generatorClass): void
    {
        if (false === is_a($generatorClass, GeneratorInterface::class, true))
        {
            throw  GeneratorFactoryException::fromClassThatDoesNotImplementGeneratorInterface($generatorClass);
        }
    }

}
