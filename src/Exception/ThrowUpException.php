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
 * A throw-up exception, used for throwing an exception out of the Psy Shell.
 */
class ThrowUpException extends \Exception implements Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct(\Throwable $throwable)
    {
        $message = \sprintf("Throwing %s with message '%s'", \get_class($throwable), $throwable->getMessage());
        parent::__construct($message, $throwable->getCode(), $throwable);
    }

    /**
     * Return a raw (unformatted) version of the error message.
     *
     * @return string
     */
    public function getRawMessage(): string
    {
        return $this->getPrevious()->getMessage();
    }

    /**
     * Create a ThrowUpException from a Throwable.
     *
     * @deprecated psySH no longer wraps Throwables
     *
     * @param \Throwable $throwable
     *
     * @return self
     */
    public static function fromThrowable($throwable): self
    {
        if ($throwable instanceof \Error) {
            $throwable = ErrorException::fromError($throwable);
        }

        if (!$throwable instanceof \Exception) {
            throw new \InvalidArgumentException('throw-up can only throw Exceptions and Errors');
        }

        return new self($throwable);
    }
}
