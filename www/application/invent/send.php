<?php
/*
 * Copyright (C) 2010 Urban Suppiger, Pirmin Mattmann
 *
 * This file is part of eCamp.
 *
 * eCamp is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * eCamp is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with eCamp.  If not, see <http://www.gnu.org/licenses/>.
 */

	$email = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $_REQUEST['email'] ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
	$from  = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"],  $_REQUEST['from']  ) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
	$text  = $_REQUEST['text'];
	
	if( !filter_var( $email, FILTER_VALIDATE_EMAIL) )
	{
		header( "location: index.php?app=invent" );
		die();
	}
	
	//	SEND MAIL:
	// ============
	if( $from == "support" )
	{	$from = "From: eCamp Pfadi Luzern <ecamp@pfadiluzern.ch>";	}
	else
	{	$from = "From: " . $_user->display_name . " " . $_user->mail;	}
	
	ecamp_send_mail($email, "eCamp - Einladung von " . $_user->display_name, $text);
	//mail( $email, "eCamp - Einladung von " . $_user->display_name, $text, $from );
	
	header( "location: index.php?app=invent" );
	die();
	