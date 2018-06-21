<div class="menu-bar" >
    <img src="/front/img/menu-icon.png" class="menu-bar__image" />
</div>

<div class="bar bar-adv js-reviews-scroll">
    <ul class="bar__ul">
        @foreach (SysAdvertCat::where(function($q) { $q->where('id', 4)->orWhere('id', 5)->orWhere('id', 7)->orWhere('id', 6);})->get() as $cat_1)
            <li class="bar__li" id="adv-cat-{{ $cat_1->id }}">
                <span class="bar__li_title" data-id='{{ $cat_1->id }}'>
                    <span class="{{ $cat_1->icon }} bar__li__img"> </span>
                   {{ TransWord::getArabic($cat_1->name,false) }}
                    <span class="bar__li_open icon-plus" data-id='{{ $cat_1->id }}'>&nbsp;</span>
                </span>
                <ul class="bar__sub__ul">
                    @foreach ($cat_1->relsChilds()->orderBy('name', 'asc')->get() as $cat_2)
                        <li class="bar__sub__li" id="adv-subcat-{{ $cat_2->id }}">
                            <a href='{{ action('CatalogAdController@getIndex', $cat_2->id) }}'>
                                <span class="bar__sub__li_title">
                                    {{TransWord::getArabic($cat_2->name,false)}}
                                    <span class="bar__sub__li_open" data-id='{{ $cat_2->id }}'></span>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach

    </ul>
</div>

<div class="bar bar-com js-reviews-scroll">
    <ul class="bar__ul">
        @foreach (SysCompanyType::where('id', '>=', 2)->get() as $cat_1)
            <li class="bar__li" id="com-cat-{{ $cat_1->id }}">
                <span class="bar__li_title" data-id='{{ $cat_1->id }}'>
                    {{TransWord::getArabic($cat_1->name,false)}}
                    <span class="bar__li_open icon-plus" data-id='{{ $cat_1->id }}'>&nbsp;</span>
                </span>
                <ul class="bar__sub__ul">
                    @foreach ($cat_1->relChilds()->orderBy('name', 'asc')->get() as $cat_2)
                        <li class="bar__sub__li" id="com-subcat-{{ $cat_2->id }}">
                            <a href='{{ action('CatalogCompanyController@getIndex', $cat_2->id) }}'>
                                <span class="bar__sub__li_title">
                                    {{TransWord::getArabic($cat_2->name,false)}}
                                    <span class="bar__sub__li_open" data-id='{{ $cat_2->id }}'></span>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
