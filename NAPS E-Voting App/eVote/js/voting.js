$(function(){
	 $(".vote_icon a,input[type=radio]").click(function(){
		 $(this).parent("span").addClass("voted_icon").removeClass("vote_icon");
		 
		 $(this).siblings("span").addClass("voted_icon").removeClass("vote_icon");
		 
		 var field = $(this).parent("span").siblings("input[type=radio]");
		 field.trigger("click");
		 
		 var field2 = $(this);
		 //reset others
		 field.parent("p").parent("div").siblings(".aspirant").each(function(){
			 $(this).children("p").children("span").addClass("vote_icon").removeClass("voted_icon");
		 });
		 field2.parent("p").parent("div").siblings(".aspirant").each(function(){
			 $(this).children("p").children("span").addClass("vote_icon").removeClass("voted_icon");
		 });
	 });
	 
	 $("#submitButton").click(function(){
		 $("form input[type=submit]").trigger("click");
	 });
	 
	 $("#resetButton").click(function(){
		 $("form input[type=reset]").trigger("click");
		 $("span.voted_icon").removeClass("voted_icon").addClass("vote_icon");
		 //close dialogue box
		 
	 });
});