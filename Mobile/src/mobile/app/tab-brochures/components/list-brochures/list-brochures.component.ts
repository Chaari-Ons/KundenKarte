import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {NgDragDropModule} from "ng-drag-drop";

@Component({
  selector: 'app-list-brochures',
  templateUrl: './list-brochures.component.html',
  styleUrls: ['./list-brochures.component.scss'],
})
export class ListBrochuresComponent implements OnInit {
  brochures: any;

  constructor(private router: Router) {}

  ngOnInit() {
    this.brochures = this.getListBrochures();
    console.log(this.brochures.length);
  }

  getListBrochures() {
    const data = {
      items: [
        {
          id: 324,
        },
        {
          id: 321,
        },
        {
          id: 435,
        },

      ],
    };
    const list = [];

    for (const item of data.items) {
      list.push({id: item.id,src: 'https://picsum.photos/335/473?t=' + item.id});
    }
    return list;
  }

  checkposition(element) {
    element.source.element.nativeElement.style.transform = null;
    this.brochures.push(this.brochures[0]);
    this.brochures = this.brochures.slice(1);
  }

  openBrochure(brochureId) {
    let url = btoa(brochureId);
    this.router.navigateByUrl('/home/prospekte/' + url);
  }
}
