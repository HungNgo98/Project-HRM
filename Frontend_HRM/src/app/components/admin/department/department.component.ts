import { Component, OnInit } from '@angular/core';
import {DepartmentService} from "../../services/department.service";
import {Router} from "@angular/router";


@Component({
  selector: 'app-department',
  templateUrl: './department.component.html',
  styleUrls: ['./department.component.scss']
})
export class DepartmentComponent implements OnInit {

  department: any;
  constructor(
    private departmentService: DepartmentService,
    private router: Router
  ) { }

  ngOnInit(): void {
  }

  // list(){
  //   this.departmentService.list().subscribe((res:any)=>{
  //     this.department = res;
  //     console.log(this.department);
  //   }, (error:any) => {
  //       // this.toastr.success('List lỗi');
  //   });
  // }
}
