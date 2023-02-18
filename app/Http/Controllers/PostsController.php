<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $values = $this->get_posts($request);
        return view('posts.index', ['posts' => $values['posts'], 'search' => $values['search'], 'output' => null]);
    }

    public function describeInstances(){

        $process = new Process(['ls', '-lsa']);
        $process->run();
        $output = $process->getOutput();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $values = $this->get_posts(null);
        return view('posts.index', ['output' => $output, 'posts' => $values['posts'], 'search' => $values['search']]);

    }

    public function get_posts($value){
        $search = '';
        if($value != null && $value->has('search')){
            $search = $value->search;
            $posts = Post::where('title', 'like', '%'.$search.'%')->get();
        }else{
            $posts = Post::all();
        }
        return ['posts' => $posts, 'search' => $search];
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
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect()->route('posts.index');
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
