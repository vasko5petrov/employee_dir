<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostCategory;
use App\Http\Requests;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function categoriesNames() {
        return ['Default', 'Info', 'Attention', 'Very Important', 'Extremly Important'];
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $post_search_title = $request->get('post-search-title');
        $query = Post::where('title', 'like', '%' . $post_search_title . '%');
        $posts = $query->orderBy('created_at', 'desc')->paginate(7)->appends([
            'search' => $search,
            'post-search-title' => $post_search_title
        ]);

        $categories = PostCategory::all();
        $importanceLabels = ['success', 'info', 'primary' , 'warning', 'danger'];

        foreach($categories as $key => $cat){
            $number_posts[$key] = count($cat->posts);
        }

        return view('posts.index', compact('posts', 'categories', 'importanceLabels', 'number_posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addForm()
    {
        $categories = PostCategory::all();

        return view('posts.addPostForm', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // Customize validation messages
        $messages = [
            'post-title.required' => 'The title field is required.',
            'post-body.required' => 'The body field is required.',
            'image.image' => 'Please upload an image.',
            'image.max' => 'Please upload an image with max size 2048KB.'
        ];

        // Validation rules
        $rules = [
            'post-title' => 'required|string',
            'post-body' => 'required|string',
            'image' => 'image|max:2048'
        ];

        // Make validation
        $this->validate($request, $rules, $messages);

        $post_title = $request->input('post-title');
        $post_body = $request->input('post-body');
        $post_category_id = $request->input('post-category-id');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img_name = $image->getClientOriginalName();
            $post_cover_image = time() . '.' . $img_name;
            $image->move('uploads/posts', $post_cover_image);
        } else {
            $post_cover_image = 'cover-image-default.jpg';
        }

        // Insert new employee record into database
        $post = new Post();
        $post->title = $post_title;
        $post->body = $post_body;
        $post->post_category_id = $post_category_id;
        $post->cover_image = 'uploads' . '/posts/' . $post_cover_image;
        $post->save();

        // Create success flag
        $flag = true;

        $categories = PostCategory::all();

        return view('posts.addPostForm', compact('flag', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*
         *  --- PDF Viewing ---
         *
         *  $filename = 'test.pdf';
         *  $path = 'uploads/images/'.$filename;
         *
         *  return Response::make(file_get_contents($path), 200, [
         *      'Content-Type' => 'application/pdf',
         *      'Content-Disposition' => 'inline; filename="'.$filename.'"'
         *  ]);
         *
         */

        $post = Post::find($id);

        $categories = PostCategory::all();
        $categories = $categories->sortBy('id')->values()->all();

        $post_category_name = null;
        $post_category_importance = null;

        foreach($categories as $index => $cat) {
            if($cat->id == $post->post_category_id) {
                $post_category_name = $cat->name;
                $post_category_importance = $cat->importance;
                $tmp = $categories[0];
                $categories[0] = $categories[$index];
                $categories[$index] = $tmp;
            }
        }

        $importanceLabels = ['success', 'info', 'primary' , 'warning', 'danger'];

        return view('posts.showPost', compact('post', 'post_trunc', 'post_category_name', 'post_category_importance', 'categories', 'importanceLabels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        $post = Post::find($id);

        $categories = PostCategory::all();
        $categories = $categories->sortBy('id')->values()->all();

        $post_category_name = null;

        foreach($categories as $index => $cat) {
            if($cat->id == $post->post_category_id) {
                $post_category_name = $cat->name;
                $tmp = $categories[0];
                $categories[0] = $categories[$index];
                $categories[$index] = $tmp;
            }
        }

        $categoriesNames = PostsController::categoriesNames();

        return view('posts.editPostForm', compact('post', 'categories', 'categoriesNames', 'post_category_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // Customize validation messages
        $messages = [
            'post-title.required' => 'The title field is required.',
            'post-body.required' => 'The body field is required.',
            'image.image' => 'Please upload an image.',
            'image.max' => 'Please upload an image with max size 2048KB.'
        ];

        // Validate
        // If success, continue
        // Else, flash errors to the session
        $this->validate($request,[
            'post-title' => 'required|string',
            'post-body' => 'required|string',
            'image' => 'image|max:2048'
        ], $messages);

        $post_id = $request->input('post-id');
        $new_post_title = $request->input('post-title');
        $new_post_body = $request->input('post-body');
        $new_post_category_id = $request->input('post-category-id');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img_name = $image->getClientOriginalName();
            $upload_name = time() . '.' . $img_name;
            $new_post_cover_image = 'uploads/images/' . $upload_name;
            $image->move('uploads/images', $upload_name);
        }

        // Find the post with provided id
        $post = Post::find($post_id);

        if (!isset($new_post_cover_image) && $post->title == $new_post_title && $post->body == $new_post_body && $post->post_category_id == $new_post_category_id) {
            $result = 'Article information remains unchanged!';
            $alert_type = 'warning';
        }
        else {
            // Update to database
            $post->title = $new_post_title;
            $post->body = $new_post_body;
            $post->post_category_id = $new_post_category_id;
            if (isset($new_post_cover_image)) $post->cover_image = $new_post_cover_image;
            $post->save();

            // Create alert message to flash back to session
            $result = 'Article information successfully updated!';
            $alert_type = 'success';
        }

        $categories = PostCategory::all();
        $categories = $categories->sortBy('id')->values()->all();

        $post_category_name = null;

        foreach($categories as $index => $cat) {
            if($cat->id == $post->post_category_id) {
                $post_category_name = $cat->name;
                $tmp = $categories[0];
                $categories[0] = $categories[$index];
                $categories[$index] = $tmp;
            }
        }


        return view('posts.editPostForm', compact('result', 'alert_type', 'post', 'categories', 'post_category_name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $delete_id = $request->input('post-id');
        if (is_numeric($delete_id)) {
            try {

                // Find post and delete
                $post = Post::find($delete_id);
                if ($post->cover_image != 'uploads/posts/cover-image-default.jpg') {
                    unlink($post->cover_image);
                }
                $post->delete();
            }
            catch (\PDOException $exception) {
                return Response::make('Error! '.$exception->getCode());
            }
        }
        return redirect('/posts');
    }
}
