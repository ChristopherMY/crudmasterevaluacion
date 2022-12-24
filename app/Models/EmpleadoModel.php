<?php
namespace App\Models;
use CodeIgniter\Model;

class EmpleadoModel extends Model
{

    protected $table = "empleado";
    protected $primaryKey = "id_empleado";
    protected $returnType = "array";
    protected $allowedField = ['nombre', 'apellido', 'edad', 'fecha_nacimiento', 'fecha_ingreso', 'fecha_termino_contrato', 'flg_estd'];

    protected $useTimestamps = false;


    protected $validationRules = [
        'nombre' => 'required|alpha_space|min_length[3]|max_length[30]',
        'apellido' => 'required|alpha_space|min_length[3]|max_length[15]',
        'edad' => 'required|alpha_space|max_length[2]',
        'flg_estd' => 'required|alpha_space|max_length[1]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => "El campo nombre es obligatorio",
            'min_length[3]' => "El nombre debe tener como minimo 3 caracteres",
            'max_length[30]' => "El nombre debe tener como maximo 30 caracteres",
        ],
        'apellido' => [
            'required' => "El campo apellido es obligatorio",
            'min_length[3]' => "El apellido debe tener como minimo 3 caracteres",
            'max_length[15]' => "El apellido debe tener como maximo 15 caracteres",
        ],
        'edad' => [
            'required' => "El campo edad es obligatorio",
            'max_length[15]' => "La edad debe tener como maximo 2 digitos",
        ],
        'flg_estd' => [
            'required' => "El campo estado es obligatorio",
            'max_length[15]' => "El estado debe tener como maximo 1 caracter",
        ],
    ];

    protected $skipValidation = false;


/*
id_empleado bigint(20) NOT NULL AUTO_INCREMENT,
nombre varchar(3) NOT NULL,
apellido varchar(15) NOT NULL,
edad int(2) NOT NULL,
fecha_nacimiento date DEFAULT NULL,
fecha_ingreso date DEFAULT NULL,
fecha_termino_contrato date DEFAULT NULL,
flg_estd char(1) DEFAULT NULL,
*/
}