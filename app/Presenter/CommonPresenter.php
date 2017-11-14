<?php

namespace App\Presenter;

class CommonPresenter
{
    public function yesNo($option = '')
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

    public function yesNoOptions()
    {
        return array(
            'Y' => '是',
            'N' => '否'
        );
    }
}