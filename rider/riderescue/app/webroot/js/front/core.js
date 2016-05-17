/* Bx Slider Homepage Banner  */

$(document).ready(function(){
    $('#navTrigger').click(function(){
		if($("#nav").hasClass('active')){
			$("#nav").animate({"left":"-400px"}).removeClass('active');
			$("#navTrigger").animate({"left":"0px"}).removeClass('active');
		} else {
			$("#nav").animate({"left":"0px"}).addClass('active');
			$("#navTrigger").animate({"left":"0px"}).addClass('active');
		}
  });
});