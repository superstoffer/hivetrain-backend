<?php

namespace App\Http\Controllers;


use App\Models\Trade;
use App\Models\User;
use App\Models\UserTrade;
use Illuminate\Http\Request;

class TradeController extends Controller
{
	private $headers = [
		'Access-Control-Allow-Origin' => '*',
	];

	public function getTrades()
	{
		$trades = Trade::all();

		return response()->json($trades->toArray(), 200, $this->headers);
    }

	public function getTradesByCategory($cat)
	{
		$trades = Trade::where('category', '=', $cat)->get();

		foreach($trades as &$trade)
		{
			$trade = $trade->toArray();
		}

		return response()->json($trades->toArray(), 200, $this->headers);
	}

	public function postTrade(Request $request)
	{
		try {
			$trade = new Trade();

			$trade->open = $request->get('open');
			$trade->close_price = $request->get('close_price');
			$trade->close_time = $request->get('close_time');
			$trade->pool_size = $request->get('pool_size');
			$trade->category = $request->get('category');
			$trade->created_at = date('Y-m-d');

			$trade->save();

			return response()->json($trade->id, 200, $this->headers);
		}
		catch(\Exception $ex)
		{
			return response()->json([], 400, $this->headers);
		}
	}

	public function deleteTrade($id)
	{
		$trade = Trade::find($id);

		if(is_null($trade))
		{
			return response()->json([], 404, $this->headers);
		}
		else
		{
			$trade->delete();

			return response()->json($id, 200, $this->headers);
		}
	}

	public function addUserToTrade(Request $request, $user_id, $trade_id)
	{
		$trade = Trade::find($trade_id);
		$user = User::find($user_id);

		if(is_null($trade) || is_null($user))
		{
			return response()->json([], 404, $this->headers);
		}
		else
		{
			try {
				$user_trade = new UserTrade();
				$user_trade->user_id = $user_id;
				$user_trade->trade_id = $trade_id;
				$user_trade->risk = $request->get('risk');
				$user_trade->user_position = 0;
				$user_trade->save();

				return response()->json($user_trade->id, 200, $this->headers);
			}
			catch(\Exception $ex)
			{
				return response()->json([], 400, $this->headers);
			}
		}
	}

	public function getStocks($name)
	{
		$client = new \Scheb\YahooFinanceApi\ApiClient();

		$data = $client->getQuotesList($name); //Single stock

		return response()->json($data, 200, $this->headers);

	}
}