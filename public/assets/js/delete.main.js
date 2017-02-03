$(document).ready(function(){
	$('.delete').click(function(){
		$('.delete_one').attr('href',$(this).attr('data-href'));
	})
})