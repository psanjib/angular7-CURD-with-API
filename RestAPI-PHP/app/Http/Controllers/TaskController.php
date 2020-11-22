<?php
namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Middleware\CommonMessage;


class TaskController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function add(Request $request)
    {
        $data = $request->input();
        if(isset($data['city']) && $data['city'] && isset($data['start_date']) && $data['start_date'] && isset($data['end_date']) && $data['end_date'] && isset($data['status']) && $data['status'] && isset($data['price']) && $data['price']){
            $task = new Task;
            $saveTask = $task->saveTask($data);
            if($saveTask){
                $response = CommonMessage::Success("Task"); 
            }else{
                $response = CommonMessage::BadRequest();
            }           
        }else{
            $response = CommonMessage::BadRequest();
        }
        return json_encode($response);
    }
    
    public function update(Request $request)
    {
        $data = $request->input();
        if(isset($data['city']) && $data['city'] && isset($data['start_date']) && $data['start_date'] && isset($data['end_date']) && $data['end_date'] && isset($data['status']) && $data['status'] && isset($data['price']) && $data['price']){
            $task = new Task;
            $response = $task->updateTask($data);          
        }else{
            $response = CommonMessage::BadRequest();
        }
        return json_encode($response);
    }
    
    public function getTask(Request $request){ 
        $data = $request->input();//print_r($data); exit;
        $data['per_page'] = 20;
        $page = (isset($data['page']) && @$data['page'])?@$data['page']:1;
        $offset = ($page)?($page-1)*@$data['per_page']:0;
        $limit = (@$data['per_page'])?@$data['per_page']:20;
        $where = array('is_active'=>1);
        (isset($data['id']) && @$data['id'])?$where['id']=$data['id']:"";
	$task = new Task;
	$query = $task->where($where);
	$task1 = new Task;
        $query1 = $task1->where(array('is_active'=>1));
	if(isset($data['from_date']) && @$data['from_date'] && isset($data['to_date']) && @$data['to_date']){
	    $start_date = $data['from_date']['year'].'-'.$data['from_date']['month'].'-'.$data['from_date']['day'];
	    $end_date = $data['to_date']['year'].'-'.$data['to_date']['month'].'-'.$data['to_date']['day'];
	    $query->whereBetween('start_date', array($start_date, $end_date));
            $query1->whereBetween('start_date', array($start_date, $end_date));
	}
        $getTask = $query->offset($offset)->limit($limit)->orderBy('id','DESC')->get(); 
        //$task1 = new Task;
        $countTask = $query1->count();
        if(!empty($getTask)){
            $response['code'] = 200;
            $response['status'] = 'Success';
            $response['message'] = 'Task fetched successfully';
	    $response['data']['total'] = $countTask;
            $response['data']['task'] = $getTask;
        }else{
            $response = CommonMessage::BadRequest();
        }
        return json_encode($response);
    }
    
    public function deleteTask(Request $request){
        $data = $request->input();
        if(isset($data['id']) && $data['id']){
            $task = new Task;
            $task = $task->find($data['id']);
            if(!empty($task)){
                $task->delete();
                $response['code'] = 200;
                $response['status'] = 'Success';
                $response['message'] = 'Task deleted successfully';
            }
        }else{
            $response = CommonMessage::BadRequest();
        }
        return json_encode($response);
    }
}
