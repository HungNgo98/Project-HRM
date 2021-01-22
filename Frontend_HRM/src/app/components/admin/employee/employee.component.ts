import { Component, OnInit } from '@angular/core';
import {EmployeeService} from "../../services/employee.service";
import {Router} from "@angular/router";
import {ToastrService} from "ngx-toastr";
import {FormControl, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-employee',
  templateUrl: './employee.component.html',
  styleUrls: ['./employee.component.scss']
})
export class EmployeeComponent implements OnInit {

  employees: any;
  employeeForm = new FormGroup({});
  isShowModal= false;
  isCreate= false;

  constructor(
    private employeeService:EmployeeService,
    private route:Router,
    private toastr:ToastrService
  ) { }

  ngOnInit(): void {
    this.list();
  }

  list(){
    this.employeeService.list().subscribe((res:any)=>{
      this.employees = res.data.data;
    }, (error:any) => {
      this.toastr.success('Lỗi list');
    });
  }

  createOredit(employee ? : any){
    this.isShowModal = true;
    if (employee){
      this.isCreate = true;
      this.buildForm(employee);
    }else {
      this.isCreate = false;
      this.buildForm();
    }
  }

  buildForm(employee? : any){
    this.employeeForm = new FormGroup({
      id: new FormControl(employee ? employee.id : null, [Validators.required]),
      user_id: new FormControl( employee ? employee.user_id : null, [Validators.required]),
      employee_code: new FormControl( employee ? employee.employee_code : null, [Validators.required]),
      email: new FormControl( employee ? employee.email :null, [Validators.required]),
      full_name: new FormControl( employee ? employee.full_name :null, [Validators.required]),
      gender: new FormControl( employee ? employee.gender :null, [Validators.required]),
      department_id: new FormControl( employee ? employee.department_id : null, [Validators.required]),
      position_id: new FormControl( employee ? employee.position_id : null, [Validators.required]),
      job_status_id: new FormControl( employee ? employee.job_status_id : null, [Validators.required]),
      check_out_date: new FormControl( employee ? employee.check_out_date : null)
    });
  }

  submit() {
    if(this.employeeForm.get('id')?.value) {
      this.employeeService.update(this.employeeForm.value).subscribe(res => {
        this.toastr.success('Sửa thành công', 'Thành công');
        this.isShowModal = false;
        this.list();
      },error => {
        this.toastr.success('Thêm Lỗi !!!');
      });
    } else {
      this.employeeService.create(this.employeeForm.value).subscribe(res => {
        this.toastr.success('Thêm thành công', 'Thành công');
        this.isShowModal = false;
        this.list();
      }, error => {
        this.toastr.error(error, 'Sửa Lỗi !!!');
      });
    }
  }

  delete(id:number){
    this.employeeService.delete(id).subscribe(res =>{
      this.toastr.success('Xóa Thành Công', 'Thành Công');
      this.list();
    }, (error: any) =>{
      this.toastr.success('Xóa Lỗi');
    });
  }

  closeModal(){
    this.isShowModal = false;
  }
}
