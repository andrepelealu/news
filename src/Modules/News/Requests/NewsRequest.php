<?php namespace MissionControl\News\Modules\News\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

/**
 * Class NewsRequest
 * @package MissionControl\News\Modules\News\Requests
 */
class NewsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'feature_image' => 'required',
            'summary' => 'required',
            'slug' => 'required',
            'content' => 'required'
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
