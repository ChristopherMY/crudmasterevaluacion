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

    public function create()
    {
        try {
            $empleado = $this->request->getJSON();
            if ($this->model->insert($empleado)) {
                $empleado->id_empleado = $this->model->insertID();
                return $this->respondCreated($empleado);
            } else {
                return $this->failValidationErrors($this->model->validation->listErrors());
            }
        } catch (\Throwable $th) {
            $this->failServerError("A ocurrido un error con los servicios, intentelo mas tarde.");
        }
    }

    public function find($id = null)
    {

        try {
            if ($id == null) {
                return $this->failValidationErrors("No se ha enviado un ID valido");
            }
            $empleado = $this->model->find($id);
            if ($empleado == null)
                return $this->failNotFound("No se a encontrado un empleado con el ID: $id");

            return $this->respond($empleado);

        } catch (\Throwable $th) {
            $this->failServerError("A ocurrido un error con los servicios, intentelo mas tarde.");
        }

    }

    public function updated()
    {

        try {
            $empleadoJSON = $this->request->getJSON();
            $id = $empleadoJSON->id_empleado;
            if ($id == null) {
                return $this->failValidationErrors("No se ha enviado un ID valido");
            }

            $empleado = $this->model->find($id);
            if ($empleado == null)
                return $this->failNotFound("No se a encontrado un empleado con el ID: $id");

            // unset($empleado["key"]);
            if ($this->model->update($id, $empleadoJSON)) {
                // $empleado->id_empleado = $id;
                return $this->respondUpdated($empleadoJSON);
            } else {
                return $this->failValidationErrors($this->model->validation->listErrors());
            }

        } catch (\Throwable $th) {
            $this->failServerError("A ocurrido un error con los servicios, intentelo mas tarde.");
        }
    }

    public function deleted($id = null)
    {
        try {
            if ($id == null) {
                return $this->failValidationErrors("No se ha enviado un ID valido");
            }

            $empleado = $this->model->find($id);
            if ($empleado == null)
                return $this->failNotFound("No se a encontrado un empleado con el ID: $id");

            // unset($empleado["key"]);
            if ($this->model->delete($id)) {
                // $empleado->id_empleado = $id;
                return $this->respondDeleted($empleado);
            } else {
                return $this->failServerError("No se a podido eliminar el registro.");
            }

        } catch (\Throwable $th) {
            $this->failServerError("A ocurrido un error con los servicios, intentelo mas tarde.");
        }
    }
}