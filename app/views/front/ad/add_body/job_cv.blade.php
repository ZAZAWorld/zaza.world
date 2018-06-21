@include('front.ad.head_body')

<div class="add_ad_feilds">
    <div class="add_ad_feilds__line">
		@include('front.ad.add_body.body_include.full_name')
    </div>
	<div class="add_ad_feilds__line">
		<div class='col-md-47'>
			<!-- Target Role -->
			<input name='prop[35]' type="text" class="add_ad_field" placeholder="{{ $props->get(35)->name}}" />
		</div>
		<div class='col-md-47' style="float:right;">
			<!-- Target Industry -->
			<input name='prop[36]' type="text" class="add_ad_field" placeholder="{{$props->get(36)->name}}" />
		</div>
	</div>
</div>

<div class="add_ad_option add_ad_option_all-border">
	<div class="add_ad_option__line">
		<!-- Current/Last position -->
		<input name='prop[37]' type="text" class="add_ad_field" placeholder="{{$props->get(37)->name}}" />
	</div>
	
	<div class="add_ad_option__line">
		<div class="col-md-45">
			<!-- Experience of this role -->
			{{TransWord::getArabic($props->get(38)->name)}}
            <input name='prop[38]' type="text" class="add_ad_field" maxlength = "10" placeholder="{{$props->get(38)->name}}" />
        </div>
        <div class="col-md-45 col-md-offset-10">
			<!-- Country of Residence -->
			{{TransWord::getArabic($props->get(41)->name)}}
            <select name="prop[41]" class="add_ad_option__inline">
				@foreach ($props->get(41)->relPropOption as $option)
					<option value="{{ $option->id }}">{{$option->name}}</option>
				@endforeach
            </select>
        </div>
	</div>
	
	<div class="add_ad_option__line">
		<div class="col-md-45">
			<!-- Total experience -->
			{{TransWord::getArabic($props->get(39)->name)}}
            <input name='prop[39]' type="text" class="add_ad_field" maxlength = "10" placeholder="{{$props->get(39)->name}}" />
        </div>
        <div class="col-md-45 col-md-offset-10">
			<!-- Nationality -->
			{{TransWord::getArabic($props->get(42)->name)}}
            <select name="prop[42]" class="add_ad_option__inline">
				@foreach ($props->get(42)->relPropOption as $option)
					<option value="{{ $option->id }}">{{$option->name}}</option>
				@endforeach
            </select>
        </div>
	</div>
	
	<div class="add_ad_option__line">
		<div class="col-md-45">
			<!-- Experience in UAE -->
			{{ TransWord::getArabic($props->get(40)->name) }}
            <input name='prop[40]' type="text" class="add_ad_field" maxlength="10" placeholder="{{$props->get(40)->name}}" />
        </div>
        <div class="col-md-45 col-md-offset-10">
			<!-- Gender -->
			{{TransWord::getArabic($props->get(43)->name)}}
            @foreach ($props->get(43)->relPropOption as $option)
				<input name='prop[43]' type="radio" value='{{ $option->id }}'> <label class='add_ad_option__label' for='prop[43]'>{{$option->name}} </label>
			@endforeach
        </div>
	</div>
	<div class="add_ad_option__line">
		<div class="col-md-100">
			<!-- Visa type -->
			{{TransWord::getArabic($props->get(44)->name)}}
            @foreach ($props->get(44)->relPropOption as $option)
				<input name='prop[44]' type="radio" value='{{ $option->id }}'> <label class='add_ad_option__label' for='prop[44]'>{{$option->name}}</label>
			@endforeach
		</div>
		
	</div>	
</div>
	<div class="add_ad_option__line">
		<div class="add_ad_feilds__line">
			@include('front.ad.add_body.body_include.photo_resume_block')
		</div>
	</div>
	<div>
		<textarea 
			name="note" 
			class="add_ad_field"
			rows="5" 
			placeholder="{{ TransWord::getArabic('Additional information',false) }}" 
			value="{{ TransWord::getArabic('Additional information',false) }}"></textarea>
    
	</div>
	
@include('front.ad.owner')
