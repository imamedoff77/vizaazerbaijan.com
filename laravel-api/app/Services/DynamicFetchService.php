<?php

namespace App\Services;

use Doctrine\Inflector\InflectorFactory;

class DynamicFetchService
{
    protected array $allowedModels = [
        'VisaRequest',
        'Country',
        'EligibleCountry',
        'User',
        'Service',
        'ContactMessage',
        'Page'
    ];

    public function fetch(array $models): array
    {
        $fetchedData = [];
        $user = auth('sanctum')->user();

        foreach ($models as $requestedModel) {
            $modelClass = "App\\Models\\" . $requestedModel['name'];
            $this->validateModel($modelClass, $requestedModel['name']);

            $model = new $modelClass;
            $modelOptions = $model::$fetchOptions;
            $query = $model->query();

            if (request()->route()->getName() != 'admin.fetch') {
                $this->validateAuthPermissions($user, $modelOptions, $query);
            }

            if (isset($requestedModel['query'])) {
                $this->applyQuery($query, $requestedModel['query'], $modelOptions);
            } else {
                $query->orderBy('id', 'DESC');
            }

            $responseName = $modelOptions['table'];
            if ($requestedModel['fetchOptions']['type'] == 'first') {
                $responseName = $this->getResponseName($modelOptions['table']);
            }

            $fetchedData[$responseName] = $this->executeQuery(
                $query,
                $requestedModel['fetchOptions']
            );
        }

        return $fetchedData;
    }

    /**
     * @param array $modelOptions
     * @return void
     */
    protected function validateAuthPermissions($user, array $modelOptions, $query): void
    {
        if (isset($modelOptions['auth']) && $modelOptions['auth'] && empty($user)) {
            abort(403, 'Authentication required');
        } elseif (isset($modelOptions['onlyAuthor'])) {
            $query->where($modelOptions['onlyAuthor']['column'], $user->id);
        }
    }

    protected function applyQuery($query, $requestedQuery, $modelOptions)
    {
        $parsedQuery = $this->parseQuery($requestedQuery, $modelOptions);
        if (isset($parsedQuery['select'])) {
            $query->select($parsedQuery['select']);
        }

        if (isset($parsedQuery['withCount'])) {
            foreach ($parsedQuery['withCount'] as $withCount) {
                $query->withCount($withCount);
            }
        }

        if (isset($parsedQuery['where'])) {
            foreach ($parsedQuery['where'] as $item) {
                if (is_array($item['val'])) {
                    $query->whereIn($item['key'], $item['val']);
                } elseif (is_scalar($item['val'])) {
                    $query->where($item['key'], $item['operator'] ?? '=', $item['val']);
                } elseif ($item['val'] == null) {
                    $query->whereNull($item['key']);
                }
            }
        }

        if (isset($parsedQuery['whereHas'])) {
            foreach ($parsedQuery['whereHas'] as $item) {
                $query->whereHas($item['relation'], function ($query) use ($item) {
                    if (is_array($item['val'])) {
                        $query->whereIn($item['key'], $item['val']);
                    } elseif (is_scalar($item['val'])) {
                        $query->where($item['key'], $item['operator'] ?? '=', $item['val']);
                    }
                });
            }
        }

        if (isset($parsedQuery['with'])) {
            foreach ($parsedQuery['with'] as $item) {
                $relationName = $item['name'];
                $subRelationName = null;
                if (str_contains($item['name'], '.')) {
                    $exploded = explode('.', $item['name']);
                    $relationName = $exploded[0];
                    $subRelationName = implode(".", array_slice($exploded, 1));
                }

                $query->with($relationName, function ($q) use ($item, $subRelationName) {

                    if (isset($item['select'])) {
                        $q->select($item['select']);
                    }
                    if (isset($item['where'])) {
                        foreach ($item['where'] as $con) {
                            if ($con['val']) {
                                $q->where($con['key'], $con['val']);
                            } else {
                                $q->whereNull($con['key']);
                            }
                        }
                    }
                    if (isset($item['count'])) {
                        foreach ($item['count'] as $withCountItem) {
                            $q->withCount($withCountItem);
                        }
                    }
                    if (isset($item['sort'])) {
                        $q->orderBy($item['sort']['field'], $item['sort']['dir']);
                    }
                    if ($subRelationName) {
                        $q->with($subRelationName);
                    }
                });
            }
        }

        if (isset($parsedQuery['sort'])) {
            $query->orderBy($parsedQuery['sort']['field'], $parsedQuery['sort']['dir']);
        } else {
            $query->orderBy('id', 'DESC');
        }
    }

