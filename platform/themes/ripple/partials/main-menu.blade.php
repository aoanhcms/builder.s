<ul {!! BaseHelper::clean($options) !!}>
    @php $menu_nodes->loadMissing('metadata'); @endphp
    @foreach ($menu_nodes as $key => $row)
        <li class="menu-item @if ($row->has_child) menu-item-has-children @endif {{ $row->css_class }} @if ($row->active) active @endif">
            <a href="{{ $row->url }}" target="{{ $row->target }}">
                @if ($iconImage = $row->getMetadata('icon_image', true))
                    <img src="{{ RvMedia::getImageUrl($iconImage) }}" alt="icon image" width="12" height="12" style="vertical-align: top; margin-top: 3px"/>
                @elseif ($row->icon_font)<i class='{{ trim($row->icon_font) }}'></i> @endif{{ $row->title }}
                @if ($row->has_child) <span class="toggle-icon"><i class="fa fa-angle-down"></i></span>@endif
            </a>
            @if ($row->has_child)
                {!!
                    Menu::generateMenu([
                        'menu'       => $menu,
                        'menu_nodes' => $row->child,
                        'view'       => 'main-menu',
                        'options'    => ['class' => 'sub-menu'],
                    ])
                !!}
            @endif
        </li>
    @endforeach
</ul>
