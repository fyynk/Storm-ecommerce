$(document).ready(function (e){
	$("#imgDestaque").on('blur',(function(e){
		e.preventDefault();
		$.ajax({
			url: "upload.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log('esta entrando');
			$("#boxDestaque").empty().html(data);
			},
			error: function(){console.log('não está entrando');} 	        
		});
	}));
});