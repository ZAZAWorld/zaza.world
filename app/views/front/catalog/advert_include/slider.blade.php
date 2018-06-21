
<div class="head_slider">
	  <div id="slide-container">
		  <div>
			  <ul class="slides_ads">
					 
					@forelse ($files as $f )
						<li>
							<a href="{{ $f->file }}" data-lightbox="example-set"><img src="/front/popup/size-up.png" class="catalog_image_full" /> </a>
							<div class="catalog_image_org" style="background:#eee url('{{ $f->file }}') no-repeat center; background-size: contain;"></div>
						</li>
					@empty
						<li>
							<div class="catalog_image_org" style="background:#eee url('{{ $advert->photo }}') no-repeat center; background-size: contain;"></div>
						</li>
						
					@endforelse
			  </ul>
		  </div>
	  </div>
</div>
