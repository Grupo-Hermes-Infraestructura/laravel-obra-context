@if($currentObra)
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{ $currentObra->nombre }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li>{!! link_to_route('obras.index', 'Cambiar de obra') !!}</li>
        </ul>
    </li>
@else
    <li>
        <a href="{{ route('obras.index') }}">Obras</a>
    </li>
@endif