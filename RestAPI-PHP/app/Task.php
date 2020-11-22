<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model{
    //protected $table = 'task';
    public $timestamps = false;
    
    public function savetask($data = array()){
        if(!empty($data)){
            $start_date = $data['start_date']['year'].'-'.$data['start_date']['month'].'-'.$data['start_date']['day'];
	    $end_date = $data['end_date']['year'].'-'.$data['end_date']['month'].'-'.$data['end_date']['day'];
            $task = new Task;
            $task->city = $data['city'];
            $task->start_date = $start_date;
            $task->end_date = $end_date;
            $task->color = $data['color'];
            $task->price = $data['price'];
            $task->status = $data['status'];
            $task->save();
            return true;
        }else{
            return false;
        }
    }
    public function updatetask($data = array()){
        if(!empty($data)){
            $task = $this->find($data['id']);
            if(!empty($task)){
                $task->city = $data['city'];
                $task->start_date = $data['start_date'];
                $task->end_date = $data['end_date'];
                $task->color = $data['color'];
                $task->price = $data['price'];
                $task->status = $data['status'];
                $task->save();
                $response['code'] = 200;
                $response['status'] = 'Success';
                $response['message'] = 'Task updated successfully';
            }else{
                $response['code'] = 204;
                $response['status'] = 'Success';
                $response['message'] = 'Invalid task';
            }
        }else{
            $response['code'] = 400;
            $response['status'] = 'Fail';
            $response['message'] = 'invalid request message parameters, or deceptive request routing';
        }
        return $response;
    }
}
