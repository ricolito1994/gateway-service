<?php
namespace App\Http\Repositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Logs;

class LogRepository {

    public function get(Request $request) 
    {
        return Logs::filter($request);
    }

    public function find(int $id) 
    {
        return Logs::findOrFail($id);
    }

    public function create(array $body) 
    {
        Logs::create($body);
    }

    public function update(int $id, array $body) 
    {
        // cannot edit a log
        Logs::findOrFail($id)->update($body);
    }

    public function delete(int $id) 
    {
        // never delete a log
        Logs::findOrFail($id)->delete();
    }
}