function getProfile(topic,pageNum){
	$(document).ready(function(){
		$.ajax({
			type:"GET",
			url:"https://f.dan-shen.dog/api/forum/"+topic+"?&count=9&page="+pageNum+"&sort=reply_time_dsc",
			dataType:"json",
			success: function(data){
				if(!data.status){
					for(var i=0;i<10;i++){
					$("."+topic+"profileTitle"+i).html(data[i].title),
					$("."+topic+"profileAuthor"+i).html(data[i].author);
					}
				}
				else{
					alert(data.reason);
				}
			},
			error: function(jqXHR){
				alert("出错："+jqXHR.status);
			},
		});
	});
};