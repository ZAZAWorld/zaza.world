<div class='team_list'>
	@foreach (CompanyFile::where(array('file_type_id'=>10, 'company_id'=>$company->id))->get() as $f)
		<div class='team_item'>
			<div class='team_round' style="background: url('{{ $f->path }}') no-repeat center; background-size: auto 100%;"></div>
			<div class='team_item_name'>{{ $f->title }}</div>
			<div class='team_item_pos'>{{ $f->note }}</div>
		</div>
	@endforeach
</div>