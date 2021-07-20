$(function() {
	get_data();
});
    
function get_data() {
	const receive_user_id = $('#chat-data').data('receiveUserId');
	const login_id = $('#chat-data').data('sendUserId');
	const base_url = $('#chat-data').data('baseUrl');
	
	$.ajax({
		type: "GET",
		url: `${base_url}/public/chat/${receive_user_id}/${login_id}/ajax`,
		dataType: "json",
		success: data => {
			//作成済みの要素を削除する
			$("#chat-data")
				.find(".chat-visible")
				.remove();
			
			//受信者プロフィール画像までのパスを作成
			if (data.receive_user.image_pass) {
				receive_user_image = `${base_url}/public/storage/image/${data.receive_user.image_pass}`
			} else {
				receive_user_image = `${base_url}/public/storage/default/default.jpeg`
			}
			//送信者プロフィール画像までのパスを作成
			if (data.send_user.image_pass) {
				send_user_image = `${base_url}/public/storage/image/${data.send_user.image_pass}`
			} else {
				send_user_image = `${base_url}/public/storage/default/default.jpeg`
			}

			//5秒毎にAPIからChatデータを取得しレンダリングする
			for (var i = 0; i < data.chats.length; i++) {
				var html = `<div class="chat-visible" style="border: solid">`;
						
				console.log(data.send_user.image_pass);
				if (data.chats[i].send_user_id == login_id) {
					html += `
						<div align="right" style="background-color: white;">
							<img src="${send_user_image}" alt="" width="10">
							${data.chats[i].message}
							${data.chats[i].created_at}
						</div>
					`;
				} else {
					html += `
						<div align="left" style="background-color: lightyellow;">
							<img src="${receive_user_image}" alt="" width="10">
							${data.chats[i].message}
							${data.chats[i].created_at}
						</div>
					`;
				}
				html += `</div>`
				$("#chat-data").append(html);
			}
		},
		error: () => {
			html = `
				<div class="chat-visible" align="left" style="background-color: red; border: solid">
					問題が発生しました。
				</div>
			`;
		}
	});

	setTimeout("get_data()", 5000);
}