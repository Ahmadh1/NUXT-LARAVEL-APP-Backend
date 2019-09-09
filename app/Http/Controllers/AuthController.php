<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\User as UserResource;
class AuthController extends Controller {
	
	public function register(UserRegisterRequest $request) {
		$user = User::create([
			'email' => $request->email,
			'name' => $request->name,
			'password' => bcrypt($request->password),
		]);

		if (!$token = Auth::attempt($request->only(['email', 'password']))) {
			return abort(401);
		};

		return (new UserResource($request->user()))->additional([
			'meta' => [
				'token' => $token,
			],
		]);
	} // end register

	public function login(UserLoginRequest $request) {
		if (!$token = Auth::attempt($request->only(['email', 'password']))) {
			return response()->json([
				'errors' => [
					'email' => ['Sorry we cant find you with those details.'],
				],
			], 422);
		};

		return (new UserResource($request->user()))->additional([
			'meta' => [
				'token' => $token,
			],
		]);
	} // end login

	public function user(Request $request) {
		return new UserResource($request->user());
	} // end user

	public function logout() {
		Auth::logout();
	} // end logout
}
