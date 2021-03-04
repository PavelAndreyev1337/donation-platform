<?php

use App\Contracts\RepositoryInterface;
use App\Repositories;
use Illuminate\Database\Eloquent\Model;

class DonationRepositories implements RepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $this->model->find($id)->update($data);
    }
    
    public function delete($id)
    {
        $this->model->destroy($id);
    }

    public function show($id)
    {
        $this->model->findOrFail($id);
    }
}