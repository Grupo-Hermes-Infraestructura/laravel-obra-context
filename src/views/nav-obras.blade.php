@if($currentObra)
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{ $currentObra->nombre }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li>{!! link_to_route('pages.obras', 'Cambiar de obra') !!}</li>
        </ul>
    </li>
@else
    <li>
        <a href="{{ route('pages.obras') }}">Obras</a>
    </li>
@endif