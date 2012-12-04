jQuery(function($){

	// alert('ok');
	var portfolio = $('#portfolio');
	portfolio.masonry({
		isAnimated: true,
		itemSelector:'.bloc:not(.hidden)',
		isFitWidth:true,
		columnWidth:160
	});
	
	
	//Fonction de filtre
	$('h1 a').click(function(e){
	
		var cls = $(this).attr('href').replace('#','');
		portfolio.find('.bloc').removeClass('hidden'); 
		portfolio.find('.bloc').removeClass('all'); 
		portfolio.find('.bloc:not(.'+cls+')').addClass('hidden');	
		portfolio.masonry('reload'); 
		portfolio.find('.'+cls).show(500);
		portfolio.find('.bloc:not(.'+cls+')').hide(500);

		location.hash = cls;
		e.preventDefault(); 
		
	});
	
	var bloc = portfolio.find('.bloc:first'); 
	var cssi = {width:bloc.width(),height:bloc.height()};
	var cssf = null; 
	
	//Click All
	$('h1 a.all').click(function(){
	
		var cls = $(this).attr('href').replace('#','');
		// alert(cls);
		portfolio.find('.bloc').removeClass('hidden'); 
		portfolio.find('.bloc').addClass('all'); 
		portfolio.masonry('reload'); 
		//portfolio.find('.'+cls).show(500);
		portfolio.find('.bloc:not(.'+cls+')').show(500);
		
		location.hash = cls;
		e.preventDefault(); 
	
	});
	
	//Click sur le lien pour déclencher l'aggrandissement
	portfolio.find('a.thumb').click(function(e)
	{
		var elem = $(this);
		var cls = elem.attr('href').replace('#','');
		var fold = portfolio.find('.unfold').removeClass('unfold').css(cssi); 		
		var unfold = elem.parent().addClass('unfold').css(cssf); 
		portfolio.masonry('reload'); 
		if(cssf == null)
		{
			cssf = {width : unfold.width(),height : unfold.height()};
		}
		unfold.css(cssi).animate(cssf);
		location.hash = cls;
		e.preventDefault();//evite le comportement par défaut
		
	});
	
	//Déclenche le filtre sur l'élément dans l'adresse
	if(location.hash != '')
	{
		$('a[href="'+location.hash+'"]').trigger('click');
	};

})