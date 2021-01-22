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
      icon: "fa fa-tachometer-alt",
      abc: "new",

      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Nhân Sự",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Đào Tạo",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Danh sách khóa học"},
        {name: "Quản lý khóa học"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "OT/Nghỉ Phép",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Chấm Công",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Danh Mục",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Chức danh"},
        {name: "Phòng ban"},
        {name: "Trạng thái công việc"},
        {name: "Nhân viên"},
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
