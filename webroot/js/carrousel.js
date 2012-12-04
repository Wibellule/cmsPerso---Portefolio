// Carrousel Jquery
//Création de l'objet javascript
var carrousel = {

	nbSlide : 0,
	nbCurrent : 1,
	elemCurrent : null, 
	elem : null, 
	timer : null,
	
	init : function(elem)
	{
		this.nbSlide = elem.find(".slide").length;
		// alert(this.nbSlide);
		
		//Création de la pagination
		elem.append('<div class="navigation"></div>');//Crée la div navigation
		for(var i=1;i<=this.nbSlide;i++)
		{
			elem.find(".navigation").append("<span>"+i+"</span>");//Rajoute pour chaque element trouvé une span
		}
		
		//Evenement au clic
		elem.find(".navigation span").click(function(){carrousel.gotoSlide($(this).text());});
		
		//Initialisation du carrousel
		this.elem = elem;//Porté de l'élément navigation
		elem.find(".slide").hide();//Cache les slides
		elem.find(".slide:first").show();//Affiche le premier slide
		this.elemCurrent = elem.find(".slide:first");//Element courant
		this.elem.find(".navigation span:first").addClass("active");//Active le premier élement
		
		//Création du timer
		// carrousel.play();
		
		//Création de la pause au passage de la souris
		// elem.mouseleave(carrousel.play);
		// elem.mouseenter(carrousel.pause);
	
	},
	
	gotoSlide : function(num)
	{
		if(num==this.nbCurrent){return false;}
		
		/*Animation FadeIn et FadeOut*/
		// this.elemCurrent.fadeOut();//Cache
		// this.elem.find("#slide"+num).fadeIn();//Affiche
		
		/*Animation en slide*/
		var sens = 1;
		if(num < this.nbCurrent){sens = -1;}
		var cssDeb = {"left":sens*this.elem.width()};
		var cssFin = {"left":-sens*this.elem.width()};
		this.elem.find("#slide"+num).show().css(cssDeb);
		this.elem.find("#slide"+num).animate({"top":0,"left":0},500);
		this.elemCurrent.animate(cssFin,500);
		
		/*this.elemCurrent.find(".visu").fadeOut();
		this.elem.find("#slide"+num).show();
		this.elem.find("#slide"+num+" .visu").hide().fadeIn();
		
		var titleHeight = this.elemCurrent.find(".title").height();
		
		this.elemCurrent.find(" .title").animate({"bottom": -titleHeight},500);
		this.elem.find("#slide"+num+" .title").css("bottom",-titleHeight).animate({"bottom":0},500);*/
		
		this.elem.find(".navigation span").removeClass("active");//Cherche l'index, eq commence toujours à 0;
		this.elem.find(".navigation span:eq("+(num-1)+")").addClass("active");//Cherche l'index, eq commence toujours à 0;
		this.nbCurrent = num;
		this.elemCurrent = this.elem.find("#slide"+num);
	},
	
	next : function()
	{
		var num = this.nbCurrent+1;
		if(num > this.nbSlide)
		{
			num = 1;
		}
		this.gotoSlide(num);
		// alert("forward");
	},
	
	prev : function()
	{
		var num = this.nbCurrent-1;
		if(num < 1)
		{
			num = this.nbSlide;
		}
		this.gotoSlide(num);
		// alert("return");
	},
	
	// pause : function()
	// {
		// window.clearInterval(carrousel.timer);
	// },
	
	// play : function()
	// {
		// window.clearInterval(carrousel.timer);
		// this.timer = window.setInterval("carrousel.next()",5000);
	// }
}



// Dès que Jquery est chargé, lancer ce script
$(function(){
	carrousel.init($("#carrousel"));
});