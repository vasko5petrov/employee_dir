<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostCategory;
use App\Post;
use App\Http\Requests;

use Illuminate\Validation\Validator;
use Symfony\Component\Finder\Iterator\DepthRangeFilterIterator;


class PostsCategoriesController extends Controller
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
        $cat_search_name = $request->get('cat-search-name');
        $query = PostCategory::where('name', 'like', '%' . $cat_search_name . '%');
        $postsCategories = $query->orderBy('created_at', 'desc')->paginate(15)->appends([
            'search' => $search,
            'cat-search-name' => $cat_search_name
        ]);

        $categoriesNames = PostsCategoriesController::categoriesNames();

        return view('posts.categories.index', compact('postsCategories', 'categoriesNames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addForm()
    {
        //
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
            'category-name.required' => 'The name field is required.',
            'category-importance.required' => 'The importance field is required.'
        ];

        // Validate
        // If success, continue
        // Else, flash errors to the session
        $this->validate($request,[
            'category-name' => 'required|string',
            'category-importance' => 'required|integer'
        ], $messages);

        // Insert new category record to DB
        $cat_name = $request->input('category-name');
        $cat_importance = $request->input('category-importance');

        $categories = new PostCategory();
        $categories->name = $cat_name;
        $categories->importance = $cat_importance;
        $categories->save();

        // Get Categories
        $search = $request->get('search');
        $cat_search_name = $request->get('cat-search-name');
        $query = PostCategory::where('name', 'like', '%' . $cat_search_name . '%');
        $postsCategories = $query->orderBy('created_at', 'desc')->paginate(15)->appends([
            'search' => $search,
            'cat-search-name' => $cat_search_name
        ]);

        // Create success flag
        $flag1 = true;

        return redirect('/posts/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post_search_category_id = $id;
        $query = Post::where('post_category_id', 'like', '%' . $post_search_category_id . '%');
        $posts = $query->orderBy('created_at', 'desc')->paginate(3);

        $categories = PostCategory::all();

        $category = PostCategory::find($id);

        $categoriesNames = PostsCategoriesController::categoriesNames();

        $importanceLabels = ['success', 'info', 'primary' , 'warning', 'danger'];

        return view('posts.categories.showCategory', compact('posts', 'categories', 'category', 'categoriesNames', 'importanceLabels'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editForm($id)
    {
        $pcat = PostCategory::find($id);

        $categoriesNames = PostsCategoriesController::categoriesNames();

        return view('posts.categories.editCategoryForm', compact('pcat', 'categoriesNames'));
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
            'new-category-name.required' => 'The name field is required.',
            'new-category-importance.required' => 'The importance field is required.'
        ];

        // Validate
        // If success, continue
        // Else, flash errors to the session
        $this->validate($request,[
            'new-category-name' => 'required|string',
            'new-category-importance' => 'required|integer'
        ], $messages);

        $cat_id = $id;
        $new_cat_name = $request->input('new-category-name');
        $new_cat_importance = $request->input('new-category-importance');

        // Find the category with provided id
        $pcat = PostCategory::find($cat_id);

        // If the provided information from Edit form is not modified, do nothing
        if ($pcat->name == $new_cat_name && $pcat->importance == $new_cat_importance) {
            $result = 'Category information remains unchanged!';
            $alert_type = 'warning';
        }
        else {
            // Update to database
            $pcat->name = $new_cat_name;
            $pcat->importance = $new_cat_importance;
            $pcat->save();

            // Create alert message to flash back to session
            $result = 'Category information updated!';
            $alert_type = 'success';
        }
        
        $categoriesNames = PostsCategoriesController::categoriesNames();

        return view('posts.categories.editCategoryForm', compact('result', 'alert_type', 'pcat', 'categoriesNames'));
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
