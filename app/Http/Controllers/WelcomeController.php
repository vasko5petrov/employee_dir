<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostCategory;

use Illuminate\Http\Request;

use App\Http\Requests;
use Datetime;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function formatDateToView($date) {
        $dateFormat = new DateTime($date);
        return date_format($dateFormat, 'd F Y H:m');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->take(5)->get();
        foreach ($posts as $index => $post) {
            $postedOn[$index] = WelcomeController::formatDateToView($post->created_at);
        }
        return view('welcome', compact('posts', 'postedOn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
