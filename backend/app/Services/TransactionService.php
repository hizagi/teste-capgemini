<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;

class TransactionService
{
    public function index($filters)
    {
        $response = Transaction::where(function ($query) use ($filters) {
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

    public function store($transactionData)
    {
        $transaction = Transaction::create($transactionData);
        return $transaction;
    }
}
