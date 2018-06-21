@if ($cat_3 == 30)
@if (!empty($ar_auto_models))
<select name='car_type_model' class="add_ad_field js-auto-model">
    <option value="">{{ TransWord::getArabic('Model') }}</option>
    @foreach ($ar_auto_models as $am)
        <option @if ($advert->auto_model_id == $am->id) selected @endif value="{{ $am->id }}">{{ $am->name }}</option>
    @endforeach
</select>
@else
<select name='car_type_model' class="add_ad_field js-auto-model">
	<option value="">{{ TransWord::getArabic('Model') }}</option>
</select>
@endif
@endif