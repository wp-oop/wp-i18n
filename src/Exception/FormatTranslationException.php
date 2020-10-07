<?php

declare(strict_types=1);

namespace WpOop\I18n\Exception;

use Dhii\I18n\Exception\FormatTranslationExceptionInterface;
use Throwable;

class FormatTranslationException extends ContextStringTranslationException implements FormatTranslationExceptionInterface
{
    /**
     * A map of parameter position to value.
     *
     * @var mixed[]|null
     */
    protected $params;

    /**
     * {@inheritDoc}
     *
     * @param array|null $params The parameters for interpolation, if any.
     * @psalm-param array<positive-int, scalar>|null $params
     */
    public function __construct(
        $message = "",
        $code = 0,
        Throwable $previous = null,
        string $context = null,
        string $subject = null,
        $params = null
    ) {
        parent::__construct($message, $code, $previous, $context, $subject);
        $this->params = $params;
    }

    /**
     * {@inheritDoc}
     */
    public function getParams(): ?array
    {
        $params = $this->params;
        $params = is_array($params)
            ? $params
            : null;

        return $params;
    }
}
