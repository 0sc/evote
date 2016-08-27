$(function(){
	 $("a.vote_icon").click(function(){
		 $(this).siblings("input[type=radio]").trigger("click");
		 
		 //$(this).addClass("voted_icon").removeClass("vote_icon");
	 });
	 
	 $("input[type=radio]").click(function(){
		 //reset everybody
		 $(this).parent("p").parent("div").siblings(".aspirant").each(function(){
			 $(this).children("p").children("a.voted_icon").removeClass("voted_icon").addClass("vote_icon");
		 });
		 
		 $(this).siblings("a").addClass("voted_icon").removeClass("vote_icon");
	 });
});
