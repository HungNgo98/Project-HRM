import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {PositionComponent} from './position/position.component';
import {DepartmentComponent} from "./department/department.component";

const routes: Routes = [
  {
    path: 'position',
    component: PositionComponent
  },
  {
    path: 'department',
    component: DepartmentComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule {
}
