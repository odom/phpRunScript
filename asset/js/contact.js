socket = io.connect('http://54.221.195.231:5000');

var message = {
	"Header": {
		"From": "",
		"To": "",
		"DateTime": "",
		"PartnerID": "",
		"DeviceType": "",
		"DeviceOS": "",
		"FromIP": "",
		"Region": "enUS"
	},
	"Body": {
		"ID": "",
		"ObjectType": "1000",
		"Action": "100"
	}
}
/*
* Socket function
* */
var searchUser = function(AccessKey, Username){
		var input = {
			"AccessKey" : AccessKey,
			"UserName" : Username,
			"Limit" : "10",
			"Offset" : ""
		}
		console.log(input);
		message.Body.Data = input;
		socket.emit('searchUser', JSON.stringify(message));
		socket.on('searchUser-result', function(result) {
			var output = JSON.parse(result);
			var usageData = JSON.parse(output.Body.Data);
			if(usageData.code == "1"){
				console.log('--------------- search users success ---------------');
				listSearchUserResult(usageData.data);
			}
		});
};
var addFriend = function(ele){
	console.log('------------- add friend -------------------')
	userId = $(ele).data('friendid');
	accKey = $.cookie('AccessKey')
	var input = {
		"UserID" : userId,
		"AccessKey" : accKey
	}
	message.Body.Data = input;
	socket.emit('addFriend', JSON.stringify(message));
	socket.on('addFriend-result', function(result) {
		var output = JSON.parse(result);
		var usageData = JSON.parse(output.Body.Data);
		if(usageData.code == "1"){
			console.log('--------------- add friend success ---------------');
//			listSearchUserResult(usageData.data);
			$(ele).addClass('hidden')

		}
	});
	return false;
}
/* End Socket function */

/**
 * View function
 * */
var listSearchUserResult = function (content) {
	console.log('--------------------- listSearchUserResult -----------------------');
	console.log(content);
	string = '';
	defaultAvatar = '../asset/images/icons/profile_02.png'
	var boxListUserResult = $('#listSearchUserResult');
	for (i=0 ; i < content.length ; i++){
		avatar = (content[i].ImageAvatar !="")? content[i].ImageAvatar : defaultAvatar;
		string += '<a onclick="addFriend(this)" class="list-group-item first friend-item" data-friendid="'+content[i].UserID+'">';
		string += '<img src="'+avatar+'" class="img-circle my" alt=""/>';
		string += '<p>' +content[i].DisplayName+ '</p>';
		string += '<img src="/asset/images/icons/logo_superchat_01_realSize.png" class="img-circle myimg" alt=""/>';
		string += '<img src="/asset/images/icons/select_contact_on_01.png" class="img-circle myimg" alt=""/>';
		string += '</a>';
	}

	boxListUserResult.html(string);
}

/* End View Function */
$(document).ready(function () {
	console.log('---------------------- contact.js --------------------------------')
	var AccessKey = $.cookie('AccessKey');
	$('.search').keyup(function(e){
		if (e.keyCode == 13) {
			$('.icon-search').trigger( "click" );
		}
		return true;
	});

	$('.icon-search').click(function(){
		var Username = $('.search').val();
		searchUser(AccessKey, Username);
	});

});
