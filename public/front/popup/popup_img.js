$(document).ready(function() { // Ждём загрузки страницы
	$( ".body " ).on( "click",'.catalog_image', function() {
		var li = $(this).parent();
		var slider = $(this).parent().parent();
		var slider_count = slider.children().length;
		var before_count_li = parseInt(li.prevAll().length) + 1;
		
		var linc_before_id = before_count_li - 1;
		if (linc_before_id < 1)
			linc_before_id = slider_count;
		var linc_after_id = before_count_li + 1;
		if (linc_after_id > slider_count)
			linc_after_id = 1;
		
		var img = $(this).siblings(".catalog_image_org");
		var src = img.attr('src'); // Достаем из этого изображения путь до картинки
		var clicon = ('/front/images/close-icon-big.png'); // Достаем из этого изображения путь до картинки
		$("body").append("	<div class='catalog_popup'>"+ //Добавляем в тело документа разметку всплывающего окна
								"<div class='catalog_popup_bg'></div>"+ // Блок, который будет служить фоном затемненным
								"<img src="+clicon+" class='catalog_popup_img_close' />"+ 
								"<div class='catalog_popup_img'>"+
									"<img src="+src+" style='width: auto; height: 100%;' />"+
									"<div style='position: absolute; bottom: 0; width: 10%; text-align: center; color: #fff; background-color: rgba(0,0,0,0.6);left: 45%; z-index: 999999999;'>" + before_count_li + "/" + slider_count + "</div>" + 
									/*+
									"<div class='catalog_image_link_link' style='position: absolute; left: 14px; top: 0%; color: #fff; font-size: 400px; z-index: 999999999; cursor:pointer; height: 100%; width: 30%; text-align: left;     font-family: serif;' data-id='" + linc_before_id + "'>&larr;</div>"+
									"<div class='catalog_image_link_link' style='position: absolute; right: 14px; top: 0%; color: #fff; font-size: 400px; z-index: 999999999; cursor:pointer; height: 100%; width: 30%; text-align: right;     font-family: serif;' data-id='" + linc_after_id + "'>&rarr;</div>"+
									*/
									"<div class='catalog_image_link_link' style='position: absolute; left: 10%; top: calc(90%/2); color: #fff; font-size: 100px; z-index: 999999999; cursor:pointer; height: 100%; width: 30%; text-align: left;     font-family: serif;' data-id='" + linc_before_id + "'><img src='/front/img/icons/popup_arrow_left.png' /></div>"+
									"<div class='catalog_image_link_link' style='position: absolute; right: 10%; top: calc(90%/2); color: #fff; font-size: 100px; z-index: 999999999; cursor:pointer; height: 100%; width: 30%; text-align: right;     font-family: serif;' data-id='" + linc_after_id + "'><img src='/front/img/icons/popup_arrow_right.png' /></div>"+
								"</div>"+ // Само увеличенное фото
							"</div>");
		$(".catalog_popup").fadeIn(800); // Медленно выводим изображение
		$(".catalog_popup_bg").click(function(){	// Событие клика на затемненный фон
			$(".catalog_popup").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".catalog_popup").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
		$(".catalog_popup_img_close").click(function(){	// Событие клика на затемненный фон
			$(".catalog_popup").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".catalog_popup").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
		$(".catalog_image_link_link").click(function(){
			console.log($(this).data('id'));
			$(".catalog_popup").remove();
			$('#slides_advert_image_' + $(this).data('id')).click();
			console.log($('#slides_advert_image_' + $(this).data('id')).attr('class'));
		});
	});
	
	
	$( ".body " ).on( "click",'.popup_company_img', function() {
		var src = $(this).data('img'); // Достаем из этого изображения путь до картинки
		var clicon = ('/front/images/close-icon-big.png'); // Достаем из этого изображения путь до картинки
		$("body").append("<div class='catalog_popup'>"+ //Добавляем в тело документа разметку всплывающего окна
						 "<div class='catalog_popup_bg'></div>"+ // Блок, который будет служить фоном затемненным
						 "<img src="+clicon+" class='catalog_popup_img_close' />"+ 
						 "<img src="+src+" class='catalog_popup_img' />"+ // Само увеличенное фото
						 "</div>");
		$(".catalog_popup").fadeIn(800); // Медленно выводим изображение
		$(".catalog_popup_bg").click(function(){	// Событие клика на затемненный фон
			$(".catalog_popup").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".catalog_popup").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
		$(".catalog_popup_img_close").click(function(){	// Событие клика на затемненный фон
			$(".catalog_popup").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".catalog_popup").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
	});
	
	
	$( ".body " ).on( "click",'.license_item_img', function() {
	  	var img = $(this).siblings(".license_item_img_org");	// Получаем изображение, на которое кликнули
		var src = $(this).data('img'); // Достаем из этого изображения путь до картинки
		var clicon = ('/front/images/close-icon-big.png'); // Достаем из этого изображения путь до картинки
		$("body").append("<div class='catalog_popup'>"+ //Добавляем в тело документа разметку всплывающего окна
						 "<div class='catalog_popup_bg'></div>"+ // Блок, который будет служить фоном затемненным
						 "<img src="+clicon+" class='catalog_popup_img_close' />"+ 
						 "<img src="+src+" class='catalog_popup_img' />"+ // Само увеличенное фото
						 "</div>");
		$(".catalog_popup").fadeIn(800); // Медленно выводим изображение
		$(".catalog_popup_bg").click(function(){	// Событие клика на затемненный фон
			$(".catalog_popup").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".catalog_popup").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
		$(".catalog_popup_img_close").click(function(){	// Событие клика на затемненный фон
			$(".catalog_popup").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".catalog_popup").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
	});
	
	
	$( ".body " ).on( "click",'.license_item_ifram', function() {
	  	var img = $(".license_item_ifram_org");	// Получаем изображение, на которое кликнули
		var src = img.attr('src'); // Достаем из этого изображения путь до картинки
		var clicon = ('/front/images/close-icon-big.png'); // Достаем из этого изображения путь до картинки
		$("body").append("<div class='catalog_popup'>"+ //Добавляем в тело документа разметку всплывающего окна
						 "<div class='catalog_popup_bg'></div>"+ // Блок, который будет служить фоном затемненным
						 "<img src="+clicon+" class='catalog_popup_img_close' />"+ 
						 "<iframe src="+src+" class='catalog_popup_iframe'/></iframe>"+ // Само увеличенное фото
						// "<iframe src="+src+" frameborder="0" allowfullscreen class='catalog_popup_img'></iframe>"+ // Само увеличенное видео
						 "</div>");
		$(".catalog_popup").fadeIn(800); // Медленно выводим изображение
		$(".catalog_popup_bg").click(function(){	// Событие клика на затемненный фон
			$(".catalog_popup").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".catalog_popup").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
		$(".catalog_popup_img_close").click(function(){	// Событие клика на затемненный фон
			$(".catalog_popup").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".catalog_popup").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
	});
	
	
	// Restorant meals
	$(".image_gall").click(function(){	// Событие клика на маленькое изображение
	  	var img = $(this);	// Получаем изображение, на которое кликнули
		var src = img.attr('src'); // Достаем из этого изображения путь до картинки
		var clicon = ('/front/images/close-icon-big.png'); // Достаем из этого изображения путь до картинки
		$("body").append("<div class='popup_restorant'>"+ //Добавляем в тело документа разметку всплывающего окна
						 "<div class='popup_restorant_bg'></div>"+ // Блок, который будет служить фоном затемненным
						 "<img src="+clicon+" class='catalog_popup_img_close' />"+ 
						 "<img src="+src+" class='popup_restorant_img' />"+ // Само увеличенное фото
						 "</div>"); 
		$(".popup_restorant").fadeIn(800); // Медленно выводим изображение
		$(".popup_restorant_bg").click(function(){	// Событие клика на затемненный фон
			$(".popup_restorant").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".popup_restorant").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
		$(".catalog_popup_img_close").click(function(){	// Событие клика на затемненный фон
			$(".popup_restorant").fadeOut(800);	// Медленно убираем всплывающее окно
			setTimeout(function() {	// Выставляем таймер
			  $(".popup_restorant").remove(); // Удаляем разметку высплывающего окна
			}, 800);
		});
		
	});

});
