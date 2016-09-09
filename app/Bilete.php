<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bilete extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'bilete';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'data', 'aparat', 'bilet', 'crc', 'castigBrut', 'ramburs', 'impozit', 'castigNet', 'userId',
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
