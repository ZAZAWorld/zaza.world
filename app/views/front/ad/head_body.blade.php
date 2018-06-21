@if (Input::has('is_personal_cabinet'))
<form action="{{ action('AdController@postUpdate') }}"  method='post' >

    <div class="ad_dialog_edit open shadow">
        <div class="ad_dialog_edit__body">
            <span class="add_ad_modal__close"></span>
            <div>
                <div class="block_step3 first_edit_step">
@endif
<div class="add_ad_line">
    <div class="add_ad_line__title">
		<?php 
			$ar_title = explode('/', $title);
			$ar_res = array();
			foreach ($ar_title as $t) {
				$ar_res[]= TransWord::getArabic(trim($t), false); 
			}
			$title2 = implode(' / ', $ar_res);
		?>
        {{ $title2 }}
    </div>

    <div class="add_ad_line__stroke">&nbsp;</div>
    <div class="add_ad_line__ball_1 add_ad_line__ball-check"><span>&#10004;</span></div>
    <div class="add_ad_line__ball_2 add_ad_line__ball-red">&nbsp;</div>
    <div class="add_ad_line__ball_3">&nbsp;</div>
</div>
