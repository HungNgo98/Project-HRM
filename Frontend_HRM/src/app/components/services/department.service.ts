import { Injectable } from '@angular/core';
import {environment} from "../../../environments/environment";
import {HttpClient} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class DepartmentService {

  urlApi = environment.urlApi;

  constructor(private http: HttpClient) { }

  // list(param?: any) {
  //   return this.http.get(this.urlApi + 'department/list');
  // }
  //
  // create(body: any) {
  //   return this.http.post(this.urlApi + 'department/create', body);
  // }
  //
  // update(body: any) {
  //   return this.http.post(this.urlApi + 'department/update/' + body.id, body);
  // }
  //
  // delete(id: number) {
  //   return this.http.delete(this.urlApi + 'department/delete/' + id);
  // }
}
