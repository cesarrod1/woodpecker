<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

    protected $fillable = [
        'id', 'user_id', 'amount'
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function deposit($amount)
    {
        $this->update([
           'amount' => $this->attributes['amount'] + $amount
        ]);

    }

    public function withdraw($amount)
    {
        $this->update([
            'amount' => $this->attributes['amount'] - $amount
        ]);
    }
}
