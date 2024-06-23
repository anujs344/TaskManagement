<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoControllerApi extends Controller
{
    public function authUser($user_id){
        $user = User::find($user_id);
        if(!$user){
            return response()->json(['status' => "user not Found"], 404);
        }
        else return $user;
    }
    public function index(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $this->authUser($request->user_id);
        $user = User::find($request->user_id);
        $todos =$user->todos;

        return response()->json(['result' => $todos],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'completion_status' => 'required|in:0,1',
        ]);
       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        try{
            $this->authUser($request->user_id);
            $user = User::find($request->user_id);
            $user->todos()->create($request->all());
            $user = User::find($request->user_id);

            return response()->json(['result' =>$user],200);
        }catch(Exception $e){
            return $e;

        }

        
    }

    public function show(Request $request){
        $validator = Validator::make($request->all(), [
            'task_id'=> 'required',
            'user_id' => 'required'
        ]);
       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try{
            
            $this->authUser($request->user_id);
            $user = User::find($request->user_id);
            $todo = Todo::where('user_id', $request->user_id)
                ->where('id', $request->todo_id) // Assuming you have todo_id in your request
                ->first();

            // Ensure todo exists
            if (!$todo) {
                return response()->json(['error' => 'Todo not found'], 404);
            }

            return response()->json(['result' => $todo], 200);

        }catch(Exception $e){
                return $e;

        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'task_id'=> 'required',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'completion_status' => 'nullable|in:0,1',
            'comments' => 'nullable|string',
        ]);
       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        
        try{
            $this->authUser($request->user_id);
            $user = User::find($request->user_id);
            $todo = Todo::where('user_id', $request->user_id)
                ->where('id', $request->task_id) // Assuming you have todo_id in your request
                ->first();
            if(!$todo){
                return response()->json(["result" => "Task Not Exists"],404);
            }else{
                $todo->update($request->all()); 
            }
            
            $todos = Todo::where('user_id',$request->user_id)->get();

            return response()->json(['result' => $todos], 200);
        }catch(Exception $e){
                return $e;

        }
        
        // return redirect()->route('todos.create')->with('todos', $todos);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_id'=> 'required',
            'user_id' => 'required'
        ]);
       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try{
            
            $this->authUser($request->user_id);
            $user = User::find($request->user_id);
            $todo = Todo::where('user_id', $request->user_id)
                ->where('id', $request->task_id) // Assuming you have todo_id in your request
                ->first();

            // Ensure todo exists
            if (!$todo) {
                return response()->json(['error' => 'Todo not found'], 404);
            }

            $todo->delete();
            return response()->json(['result' => $todo], 200);

        }catch(Exception $e){
                return $e;

        }
    }
    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_id'=> 'required',
            'user_id' => 'required'
        ]);
       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try{
            
            $this->authUser($request->user_id);
            $user = User::find($request->user_id);
            $todo = Todo::where('user_id', $request->user_id)
                ->where('id', $request->task_id) // Assuming you have todo_id in your request
                ->first();

            // Ensure todo exists
            if (!$todo) {
                return response()->json(['error' => 'Todo not found'], 404);
            }

            return response()->json(['result' => $todo], 200);

        }catch(Exception $e){
                return $e;

        }
    }
  
}
