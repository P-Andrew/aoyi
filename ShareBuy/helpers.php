<?php

namespace ShareBuy;

////////////////////////////////////////////////////////////////

function shop_name():string
{
	return strtok( app('request')->getHost(), '.' );
}

function shop_id():string
{
	return Models\Shop::named( shop_name() )->value( 'id' );
}
