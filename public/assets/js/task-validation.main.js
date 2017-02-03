$(document).ready(function(){
	$('.save_task').click(function(){
		var data = [];
		var token = $('#token_task').attr('data');
		$('.task_validation').each(function () {
			data[$(this).attr('name')] = $(this).val()
		});
		$.ajax({
			url:'/provider/task-detal-validation',
			type: 'POST',
			data: { 'description': data['description'],'money':data['money']},
		    headers: {'X-CSRF-TOKEN': token},
		    success:function(data){
		    	$('.validator').hide();
	    		$('.validator').html('');
		    	if(data.errors){
		    		var html_content = '';
		    		$.each(data.errors, function(i,v){
		    			html_content += "<li>"+v+"</li>" 
		    		})
		    		$('.validator').show();
		    		$('.validator').html("<li><b>Ops, something went wrong.</b></li>"+html_content);
		    	}else if(data.error_reg){
	    			$('.task-attach').submit();
	    		}
	    	}
		})
	})
})