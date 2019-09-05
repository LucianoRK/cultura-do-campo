<?php

if (isset($_COOKIE["REMEMBER_ME"])) {
    $o_cookie = new Cookie();
    $o_cookie->delete_cookie($_COOKIE["REMEMBER_ME"]);
    setcookie("REMEMBER_ME", "", time() - 3600, "/");
}

session_destroy();
header("location: ./");
