import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {CourseComponent} from './course/course.component';
import {PositionComponent} from './position/position.component';
import {DepartmentComponent} from './department/department.component';
import {CoursesScoreExcelFilesComponent} from './courses-score-excel-files/courses-score-excel-files.component';


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
    path: 'course_score',
    component: CoursesScoreExcelFilesComponent
  }
];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule {
}
