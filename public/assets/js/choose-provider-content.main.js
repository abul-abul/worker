$(document).ready(function(){
	$('.choose_btn').click(function(){
		var providerId = $(this).attr('alt'),
			token = $('#token_task').attr('data');

		window.money = $(this).next().next().next().children().text(),
		window.description = $(this).parent().next().text();
		money = money.split(' ');
		money = money[1];
		$.ajax({
			url:'/seeker/choose-provider/'+providerId,
			type: 'GET',
		    headers: {'X-CSRF-TOKEN': token},
		    success:function(data){
		    	var content = '<div class="modal-header">Are you sure you want to choose '+data.provider.first_name+'?<button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body user-info"><img class="avatar" src="/assets/uploads/'+data.provider.profile_img+'" alt=""><h4 class="modal-title">'+data.provider.first_name+'</h4></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">No</button><button type="button" class="btn btn-success" id="choose_success" data-id="'+data.provider.id+'" data-dismiss="modal">Yes</button></div></div>';
		    	$('#provider_choose_content').html(content);
		    	$('#choose-provider-modal').modal('show')
		    }
		})
	})

	$(document).on('click','#choose_success',function(){
		var providerId = $(this).attr('data-id'),
			taskId = $('#task_id').attr('data'),
			token = $('#token_task').attr('data');
		$.ajax({
			url:'/seeker/add-provider-task',
			type: 'GET',
			data:{'provider_id':providerId,'task_id':taskId,'money':money,'description':description},
		    headers: {'X-CSRF-TOKEN': token},
		    success:function(data){
		    	//location.reload();
		    	$("html, body").animate({scrollTop: "0"},1000);

		    	$('.noticication_create_provider').fadeIn(500)
		    	setTimeout(function(){
		    		location.reload();
		    	},2000)
		    }
		})
	})

	$(document).on('click','.choose_another',function(){
		$('#choos_step2').fadeOut();
		$('#choos_step1').fadeIn();
	})

	

	
})