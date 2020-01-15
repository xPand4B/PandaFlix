<?php

namespace App\Components\User\Http\Controllers;

use App\Components\User\Database\User;
use Illuminate\Http\Request;
use App\Components\Common\Http\Controllers\Controller;
use App\Components\User\Repositories\UserRepository;

class UserApiController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserApiController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (User::all()->count() == 0) {
            factory(User::class, 30)->create();
        }

        return $this->userRepository->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Resources\UserResource
     */
    public function show($id)
    {
        return $this->userRepository->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     */
    public function destroy($id)
    {
        //
    }
}
