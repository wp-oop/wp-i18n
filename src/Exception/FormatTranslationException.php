<?php


namespace WpOop\I18n\Exception;

use Dhii\I18n\Exception\FormatTranslationExceptionInterface;
use Throwable;

class FormatTranslationException extends ContextStringTranslationException implements FormatTranslationExceptionInterface
{
    /**
     * @var array|null
     */
    protected $params;

    /**
     * {@inheritDoc}
     *
     * @param array|null $params The parameters for interpolation, if any.
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
    public function getParams()
    {
        $params = $this->params;
        $params = is_array($params)
            ? $params
            : null;

        return $params;
    }
}
