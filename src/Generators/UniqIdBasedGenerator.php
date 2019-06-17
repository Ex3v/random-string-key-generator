<?php
/**
 * Author: Maciej Szkamruk <maciej.szkamruk@gmail.com>
 * Date: 2019-06-17 13:04
 */

declare(strict_types=1);

namespace Ex3v\RandomStringKeyGenerator\Generators;

use Ex3v\RandomStringKeyGenerator\GeneratorInterface;

final class UniqIdBasedGenerator implements GeneratorInterface
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
        $seed = md5(uniqid('', true), true);
        $base = base64_encode($seed);

        $trimmed = strtr(substr($base, 0, $this->keyLength), '+/', '-_');

        return $trimmed;
    }

}
