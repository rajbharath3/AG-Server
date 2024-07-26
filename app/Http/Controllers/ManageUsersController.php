<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageUsersController extends Controller
{
    public function fetchGridData(Request $request)
    {
        $requestedPage = (int) $request->input('requestedPage', 1);
        $pageSize = (int) $request->input('pageSize', 10); // Default page size if not provided

        // Validate the requested page and page size
        $requestedPage = max($requestedPage, 1); // Ensure page is at least 1
        $pageSize = max($pageSize, 1); // Ensure page size is at least 1

        // Fetch grid data with pagination
        $totalItems = User::count(); // Total number of users
        $totalPages = ceil($totalItems / $pageSize); // Calculate total number of pages

        // Fetch the data for the requested page
        $users = User::skip(($requestedPage - 1) * $pageSize)
                    ->take($pageSize)
                    ->get();

        // Transform the data
        $gridData = $users->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'password' => $user->password, // Be cautious about displaying plain passwords
                'created_at' => $user->created_at->format('Y-m-d'),
                'updated_at' => $user->updated_at->format('Y-m-d'),
            ];
        });

        // Return the paginated response
        return response()->json([
            'grid' => $gridData,
            'totalItems' => $totalItems,
            'totalPages' => $totalPages,
            'currentPage' => $requestedPage,
            'pageSize' => $pageSize
        ]);
    }

    public function jxBecomeUser(Request $request)
    {
        $userID = $request->input('user_id');
        $user = User::find($userID);    
        if ($user) {
            $currentUserId = Auth::user()->id;
            Session::put('superadmin_id', $currentUserId);
            
            // Login this user specifying the web guard
            Auth::guard('web')->login($user);

            // let jetstream know that user has been changed
            Auth::guard('sanctum')->setUser($user);

            return redirect()->route('dashboard');
        } else {
            abort(500, "User Not Found");
        }
    }

    public function revertToSuperadmin()
    {
        $originalUserId = Session::get('superadmin_id');

        if (!$originalUserId) {
            abort(403);
        }

        // delete the session value
        Session::forget('superadmin_id');

        $userModel = User::find($originalUserId);

        if (!$userModel) {
            abort(403);
        }

        Auth::guard('web')->login($userModel);
        Auth::guard('sanctum')->setUser($userModel);

        return redirect()->route('manage-users');
    }


}
