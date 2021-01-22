import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CourseService {
  urlApi = environment.urlApi;
  constructor(
    private http: HttpClient
  ) { }
  // tslint:disable-next-line:typedef
  all(param?: any){
    return this.http.get(this.urlApi + 'course/all');
  }
  // tslint:disable-next-line:typedef
  create(body: any){
    return this.http.post(this.urlApi + 'course/create', body);
  }
  // tslint:disable-next-line:typedef
  update(body: any){
    return this.http.post(this.urlApi + 'course/update/' + body.id, body);
  }
  // tslint:disable-next-line:typedef
  delete(id: number){
    return this.http.delete(this.urlApi + 'course/delete/' + id);
  }
}
