<?php

/*** Define constant ***/
require_once "config/config.php";

/*** Process URL from browser ***/
require_once "core/router.php";

/*** How controllers call Views & Models ***/
require_once "core/controller.php";

/*** Connect Database ***/
require_once "core/model.php";

/*** Config url ***/
require_once "config/base_url.php";

/*** Request ***/
require_once "core/request.php";
