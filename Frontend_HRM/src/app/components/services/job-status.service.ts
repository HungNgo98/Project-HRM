import { Injectable } from '@angular/core';
import {environment} from '../../../environments/environment';
import {HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class JobStatusService {
  urlApi = environment.urlApi;

  constructor(
    private http: HttpClient
  ) {
  }
  private httpOptions: any;
  list(param?: any){
    return this.http.get(this.urlApi + 'job-status/list');
  }
  store(body: any){
    return this.http.post(this.urlApi + 'job-status/create', body);
  }
  update(body: any){
    return this.http.post(this.urlApi + 'job-status/update/' +  body.id, body);
  }
  destroy(id: number){
    return this.http.delete(this.urlApi + 'job-status/delete/' + id);
  }
}
