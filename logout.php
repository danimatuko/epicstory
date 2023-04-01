<?php

// Initialize the session.
require "includes/init.php";

Auth::logout();

header("Location: index.php");
