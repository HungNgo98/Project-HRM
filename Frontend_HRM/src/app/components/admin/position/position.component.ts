import { Component, OnInit } from '@angular/core';
import {PositionService} from '../../services/position.service';
import {Router} from '@angular/router';
import {FormGroup, FormControl, Validators} from '@angular/forms';
import {ToastrService} from 'ngx-toastr';




@Component({
  selector: 'app-position',
  templateUrl: './position.component.html',
  styleUrls: ['./position.component.scss']
})
export class PositionComponent implements OnInit {
  position: any;
  isShowModal = false;
  isAddOrEdit = false;
  positionForm = new FormGroup({});


  constructor(
    private positionService: PositionService,
    private router: Router,
    private toastr: ToastrService
  ) {
  }

  ngOnInit(): void {
    this.list();
    this.buildForm();
  }
  buildForm(position?: any): void {
    this.positionForm = new FormGroup({
      id: new FormControl(position ? position.id : null),
      name: new FormControl(position ? position.name : null, [Validators.required]),
      code: new FormControl(position ? position.code : null),
      description: new FormControl(position ? position.description : null)
    });
  }
  addOrEdit(p?: any): void {
    this.isShowModal = true;
    if (p) {
      this.isAddOrEdit = true;
      this.buildForm(p);
    } else {
      this.isAddOrEdit = false;
      this.buildForm();
    }
  }
  closeModal(): void{
    this.isShowModal = false;
  }
  list(): void{
    this.positionService.list().subscribe((res: any) => {
      this.position = res.data.data;
    });
  }
  delete(id: number): void{
    this.positionService.destroy(id).subscribe(res => {
      this.list();
    });
  }
  submit(): void {
    if (this.positionForm.get('id')?.value) {
      this.positionService.update(this.positionForm.value).subscribe(res => {
        this.list();
        this.isShowModal = false;
        this.toastr.success('Sửa', 'Thành công');
      }, error => {
        this.toastr.error(error, 'Loi');
      });
    } else {
      this.positionService.store(this.positionForm.value).subscribe(res => {
        this.list();
        this.isShowModal = false;
        this.toastr.success('Them', 'Thành công');
      });
    }
  }
}
