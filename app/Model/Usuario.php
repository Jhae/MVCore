<?php

namespace MVCore\Model;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

    protected $table = 'wx_cliente';
    protected $primaryKey='id';
    protected $keyType='int';
}