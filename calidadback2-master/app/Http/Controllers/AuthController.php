<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Role;

define('SUPERADMIN_ROLE_ID', 1);
define('ADMINISTRADOR_ID', 2);
define('RESIDENTE_ID', 3);
define('RECEPCIONISTA_ID', 4);

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'role_id' => 'required|integer',
            'password' => 'required|string|confirmed'
        ]);

        if($request->role_id == 3)
        {
            return response()->json([
                'message' => 'Error'
            ], 201);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'edifice_id' => $request->edifice_id,
            'password' => bcrypt($request->password)
        ]);
        
        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        $user = $request->user();

        switch ($user->role_id) {

            case SUPERADMIN_ROLE_ID:
                return response()->json([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role->id,
                'role_name' => $user->role->name
                ], 200);
            
            case ADMINISTRADOR_ID:    
                return response()->json([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role->id,
                'role_name' => $user->role->name
                ], 200);
            
            case RESIDENTE_ID:   
                return response()->json([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role->id,
                'role_name' => $user->role->name
                ], 200);

            case RECEPCIONISTA_ID:
                return response()->json([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role->id,
                'role_name' => $user->role->name
                ], 200);

        }
    }

    public function notifications(Request $request) {
        $user = $request->user();
        $notifications = $user->notifications()->limit(10)->get();
        return response()->json($notifications);
    }

    public function readNotification(Request $request, $id) {
        $user = $request->user();
        $notification = $user->notifications()->where('id', $id)->first();
        $notification->markAsRead();
        return response()->json(['message' => 'Success'], 200);
    }
}
