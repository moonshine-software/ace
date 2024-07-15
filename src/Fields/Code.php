<?php

declare(strict_types=1);

namespace MoonShine\Ace\Fields;

use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Fields\Textarea;

class Code extends Textarea
{
    protected string $view = 'moonshine-ace::fields.code';

    protected array $options = [];
    protected ?string $language = null;

    protected array $reservedOptions = [
        'mode',
        'theme',
        'readOnly',
    ];

    public function getAssets(): array
    {
        return [
            Css::make('vendor/moonshine-ace/ace.css'),
            Js::make('vendor/moonshine-ace/assets/ace.js'),
            Js::make('vendor/moonshine-ace/init.js'),
        ];
    }

    public function addOption(string $name, string|int|float|bool $value): self
    {
        if (in_array($name, $this->reservedOptions)) {
            return $this;
        }

        $this->options[$name] = $value;

        return $this;
    }

    public function getOptions(): array
    {
        return array_merge(
            config('moonshine_ace.options', []),
            $this->options,
            ['readOnly' => $this->getAttribute('readonly', false) || $this->getAttribute('disabled', false) ]
        );
    }

    public function language(string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language ?? config('moonshine_ace.language');
    }

    protected function resolvePreview(): string
    {
        if ($this->isRawMode()) {
            return $this->toRawValue();
        }

        return (string)str(parent::resolvePreview())
            ->before('<pre>')
            ->after('</pre>')
            ->stripTags();
    }

    protected function viewData(): array
    {
        return [
            'options' => json_encode($this->getOptions()),
            'language' => $this->getLanguage()
        ];
    }
}
