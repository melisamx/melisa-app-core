<?php namespace App\Core\Http\Requests;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateIdentity extends Generic
{
    protected $rules = [
        'idUser'=>'required|max:36|exists:users,id',
        'idVehicle'=>'required|max:36',
        'display'=>'required|max:75',
        'displayEspecific'=>'required|max:75',
        'active'=>'required|boolean',
        'isDefault'=>'required|boolean',
        'name'=>'required|max:45',
        'firstName'=>'required|max:45',
        'lastName'=>'required|max:45',
        'gender'=>'required|boolean',
        'nickname'=>'required|max:75',
        'birthday'=>'sometimes',
    ];
    
    public function rules()
    {
        
        return $this->rules;
        
    }
    
}
