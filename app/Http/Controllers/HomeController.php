<?php

namespace Dixit\Http\Controllers;

use Illuminate\Http\Request;

use Dixit\Http\Requests;
use Dixit\Http\Controllers\Controller;

use Dixit\Card;

use DebugBar;

class HomeController extends Controller {

    protected $cards;

    public function __construct(Card $_cards)
    {
        $this->cards=$_cards;
        $this->middleware('auth');
    }

    public function getIndex()
    {
        //Debugbar::error("error");
        return view('home')->with('cards', $this->cards->all());
    }

    public function postImageByID(Request $request)
    {
        $validator = $this->validate($request, [
            'id' =>  'integer',
        ]);

        $id = $request->input('id');

        $countCards = Card::count();

        $id = $id % $countCards;

        if ($id <= 0)
        {
            $id += $countCards;
        }

        return(Card::where('pk_id',$id)->first()->name);

    }

    public function getImageByID($cardId)
    {

        $countCards = Card::count();

        $cardId = $cardId % $countCards;

        if ($cardId <= 0)
        {
            $cardId += $countCards;
        }

        return(Card::where('pk_id',$cardId)->first()->name);

    }
}
