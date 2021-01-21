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
      name: "Dashboard",
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
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
      ]
    },
    {
      isActive: false,
      name: "Dashboard2",
      icon: "fa fa-tachometer-alt",
      children: [
        {name: "Dashboard 1"},
        {name: "Dashboard 2"},
        {name: "Dashboard 3"}
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
