import { Injectable } from '@angular/core';
import {environment} from '../../../environments/environment';
import {HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class PositionService {
  urlApi = environment.urlApi;

  constructor(
    private http: HttpClient
  ) {
  }
  private httpOptions: any;
  list(param?: any){
    return this.http.get(this.urlApi + 'positions/list');
  }
  store(body: any){
    return this.http.post(this.urlApi + 'positions/create', body);
  }
  update(body: any){
    return this.http.post(this.urlApi + 'positions/update/' +  body.id, body);
  }
  destroy(id: number){
    return this.http.delete(this.urlApi + 'positions/delete/' + id);
  }
}
