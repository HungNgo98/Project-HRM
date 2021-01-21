import { Component, OnInit } from '@angular/core';
import {Router} from '@angular/router';
import {PositionService} from '../../services/position.service';


@Component({
  selector: 'app-position',
  templateUrl: './position.component.html',
  styleUrls: ['./position.component.scss']
})
export class PositionComponent implements OnInit {

  constructor(
    // private positionService: PositionService,
    // private router: Router
  ) { }

  ngOnInit(): void {
  }

}
