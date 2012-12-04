$(document).ready(function(){

	$('a[href^=#slide]').click(function(){
	
		cible = $(this).attr('href');
		// alert(cible.length);
		
		if($(cible).length >= 1)
		{
			hauteur = $(cible).offset().top;
		}
		else
		{
			hauteur = $("a[name="+cible.substr(1,cible.length-1)+"])").offset().top;
		}
		
		$('html,body').animate({scrollTop:hauteur},1000,'easeOutQuint');
		
		return false;
		
	});
	
});