<div class="header-top hidden-sm-down">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="header-top-left col-lg-6 col-md-6 d-flex justify-content-start align-items-center">
                    <div class="detail-email d-flex align-items-center justify-content-center">
                        @if(Auth::check())
                            <i class="icon-email"></i>
                            <p>Email :  </p>
                            <span>
                            {{Auth::user()->email}}
                        </span>
                        @endif
                    </div>
                    <div class="detail-call d-flex align-items-center justify-content-center">
                        <i class="icon-deal"></i>
                        <p>Today Deals </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-flex justify-content-end align-items-center header-top-right">
                    @if(!Auth::check())
                        <div class="register-out">
                            <i class="zmdi zmdi-account"></i>

                            <a class="register" href="{{route('register')}}" data-link-action="display-register-form">
                                Register
                            </a>
                            <span class="or-text">or</span>
                            <a class="login" href="{{route('login')}}" rel="nofollow" title="تسجيل الدخول إلى حسابك">Sign in</a>
                        </div>
                    @else
                        <a class="login" href="{{route('logout')}}" rel="nofollow" title="تسجيل الخروج">{{__('Log out')}}</a>
                    @endif
                    <!-- begin module:ps_currencyselector/ps_currencyselector.tpl -->
                    <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_currencyselector/ps_currencyselector.tpl --><div id="_desktop_currency_selector" class="currency-selector groups-selector hidden-sm-down currentcy-selector-dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="main">
                            <span class="expand-more">GBP</span>
                        </div>
                        <div class="currency-list dropdown-menu">
                            <div class="currency-list-content text-left">
                                <div class="currency-item current flex-first">
                                    <a title="جنيه إسترليني" rel="nofollow" href="http://demo.bestprestashoptheme.com/savemart/ar/?home=home_3&amp;SubmitCurrency=1&amp;id_currency=1">UK£ GBP</a>
                                </div>
                                <div class="currency-item">
                                    <a title="دولار أمريكي" rel="nofollow" href="http://demo.bestprestashoptheme.com/savemart/ar/?home=home_3&amp;SubmitCurrency=1&amp;id_currency=2">US$ USD</a>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_currencyselector/ps_currencyselector.tpl -->
                    <!-- end module:ps_currencyselector/ps_currencyselector.tpl -->

                    <!-- begin module:ps_languageselector/ps_languageselector.tpl -->
                    <!-- begin /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_languageselector/ps_languageselector.tpl --><div id="_desktop_language_selector" class="language-selector groups-selector hidden-sm-down language-selector-dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="main">
                            <span class="expand-more"><img class="img-fluid" src='{{asset("/assets/front/img/l/". LaravelLocalization::getCurrentLocale().".jpg")}}' alt="{{ LaravelLocalization::getCurrentLocaleName() }}" width="16" height="11"/></span>
                        </div>
                        <div class="language-list dropdown-menu">
                            <div class="language-list-content text-left">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div class="language-item">
                                        <div  >
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                <img class="img-fluid" src='{{asset("/assets/front/img/l/".$localeCode.".jpg")}}' alt="English" width="16" height="11"/>
                                                <span>{{$properties['native']}}</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- end /var/www/demo.bestprestashoptheme.com/public_html/savemart/themes/vinova_savemart/modules/ps_languageselector/ps_languageselector.tpl -->
                    <!-- end module:ps_languageselector/ps_languageselector.tpl -->

                </div>
            </div>
        </div>
    </div>
</div>
