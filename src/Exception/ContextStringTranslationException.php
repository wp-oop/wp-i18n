<?php

declare(strict_types=1);

namespace WpOop\I18n\Exception;

use Dhii\I18n\Exception\ContextStringTranslationExceptionInterface;
use RuntimeException;
use Throwable;

class ContextStringTranslationException extends RuntimeException implements ContextStringTranslationExceptionInterface
{
    /**
     * @var string|null
     */
    protected $context;
    /**
     * @var string|null
     */
    protected $subject;

    /**
     * @param string|null $context The context of translation, if any.
     * @param string $subject The subject being translated.
     */
    public function __construct(
        $message = "",
        $code = 0,
        Throwable $previous = null,
        string $context = null,
        string $subject = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->context = $context;
        $this->subject = $subject;
    }

    /**
     * {@inheritDoc}
     */
    public function getSubject(): string
    {
        $subject = is_string($this->subject)
            ? $this->subject
            : '[unknown]';

        return $subject;
    }

    /**
     * {@inheritDoc}
     */
    public function getContext()
    {
        return $this->context;
    }
}
