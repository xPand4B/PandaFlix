<?php

namespace App\Components\User;

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
        return $this->userRepository->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->userRepository->getById($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
