<?php
/**
 * @OA\Info(title="Twitter PHP API", version="1.0")
 */
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTweetRequest;
use App\Http\Requests\UpdateTweetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;


class TweetController extends Controller
{
    /**
 * @OA\Get(path="/api/tweets",tags={Tweets},
 * @OA\Response (response="200", description="Success"),
 * @OA\Response(response="404", description="Not found")
 * )
 */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(Tweet::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreTweetRequest $request)
    {
        $id = Auth::id();
        $request->validate([
            'description' => 'required|max:140'
        ]);
        $description = $request->input('description');
        // return Tweet::create($request->all());
        return Tweet::create([
        'description' => $description,
        'user_id' => $id
       ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Tweet::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tweet $tweet): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTweetRequest $request, $id) // Remove Tweet before $id
    {
        $tweet = Tweet::find($id);
        $tweet->update($request->all());
        return $tweet;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return Tweet::destroy($id);
    }
}
