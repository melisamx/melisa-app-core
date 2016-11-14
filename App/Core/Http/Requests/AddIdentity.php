<?php namespace App\Core\Http\Requests;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class AddIdentity extends Generic
{
    protected $rules = [
        'idUser'=>'required|max:36|exists:users,id',
        'idVehicle'=>'required|max:36',
        'display'=>'required|max:75',
        'displayEspecific'=>'required|max:75',
        'active'=>'required|boolean',
        'isDefault'=>'required|boolean',
        'firstName'=>'required|max:75',
        'lastName'=>'required|max:75',
        'gender'=>'required|boolean',
        'nickname'=>'required|max:75',
        'birthday'=>'sometimes',
    ];
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return $this->rules;
        
    }
    
}
