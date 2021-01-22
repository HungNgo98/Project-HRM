import { Injectable } from '@angular/core';
import {environment} from '../../../environments/environment';
import {HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class CoursesScoreExcelFilesService {
  urlApi = environment.urlApi;
  constructor(
    private http: HttpClient
  ) { }
  // tslint:disable-next-line:typedef
  all(param?: any){
    return this.http.get(this.urlApi + 'course_score/all');
  }
  // tslint:disable-next-line:typedef
  create(body: any){
    return this.http.post(this.urlApi + 'course_score/create', body);
  }
  // tslint:disable-next-line:typedef
  update(body: any){
    return this.http.post(this.urlApi + 'course_score/update/' + body.id, body);
  }
  // tslint:disable-next-line:typedef
  delete(id: number){
    return this.http.delete(this.urlApi + 'course-score/delete/' + id);
  }
}
