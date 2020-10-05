<?php


namespace WpOop\I18n;


use Dhii\I18n\ContextStringTranslatorInterface;
use Dhii\I18n\Exception\ContextStringTranslationExceptionInterface;
use Dhii\I18n\Exception\FormatTranslationExceptionInterface;
use WpOop\I18n\Exception\FormatTranslationException;

class SprintfFormatTranslator implements \Dhii\I18n\FormatTranslatorInterface
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
     */
    public function translate(string $format, array $params = null, string $context = null): string
    {
        try {
            $translation = $this->translator->translate($format, $context);
        } catch (ContextStringTranslationExceptionInterface $e) {
            throw new FormatTranslationException($e->getMessage(), 0, $e, $context, $format, $params);
        }

        $result = !is_null($params)
            ? vsprintf($translation, $params)
            : $translation;

        return $result;
    }
}
