$(document).on('click','.btnCancelOrder',function(){
	var result = confirm('want to cancel ?');

	if(!result){
		return false;
	}
});