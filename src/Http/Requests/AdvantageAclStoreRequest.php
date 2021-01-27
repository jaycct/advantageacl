<?php

namespace  jaycct\advantageacl\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;


class AdvantageAclStoreRequest extends FormRequest
{

    protected $rulesArray;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $getConstant = $this->segment(2).'_'.$this->segment(3);

        $this->rulesArray = Config('advantageacl.'.$getConstant);

        return $this->rulesArray['rules'];
    }

    public function messages()
    {
        $getConstant = $this->segment(2).'_'.$this->segment(3);

        $this->rulesArray = Config('advantageacl.'.$getConstant);
        return $this->rulesArray['messages'];
    }
}
