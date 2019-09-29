<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'diskon',
        'jenis_pembayaran'
    ];
    protected $casts = [
        'items'    => 'array',
        'customer' => 'array',
        'diskon'
    ];

    public function getRouteKeyName()
    {
        return 'invoice_no';
    }

    public function getItemsCountAttribute($value)
    {
        $pcsCount = 0;
        foreach ($this->items as $item) {
            $pcsCount += $item['qty'];
        }

        return count($this->items).' Item, '.$pcsCount.' Pcs';
    }

    public function getExchange()
    {
        return $this->payment - $this->total;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
