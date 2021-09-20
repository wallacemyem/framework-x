<?php

namespace Framework\Tests;

use PHPUnit\Framework\TestCase;
use FrameworkX\HtmlHandler;

class HtmlHandlerTest extends TestCase
{
    /**
     * @dataProvider provideNames
     * @param string $in
     * @param string $expected
     */
    public function testEscapeHtml(string $in, string $expected)
    {
        $html = new HtmlHandler();

        $this->assertEquals($expected, $html->escape($in));
    }

    public function provideNames()
    {
        return [
            [
                'hello/',
                'hello/'
            ],
            [
                'hellö.txt',
                'hellö.txt'
            ],
            [
                'hello world',
                'hello world'
            ],
            [
                'hello    world',
                'hello &nbsp; &nbsp;world'
            ],
            [
                ' hello world ',
                '&nbsp;hello world&nbsp;'
            ],
            [
                "hello\nworld",
                'hello\nworld'
            ],
            [
                "hello\tworld",
                'hello\tworld'
            ],
            [
                "hello\\nworld",
                'hello\\\\nworld'
            ],
            [
                'h<e>llo',
                'h&lt;e&gt;llo'
            ],
            [
                utf8_decode('hellö.txt'),
                'hell�.txt'
            ],
            [
                "bin\00ary",
                'bin�ary'
            ]
        ];
    }
}