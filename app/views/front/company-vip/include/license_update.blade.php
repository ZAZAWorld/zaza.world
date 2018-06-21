<div class='license_list'>
	@foreach (CompanyFile::where(array('file_type_id'=>9, 'company_id'=>$company->id))->get() as $f)
		<div class='license_item js-license_item'>
			<div class='license_item_squere license_item_img' style="background:url({{ $f->path }}) no-repeat center center; background-size: contain" data-img='{{ $f->path }}'>
			</div>
			<div class='license_item_del js-license_item-del' data-id="{{ $f->id }}">✖</div>
		</div>
	@endforeach
	
	<div class='license_item'>
		<div class='license_item_squere'>
			<div class='license_item_add_icon js-license_item-add' data-id="{{ $company->id }}"> <span style="font-size:30px"> + </span> <br/> {{TransWord::getArabic('add more',false)}} </div>
		</div>
		<input type='file' class='js-license_item-file' style='display:none' />
	</div>
</div>