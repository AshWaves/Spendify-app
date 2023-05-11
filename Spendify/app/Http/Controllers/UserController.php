<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
	public function getAllSalesByUser(User $user)
	{
		$buyerSales = $user->load('BuyerSales.Product.Category');
		return response()->json(['buyer_sales' => $buyerSales],200);
	}

	public function getAllUsersWithSales()
	{
		$users = User::with('BuyerSales.Product')->has('BuyerSales.Product')->get();
		return response()->json(['users' => $users],200);
	}
    //
	public function getAllUsers()
	{
		$users =User::get();
		return response()->json(['users' => $users], 200);
	}
	public function getAnUser(User $user)
	{
		return response()->json(['user' => $user],200);
	}
	public function createUsers(CreateUserRequest $request)
	{
		$user = new User($request->all());
		$user->save();
		return response()->json(['user' =>$user ], 201);
	}
	public function updateUser(User $user, UpdateUserRequest $request)
	{
		$user->update($request->all());
		return response()->json(['user' =>$user->refresh() ], 201);
	}
	public function deleteUser(User $user)
	{
		$user->delete();
		return response()->json([], 204);
	}
}
