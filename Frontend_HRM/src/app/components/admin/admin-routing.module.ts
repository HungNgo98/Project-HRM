import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {PositionComponent} from './position/position.component';

const routes: Routes = [
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
