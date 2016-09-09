<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContoareMecanice extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'contoare_mecanice';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'data', 'aparat', 'userId', 'in', 'out', 'bet', 'win', 'games', 'remonte', 'handPay', 'bills',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    
    public function setari()
    {
    	return $this->belongsTo('App\Setari','aparat');
    }
}
