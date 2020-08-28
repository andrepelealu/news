<?php namespace MissionControl\News\Modules\NewsCategories\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

/**
 * Class NewsCategoryRequest
 * @package MissionControl\News\Modules\NewsCategories\Requests
 */
class NewsCategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}
