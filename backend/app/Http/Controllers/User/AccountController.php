<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountDepositRequest;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\AccountWithdrawRequest;
use App\Http\Requests\UpdateAccountRequest;

class AccountController extends Controller
{
    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        $response = $this->accountService->index($filters);
        return $response;
    }

    public function store(AccountRequest $request)
    {
        $accountData = $request->only(['user_id', 'balance']);
        $response = $this->accountService->store($accountData);
        return $response;
    }

    public function show($id)
    {
        $response = $this->accountService->show($id);
        return $response;
    }

    public function update(UpdateAccountRequest $request, $id)
    {
        $accountData = $request->only(['balance']);
        $response = $this->accountService->update($id, $accountData);
        return $response;
    }

    public function destroy($id)
    {
        $response = $this->accountService->destroy($id);
        return $response;
    }

    public function deposit(AccountDepositRequest $request, $id)
    {
        $accountData = $request->only(['value']);
        $response = $this->accountService->deposit($id, $accountData);
        return $response;
    }

    public function withdraw(AccountWithdrawRequest $request, $id)
    {
        $accountData = $request->only(['value']);
        $response = $this->accountService->withdraw($id, $accountData);
        return $response;
    }
}
