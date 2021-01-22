import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CourseComponent } from './course/course.component';
import {AdminRoutingModule} from './admin-routing.module';
import { DepartmentComponent } from './department/department.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {PositionComponent} from './position/position.component';
import { FooterComponent } from './footer/footer.component';
import { HeaderComponent } from './header/header.component';
import {NgxPaginationModule} from 'ngx-pagination';
import { JobStatusComponent } from './job-status/job-status.component';






@NgModule({
  declarations: [CourseComponent, PositionComponent, FooterComponent, HeaderComponent, DepartmentComponent, JobStatusComponent],
  exports: [
    HeaderComponent, FooterComponent
  ],
  imports: [
    CommonModule,
    AdminRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    NgxPaginationModule
  ]
})
export class AdminModule {
}

