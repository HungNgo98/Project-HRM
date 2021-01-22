import { Component, OnInit } from '@angular/core';
import {DepartmentService} from "../../services/department.service";
import {Router} from "@angular/router";
import {ToastrService} from "ngx-toastr";
import {newArray} from "@angular/compiler/src/util";


@Component({
  selector: 'app-department',
  templateUrl: './department.component.html',
  styleUrls: ['./department.component.scss']
})
export class DepartmentComponent implements OnInit {

  department: any[]=new Array();
  constructor(
    private departmentService: DepartmentService,
    private router: Router,
    private toastr: ToastrService
  ) { }

  ngOnInit(): void {
    this.list();
  }

  list(){
    this.departmentService.list().subscribe((res:any)=>{
      this.department = res;
      console.log(1111, this.department);
    }, (error:any) => {
        this.toastr.success('List lỗi');
    });
  }
}
