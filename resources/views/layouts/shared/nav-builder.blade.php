<?php
/*
    $data = $menuel['elements']
*/
/*
if(!function_exists('renderDropdown')){
    function renderDropdown($data){
        if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){
            echo '<li class="c-sidebar-nav-dropdown">';
            echo '<a class="c-sidebar-nav-dropdown-toggle" href="#">';
            if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){
                echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';    
            }
            echo $data['name'] . '</a>';
            echo '<ul class="c-sidebar-nav-dropdown-items">';
            renderDropdown( $data['elements'] );
            echo '</ul></li>';
        }else{
            for($i = 0; $i < count($data); $i++){
                if( $data[$i]['slug'] === 'link' ){
                    echo '<li class="c-sidebar-nav-item">';
                    echo '<a class="c-sidebar-nav-link" href="' . url($data[$i]['href']) . '">';
                    echo '<span class="c-sidebar-nav-icon"></span>' . $data[$i]['name'] . '</a></li>';
                }elseif( $data[$i]['slug'] === 'dropdown' ){
                    renderDropdown( $data[$i] );
                }
            }
        }
    }
}*/
?>


        <div class="c-sidebar-brand">
            <img class="c-sidebar-brand-full" src="{{ url('/assets/brand/coreui-base-white.svg') }}" width="118" height="46" alt="CoreUI Logo">
            <img class="c-sidebar-brand-minimized" src="{{ url('assets/brand/coreui-signet-white.svg') }}" width="118" height="46" alt="CoreUI Logo">
        </div>
        <ul class="c-sidebar-nav">
        @if(isset($appMenus['sidebar menu']))
            @foreach($appMenus['sidebar menu'] as $menuel)
                @if($menuel['slug'] === 'link')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ url($menuel['href']) }}">
                        @if($menuel['hasIcon'] === true)
                            @if($menuel['iconType'] === 'coreui')
                                <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                            @endif
                        @endif 
                        {{ $menuel['name'] }}
                        </a>
                    </li>
                @elseif($menuel['slug'] === 'dropdown')
                    <?php renderDropdown($menuel) ?>
                @elseif($menuel['slug'] === 'title')
                    <li class="c-sidebar-nav-title">
                        @if($menuel['hasIcon'] === true)
                            @if($menuel['iconType'] === 'coreui')
                                <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>
                            @endif
                        @endif 
                        {{ $menuel['name'] }}
                    </li>
                @endif
            @endforeach
        @endif

            {{-------New ----------}}
            {{--<li class="c-sidebar-nav-item">--}}
                {{--<a class="c-sidebar-nav-link" href="{{ URL('admin').'/dashboard' }}">--}}
                    {{--<i class="c-sidebar-nav-icon"></i>--}}
                    {{--Dashboard--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--<li class="c-sidebar-nav-item">--}}
                {{--<a class="c-sidebar-nav-link" href="{{ URL('admin').'/acl-modules' }}">--}}
                            {{--<i class="c-sidebar-nav-icon"></i>--}}
                  {{--Modules--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="c-sidebar-nav-dropdown">--}}
                {{--<a class="c-sidebar-nav-dropdown-toggle" href="#">--}}
                    {{--<i class="c-sidebar-nav-icon"></i>--}}
                    {{--Users Management--}}
                {{--</a>--}}
                {{--<ul class="c-sidebar-nav-dropdown-items">--}}
                   {{--<li class="c-sidebar-nav-item">--}}
                       {{--<a class="c-sidebar-nav-link" href="{{ URL('admin').'/users' }}">--}}
                       {{--Users--}}
                       {{--</a>--}}
                   {{--</li>--}}
                    {{--<li class="c-sidebar-nav-item">--}}
                        {{--<a class="c-sidebar-nav-link" href="{{ URL('admin').'/roles' }}">--}}
                            {{--Users Role--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

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
        {{-------##New ----------}}

        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
    </div>