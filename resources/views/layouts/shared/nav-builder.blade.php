        <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ URL('admin').'/dashboard' }}">
            <i class="c-sidebar-nav-icon"></i>
                Dashboard
            </a>
        </li>
        @foreach(GenerateMenuHelper::__menu() as $main => $menu)
            @if(isset($menu['sub_menu']))
                <li class="c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-dropdown-toggle" href="#">
                        <i class="{{$menu['icon']}}"></i>
                        <span>
                        {{ $main  }}
                         </span>
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                    @foreach($menu['sub_menu'] as $key => $sub_menu)

                        <li class="c-sidebar-nav-title">
                            <a class="c-sidebar-nav-link" href="{{ URL('admin').'/'.$sub_menu['module_path'] }}">
                                <i class=""></i>
                                <span>
                                {{ $sub_menu['menu_name'] }}
                                </span>
                            </a>
                        </li>

                    @endforeach
                    </ul>
                </li>
            @else
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ URL('admin').'/'.$menu['module_path'] }}">
                            <i class="{{$menu['icon']}}"></i>
                            <span>
                            {{ $main  }}
                            </span>
                        </a>
                    </li>
            @endif
            @endforeach
            </ul>
