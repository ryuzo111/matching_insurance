const receiveUserId = $('#chat-data').data('receiveUserId');
const loginId = $('#chat-data').data('sendUserId');
const baseURL = $('#chat-data').data('baseUrl');

const Chat = {
	data() {
		return {
			newChat: "",
			chats: [],
			last: null,
			editIndex: -1, //入力テキストの最終更新日
			receiveUserId: receiveUserId,
			loginId: loginId,
		}
	},
	methods: {
		send() {
			if (this.editIndex === -1) {
				if (!vm.last) {
					vm.last = {
						created_at: "1970-01-01 00:00:00"
					}
				}
				sendMessage(this.newChat, vm.last.created_at, receiveUserId, loginId);
				this.newChat = "";

			} else {
				console.log(this.created_at);
				editMessage(this.newChat, this.created_at, receiveUserId, loginId);
			}
		},
		remove: function (created_at, index) {
			removeMessage(created_at, receiveUserId, loginId);
			this.chats.splice(index, 1);
		},
		edit: function (index) {
			this.editIndex = index;
			this.newChat = this.chats[index].message;
			this.created_at = this.chats[index].created_at;
			this.$refs.editor.focus();
		},
		cancel() {
			this.newChat = "";
			this.editIndex = -1;
		}


	},
	computed: {
		changeButtonText() {
			return this.editIndex === -1 ? "追加" : "編集";
		}
	}
}
vm = Vue.createApp(Chat).mount('#chat')

getMessages(true);

function getMessages() {
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	})

	$.ajax({
		type: "GET",
		url: baseURL + `chat/${receiveUserId}/${loginId}/messages_list_api`,
		dataType: "json",
		// data: { "created_at":date }
	}).done(function(results) {
		console.log('メッセージの取得に成功')
		addChat(results)
	}).fail(function(jqXHR, textStatus, errorThrown) {
		alert('メッセージの取得に失敗しました')
		console.log('ajax通信に失敗しました')
		console.log("jqXHR : " + jqXHR.status )
		console.log("textStatus : " + testStatus )
	})
	// setTimeout("getMessages()", 5000);
}

//ブラウザで表示するために取得した情報を追加
function addChat(results) {

	$.each(results.chats, function() {
		vm.chats.push(this);
		vm.last = this; //最終更新日を入れる→Chat.last.created_atでアクセス
		if (this.receive_user_id == loginId) {
			// vm.activeAlign = 'left';
			console.log('これはreceive_userのメッセージです')
		} else {
			// vm.activeAlign = 'right';
			console.log('これはlogin_userのメッセージです')
		}

	})
	vm.$forceUpdate();
}

//サーバに新規メッセージを送信
function sendMessage(message, created_at, receiveUserId, sendUserId) {
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	})
	$.ajax({
		type: "POST",
		url: `${baseURL}chat/${receiveUserId}/${sendUserId}/send_message_api`,
		dataType: "json",
		data: { "message": message, "created_at": created_at, "receive_user_id": receiveUserId, "send_user_id": loginId}
	}).done(function(results) {
		console.log("メッセージ追加成功")
		console.log('results=', results)
		addChat(results)
	}).fail(function(jaXHR, textStatus, errorThrown) {
		alert('メッセージ送信に失敗しました')
		console.log('ajax通信に失敗しました。')
		console.log('jaXHR : ' + jaXHR.status)
		console.log('textStatus : ' + textStatus)
	})
}

//サーバでメッセージを削除
function removeMessage(created_at, receiveUserId, sendUserId) {
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({
		type: "POST",
		url: `${baseURL}chat/${receiveUserId}/${sendUserId}/remove_message_api`,
		dataType: "json",
		data: { "created_at": created_at, "receive_user_id": receiveUserId, "send_user_id": loginId}
	}).done(function() {
		console.log("メッセージ削除成功");
	}).fail(function(jaXHR, textStatus, errorThrown) {
		alert('メッセージ削除に失敗しました')
		console.log('ajax通信に失敗しました。')
		console.log('jaXHR : ' + jaXHR.status)
		console.log('textStatus : ' + textStatus)
	});
}

//サーバでメッセージを編集
function editMessage(message, created_at, receiveUserId, sendUserId) {
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	});
	$.ajax({
		type: "POST",
		url: `${baseURL}chat/${receiveUserId}/${sendUserId}/edit_message_api`,
		dataType: "json",
		data: { "message": message, "created_at": created_at, "receive_user_id": receiveUserId, "send_user_id": sendUserId}
	}).done(function(results) {
		console.log("メッセージ編集成功");
		console.log("results=", results);
		changeMessage(results);
	}).fail(function(jaXHR, textStatus, errorThrown) {
		alert('メッセージ編集に失敗しました');
		console.log('ajax通信に失敗しました');
		console.log('jaXHR : ' + jaXHR.status);
		console.log('textStatus : ' + textStatus);
	});
}

function changeMessage(results) {
	console.log('changeMessage起動');
	console.log(results.chats);
	$.each(results.chats, function () {
		vm.chats.splice(vm.editIndex, 1, this);
	});

	//入力文字と編集用のフラグをクリア
	vm.cancel();
	//DOMの再評価
	vm.$forceUpdate();
}
