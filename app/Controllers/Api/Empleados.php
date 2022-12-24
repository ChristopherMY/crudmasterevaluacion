<?php

namespace App\Controllers\Api;


// use EmpleadoModel;
use App\Models\EmpleadoModel;
use CodeIgniter\RESTful\ResourceController;

class Empleados extends ResourceController
{

    public function __construct()
    {
        $this->model = $this->setModel(new EmpleadoModel());
    }

    public function index()
    {
        // return view('welcome_message');

        $empleados = $this->model->findAll();
        return $this->respond($empleados);
    }
}