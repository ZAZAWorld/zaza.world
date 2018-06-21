<div class='team_list'>
	@foreach (CompanyFile::where(array('file_type_id'=>10, 'company_id'=>$company->id))->get() as $f)
		<div class='team_item js-team_item'>
			<div class='team_round' style="background: url('{{ $f->path }}') no-repeat center; background-size: auto 100%;"></div>
			<div class='team_item_name'>{{ $f->title }}</div>
			<div class='team_item_pos'>{{ $f->note }}</div>
			<div class='team_item_del js-license_item-del' data-id='{{ $f->id }}'>✖</div>
		</div>
	@endforeach
	
	<div class='team_item'>
		<div class='team_round'>
			<div class='team_item_inputs'>
				<input type='text' class='team_item_input js-team_item-name' placeholder="{{TransWord::getArabic('Name',false)}}" /> <br/>
				<input type='text' class='team_item_input js-team_item-pos' placeholder="{{TransWord::getArabic('Position',false)}}"  />
			</div>
		</div>
		<div class='team_item_add js-team_item-add'>{{TransWord::getArabic('Add new member',false)}}</div>
		<input type='file' class='js-team_item-file' style='display:none' />
	</div>
</div>