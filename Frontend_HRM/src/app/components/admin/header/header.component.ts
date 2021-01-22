import {Component, OnInit} from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {
  isShowMenu = true;

  menus = [
    {
      isActive: true,
      name: "Quản Trị",
      icon: "fa fa-user",
      abc: "new",

      children: [
        {name: "Dashboard 1", url: ''},
        {name: "Dashboard 2", url: ''},
        {name: "Dashboard 3", url: ''}
      ]
    },
    {
      isActive: false,
      name: "Nhân Sự",
      icon: "fa fa-users",
      children: [
        {name: "Danh sách", url: 'admin/employee'},
        {name: "Dashboard 2", url: ''},
        {name: "Dashboard 3", url: ''}
      ]
    },
    {
      isActive: false,
      name: "Đào Tạo",
      icon: "fa fa-book",
      children: [
        {name: "Danh sách khóa học", url: ''},
        {name: "Quản lý khóa học", url: ''},
        {name: "Dashboard 3", url: ''}
      ]
    },
    {
      isActive: false,
      name: "OT/Nghỉ Phép",
      icon: "fa fa-clock-o",
      children: [
        {name: "Dashboard 1", url: ''},
        {name: "Dashboard 2", url: ''},
        {name: "Dashboard 3", url: ''}
      ]
    },
    {
      isActive: false,
      name: "Chấm Công",
      icon: "fa fa-usd",
      children: [
        {name: "Dashboard 1", url: ''},
        {name: "Dashboard 2", url: ''},
        {name: "Dashboard 3", url: ''}
      ]
    },
    {
      isActive: false,
      name: "Danh Mục",
      icon: "fa fa-bars",
      children: [
        {name: "Chức danh", url: ''},
        {name: "Phòng ban", url: 'admin/department'},
        {name: "Trạng thái công việc", url: ''},
        {name: "Nhân viên", url: ''},
        {name: "Danh sách khóa học"}
      ]
    }
  ];

  constructor() {
  }

  ngOnInit(): void {
  }

  toggleChildren(index: number): void {
    if (this.menus[index].isActive) {
      this.menus[index].isActive = false;
    } else {
      this.menus = this.menus.map((v, i) => {
        v.isActive = index === i;
        return v;
      })
    }
  }
}
