import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {PositionComponent} from './position/position.component';
import {AdminRoutingModule} from './admin-routing.module';





@NgModule({
  declarations: [PositionComponent],
  imports: [
    CommonModule,
    AdminRoutingModule
  ]
})
export class AdminModule { }
