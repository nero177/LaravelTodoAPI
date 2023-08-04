<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class TodoFilter extends ModelFilter
{
    protected $operators = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
    ];

    protected $blacklist = ['proceedParams'];

    public function done($done){
        return $this->where('done', '=', "$done%");
    }

    public function title($title){
        return $this->where('title', 'LIKE', "$title%");
    }

    public function sort($key){
        $this->orderBy($key);
    }

    public function priority($priority){
        $params = $this->proceedParams($priority);
        $query_arr = [];

        foreach ($params as $param){
            $query_arr[] = ['priority', $param['operator'],$param['value']];
        }

        return $this->where($query_arr);
    }

    public function proceedParams($arr){
        $params = [];

        foreach($arr as $p_name => $p_value){
            if(!isset($this->operators[$p_name]))
                continue;

            $params[] = ['operator' => $this->operators[$p_name], 'value' => $p_value];  
        }

        return $params;
    }
}
