<?php


namespace WpOop\I18n;


use Dhii\I18n\ContextStringTranslatorInterface;
use Dhii\I18n\StringTranslatorInterface;

class StringTranslator implements ContextStringTranslatorInterface
{
    /**
     * @var string
     */
    protected $textDomain;

    /**
     * @param string $textDomain The text domain of the translator.
     */
    public function __construct(string $textDomain)
    {
        $this->textDomain = $textDomain;
    }

    /**
     * @inheritDoc
     */
    public function translate(string $subject, string $context = null): string
    {
        $textDomain = $this->textDomain;

        /* @psalm-suppress UndefinedFunction */
        $result = is_null($context)
            ? __($subject, $textDomain)
            : _x($subject, $context, $textDomain);

        return $result;
    }
}
