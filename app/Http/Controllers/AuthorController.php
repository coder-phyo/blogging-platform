<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    // direct profile page
    public function index()
    {
        $id = Auth::user()->id;
        $author = User::where('id', $id)->first();
        return view('author.pages.profile', compact('author'));
    }
    // change details
    public function updateDetails(Request $request)
    {
        $userData = $this->getUserData($request);
        $this->userValidationCheck($request);
        User::where('id', Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess' => 'Your Profile has been successfully updated!']);
    }

    // change profile picture
    public function changeProfilePicture(Request $request)
    {
        $path = 'storage/authorImage';

        // get database image
        $dbImage = User::where('id', Auth::user()->id)->first();
        $dbImage = $dbImage->profile_picture;

        // delete image from public
        if ($dbImage !== null) {
            Storage::delete('public/authorImage/' . $dbImage);
        }

        // get client image
        $file = $request->file('file');
        $new_image_name = 'UIMG' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if ($upload) {
            User::where('id', Auth::user()->id)->update(['profile_picture' => $new_image_name]);
            return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.', 'name' => $new_image_name]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }

    }

    // direct authors page
    public function authorsPage()
    {
        $authors = User::where('role','=',1)->when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->paginate(4);

        return view('author.pages.authors', compact('authors'));
    }

    // delete author
    public function deleteAuthor($id){
        $data = User::select('name')->where('id',$id)->first();
        $name = $data->name;
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => $name.' has been deleted successfully!']);
    }

    // get user data
    private function getUserData($request)
    {
        return [
            'name' => $request->authorName,
            'email' => $request->authorEmail,
            'bio' => $request->authorBio,
            'updated_at' => Carbon::now(),
        ];
    }

    // validation check
    private function uservalidationCheck($request)
    {
        return Validator::make($request->all(),
            [
                'authorName' => 'required',
                'authorEmail' => 'required|unique:users,email,' . Auth::user()->id,
                'authorBio' => 'required',
            ])->validate();
    }
}
