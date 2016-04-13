$(document).ready(function(){
						   
				$('.projectbox').hover(function(){ 
					
				$(this).children('.projectintro').stop().animate({opacity:'1',marginTop:'-70px'},150);

				$(this).children('.projectpic').stop().animate({opacity:"0.3"},200);
 
	
},



function(){
    $(this).children('.projectintro').stop().animate({opacity:'0',marginTop:'-70px'},150);
	 
    $(this).children('.projectpic').stop().animate({opacity:"1"},200);
 
   
	 
});				   
						   
});

$("#navi1").click(function(){ 
$('body,html').animate({scrollTop:0}, 800); 
});

$("#navi2").click(function(){ 
$('body,html').animate({scrollTop:633}, 800); 
});

$("#navi3").click(function(){ 
$('body,html').animate({scrollTop:1470}, 800); 
});
