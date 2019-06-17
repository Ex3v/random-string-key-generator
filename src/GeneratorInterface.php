<?php
/**
 * Author: Maciej Szkamruk <maciej.szkamruk@gmail.com>
 * Date: 2019-06-17 13:10
 */

declare(strict_types=1);

namespace Ex3v\RandomStringKeyGenerator;

interface GeneratorInterface
{
    public const KEY_LENGTH = 'key_length';

    public function generateId(): string;

}
