<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use App\Interfaces\UserInterface;

class UserController extends Controller
{
    protected $userInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index()
    {
        return $this->userInterface->getAllUsers();
    }

    public function store(Request $request)
    {
        return $this->userInterface->requestUser($request);

    }

    public function show($id)
    {
        return $this->userInterface->getUserById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->userInterface->requestUser($request, $id);
    }

    public function destroy($id)
    {
        return $this->userInterface->deleteUser($id);
    }
}
