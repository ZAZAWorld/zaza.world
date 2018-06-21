@extends('front.layout')
@section('content')

<div class="catalogs">
    <div class="row ad_vip">
        <div class="catalogs__vip__before">
            <
        </div>
        <div class="catalogs__vip__after">
            >
        </div>

        <div class="catalogs__vip">
            @foreach ($copms_vip as $comp)
                <div class="col-md-20 col-lg-12-5 col-sm-33 col-xs-50 ad-vip-block ">
                   <div class="advert"  >
                       <div class="advert__image-block ">
                           <img src="{{ $comp->photo }}" class="advert__image " />
                       </div>
                       <div class="advert__text-block red">
                           <a href="{{ action('CatalogCompanyController@getCompanyView', $comp->id) }}" class="advert__link">
                               <h3 class="advert__title">{{$comp->title}}</h3>
                           </a>
                       </div>
                   </div>
               </div>
            @endforeach
        </div>
    </div>

    <div class="row ad_normal">
        @foreach ($copms as $comp)
            <div class="col-md-20 col-lg-12-5 col-sm-33 col-xs-50 ">
               <div class="advert" >
                   <div class="advert__image-block ">
                       <img src="{{ $comp->photo }}" class="advert__image " />
                   </div>
                   <div class="advert__text-block red">
                       <a href="{{ action('CatalogCompanyController@getCompanyView', $comp->id) }}" class="advert__link">
                           <h3 class="advert__title">{{$comp->title}}</h3>
                       </a>
                   </div>
               </div>
           </div>
        @endforeach
    </div>


</div>

@stop
