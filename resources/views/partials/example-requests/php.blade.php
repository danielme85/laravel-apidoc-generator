```php

$client = new \GuzzleHttp\Client();
$response = $client->{{ strtolower($route['methods'][0]) }}("{{ rtrim($baseUrl, '/') . '/' . ltrim($route['boundUri'], '/') }}", [
@if(!empty($route['headers']))
    'headers' => [
    @foreach($route['headers'] as $header => $value)
        "{{$header}}" => "{{$value}}",
    @endforeach
    ],
@endif
@if(!empty($route['cleanQueryParameters']))
    'query' => [
    @foreach($route['cleanQueryParameters'] as $parameter => $value)
        "{{$parameter}}" => "{{$value}}",
    @endforeach
    ],
@endif
@if(!empty($route['cleanBodyParameters']))
    'json' => [
    @foreach($route['cleanBodyParameters'] as $parameter => $value)
        @if(is_array($value))
        "{{$parameter}}" => [@foreach($value as $arrayValue)"{{{$arrayValue}}}", @endforeach]
        @else
        "{{$parameter}}" => "{{{$value}}}",
        @endif

    @endforeach
    ],
@endif
]);
$body = $response->getBody();
print_r(json_decode((string) $body));
```
