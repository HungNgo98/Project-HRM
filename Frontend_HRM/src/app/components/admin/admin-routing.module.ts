import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {CourseComponent} from './course/course.component';
import {PositionComponent} from './position/position.component';


const routes: Routes = [
  {
    path: 'course',
    component: CourseComponent
  },
  {
    path: 'position',
    component: PositionComponent
  }
];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule {
}
