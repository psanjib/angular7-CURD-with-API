import { Component, OnInit } from '@angular/core';
import { TaskService } from '../task.service'
import { Router, ActivatedRoute } from '@angular/router';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {Sort} from '@angular/material';
@Component({
  selector: 'app-list-task',
  templateUrl: './list-task.component.html',
  styleUrls: ['./list-task.component.css']
})
export class ListTaskComponent implements OnInit {
  searchForm:FormGroup;
  constructor(private formBuilder: FormBuilder,private taskService:TaskService,public router: Router,private routerx:ActivatedRoute) { }
  public msg:string;
  public tasks:any;
  public tasksDetails:any;
  formData:any;
  itemsPerPage: number=20;
  totalItems: number =  0;
  page: number =  1;
  previousPage: number = 1;
  postedData:any;
  public taskId:any;
  ngOnInit() {
    this.searchForm = this.formBuilder.group({
      from_date: ['', Validators.required],
      to_date: ['', Validators.required],
    });

    this.getTask(this.page);
  }  

  onSubmit() {
    
    this.taskService.getTaskList(this.searchForm.value).subscribe(
      (res: any) => {
        console.log("ddddddd",res.data.total);
        this.totalItems = res.data.total;
        this.tasks = res.data.task;
        this.tasksDetails = res.data.task;
      },
      (err) => {
        this.msg = err;
      }
    );
  }

  getTask(page){
    let postDatas = {};
    postDatas['page'] = page;
    this.taskService.getTaskList(postDatas).subscribe(
      (res: any) => {
        console.log(res);
        this.totalItems = res.data.total;
        this.tasks = res.data.task;
        this.tasksDetails = res.data.task;
      },
      (err) => {
        this.msg = err;
      }
    );
  }

  sortTask(sort: Sort) {
    const data = this.tasksDetails.slice();
    if (!sort.active || sort.direction === '') {
       this.tasks = data;
       return;
    }
    this.tasks = data.sort((a, b) => {
       const isAsc = sort.direction === 'asc';
       switch (sort.active) {
          case 'city': return compare(a.city, b.city, isAsc);
          case 'start_date': return compare(a.start_date, b.start_date, isAsc);
          case 'end_date': return compare(a.end_date, b.end_date, isAsc);
          case 'price': return compare(a.price, b.price, isAsc);
          case 'status': return compare(a.status, b.status, isAsc);
          case 'color': return compare(a.color, b.color, isAsc);
          default: return 0;
       } 
    });
 }

  loadPage(page: number) {
    console.log(page);
    this.page = page;
    if (page !== this.previousPage) {
      this.previousPage = page;
      this.getTask(page);
    }
  }

  isConfirmed(task,id){
    if(task){
      this.taskId = id;
    }
    if(confirm("Are you sure to delete?")) {
      let postDatas = {};
      postDatas['id'] = this.taskId;
    this.taskService.deleteTask(postDatas).subscribe(
      (res: any) => {
        if(res.code === 200) {
          alert('Task deleted successfully.');
          this.getTask(this.page);
        }else {
          alert(res.msg);
        }
      },
      (err) => {
        this.msg = err;
      }
    );
    }
  }
  

}
function compare(a: number | string, b: number | string, isAsc: boolean) {
  return (a < b ? -1 : 1) * (isAsc ? 1 : -1);
}
