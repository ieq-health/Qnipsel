<?php

function templateq_code_block($lang, $code)
{
	return '<pre><code data-language="' . $lang . '">'. $code . '</code></pre>';
}