<?php

namespace App\Actions;

use Illuminate\Support\Str;

class ReadmeConversion
{
    public function handle(string $text = ''): string
    {
        $text = html_entity_decode(Str::markdown($text));

        $text = preg_replace('/("https:\/\/github.com\/.+?\.(?:jpe?g|png|gif))/', '${1}?raw=true', $text);

        $text = preg_replace_callback(
            '/<pre><code(\s*class="language-(.*?)"|(.*?))>(.*?)<\/code><\/pre>/ius',
            function ($matches) {
                $language =  $matches[2] ?? 'php';

                return view('components.code', [
                        'language' => $language,
                        'slot' => $matches[4]]
                )->render();
            },
            $text
        );

        return $text;
    }

}
