<?php
/**
 * Author: hans
 * Date: 2019-06-17 13:36
 */

declare(strict_types=1);

namespace Ex3v\RandomStringKeyGenerator\Tests;

use Ex3v\RandomStringKeyGenerator\Exception\GeneratorFactoryException;
use Ex3v\RandomStringKeyGenerator\GeneratorFactory;
use Ex3v\RandomStringKeyGenerator\GeneratorInterface;
use PHPUnit\Framework\TestCase;

final class GeneratorFactoryTest extends TestCase
{


    public function testFactoryReturnsGeneratorWithoutAnyParametersGiven()
    {
        $factory = new GeneratorFactory();

        $generator = $factory->getGenerator();

        $this->assertInstanceOf(GeneratorInterface::class, $generator);
    }

    public function testFactoryReturnsCustomGeneratorFromParameter()
    {
        $factory = new GeneratorFactory();

        $dummy = new DummyGenerator();
        $generator = $factory->getGenerator(DummyGenerator::class);

        $this->assertInstanceOf(DummyGenerator::class, $generator);
    }

    public function testGeneratorParamsArePassedCorrectly()
    {
        $factory = new GeneratorFactory();

        /** @var DummyGenerator $generator */
        $generator = $factory->getGenerator(DummyGenerator::class, [GeneratorInterface::KEY_LENGTH => 12]);

        $this->assertInstanceOf(DummyGenerator::class, $generator);
        $this->assertEquals(12, $generator->getKeyLength());
    }

    public function testGeneratorDefaultsCanBeChanged()
    {
        $factory = new GeneratorFactory();
        $factory::setDefaultStrategy(DummyGenerator::class, [GeneratorInterface::KEY_LENGTH => 12]);

        /** @var DummyGenerator $generator */
        $generator = $factory->getGenerator();

        $this->assertInstanceOf(DummyGenerator::class, $generator);
        $this->assertEquals(12, $generator->getKeyLength());
    }

    public function testGeneratorWillThrowExceptionWhenNotAGeneratorClassIsPassed()
    {
        $this->expectException(GeneratorFactoryException::class);

        $factory = new GeneratorFactory();
        /** @var DummyGenerator $generator */
        $factory->getGenerator(NotAGenerator::class);
    }
}
