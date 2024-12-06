// app/Http/Middleware/Authenticate.php
<?php

protected function redirectTo($request)
{
    if (!$request->expectsJson()) {
        return route('login'); // ログインページにリダイレクト
    }
}

