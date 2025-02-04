<?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2023 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\Exception;

/**
 * A "parse error" Exception for Psy.
 */
class ParseErrorException extends \PhpParser\Error implements Exception
{
    /**
     * Constructor!
     *
     * @param string $message (default: "")
     * @param int    $line    (default: -1)
     */
    public function __construct(string $message = '', int $line = -1)
    {
        $message = \sprintf('PHP Parse error: %s', $message);
        parent::__construct($message, $line);
    }

    /**
     * Create a ParseErrorException from a PhpParser Error.
     *
     * @param \PhpParser\Error $e
     *
     * @return self
     */
    public static function fromParseError(\PhpParser\Error $e): self
    {
        return new self($e->getRawMessage(), $e->getStartLine());
    }
}
