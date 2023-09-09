<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ActionLog;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    // direct home page
    public function index()
    {
        $count = count(Post::get());
        $latestPost = Post::select('posts.*', 'categories.category_name')
            ->leftJoin('categories', 'posts.category_id', 'categories.category_id')
            ->latest()
            ->first();

        $posts = Post::select('posts.*', 'categories.category_name')
            ->leftJoin('categories', 'posts.category_id', 'categories.category_id')
            ->where('post_id', '<', $latestPost->post_id)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $logs = ActionLog::get();

        $recommendedPosts = Post::limit(4)->inRandomOrder()->get();

        $categories = Category::get();

        $admin = User::where('role', 0)->first();

        return view('user.pages.home', compact('latestPost', 'posts', 'recommendedPosts', 'categories', 'admin', 'logs'));
    }

    // sort posts with categories
    public function categoryPosts($id)
    {
        $categories = Category::get();
        $category = Category::where('category_id', $id)->first();
        $posts = Post::where('category_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $recommendedPosts = Post::limit(4)->inRandomOrder()->get();

        $admin = User::where('role', 0)->first();

        return view('user.pages.categoryPosts', compact('category', 'posts', 'categories', 'recommendedPosts', 'admin'));
    }

    // search posts
    public function searchPosts()
    {

        $categories = Category::get();
        $posts = Post::select('posts.*', 'categories.category_name')
            ->when(request('key'), function ($query) {
                $query->orWhere('posts.title', 'like', '%' . request('key') . '%');
                $query->orWhere('categories.category_name', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('categories', 'posts.category_id', 'categories.category_id')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $recommendedPosts = Post::limit(4)->inRandomOrder()->get();

        $admin = User::where('role', 0)->first();

        return view('user.pages.searchPosts', compact('posts', 'categories', 'recommendedPosts', 'admin'));
    }

    // read post
    public function readPost($id)
    {
        // for action log
        $data = [
            'user_id' => Auth::user()->id,
            'post_id' => $id,
        ];
        ActionLog::create($data);

        $post = Post::where('post_id', $id)
            ->select('posts.*', 'categories.category_name')
            ->leftJoin('categories', 'posts.category_id', 'categories.category_id')
            ->first();

        $categories = Category::get();

        $relatedPosts = Post::where('post_id', '!=', $id)
            ->where('category_id', $post->category_id)
            ->limit(3)
            ->inRandomOrder()
            ->get();

        $latestPosts = Post::where('post_id', '!=', $id)
            ->limit(4)
            ->get();

        $admin = User::where('role', 0)->first();

        return view('user.pages.readPost', compact('post', 'categories', 'relatedPosts', 'latestPosts', 'admin'));
    }

    // direct about me page
    public function aboutMe()
    {
        $admin = User::where('role', 0)->first();

        return view('user.pages.aboutMe', compact('admin'));
    }

    // direct profile page
    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->first();

        return view('user.pages.profile', compact('user'));
    }

    // update profile
    public function updateProfile(Request $request)
    {
        $this->userValidationCheck($request);
        $updateData = $this->getUserUpdateData($request);

        User::where('id', Auth::user()->id)->update($updateData);

        return back()->with(['updateSuccess' => 'Your profile has been updated Successfully']);
    }

    // change password page
    public function changePasswordPage()
    {
        return view('user.pages.changePassword');
    }

    // change password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);
        $dbData = User::where('id', Auth::user()->id)->first();
        $updateData = [
            'password' => Hash::make($request->newPassword),
            'updated_at' => Carbon::now(),
        ];

        if (Hash::check($request->oldPassword, $dbData->password)) {
            User::where('id', Auth::user()->id)->update($updateData);
            return back();
        } else {
            return back()->with(['fail' => 'Old Password does not match!']);
        }
    }

    // user validation check
    private function userValidationCheck($request)
    {
        return Validator::make($request->all(),
            [
                'userName' => 'required',
                'userEmail' => 'required|unique:users,email,' . Auth::user()->id,
            ])->validate();

    }

    // get user data
    private function getUserUpdateData($request)
    {
        return [
            'name' => $request->userName,
            'email' => $request->userEmail,
            'bio' => $request->userBio,
            'updated_at' => Carbon::now(),
        ];
    }

    // password validation check
    private function passwordValidationCheck($request)
    {

        return Validator::make($request->all(),
            [
                'oldPassword' => 'required',
                'newPassword' => 'required|min:8|max:15',
                'confirmPassword' => 'required|same:newPassword|min:8|max:15',
            ])->validate();

    }

}
