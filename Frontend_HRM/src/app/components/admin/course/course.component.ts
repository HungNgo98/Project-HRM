import { Component, OnInit } from '@angular/core';
import {CourseService} from '../../services/course.service';
import {AbstractControl, FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {ToastrService} from 'ngx-toastr';
import {THIS_EXPR} from '@angular/compiler/src/output/output_ast';

@Component({
  selector: 'app-course',
  templateUrl: './course.component.html',
  styleUrls: ['./course.component.scss']
})
export class CourseComponent implements OnInit {
  courses: any;
  isShowModal = false;
  isAddOrEdit = false;
  courseForm = new FormGroup({
    name: new FormControl('', [Validators.required]),
    description: new FormControl('', [Validators.required])
  });
  constructor(
    private courseService: CourseService,
    private router: Router,
    private toastr: ToastrService
  ) { }

  ngOnInit(): void {
    this.index();
    this.buildForm();
  }
  buildForm(course?: any): void {
    this.courseForm = new FormGroup({
      id: new FormControl(course ? course.id : null),
      name: new FormControl(course ? course.name : null, [Validators.required]),
      description: new FormControl(course ? course.description : null)
    });
  }
  // tslint:disable-next-line:typedef
  index(){
    this.courseService.all().subscribe((res: any) => {
      this.courses = res.data.data;
    }, ( error: any) => {console.log(2, error);
    });
  }
  // tslint:disable-next-line:typedef
  get cate() {
    return this.courseForm.controls;
  }
  // tslint:disable-next-line:typedef
  addOrEdit(course?: any): void {
    this.isShowModal = true;
    if (course) {
      this.isAddOrEdit = true;
      this.buildForm(course);
    }else{
      this.isAddOrEdit = false;
      this.buildForm();
    }
  }
  // tslint:disable-next-line:typedef
  submit(){
    if (this.courseForm.get('id')?.value)
    {
      this.courseService.update(this.courseForm.value).subscribe(res => {
        this.index();
        this.toastr.success('Sửa', 'Thành công');
      }, error => {
        this.toastr.error(error, 'Lỗi');
      });
    }
    else {
      this.courseService.create(this.courseForm.value).subscribe(res => {
        this.index();
        this.toastr.success('Thêm', 'Thành công');
      }, error => {
        this.toastr.error(error, 'Thất bại');
      });
    }
    this.isShowModal = false;
  }
  // tslint:disable-next-line:typedef
  addCourse(){
    this.isShowModal = true;
  }
  // tslint:disable-next-line:typedef
  close(){
    this.isShowModal = false;
  }
  // tslint:disable-next-line:typedef
  deleteCourse(id: number){
    this.courseService.delete(id).subscribe(res => {
      this.index();
      this.toastr.success('Xóa', 'Thành công');
  }, error => {
  this.toastr.error(error, 'Thất bại');
  });
  }
  // tslint:disable-next-line:typedef
  search(){
    this.courseService.all().subscribe((res: any) => {
      this.courses = res.data.data;
    }, ( error: any) => {console.log(2, error);
    });
  }
}
