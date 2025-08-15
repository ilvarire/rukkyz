<!-- Header -->
<header class="site-header main-bar-wraper top-0 left-0 w-full z-[999] is-fixed sticky-header">
    <div class="main-bar">
        <div class="container">
            <!-- Website Logo -->
            <div class="logo-header w-[60px] h-[16px] items-center relative flex float-left">
                <a href="{{ route('home')}}">
                    <img src="{{ url('/assets/images/logo.png')}}" alt="/">
                </a>
            </div>

            <!-- Toggle button -->
            <button
                class="togglebtn lg:hidden block bg-primary w-[45px] h-[45px] relative rounded-md float-right mt-12">
                <span class="bar1"></span>
                <span class="bar2"></span>
                <span class="bar3"></span>
            </button>

            <!-- EXTRA NAV -->
            <div class="extra-nav float-right items-center h-[64px] lg:flex relative mt-2 mr-2 pl-[60px]">
                <div class="extra-cell flex items-center">
                    <ul class="flex items-center gap-[10px]">
                        @auth
                            <li class="inline-block">
                                <a class="bg-white text-[var(--title)] user-btn white-btn flex items-center justify-center w-[45px] h-[45px] rounded-md shadow-[0_10px_10px_0_rgba(0,0,0,0.1)]"
                                    href="{{ route('settings.profile')}}">
                                    <i class="flaticon-user text-2xl inline-flex"></i>
                                </a>

                            </li>
                        @endauth
                        <li class="inline-block">
                            <a href="{{ route('cart')}}">
                                <button
                                    class="cart-btn bg-white white-btn flex items-center justify-center w-[45px] h-[45px] rounded-md shadow-[0_10px_10px_0_rgba(0,0,0,0.1)]">
                                    <i class="flaticon-shopping-bag-1 text-2xl inline-flex ping-bag-1"></i>
                                    <span
                                        class="badge absolute top-[3px] right-[-6px] p-0 h-5 w-5 font-medium text-xs leading-5 bg-[#666666] text-white rounded-[10px]">
                                        <livewire:cart.cart-counter>
                                    </span>
                                </button></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- EXTRA NAV -->

            <!-- Header Nav -->
            <div class="header-nav lg:justify-end lg:flex-row flex-col lg:gap-0 gap-5 flex">
                <div class="logo-header lg:hidden">
                    <a href="/">
                        <img src="{{ url('/assets/images/logo.png')}}" class="w-[60px] h-[16px]" alt="/">
                    </a>
                </div>
                <ul class="nav {{ $nav ?? '' }} navbar-nav navbar lg:flex items-center float-right">
                    <li>
                        <a href="{{ route('home')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('menu')}}">Menu</a>
                    </li>
                    <li>
                        <a href="{{ route('cart')}}">Cart</a>
                    </li>

                    <li class="sub-menu-down"><a href="javascript:void(0);" {{request()->is('/') ? 'active-menu' : ''}}>Rukkyz</a>
                        <ul class="sub-menu">
                            <li class="py-[5px] px-5 relative"><a href="{{ route('about')}}">About Us</a></li>
                            <li class="py-[5px] px-5 relative"><a href="{{ route('contact')}}">Contact Us</a></li>
                            <li class="py-[5px] px-5 relative"><a href="{{ route('preorder')}}">Pre-Order</a></li>
                        </ul>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('login')}}">Login</a>
                        </li>
                    @endguest
                    @auth
                        <li class="sub-menu-down"><a href="javascript:void(0);" {{request()->is('/') ? 'active-menu' : ''}}>Account</a>
                            <ul class="sub-menu">
                                <li class="py-[5px] px-5 relative"><a href="{{ route('orders')}}">Orders</a></li>
                                <li class="py-[5px] px-5 relative"><a href="{{ route('payments')}}">Payments</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>

                <div class="dz-social-icon">
                    <ul>
                        <li><a target="_blank" class="fab fa-facebook-f" href="https://www.facebook.com/"></a>
                        </li>
                        <li><a target="_blank" class="fab fa-twitter" href="https://twitter.com/"></a></li>
                        <li><a target="_blank" class="fab fa-linkedin-in" href="https://www.linkedin.com/"></a>
                        </li>
                        <li><a target="_blank" class="fab fa-instagram" href="https://www.instagram.com/"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header -->