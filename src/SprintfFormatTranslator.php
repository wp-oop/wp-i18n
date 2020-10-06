<?php

declare(strict_types=1);

namespace WpOop\I18n;

use Dhii\I18n\ContextStringTranslatorInterface;
use Dhii\I18n\Exception\ContextStringTranslationExceptionInterface;
use Dhii\I18n\FormatTranslatorInterface;
use WpOop\I18n\Exception\FormatTranslationException;

class SprintfFormatTranslator implements FormatTranslatorInterface
{
    /**
     * @var ContextStringTranslatorInterface
     */
    protected $translator;

    /**
     * @param ContextStringTranslatorInterface $translator The translator that actually does the translation.
     */
    public function __construct(ContextStringTranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @inheritDoc
     *
     * @psalm-suppress ParamNameMismatch
     */
    public function translate(string $subject, ?array $params = null, ?string $context = null): string
    {
        try {
            $translation = $this->translator->translate($subject, $context);
        } catch (ContextStringTranslationExceptionInterface $e) {
            throw new FormatTranslationException($e->getMessage(), 0, $e, $context, $subject, $params);
        }

        $result = !is_null($params)
            ? vsprintf($translation, $params)
            : $translation;

        return $result;
    }
}
