<div class='callback_block '>
	<div class='callback_close'>X</div>
	<div class='callback_body'>
		<form method="GET" action="{{ action('CatalogCompanyController@getCallBack', $company->id) }}" accept-charset="UTF-8" role="form">
			@if (Auth::check())
				<div class='row' style='margin: 10px 0;'>
					<input type="text" name="full_name" placeholder="{{TransWord::getArabic('Set your full name',false)}}" value='{{ Auth::user()->full_name }}' disabled required  class='callback_input'  /> 
				</div>
				<div class='row'  style='margin: 10px 0;'>
					<input type="text" name="email" placeholder="{{TransWord::getArabic('Set your email',false)}}" value='{{ Auth::user()->email }}' disabled required class='callback_input' /> 
				</div>
				<div class='row'  style='margin: 10px 0;'>
					<input type="text" name="number" placeholder="{{TransWord::getArabic('Set your contact number',false)}}" value='{{ Auth::user()->getContactNumber() }}' required  class='phone_uae callback_input' /> 
				</div>
			@else
				<div class='row'  style='margin: 10px 0;'>
					<input type="text" name="full_name" placeholder="{{TransWord::getArabic('Set your full name',false)}}" required  class='callback_input' /> 
				</div>
				<div class='row'  style='margin: 10px 0;'>
					<input type="text" name="email" placeholder="{{TransWord::getArabic('Set your email',false)}}" required  class='callback_input' />
				</div>
				<div class='row'  style='margin: 10px 0;'>
					<input type="text" name="number" placeholder="{{TransWord::getArabic('Set your contact number',false)}}" required  class='phone_uae callback_input' /> 
				</div>
			@endif
			<div class='row' style='margin: 10px 0;'>
				<textarea  name="subject" placeholder="{{TransWord::getArabic('Set your message',false)}}" required class='callback_input'></textarea>
			</div>
			<div class='row'  style='margin: 10px 0;'>
				<input type="submit" value="{{TransWord::getArabic('Send',false)}}" class='callback_submit'>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
jQuery(function($){
	$.mask.definitions['9'] = '';
	$.mask.definitions['n'] = '[0-9]';
    $(".phone_uae").mask("+ (971) nn nnn-nnnn");
});
</script>