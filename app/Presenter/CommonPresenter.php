<?php

namespace App\Presenter;

class CommonPresenter
{
    public function YesNo($option = '')
    {
        switch ($option){
            case 'Y' :
                return '是';
                break;
            case 'N' :
                return '否';
                break;
            default :
                return 'unDefine';
        }
    }
}