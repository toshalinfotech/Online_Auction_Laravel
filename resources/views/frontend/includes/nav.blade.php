<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <a href="{{ route('frontend.index') }}" class="navbar-brand">{{ app_name() }}</a>

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('labels.general.toggle_navigation')">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            @if(config('locale.status') && count(config('locale.languages')) > 1)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">@lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</a>

                    @include('includes.partials.lang')
                </li>
            @endif

            @auth
                @if($logged_in_user->user_type == 1)
                <li class="nav-item"><a href="{{route('frontend.user.dashboard')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}">@lang('navs.frontend.dashboard')</a></li> 

                <!-- User Type Menus  user_type 1 = admin , 2 = seller, user_type 3 = buyer-->
                @elseif($logged_in_user->user_type == 2)

                    <li class="nav-item"><a href="{{route('frontend.auth.user-type.seller')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.user-type.seller')) }}">@lang('navs.frontend.product_index')</a></li>

                    <li class="nav-item"><a href="{{route('frontend.auth.user-type.seller.add-products')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.user-type.seller.add-products')) }}">@lang('navs.frontend.add_products')</a></li>

                    <li class="nav-item"><a href="{{route('frontend.auth.user-type.seller.set-auction')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.user-type.seller.set-auction')) }}">@lang('navs.frontend.auction_index')</a></li>

                    <li class="nav-item"><a href="{{route('frontend.auth.seller.add-auction')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.seller.add-auction')) }}">@lang('navs.frontend.add_auction')</a></li>

                @elseif($logged_in_user->user_type == 3)

                <li class="nav-item"><a href="{{route('frontend.auth.user-type.buyer')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.user-type.buyer')) }}">@lang('navs.general.home') <i class="fa fa-home"></i> </a></li>
                
                @endif

            @endauth

            @guest
                <li class="nav-item"><a href="{{route('frontend.auth.login')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.login')) }}">@lang('navs.frontend.login')</a></li>
        
                @if(config('access.registration'))
                    <li class="nav-item"><a href="{{route('frontend.auth.register')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.register')) }}">@lang('navs.frontend.register')</a></li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">{{ $logged_in_user->name }}</a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                        @can('view backend')
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a>
                        @endcan

                        <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Active::checkRoute('frontend.user.account')) }}">@lang('navs.frontend.user.account')</a>
                        <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a>
                    </div>
                </li>
            @endguest

            <li class="nav-item"><a href="{{route('frontend.contact')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.contact')) }}">@lang('navs.frontend.contact')</a></li>
        </ul>
    </div>
</nav>
