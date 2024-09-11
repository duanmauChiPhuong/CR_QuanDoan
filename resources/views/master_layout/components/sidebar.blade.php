<div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <a href="{{ route('system.index') }}" class="d-flex align-items-center">
            <img alt="Logo" src="https://upload.wikimedia.org/wikipedia/vi/0/09/Huy_Hi%E1%BB%87u_%C4%90o%C3%A0n.png"
                class="h-55px logo" />
            <span class="ml-4 h5 font-weight-bold">QUẬN CÁI RĂNG</span>
        </a>

    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <div class="menu-content pb-2">
                        <span class="menu-section text-muted text-uppercase fs-8 ls-1">BẢNG ĐIỀU KHIỂN</span>
                    </div>
                </div>

                @foreach (config('apps.module') as $key => $value)
                    @foreach ($value as $item)
                        {{-- @if (in_array(session('user_role'), (array) $item['user_role'])) --}}
                        <div data-kt-menu-trigger="click"
                            class="menu-item menu-accordion {{ in_array(Route::currentRouteName(), (array) $item['route']) ? 'hover show' : '' }}">
                            <span class="menu-link">
                                <i class="{{ $item['icon'] }} me-2"></i>
                                <span class="menu-title">{{ $item['title'] }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                @foreach ($item['subModule'] as $sub)
                                    {{-- @if (in_array(session('user_role'), (array) $sub['user_role'])) --}}
                                    @if (Route::has($sub['route']))
                                        <div class="menu-item">
                                            <a class="menu-link {{ in_array(Route::currentRouteName(), (array) $sub['route']) ? 'active' : '' }}"
                                                href="{{ route($sub['route']) }}">
                                                <i class="{{ $sub['icon'] }} me-2"></i>
                                                <span class="menu-title">{{ $sub['title'] }}</span>
                                            </a>
                                        </div>
                                    @else
                                        <div class="menu-item">
                                            <a class="menu-link" href="">
                                                <i class="fa fa-x me-2 text-danger"></i><s class="menu-title">Không Tìm
                                                    Thấy Đường Dẫn</s>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- @endif --}}
                                @endforeach
                            </div>
                        </div>
                        {{-- @endif --}}
                    @endforeach
                @endforeach

            </div>
        </div>
    </div>
</div>
