<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // direct add post page
    public function addPost()
    {
        $categories = Category::get();
        return view('author.pages.add-post', compact('categories'));
    }

    // create post
    public function createPost(Request $request)
    {
        $this->postValidationCheck($request);
        $data = $this->getPostData($request);

        if($request->hasFile('postImage')){
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/postImage', $fileName);
            $data['post_image'] = $fileName;
        }

        Post::create($data);
        return back()->with(['createSuccess' => 'Post has been created Successfully!']);
    }

    // direct all post page
    public function allPosts()
    {
        $posts = Post::when(request('key'),function($query){
            $query->where('title','like','%'.request('key').'%');
        })
        ->orderBy('post_id','desc')
        ->paginate(8);
        return view('author.pages.all-posts', compact('posts'));
    }

    // direct edit page
    public function editPage($id)
    {
        $categories = Category::get();
        $post = Post::where('post_id', $id)->first();
        return view('author.pages.edit-post', compact('categories','post'));
    }

    // update post
    public function updatePost($id, Request $request)
    {
        $this->postValidationCheck($request);
        $updateData = $this->getUpdatePostData($request);
        if($request->hasFile('postImage')){

            // get old image
            $dbImage = Post::where('post_id',$id)->first();
            $dbImage = $dbImage->post_image;

            if($dbImage != null){
                Storage::delete('public/postImage/'.$dbImage);
            }

            // get client image
            $file = $request->file('postImage');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/postImage',$fileName);

            $updateData['post_image'] = $fileName;
        }

        Post::where('post_id',$id)->update($updateData);
        return redirect()->route('author#allPosts')->with(['updateSuccess' => 'Post has been Updated Successfully!']);
    }

    // delect post
    public function deletePost($id)
    {
        Post::where('post_id', $id)->delete();
        return back()->with(['deleteSuccess'=>'Post has been deleted Successfully!']);
    }

    // validation check
    private function postValidationCheck($request)
    {
        return Validator::make($request->all(),[
            'postTitle' => 'required',
            'postContent' => 'required',
            'postCategory' => 'required',
            'postImage' => 'required|mimes:jpeg,jpg,png,jfif,webp'
        ])->validate();
    }

    // get create data
    private function getPostData($request)
    {
        return [
            'category_id' => $request->postCategory,
            'title' => $request->postTitle,
            'content' => $request->postContent,
        ];
    }

    // get update data
    private function getUpdatePostData($request)
    {
        return [
            'category_id' => $request->postCategory,
            'title' => $request->postTitle,
            'content' => $request->postContent,
            'updated_at' => Carbon::now()
        ];
    }
}
