import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {CourseComponent} from './course/course.component';
import {PositionComponent} from './position/position.component';
import {DepartmentComponent} from "./department/department.component";
import {EmployeeComponent} from "./employee/employee.component";


const routes: Routes = [
  {
    path: 'course',
    component: CourseComponent
  },
  {
    path: 'position',
    component: PositionComponent
  },
  {
    path: 'department',
    component: DepartmentComponent
  },
  {
    path: 'employee',
    component: EmployeeComponent
  }
];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule {
}
