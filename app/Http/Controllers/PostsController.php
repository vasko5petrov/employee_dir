<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostCategory;
use App\Http\Requests;
use Response;
use Datetime;

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

    public function getImageSize($path) {
        $dimensions = getimagesize($path);
        return $dimensions;
    }

    public function formatDateToView($date) {
        $dateFormat = new DateTime($date);
        return date_format($dateFormat, 'd F Y H:m');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $post_search_title = $request->get('post-search-title');
        $post_search_cat = $request->get('post-search-cat');
        $query = Post::where('title', 'like', '%' . $post_search_title . '%');
        if(count($query->get()) == 0) {
            $query = Post::where('body', 'like', '%' . $post_search_title . '%');
        }
        if ($post_search_cat != '') {
            $query = $query->where('post_category_id', '=', $post_search_cat);
        }
        $posts = $query->orderBy('created_at', 'desc')->paginate(7)->appends([
            'search' => $search,
            'post-search-title' => $post_search_title,
            'post-search-cat' => $post_search_cat
        ]);

        $categories = PostCategory::all();
        $importanceLabels = ['success', 'info', 'primary' , 'warning', 'danger'];

        foreach($categories as $key => $cat){
            $number_posts[$key] = count($cat->posts);
        }

        $imagesPaths = [];

        foreach ($posts as $index => $post) {
            array_push($imagesPaths, $post->cover_image);

            $postedOn[$index] = PostsController::formatDateToView($post->created_at);
        }

        foreach ($imagesPaths as $key => $value) {
            $imageSizes[$key] = PostsController::getImageSize($value);
        }

        return view('posts.index', compact('postedOn', 'imageSizes', 'posts', 'categories', 'importanceLabels', 'number_posts', 'post_search_title', 'post_search_cat'));
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
            'post-category-id.required' => 'The category field is required.',
            'image.image' => 'Please upload an image.',
            'image.max' => 'Please upload an image with max size 2048KB.',
        ];

        // Validation rules
        $rules = [
            'post-title' => 'required|string',
            'post-body' => 'required|string',
            'image' => 'image|max:2048',
            'post-category-id' => 'required|integer'
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

        $files_array = [];

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $file_count = count($files);

            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                $attached_files = $filename;
                $file->move('uploads/posts/document_files/', $attached_files);
                array_push($files_array, 'uploads/posts/document_files/' . $attached_files);
            }
        }

        $serialized_files_array = json_encode($files_array);

        // Insert new employee record into database
        $post = new Post();
        $post->title = $post_title;
        $post->body = $post_body;
        $post->post_category_id = $post_category_id;
        $post->cover_image = 'uploads' . '/posts/' . $post_cover_image;
        $post->attached_files = $serialized_files_array;
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
                $post_category_id = $cat->id;
                $tmp = $categories[0];
                $categories[0] = $categories[$index];
                $categories[$index] = $tmp;
            }
        }
        $unserialized_files_array = [];
        if($post->attached_files != null){
            $unserialized_files_array = json_decode($post->attached_files);

            $filesNames = [];
            foreach ($unserialized_files_array as $key => $value) {
                $filename = pathinfo($value);
                array_push($filesNames, $filename);
            }
        }

        $post_search_category_id = $post_category_id;
        $query = Post::where('post_category_id', 'like', '%' . $post_search_category_id . '%')->where('id', '!=' , $id);
        $posts = $query->orderBy('created_at', 'desc')->take(3)->get();
        foreach ($posts as $index => $cat_post) {
            $cat_postedOn[$index] = PostsController::formatDateToView($cat_post->created_at);
        }

        $importanceLabels = ['success', 'info', 'primary' , 'warning', 'danger'];

        $postedOn = PostsController::formatDateToView($post->created_at);

        return view('posts.showPost', compact('cat_postedOn', 'postedOn', 'unserialized_files_array', 'filesNames','posts', 'post', 'post_trunc', 'post_category_name', 'post_category_importance', 'post_category_id', 'categories', 'importanceLabels', 'file'));
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
            'post-category-id.required' => 'The category field is required.',
            'image.image' => 'Please upload an image.',
            'image.max' => 'Please upload an image with max size 2048KB.'
        ];

        // Validate
        // If success, continue
        // Else, flash errors to the session
        $this->validate($request,[
            'post-title' => 'required|string',
            'post-body' => 'required|string',
            'post-category-id' => 'required|integer',
            'image' => 'image|max:2048'
        ], $messages);

        $post_id = $request->input('post-id');
        $post = Post::find($post_id);
        $new_post_title = $request->input('post-title');
        $new_post_body = $request->input('post-body');
        $new_post_category_id = $request->input('post-category-id');

        if ($request->hasFile('image')) {
            if($post->cover_image != 'uploads/posts/cover-image-default.jpg'){
                unlink($post->cover_image);
            }
            $image = $request->file('image');
            $img_name = $image->getClientOriginalName();
            $upload_name = time() . '.' . $img_name;
            $new_post_cover_image = 'uploads/posts/' . $upload_name;
            $image->move('uploads/posts', $upload_name);
        }

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $file_count = count($files);

            if($post->attached_files != null){
                $unserialize_files = json_decode($post->attached_files);
                for ($i=0; $i < count($unserialize_files); $i++) { 
                    unlink($unserialize_files[$i]);
                }
            }
            $files_array = [];
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                $attached_files = $filename;
                $file->move('uploads/posts/document_files/', $attached_files);
                array_push($files_array, 'uploads/posts/document_files/' . $attached_files);
            }
            $serialized_files_array = json_encode($files_array);
        } else {
            $serialized_files_array = $post->attached_files;
        }

        // Find the post with provided id
        $post = Post::find($post_id);

        if (!isset($new_post_cover_image) && $post->attached_files == $serialized_files_array && $post->title == $new_post_title && $post->body == $new_post_body && $post->post_category_id == $new_post_category_id) {
            $result = 'Article information remains unchanged!';
            $alert_type = 'warning';
        }
        else {
            // Update to database
            $post->title = $new_post_title;
            $post->body = $new_post_body;
            $post->post_category_id = $new_post_category_id;
            if (isset($new_post_cover_image)) $post->cover_image = $new_post_cover_image;
            if (isset($serialized_files_array)) $post->attached_files = $serialized_files_array;
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
                if (isset($post->attached_files)) {
                    $unserialize_files = json_decode($post->attached_files);
                    for ($i=0; $i < count($unserialize_files); $i++) { 
                        unlink($unserialize_files[$i]);
                    }
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
