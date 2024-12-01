<?php

declare(strict_types=1);

namespace MoonShine\Ace\Fields;

use Closure;
use MoonShine\AssetManager\Css;
use MoonShine\AssetManager\Js;
use MoonShine\UI\Fields\Textarea;

class Code extends Textarea
{
    protected string $view = 'moonshine-ace::fields.code';

    protected array $options = [];
    protected ?string $language;
    protected array $themes;

    protected array $reservedOptions = [
        'mode',
        'theme',
        'readOnly',
    ];

    public function __construct(string|Closure|null $label = null, ?string $column = null, ?Closure $formatted = null)
    {
        $this->language = config('moonshine_ace.language');
        $this->themes = [
            'light' => config('moonshine_ace.themes.light'),
            'dark' => config('moonshine_ace.themes.dark'),
        ];

        parent::__construct($label, $column, $formatted);
    }

    protected function assets(): array
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

    protected function getOptions(): array
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

    public function themes(string $light = null, string $dark = null): static
    {
        if (isset($light)) {
            $this->themes['light'] = $light;
        }

        if (isset($dark)) {
            $this->themes['dark'] = $dark;
        }

        return $this;
    }

    public function getConfig(): array
    {
        return [
            'language' => $this->language,
            'themes' => $this->themes,
            'options' => $this->getOptions(),
        ];
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
            'config' => json_encode($this->getConfig()),
        ];
    }
}
