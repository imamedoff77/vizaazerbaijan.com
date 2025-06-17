<?php

namespace App\Http\Requests\DynamicFetch;

use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Models
            'models' => 'required|array',
            'models.*.name' => 'required|string',

            // Fetch Options
            'models.*.fetchOptions' => 'required|array',
            'models.*.fetchOptions.type' => 'required|string|in:first,get,paginate,count',
            'models.*.fetchOptions.perPage' => 'required_if:models.*.fetchOptions.type,paginate|integer|min:1',
            'models.*.fetchOptions.page' => 'required_if:models.*.fetchOptions.type,paginate|integer|min:1',
            'models.*.fetchOptions.limit' => 'sometimes|integer|min:1',

            // Query
            'models.*.query' => 'sometimes|array',
            'models.*.query.select' => 'sometimes|array',
            'models.*.query.select.*' => 'string|distinct',

            //Where Conditions
            'models.*.query.where' => 'sometimes|array',
            'models.*.query.where.*.key' => 'required|string',
            'models.*.query.where.*.val' => 'nullable',
            'models.*.query.where.*.operator' => 'sometimes|string|in:=,!=,like,is null,is not null',

            //WhereHas Conditions
            'models.*.query.whereHas' => 'sometimes|array',
            'models.*.query.whereHas.*.relation' => 'required|string',
            'models.*.query.whereHas.*.key' => 'required|string',
            'models.*.query.whereHas.*.val' => 'required',
            'models.*.query.whereHas.*.operator' => 'sometimes|string|in:=,!=,like,is null,is not null',


            // Relationships
            'models.*.query.with' => 'sometimes|array',
            'models.*.query.with.*.name' => 'required|string',
            'models.*.query.with.*.select' => 'sometimes|array',
            'models.*.query.with.*.select.*' => 'string|distinct',
            'models.*.query.with.*.where' => 'sometimes|array',
            'models.*.query.with.*.where.*.key' => 'required|string',
            'models.*.query.with.*.where.*.val' => 'nullable',
            'models.*.query.with.*.count' => 'sometimes|array',
            'models.*.query.with.*.count.*' => 'string|distinct',
            'models.*.query.with.*.sort' => 'sometimes|array',
            'models.*.query.with.*.sort.field' => 'required_with:models.*.query.with.*.sort|string',
            'models.*.query.with.*.sort.dir' => 'required_with:models.*.query.with.*.sort|string|in:asc,desc',

            //Count relationships
            'models.*.query.withCount' => 'sometimes|array',
            'models.*.query.withCount.*' => 'string|distinct',

            //Sorting
            'models.*.query.sort' => 'sometimes|array',
            'models.*.query.sort.field' => 'required_with:models.*.query.sort|string',
            'models.*.query.sort.dir' => 'required_with:models.*.query.sort|string|in:asc,desc',
        ];
    }
}
