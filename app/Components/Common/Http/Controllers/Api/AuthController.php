<?php

namespace App\Components\Common\Http\Controllers\Api;

use App\Components\Common\Http\Controllers\Controller;
use App\Components\User\Database\User;
use App\Components\User\Http\Requests\UserFormRequest;
use App\Components\User\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * Registers a new user.
     *
     * @param Request $request
     * @return UserResource|JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(), (new UserFormRequest())->rules()
        );

        if ($validator->fails()) {
            return response()->json(
                $this->ResponseAdditions(
                    'error',
                    Response::HTTP_UNAUTHORIZED, $validator->errors()),
                    Response::HTTP_UNAUTHORIZED);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $user->api_token = $user->createToken('authToken')->accessToken;
        $user->save();

        return response()->json(
            $this->ResponseAdditions('success', Response::HTTP_CREATED)
        , Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => (new UserFormRequest())->rules()['email'],
            'password' => 'required|string',
        ]);

        $email = request('email');
        $password = request('password');

        if(!Auth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'error' => trans('auth.failed')
            ], Response::HTTP_UNAUTHORIZED);
        }

        return (new UserResource(
            Auth::user()
        ))->additional($this->ResponseAdditions());
    }

    /**
     * Add additional response data.
     *
     * @param string $key
     * @param int $status
     * @param array $data
     * @return array
     */
    private function ResponseAdditions(string $key, int $status = Response::HTTP_OK, $data = null): array
    {
//        if (\is_null($this->user)) {
//            $this->user = Auth::user();
//        }

        return [
            'data' => $data,
            'status' => (int)$status,
//            'api_token' => $this->user->createToken('authToken')->accessToken,
        ];
    }
}
