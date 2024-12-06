// public/js/session-check.js

setInterval(function() {
    fetch('/session-check')
        .then(response => {
            if (response.status === 401) { // セッションが切れた場合
                alert("セッションがタイムアウトしました。再ログインしてください。");
                window.location.href = '/login'; // ログインページにリダイレクト
            }
        });
}, 60000); // 1分ごとに確認

