import { TaskService } from '../task.service'
import { Router,ActivatedRoute } from '@angular/router';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-edit-task',
  templateUrl: './edit-task.component.html',
  styleUrls: ['./edit-task.component.css']
})
export class EditTaskComponent implements OnInit {
  public taskid:any;
  constructor(private formBuilder: FormBuilder,private route: ActivatedRoute,private routerx: Router, private taskService:TaskService) { 
    
  }
  editForm:FormGroup;
  
  ngOnInit() {
    let type = this.route.params.subscribe( params => {
      if(params['id']){
        this.taskid = params['id'];
      }
    });
this.getTask(this.taskid);

    this.editForm = this.formBuilder.group({
      id: [],
      city: ['', Validators.required],
      start_date: ['', Validators.required],
      end_date: ['', Validators.required],
      price: ['', Validators.required],
      status: ['', Validators.required],
      color: ['', Validators.required]
    });
  }

  onSubmit() {
    this.taskService.updateTask(this.editForm.value)
      .subscribe(
        data => {
          if(data.code === 200) {
            alert('Task updated successfully.');
            this.routerx.navigate(['/']);
          }else {
            alert(data.msg);
          }
        },
        error => {
          alert(error);
        });
  }

  getTask(taskid){
    let postDatas = {};
    postDatas['id'] = taskid;
    this.taskService.getTaskList(postDatas).subscribe(
      (res: any) => {
        console.log(res.data[0]);
        this.editForm.setValue(res.data.task[0]);
      },
      (err) => {
        alert(err);
      }
    );
  }

}
