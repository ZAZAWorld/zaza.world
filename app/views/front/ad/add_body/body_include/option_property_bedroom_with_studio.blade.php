<span class="icon-66 add_ad_option__img"></span>
<select name="prop[55]" data-placeholder="Bedrooms" class="add_ad_option__inline chosen-select">
    <option selected="Bedrooms" value="Bedrooms" disabled>Bedrooms</option>
    @foreach ($props->get(55)->relPropOption as $option)
        <option value="{{ $option->id }}">{{$option->name}}</option>
    @endforeach
</select>