import { Component, OnInit } from '@angular/core';
import { TaskService } from '../task.service'
import { Router } from '@angular/router';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {NgbDateStruct} from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-add-task',
  templateUrl: './add-task.component.html',
  styleUrls: ['./add-task.component.css']
})
export class AddTaskComponent implements OnInit {
  model: NgbDateStruct;

  constructor(private formBuilder: FormBuilder,private router: Router, private taskService:TaskService) { }
  addForm: FormGroup;
  ngOnInit() {
    this.addForm = this.formBuilder.group({
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
    this.taskService.createTask(this.addForm.value)
      .subscribe( data => {
        this.router.navigate(['/']);
      });
  }

}
