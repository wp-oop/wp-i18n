<?php

namespace Dhii\I18n\FuncTest;

use Dhii\Wp\I18n\FormatTranslator as TestSubject;
use Dhii\Util\String\StringableInterface as Stringable;
use Dhii\Data\ValueAwareInterface as Value;
use PHPUnit\Framework\TestCase;

/**
 * Tests {@see Dhii\I18n\FormatTranslator}.
 *
 * @since [*next-version*]
 */
class FormatTranslatorTest extends TestCase
{
    /**
     * The class name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Wp\\I18n\\FormatTranslator';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return TestSubject
     */
    public function createInstance($textDomain = null)
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
                ->new($textDomain);

        return $mock;
    }

    /**
     * Create a new stringable object.
     *
     * @since [*next-version*]
     *
     * @param string $string The string that the object should represent.
     *
     * @return Stringable The stringable instance.
     */
    public function createStringable($string)
    {
        $mock = $this->mock('Dhii\\Util\\String\\StringableInterface')
                ->__toString(function () use ($string) {
                    return $string;
                })
                ->new();

        return $mock;
    }

    /**
     * Create a new value-aware object.
     *
     * @since [*next-version*]
     *
     * @param mixed $value The value that the object should represent.
     *
     * @return Value The value-aware instance.
     */
    public function createValue($value)
    {
        $mock = $this->mock('Dhii\\Data\\ValueAwareInterface')
                ->getValue(function () use ($value) {
                    return $value;
                })
                ->new();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject, 'Could not create a valid instance');
        $this->assertInstanceOf('Dhii\\I18n\\FormatTranslatorInterface', $subject, 'Test subject does not implement required interface');
        $this->assertInstanceOf('Dhii\\I18n\\TranslatorInterface', $subject, 'Test subject does not implement required interface');
        $this->assertInstanceOf('Dhii\\Wp\\I18n\\FormatTranslatorInterface', $subject, 'Test subject does not implement required interface');
        $this->assertInstanceOf('Dhii\\Wp\\I18n\\TextDomainAwareInterface', $subject, 'Test subject does not implement required interface');
    }

    /**
     * Tests that a simple string translation works properly.
     *
     * @since [*next-version*]
     */
    public function testGetTextDomain()
    {
        $domain = uniqid('domain-');
        $subject = $this->createInstance($domain);
        $string = uniqid('string-');

        \WP_Mock::userFunction('__')
                ->once()
                ->withArgs(array(
                    $string,
                    $domain,
                ));
        $result = $subject->translate($string);
    }

    /**
     * Tests that a simple string translation works properly.
     *
     * @since [*next-version*]
     */
    public function testTranslatePlainNoContext()
    {
        $domain = uniqid('domain-');
        $subject = $this->createInstance($domain);
        $string = uniqid('string-');

        \WP_Mock::userFunction('__')
                ->once()
                ->withArgs(array(
                    $string,
                    $domain,
                ));
        $result = $subject->translate($string);
    }

    /**
     * Tests that a format string translation works properly.
     *
     * @since [*next-version*]
     */
    public function testTranslateFormatNoContext()
    {
        $domain = uniqid('domain-');
        $subject = $this->createInstance($domain);
        $stringId = uniqid();
        $format = 'hello-%1$s-'.$stringId;
        $param = uniqid('param-');

        \WP_Mock::userFunction('__')
                ->once()
                ->withArgs(array(
                    $format,
                    $domain,
                ))
                ->andReturnUsing(function ($string) {
                    return $string;
                });
        $result = $subject->translate($format, array($param));

        $this->assertContains($param, $result, 'Parameters were not interpolated correctly into the translation result');
    }

    /**
     * Tests that a simple string translation works properly when using context.
     *
     * @since [*next-version*]
     */
    public function testTranslatePlainWithContext()
    {
        $domain = uniqid('domain-');
        $subject = $this->createInstance($domain);
        $string = uniqid('string-');
        $context = uniqid('context-');

        \WP_Mock::userFunction('_x')
                ->once()
                ->withArgs(array(
                    $string,
                    $context,
                    $domain,
                ));
        $result = $subject->translate($string, array(), $context);
    }

    /**
     * Tests that a format string translation works properly when using context.
     *
     * @since [*next-version*]
     */
    public function testTranslateFormatWithContext()
    {
        $domain = uniqid('domain-');
        $subject = $this->createInstance($domain);
        $stringId = uniqid();
        $format = 'hello-%1$s-'.$stringId;
        $param = uniqid('param-');
        $context = uniqid('context-');

        \WP_Mock::userFunction('_x')
                ->once()
                ->withArgs(array(
                    $format,
                    $context,
                    $domain,
                ))
                ->andReturnUsing(function ($string) {
                    return $string;
                });
        $result = $subject->translate($format, array($param), $context);

        $this->assertContains($param, $result, 'Parameters were not interpolated correctly into the translation result');
    }

    /**
     * Tests that a format string translation works properly when using context, while supplying OOP values.
     *
     * @since [*next-version*]
     */
    public function testTranslateFormatWithContextOop()
    {
        $domain = uniqid('domain-');
        $subject = $this->createInstance($this->createValue($domain));
        $stringId = uniqid();
        $format = 'hello-%1$s-'.$stringId;
        $param = uniqid('param-');
        $context = uniqid('context-');

        \WP_Mock::userFunction('_x')
                ->once()
                ->withArgs(array(
                    $format,
                    $context,
                    $domain,
                ))
                ->andReturnUsing(function ($string) {
                    return $string;
                });
        $result = $subject->translate($this->createStringable($format), array($param), $this->createValue($context));

        $this->assertContains($param, $result, 'Parameters were not interpolated correctly into the translation result');
    }
}
