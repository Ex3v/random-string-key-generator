<?php
/**
 * Author: hans
 * Date: 2019-06-17 15:28
 */

declare(strict_types=1);

namespace Ex3v\RandomStringKeyGenerator\Tests;

use Ex3v\RandomStringKeyGenerator\GeneratorInterface;

final class DummyGenerator implements GeneratorInterface
{
    private const DEFAULT_KEY_LENGTH = 8;

    /** @var int */
    private $keyLength;

    public function __construct(array $args = [])
    {
        $this->keyLength = $args[GeneratorInterface::KEY_LENGTH] ?? self::DEFAULT_KEY_LENGTH;
    }

    public function generateId(): string
    {
        return 'dummy';
    }

    public function getKeyLength(): int
    {
        return $this->keyLength;
    }

}
