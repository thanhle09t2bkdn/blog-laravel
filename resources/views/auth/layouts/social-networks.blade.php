@php
    $socialNetworks = [
        ['name' => 'Facebook', 'route' => route('facebook.redirect'), 'icon' => 'fab fa-facebook', 'color' => '#507cc0'],
        ['name' => 'Google', 'route' => route('google.redirect'), 'icon' => 'fab fa-google-plus', 'color' => '#df4930'],
    ];
@endphp

<p> or login with </p>
@foreach($socialNetworks as $socialNetwork)
<a href="{{ $socialNetwork['route'] }}" class="btn btn-primary mr-1" style="background-color: {{ $socialNetwork['color'] }}; border-color: {{ $socialNetwork['color'] }};">
    <i class="{{ $socialNetwork['icon'] }}"></i> {{ ucfirst($socialNetwork['name']) }}
</a>
@endforeach
