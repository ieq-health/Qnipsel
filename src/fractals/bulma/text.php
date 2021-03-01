<?php

function templateq_text_block($text)
{
	return '<div class="content">' . wpautop($text) . '</div>';
}
