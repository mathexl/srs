<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Deck as Deck;
use App\Flashcard as Flashcard;
use Auth;

class DeckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.deck.view', ['only' => 'addCard']);
        $this->middleware('auth.deck.edit', ['only' => 'storeCard']);
    }
    
    /**
     * Show the form for creating a new deck.
     *
     * @return Response
     */
    public function create()
    {
        return view('deck.create');       
    }

    public function store(Request $request)
    {
        $deck = Deck::create([
            'name' => $request->name
        ]);

        Auth::user()->decks()->save($deck, ['permissions' => 'edit']);
        $id = $deck->id;
        return redirect()->action('DeckController@addCard', [$id]);
    }

    /**
     * Add a card to the deck.
     */
    public function addCard($id)
    {
        $deck = Deck::find($id);
        return view('deck.add')->with(['id' => $id, 'deck' => $deck]);
    }

    public function storeCard(Request $request)
    {
        $id = $request->id;
        $deck = Deck::find($id);

        if($request->front && $request->back) {
            $card = Flashcard::create([
                'front' => $request->front,
                'back' => $request->back,
                'deck_id' => $request->id
            ]);

            $deck->flashcards()->save($card);            
        }

        return redirect()->action('DeckController@addCard', [$id]);;
    }
}