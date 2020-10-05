<?php

namespace WpOop\I18n\Test\Func;

use Dhii\I18n\ContextStringTranslatorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use WpOop\I18n\SprintfFormatTranslator as Subject;
use PHPUnit\Framework\TestCase;
use WpOop\I18n\StringTranslator;
use Brain\Monkey;

class SprintfFormatTranslatorTest extends TestCase
{
    protected function setUp()
    {
        Monkey\setUp();
        parent::setUp();
    }

    protected function tearDown()
    {
        Monkey\tearDown();
        parent::tearDown();
    }

    /**
     * Creates a mock of the test subject.
     *
     * @param ContextStringTranslatorInterface $translator The translator to use.
     *
     * @return Subject&MockObject The new instance.
     */
    protected function createSubject(ContextStringTranslatorInterface $translator)
    {
        $mock = $this->getMockBuilder(Subject::class)
            ->setConstructorArgs([$translator])
            ->enableOriginalConstructor()
            ->enableProxyingToOriginalMethods()
            ->getMock();

        return $mock;
    }

    /**
     * Creates a mock of a context string translator.
     *
     * @param string $textDomain The text domain.
     *
     * @return ContextStringTranslatorInterface&MockObject The new instance.
     */
    protected function createContextTranslator(string $textDomain)
    {
        $mock = $this->getMockBuilder(StringTranslator::class)
            ->setConstructorArgs([$textDomain])
            ->enableOriginalConstructor()
            ->enableProxyingToOriginalMethods()
            ->getMock();

        return $mock;
    }

    public function testTranslate()
    {
        {
            $value1 = uniqid('value1');
            $params = [$value1];

            $stringTemplate = 'string-%1$s-';
            $string = uniqid("$stringTemplate");
            $translation = 'строка-%1$s-';

            $context = uniqid('context');
            $textDomain = uniqid('text-domain');

            $translator = $this->createContextTranslator($textDomain);
            $subject = $this->createSubject($translator);
        }

        {
            Monkey\Functions\expect('_x')
                ->times(1)
                ->with($string, $context, $textDomain)
                ->andReturn($translation);
        }

        {
            $result = $subject->translate($string, $params, $context);
            $this->assertEquals(vsprintf($translation, $params), $result);
        }
    }
}
