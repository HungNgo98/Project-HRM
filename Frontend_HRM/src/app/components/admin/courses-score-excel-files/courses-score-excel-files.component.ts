import { Component, OnInit } from '@angular/core';
import {CoursesScoreExcelFilesService} from '../../services/courses-score-excel-files.service';

@Component({
  selector: 'app-courses-score-excel-files',
  templateUrl: './courses-score-excel-files.component.html',
  styleUrls: ['./courses-score-excel-files.component.scss']
})
export class CoursesScoreExcelFilesComponent implements OnInit {
  coursesScore: any;
  constructor(
    private coursesScoreExcelFilesService: CoursesScoreExcelFilesService
  ) { }

  ngOnInit(): void {
    this.index();
  }
  // tslint:disable-next-line:typedef
  index(){
    this.coursesScoreExcelFilesService.all().subscribe((res: any) => {
      this.coursesScore = res.data.data;
    }, ( error: any) => {console.log(2, error);
    });
  }
}
