<?php

namespace MoonShine\Ace\Tests\Unit;

use MoonShine\Ace\Fields\Code;
use MoonShine\Ace\Tests\TestCase;
use MoonShine\UI\Fields\Textarea;

class CodeFieldTest extends TestCase
{
    private Code $field;

    protected function setUp(): void {
        parent::setUp();

        $this->field = Code::make('code');
    }

    public function testThatTextareaIsParent(): void
    {
        $this->assertInstanceOf(Textarea::class, $this->field);
    }
}
