<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContoareElectronice extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'contoare_electronice';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'data', 'aparat', 'indexInceput', 'indexSfarsit', 'totalImpulsuri', 'pretImpuls', 'valoareIncasari', 'userId',
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
