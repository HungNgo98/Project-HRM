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
}
