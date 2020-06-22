<?php

namespace App\Services;

use App\Models\Account;
use App\Models\User;
use LogicException;

class AccountService
{
    public function index($filters)
    {
        $response = Account::where(function ($query) use ($filters) {
            if (!empty($filters["name"])) {
                $query->where("name", 'ilike', "%" . $filters["name"] . "%");
            }

            if (!empty($filters["price_min"]) && !empty($filters["price_max"])) {
                $query->whereBetween('price', [$filters["price_min"], $filters["price_max"]]);
            } else if (!empty($filters["price_min"])) {
                $query->where("price", '=>', $filters["price_min"]);
            } else if (!empty($filters["price_max"])) {
                $query->where("price", '<=', $filters["price_max"]);
            }

            if (!empty($filters["status_id"])) {
                $query->where("status_id", '=', $filters["status_id"]);
            }
        })->orderBy('created_at', 'desc');

        if (!empty($filters["paginate"])) {
            return $response->paginate(18);
        }

        return $response->get();
    }

    public function store($accountData)
    {
        $account = Account::create($accountData);
        return $account;
    }

    public function show($id)
    {
        $account = Account::find($id);
        return $account;
    }

    public function update($id, $accountData)
    {
        $account = Account::find($id);
        $account->update($accountData);
        return Account::find($id);
    }

    public function destroy($id)
    {
        $account = Account::find($id);
        $response = $account->delete();
        return $response;
    }

    public function deposit($id, $accountData)
    {
        $account = Account::find($id);

        $account->balance = $account->balance + $accountData['value'];

        $account->save();
        return Account::find($id);
    }

    public function withdraw($id, $accountData)
    {
        $account = Account::find($id);

        $newBalance =  $account->balance - $accountData['value'];

        if ($newBalance < 0) {
            abort(400, "Value withdrawed is bigger than the current balance.");
        }

        $account->balance = $newBalance;

        $account->save();
        return Account::find($id);
    }
}
