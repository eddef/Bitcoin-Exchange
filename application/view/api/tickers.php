<?php

if ($this->model->coins($market) == false):
	exit(json_encode(['success' => 0, 'error' => 'Invalid Pair Name:'.$market]]));
endif;

array
	(
		$market => array
			(
				'high' => System::escape($tickerHigh),
				'low' => System::escape($tickerLOW),
				'avg' => System::escape($tickerAVG),
				'vol' => System::escape($tickerVOL),
				'last' => System::escape($tickerLAST),
				'buy' => 'under construction',
				'buy' => 'under construction'
			)
	);
?>