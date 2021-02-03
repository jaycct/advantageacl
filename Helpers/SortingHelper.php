<?php

namespace jaycct\advantageacl\Helpers;

use Illuminate\Support\Facades\Request;

class SortingHelper
{

    public static function instance() {
        return new SortingHelper();
    }

    public function sort($sort_by = 'created_at',$title = 'Created At') {
        $query = Request::query();
        if(isset($query['sort_dir']) && $query['sort_dir'] != ''){
            if($query['sort_dir'] == 'asc'){
                $query['sort_dir'] = 'desc';
            } else {
                $query['sort_dir'] = 'asc';
            }
        } else {
            $query['sort_dir'] = 'desc';
        }
        $_url = "<a href=".Request::fullUrlWithQuery(['sort_by' => $sort_by,'sort_dir' => $query['sort_dir']]).">".$title."</a>";
        return $_url;
    }



}