    protected function parseQuery($requestedQuery, $modelOptions)
    {
        $parsedQuery = [
            'sort' => [
                'field' => $modelOptions['defaultSort'],
                'dir' => 'desc'
            ]
        ];
        if (isset($requestedQuery['select'])) {
            $parsedQuery['select'] = $modelOptions['allowedSelects'] == '*' ? $requestedQuery['select'] : $this->validateQuerySelect($requestedQuery['select'], $modelOptions['allowedSelects']);
        }
        if (isset($requestedQuery['where'])) {
            $parsedQuery['where'] = $this->validateQueryWhere($requestedQuery['where'], $modelOptions['allowedFilters']);
        }
        if (isset($requestedQuery['whereHas'])) {
            $parsedQuery['whereHas'] = $this->validateQueryWhereHas($requestedQuery['whereHas'], $modelOptions['allowedWhereHas']);
        }
        if (isset($requestedQuery['sort'])) {
            $parsedQuery['sort'] = $this->validateQuerySort($requestedQuery['sort'], $modelOptions['allowedSorts']);
        }
        if (isset($requestedQuery['with'])) {
            $parsedQuery['with'] = $this->validateQueryWith($requestedQuery['with'], $modelOptions['allowedIncludes']);
        }
        if (isset($requestedQuery['withCount'])) {
            $parsedQuery['withCount'] = $this->validateQueryWithCount($requestedQuery['withCount'], $modelOptions['allowedIncludes']);
        }
        return $parsedQuery;
    }

    protected function validateQueryWith($includes, $allowedIncludes)
    {
        $requestedIncludes = array_column($includes, 'name');
        if (!empty(array_diff($requestedIncludes, $allowedIncludes))) {
            abort(403, 'Unauthorized relation condition for Dynamic-Fetch');
        }
        return $includes;
    }

    protected function validateQueryWhere($filters, $allowedFilters)
    {
        $requestedFilters = array_column($filters, 'key');
        if (!empty(array_diff($requestedFilters, $allowedFilters))) {
            abort(403, 'Unauthorized where condition for Dynamic-Fetch');
        }
        return $filters;
    }

    protected function validateQueryWhereHas($filters, $allowedWhereHas)
    {
        $relations = array_column($allowedWhereHas, 'cols', 'relation');

        $results = array_map(function ($request) use ($relations) {
            return isset($relations[$request['relation']]) && in_array($request['key'], $relations[$request['relation']]);
        }, $filters);

        if (count(array_filter($results)) != count($filters)) {
            abort(403, 'Unauthorized whereHas condition for Dynamic-Fetch');
        }

        return $filters;
    }

    protected function validateQueryWithCount($withCounts, $allowedIncludes)
    {
        if (!empty(array_diff($withCounts, $allowedIncludes))) {
            abort(403, 'Unauthorized relationships for Dynamic-Fetch');
        }
        return $withCounts;
    }

    protected function validateQuerySelect($requestedSelect, $allowedSelects)
    {
        if (!empty(array_diff($requestedSelect, $allowedSelects))) {
            abort(403, 'Unauthorized select fields for Dynamic-Fetch');
        }
        return $requestedSelect;
    }

    protected function validateQuerySort($requestedSort, $allowedSorts)
    {
        if (!in_array($requestedSort['field'], $allowedSorts)) {
            abort(403, 'Unauthorized sort field for Dynamic-Fetch');
        }
        return $requestedSort;
    }

    protected function validateModel(string $modelClass, string $modelName): void
    {
        if (!in_array($modelName, $this->allowedModels) || !class_exists($modelClass)) {
            abort(403, 'Dynamic-Fetch is not allowed for this model');
        }
    }

    /**
     * @param string $tableName
     * @return string
     */
    protected function getResponseName(string $tableName): string
    {
        $inflector = InflectorFactory::create()->build();
        return $inflector->singularize($tableName);
    }

    protected function executeQuery($query, array $fetchOptions)
    {
        if (isset($fetchOptions['limit'])) {
            $query->limit($fetchOptions['limit']);
        }
        switch ($fetchOptions['type']) {
            case 'paginate':
                return $query->paginate($fetchOptions['perPage'], ['*'], 'page', $fetchOptions['page']);
            case 'get':
                return $query->get();
            case 'first':
                return $query->first();
            case 'count':
                return $query->count();
        }
    }
}
