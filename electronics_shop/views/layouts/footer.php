<div id="chat-box" style="height: 300px; overflow-y: scroll; border: 1px solid #ccc;">
    </div>
<input type="text" id="msg-input" placeholder="Nhập tin nhắn...">
<button onclick="sendMessage()">Gửi</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Hàm tải tin nhắn tự động mỗi 2 giây
    setInterval(function(){
        $.get("api/get_chat.php", function(data){
            let messages = JSON.parse(data);
            let html = "";
            messages.forEach(msg => {
                html += `<div><strong>User ${msg.sender_id}:</strong> ${msg.message}</div>`;
            });
            $("#chat-box").html(html);
        });
    }, 2000);

    // Hàm gửi tin nhắn
    function sendMessage() {
        let msg = $("#msg-input").val();
        $.post("api/send_chat.php", { message: msg }, function(data) {
            $("#msg-input").val(""); // Xóa ô nhập sau khi gửi
        });
    }
</script>