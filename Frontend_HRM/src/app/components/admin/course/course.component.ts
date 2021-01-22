import { Component, OnInit } from '@angular/core';
import {CourseService} from '../../services/course.service';
import {AbstractControl, FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
// import {ToastrService} from 'ngx-toastr';

@Component({
  selector: 'app-course',
  templateUrl: './course.component.html',
  styleUrls: ['./course.component.scss']
})
export class CourseComponent implements OnInit {
  courses: any;
  constructor(
    private courseService: CourseService,
    private router: Router
    // private toastr:ToastrService
  ) { }

  ngOnInit(): void {
    this.all();
  }
  // tslint:disable-next-line:typedef
  all(){
    this.courses.all().subscribe((res: any) => {
      console.log(1);
      this.courses = res.data;
    }, ( error: any) => {console.log(2, error);
    });
  }
}
