<?php
/**
 * @OA\Info(title="Twitter PHP API", version="1.0")
 */
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     public function index($id)
    {
        $tweets = Tweet::where('user_id', $id)->get();
        return $tweets;
    }


        public function show($id)
    {
        return User::find($id);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }
}
