<?php
/**
 * Author: hans
 * Date: 2019-06-17 15:37
 */

declare(strict_types=1);

namespace Ex3v\RandomStringKeyGenerator\Tests\Generators;

use Ex3v\RandomStringKeyGenerator\GeneratorInterface;
use Ex3v\RandomStringKeyGenerator\Generators\UniqIdBasedGenerator;
use PHPUnit\Framework\TestCase;

final class UniqIdBasedGeneratorTest extends TestCase
{


    public function testGeneratorReturnsValue()
    {
        $generator = new UniqIdBasedGenerator();

        $id = $generator->generateId();

        $this->assertNotEmpty($id);
        $this->assertRegExp('/^[a-zA-Z0-9_\-]{8}$/', $id);
    }

    public function testGeneratorWillReturnValueOfCustomLength()
    {
        $generator = new UniqIdBasedGenerator([
            GeneratorInterface::KEY_LENGTH => 12,
        ]);

        $id = $generator->generateId();

        $this->assertNotEmpty($id);
        $this->assertRegExp('/^[a-zA-Z0-9_\-]{12}$/', $id);
    }

}
