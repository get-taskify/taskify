<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //Get all news from DB

        $news = news::all();

        //Return all news

        $langs = parent::cutLocation($this->langs);

        return view('news.index', compact('news', 'langs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form

        return view('news.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //Check if inputs are correct/valid

        $request->validate([

            'text' => 'required|max:255'

        ]);

        //Create object of input

        news::create([

            'text' => $request->input('text'),
            'user_id' => $request->user()->id

        ]);

        //redirect to news.index

        return redirect()->route('home')->with('success', 'The news entry was created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function show(news $news) {

        //Get news with id

        $news = news::find($news->id);

        //Return specific news

        return view('news.show', compact('news'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(news $news) {

        //Show news form

        return view('news.edit', compact('news'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, news $news) {

        //Check if inputs are correct/valid

        $request->validate([

            'text' => 'required|max:255'

        ]);

        $news->update([

            'text' => $request->input('text'),

        ]);

        //redirect to news.index

        return redirect()->route('home')->with('success', 'The news entry has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(news $news) {

        //Delete news

        $news->delete();

        //Redirect to home

        return redirect()->route('home')->with('success', 'The news entry has been deleted.');

    }
}
