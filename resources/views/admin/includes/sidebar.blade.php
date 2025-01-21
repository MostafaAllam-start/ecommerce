<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span
                            class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

{{--            <li class="nav-item  open ">--}}
{{--                <a href=""><i class="la la-home"></i>--}}
{{--                    <span class="menu-title" data-i18n="nav.dash.main">لغات الموقع </span>--}}
{{--                    <span--}}
{{--                            class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Language::count()}}</span>--}}
{{--                </a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li class="active"><a class="menu-item" href="{{route('admin.languages')}}"--}}
{{--                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>--}}
{{--                    </li>--}}
{{--                    <li><a class="menu-item" href="{{route('admin.languages.create')}}" data-i18n="nav.dash.crypto">أضافة--}}
{{--                            لغة جديده </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام </span>
                    <span
                            class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Category::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.categories')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.categories.create')}}" data-i18n="nav.dash.crypto">أضافة
                            قسم جديد </a>
                    </li>
                </ul>
            </li>

{{--            <li class="nav-item">--}}
{{--                <a href="">--}}
{{--                    <i class="la la-group"></i>--}}
{{--                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الفرعية   </span>--}}
{{--                    <span class="badge badge badge-danger badge-pill float-right mr-2">400</span>--}}
{{--                </a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li class="active">--}}
{{--                        <a class="menu-item" href="{{route('admin.sub_categories')}}" data-i18n="nav.dash.ecommerce"> عرض الكل </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="menu-item" href="{{route('admin.sub_categories.create')}}" data-i18n="nav.dash.crypto"> أضافة قسم فرعي جديد </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المتاجر  </span>
                    <span
                            class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Vendor::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.vendors')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.vendors.create')}}" data-i18n="nav.dash.crypto">أضافة
                            متجر </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الماركات  </span>
                    <span
                            class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Brand::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.brands')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.brands.create')}}" data-i18n="nav.dash.crypto">أضافة
                            ماركة </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المنتجات</span>
                    <span
                            class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Product::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.products')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.products.create')}}" data-i18n="nav.dash.crypto">أضافة
                            منتج  </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاسلايدرز</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Slider::count()}}</span>
                </a>
                <ul class="menu-content">
{{--                    <li class="active"><a class="menu-item" href="{{route('admin.sliders')}}"--}}
{{--                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>--}}
{{--                    </li>--}}
                    <li><a class="menu-item" href="{{route('admin.sliders')}}" data-i18n="nav.dash.crypto">أضافة
                            اسلايد  </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الأوسمة</span>
                    <span
                            class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Tag::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.tags')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.tags.create')}}" data-i18n="nav.dash.crypto">أضافة
                            وسم  </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الخصائص</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Attribute::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.attributes')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.attributes.create')}}" data-i18n="nav.dash.crypto">أضافة
                        خاصية</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الخيارات</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Option::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.options')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.options.create')}}" data-i18n="nav.dash.crypto">أضافة
                            خيار</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
