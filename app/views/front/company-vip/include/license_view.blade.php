<div class='license_list'>
	@foreach (CompanyFile::where(array('file_type_id'=>9, 'company_id'=>$company->id))->get() as $f)
		<div class='license_item'>
			<div class='license_item_squere license_item_img' style="background:url({{ $f->path }}) no-repeat center center; background-size: contain" data-img='{{ $f->path }}'>
				{{-- <img src="{{ $f->path }}" class="license_item_img"> --}}
				{{-- <img src="{{ $f->path }}" class="license_item_img_org" style="display:none;"> --}}
			</div>
		</div>
	@endforeach
</div>