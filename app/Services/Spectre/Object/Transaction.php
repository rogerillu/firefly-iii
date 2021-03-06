<?php
/**
 * Transaction.php
 * Copyright (c) 2018 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace FireflyIII\Services\Spectre\Object;

use Carbon\Carbon;

/**
 * Class Transaction
 */
class Transaction extends SpectreObject
{
    /** @var int */
    private $accountId;
    /** @var string */
    private $amount;
    /** @var string */
    private $category;
    /** @var Carbon */
    private $createdAt;
    /** @var string */
    private $currencyCode;
    /** @var string */
    private $description;
    /** @var bool */
    private $duplicated;
    /** @var TransactionExtra */
    private $extra;
    /** @var int */
    private $id;
    /** @var Carbon */
    private $madeOn;
    /** @var string */
    private $mode;
    /** @var string */
    private $status;
    /** @var Carbon */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Transaction constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id           = $data['id'];
        $this->mode         = $data['mode'];
        $this->status       = $data['status'];
        $this->madeOn       = new Carbon($data['made_on']);
        $this->amount       = $data['amount'];
        $this->currencyCode = $data['currency_code'];
        $this->description  = $data['description'];
        $this->category     = $data['category'];
        $this->duplicated   = $data['duplicated'];
        $this->extra        = new TransactionExtra($data['extra'] ?? []);
        $this->accountId    = $data['account_id'];
        $this->createdAt    = new Carbon($data['created_at']);
        $this->updatedAt    = new Carbon($data['updated_at']);
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isDuplicated(): bool
    {
        return $this->duplicated;
    }

    /**
     * @return TransactionExtra
     */
    public function getExtra(): TransactionExtra
    {
        return $this->extra;
    }


    /**
     * @return string
     */
    public function getAmount(): string
    {
        return strval($this->amount);
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        $array  = [
            'id'            => $this->id,
            'mode'          => $this->mode,
            'status'        => $this->status,
            'made_on'       => $this->madeOn->toIso8601String(),
            'amount'        => $this->amount,
            'currency_code' => $this->currencyCode,
            'description'   => $this->description,
            'category'      => $this->category,
            'duplicated'    => $this->duplicated,
            'extra'         => $this->extra->toArray(),
            'account_id'    => $this->accountId,
            'created_at'    => $this->createdAt->toIso8601String(),
            'updated_at'    => $this->updatedAt->toIso8601String(),
        ];
        $hashed = hash('sha256', json_encode($array));

        return $hashed;
    }

    /**
     * @return Carbon
     */
    public function getMadeOn(): Carbon
    {
        return $this->madeOn;
    }


}