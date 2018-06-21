@include('front.ad.ad_template.view')
<div style="clear:both"></div>

<div class='advert_top_block'>
	<a href='#' class='advert_edit_block__link raise_in_top' data-id="{{ $ad->id }}"><i class="top_ico_small"></i></a>
	<a href='{{ action("AdController@getReAdd", $ad->id) }}' class='advert_edit_block__link advert_edit_block__blue'><i class="renew"></i></a>
</div>
<div class='advert_edit_block'>
	<a href='#update' class='advert_edit_block__link advert_edit_block__green js-call-dialog-edit-ad' data-id='{{ $ad->id }}'><i class="edit"></i></a>&nbsp;&nbsp;
	<a href='#delete-ad' class='advert_edit_block__link advert_edit_block__red js_advert_delete_link' data-id='{{ $ad->id }}'><i class="delete"></i></a>
</div>