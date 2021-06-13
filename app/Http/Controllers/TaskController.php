<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function list()
    {
        $tasksList = Task::all()->load('category');

        return $this->sendJsonResponse($tasksList, 200);
    }

    public function item($taskId)
    {
        $taskId = intval($taskId);

        $task = Task::where('id', $taskId)->get();

        return $this->sendJsonResponse($task, 200);
    }

    public function add(Request $request)
    {
        // $taskPost = $request->all();

        $validatedData = $this->validate($request, [
            'title' => ['required', 'max:255'],
            'categoryId' => ['required',],
            'completion' => ['required',],
            'status' => ['required',],
        ]);

        // dd('hi');

        $newTask = new Task();
        // $newTask->title = $taskPost['title'];
        // $newTask->categoryId = $taskPost['categoryId'];
        // $newTask->completion = $taskPost['completion'];
        // $newTask->status = $taskPost['status'];
        // dd($request->truc, $request->input('truc'));
        $newTask->title = $request->title;
        $newTask->category_id = $request->categoryId;
        $newTask->completion = $request->completion;
        $newTask->status = $request->status;

        // dd($taskPost, $newTask);

        $isInserted = $newTask->save();
        if ($isInserted) {
            return $this->sendJsonResponse($newTask->load('category'), 201);
        }

        return $this->sendEmptyResponse(500);
    }

    public function update(Request $request, $taskId)
    {
        // ici on récupérer la tache qui a pour id
        $taskId = intval($taskId);
        $task = Task::find($taskId);

        if (!empty($task)) {
            if ($request->isMethod('patch')) {
                //! si on utilise le verbe PATCH
                $oneDataAtLeast = false;
                // ici grace a has, je demande si la requete a une entrée 'title'
                if ($request->has('title')) {
                    $task->title = $request->input('title');
                    $oneDataAtLeast = true;
                }
                if ($request->has('categoryId')) {
                    $task->category_id = $request->input('categoryId');
                    $oneDataAtLeast = true;
                }
                if ($request->has('completion')) {
                    $task->completion = $request->input('completion');
                    $oneDataAtLeast = true;
                }
                if ($request->has('status')) {
                    $task->status = $request->input('status');
                    $oneDataAtLeast = true;
                }

                if (!$oneDataAtLeast) {
                    // Si aucune donnée n'a été mis a jour
                    // dd('aucune info');
                    $this->sendEmptyResponse(400);
                //abort(400);
                } else {
                    $isUpdated = $task->save();
                    if ($isUpdated) {
                        // alors on retourne un code de réponse HTTP 204 "No Content"
                        //return $this->sendEmptyResponse(204);
                        //! OU
                        return $this->sendJsonResponse($task, 200);
                    } else {
                        // alors retourner un code de réponse HTTP 500 "Internal Server Error"
                        // https://restfulapi.net/http-status-codes/
                        // sans body (pas de JSON ni d'HTML)
                        return $this->sendEmptyResponse(500);
                    }
                }
            } else {
                //! SI ON EST PAS SUR PATCH
                //! (et donc si on est sur l methode put)
                    if($request->has(['title', 'categoryId', 'completion', 'status'])){
                        $title = $request->input('title');
                        $categoryId = $request->input('categoryId');
                        $completion = $request->input('completion');
                        $status = $request->input('status');
                        // modifier les propriétés de l'obet Task
                        $task->title = $title;
                        $task->category_id = $categoryId;
                        $task->completion = $completion;
                        $task->status = $status;

                        $isUpdated = $task->save();
                    } else {
                        // dd('aucune info');
                        $this->sendEmptyResponse(400);
                    }
                if ($isUpdated) {
                    // alors on retourne un code de réponse HTTP 204 "No Content"
                    //return $this->sendEmptyResponse(204);
                    //! OU
                    return $this->sendJsonResponse($task, 200);
                } else {
                    // alors retourner un code de réponse HTTP 500 "Internal Server Error"
                    // https://restfulapi.net/http-status-codes/
                    // sans body (pas de JSON ni d'HTML)
                    return $this->sendEmptyResponse(500);
                }
            }
        } else {
            // alors retourner un code de réponse HTTP 404 "Not Found"
            // https://restfulapi.net/http-status-codes/
            // sans body (pas de JSON ni d'HTML)
            return $this->sendEmptyResponse(404);
        }
    }
}
