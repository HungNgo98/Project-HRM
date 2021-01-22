import { Component, OnInit } from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {ToastrService} from 'ngx-toastr';
import {JobStatusService} from '../../services/job-status.service';

@Component({
  selector: 'app-job-status',
  templateUrl: './job-status.component.html',
  styleUrls: ['./job-status.component.scss']
})
export class JobStatusComponent implements OnInit {
  isShowModal = false;
  isAddOrEdit = false;
  jobstatusForm = new FormGroup({});
  jobstatus: any;
  constructor(
    private jobstatusService: JobStatusService,
    private router: Router,
    private toastr: ToastrService
  ) { }

  ngOnInit(): void {
    this.list();
    this.buildForm();
  }
  buildForm(jobstatus?: any): void {
    this.jobstatusForm = new FormGroup({
      id: new FormControl(jobstatus ? jobstatus.id : null),
      name: new FormControl(jobstatus ? jobstatus.name : null, [Validators.required]),
      code: new FormControl(jobstatus ? jobstatus.code : null),
      description: new FormControl(jobstatus ? jobstatus.description : null)
    });
  }
  addOrEdit(job?: any): void {
    this.isShowModal = true;
    if (job) {
      this.isAddOrEdit = true;
      this.buildForm(job);
    } else {
      this.isAddOrEdit = false;
      this.buildForm();
    }
  }
  closeModal(): void{
    this.isShowModal = false;
  }
  list(): void{
    this.jobstatusService.list().subscribe((res: any) => {
      this.jobstatus = res.data.data;
    });
  }
  delete(id: number): void{
    this.jobstatusService.destroy(id).subscribe(res => {
      this.list();
    });
  }
  submit(): void {
    if (this.jobstatusForm.get('id')?.value) {
      this.jobstatusService.update(this.jobstatusForm.value).subscribe(res => {
        this.list();
        this.isShowModal = false;
        this.toastr.success('Sửa', 'Thành công');
      }, error => {
        this.toastr.error(error, 'Loi');
      });
    } else {
      this.jobstatusService.store(this.jobstatusForm.value).subscribe(res => {
        this.list();
        this.isShowModal = false;
        this.toastr.success('Them', 'Thành công');
      });
    }
  }
}
