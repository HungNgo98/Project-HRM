import { Component, OnInit } from '@angular/core';
import {Router} from "@angular/router";
import {DepartmentService} from "../../services/department.service";
import {ToastrService} from 'ngx-toastr';


@Component({
  selector: 'app-department',
  templateUrl: './department.component.html',
  styleUrls: ['./department.component.scss']
})
export class DepartmentComponent implements OnInit {

  department: any;
  constructor(
    private departmentService: DepartmentService,
    private router: Router,
    private toastr:ToastrService
  ) { }

  ngOnInit(): void {
  }

  list(){
    this.departmentService.list().subscribe((res:any)=>{
      this.department = res;
      console.log(this.department);
    }, (error:any) => {
        this.toastr.success('List lỗi');
    });
  }
}
