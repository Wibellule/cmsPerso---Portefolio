// Carrousel Jquery
//Cr�ation de l'objet javascript
var tableau = {
	
	nbTableau : 0,
	nbElemCurrent : 1,
	element : null,
	elementCurrent : null,
	
	init : function(element)
	{
		this.nbTableau = element.find(".tableau").length;
		element.append('<div class="nav"></div>');
		for(var i=1;i<=this.nbTableau;i++)
		{
			element.find(".nav").append("<span>"+i+"</span>");//Rajoute pour chaque element trouv� une span
		}
		
		//Evenement au clic
		element.find(".nav span").click(function(){tableau.gotoTab($(this).text());});
		
		//Initialisation du carrousel
		this.element = element;//Port� de l'�l�ment navigation
		element.find(".tableau").hide();//Cache les slides
		element.find(".tableau:first").show();//Affiche le premier slide
		this.elementCurrent = element.find(".tableau:first");//Element courant
		this.element.find(".nav span:first").addClass("active");//Active le premier �lement

	},
	
	gotoTab : function(numT)
	{
		if(numT==this.nbElemCurrent){return false;}
		
		/*Animation en slide*/
		var sensT = 1;
		if(numT < this.nbElemCurrent){sensT = -1;}
		var cssDebT = {"left":sensT*this.element.width()};
		var cssFinT = {"left":-sensT*this.element.width()};
		this.element.find("#tab"+numT).show().css(cssDebT);
		this.element.find("#tab"+numT).animate({"top":0,"left":0},500);
		this.elementCurrent.animate(cssFinT,500);
		
		
		this.element.find(".nav span").removeClass("active");//Cherche l'index, eq commence toujours � 0;
		this.element.find(".nav span:eq("+(numT-1)+")").addClass("active");//Cherche l'index, eq commence toujours � 0;
		this.nbElemCurrent = numT;
		this.elementCurrent = this.element.find("#tab"+numT);

	},
	
	next : function()
	{
		var numT = this.nbElemCurrent+1;
		if(numT > this.nbTableau)
		{
			numT = 1;
		}
		this.gotoTab(numT);
	},
	
	prev : function()
	{
		var numT = this.nbElemCurrent-1;
		if(numT < 1)
		{
			numT = this.nbTableau;
		}
		this.gotoTab(numT);
	}
	
}



// D�s que Jquery est charg�, lancer ce script
$(function(){
	tableau.init($("#block"));
});