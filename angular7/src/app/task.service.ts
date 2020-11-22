import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class TaskService {
  public url:string = '';
  constructor(private http:HttpClient) {
    this.url = 'http://localhost:8000/';
   }

  getTaskList(postData){
    return this.http.post<any>(this.url + 'task',postData);
  }

  createTask(formData){
    return this.http.post<any>(this.url + 'saveTask',formData);
  }

  updateTask(formData){
    return this.http.put<any>(this.url + 'updateTask',formData);
  }

  deleteTask(postData){
    const options = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
      }),
      body: postData
    }
    return this.http.delete<any>(this.url + 'deleteTask',options);
  }
}
