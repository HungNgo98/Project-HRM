import { Component, OnInit } from '@angular/core';
import {DepartmentService} from "../../services/department.service";
import {Router} from "@angular/router";
import {ToastrService} from "ngx-toastr";
import {FormControl, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-department',
  templateUrl: './department.component.html',
  styleUrls: ['./department.component.scss']
})
export class DepartmentComponent implements OnInit {

  departments: any;
  departmentForm = new FormGroup({});
  isShowModal= false;
  isCreate= false;
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
      this.departments = res.data.data;
    }, (error:any) => {
        this.toastr.success('Lỗi list Department');
    });
  }

  createOredit(department? : any): void {
    this.isShowModal=true;
    if (department){
      this.isCreate= true;
      this.buildForm(department);
    }else{
      this.isCreate= false;
      this.buildForm();
    }
  }

  buildForm(department? : any){
    this.departmentForm = new FormGroup({
      id: new FormControl(department ? department.id : null),
      name: new FormControl(department ? department.name : null, [Validators.required]),
      code: new FormControl(department ? department.code : null, [Validators.required]),
      description: new FormControl(department ? department.description : null)
    });
  }

  submit() {
    if(this.departmentForm.get('id')?.value) {
      this.departmentService.update(this.departmentForm.value).subscribe(res => {
        this.toastr.success('Sửa thành công', 'Thành công');
        this.isShowModal = false;
        this.list();
      },error => {
        this.toastr.success('Thêm Lỗi !!!');
      });
    } else {
      this.departmentService.create(this.departmentForm.value).subscribe(res => {
        this.toastr.success('Thêm thành công', 'Thành công');
        this.isShowModal = false;
        this.list();
      }, error => {
        this.toastr.error(error, 'Sửa Lỗi !!!');
      });
    }
  }

  delete(id:number){
    this.departmentService.delete(id).subscribe(res =>{
      this.toastr.success('Xóa Thành Công', 'Thành Công');
      this.list();
    }, (error: any) =>{
      this.toastr.success('Xóa Lỗi')
    });
  }

  closeModal(){
    this.isShowModal = false;
  }
}
