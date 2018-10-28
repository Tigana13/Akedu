<?php

namespace App\Http\Controllers\API\Auth\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;

class RegisterController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = Client::all()->first();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()){
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 203);
        }

        //Save new user record
        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);
//        $new_user->save();

//        $params = [
//            'grant_type' => 'password',
//            'client_id' => $this->client->id,
//            'client_secret' => $this->client->secret,
//            'username' => $new_user->name,
//            'password' => $request->password,
//            'scope' => '*',
//        ];

        $tokenResult = $new_user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        $token->save();

        dd($token);

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

        $request->request->add($params);
//        dd($this->client);
        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);

    }
}
