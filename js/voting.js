$(function(){
	 $("a.vote_icon").click(function(){
		 $(this).siblings("input[type=radio]").trigger("click");
	 });
	 
	 $("input[type=radio]").click(function(){
		 //reset everybody
		 $(this).parent("p").parent("div").siblings(".aspirant").each(function(){
			 $(this).children("p").children("a.voted_icon").removeClass("voted_icon").addClass("vote_icon");
		 });
		 
		 $(this).siblings("a").addClass("voted_icon").removeClass("vote_icon");
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