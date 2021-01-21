import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {CourseComponent} from './course/course.component';

const routes: Routes = [
  {
    path: 'course',
    component: CourseComponent
  }
];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule {
}
