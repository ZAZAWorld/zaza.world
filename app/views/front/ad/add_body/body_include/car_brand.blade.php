@if ($cat_3 == 30)
<div class="col-md-15">
	<img class="add_ad_car_icon js-auto-img" src="/upload/images/1473139885_acura-logo-transparent-png-wallpaper-3.jpg" />
</div>
<div class="col-md-85">
	<select name='car_type_brand' class="add_ad_field js-auto-brand">
		@foreach ($ar_auto_brands as $auto)
            @if (!empty($advert))
            <option @if ($advert->auto_brand_id == $auto->id) selected  @endif value="{{ $auto->id }}" data-img="{{ $auto->icon }}">{{ $auto->name }}</option>
            @else
        	<option value="{{ $auto->id }}" data-img="{{ $auto->icon }}">{{ $auto->name }}</option>
            @endif
		@endforeach
	</select>
</div>
@endif