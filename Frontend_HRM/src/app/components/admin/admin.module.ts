import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {PositionComponent} from './position/position.component';
import {AdminRoutingModule} from './admin-routing.module';
import { DepartmentComponent } from './department/department.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";





@NgModule({
  declarations: [PositionComponent, DepartmentComponent],
  imports: [
    CommonModule,
    AdminRoutingModule,
    FormsModule,
    ReactiveFormsModule,
  ]
})
export class AdminModule { }
