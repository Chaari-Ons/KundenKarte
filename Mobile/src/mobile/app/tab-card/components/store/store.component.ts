import { Component, OnInit } from '@angular/core';
import {Router} from "@angular/router";

@Component({
  selector: 'app-store',
  templateUrl: './store.component.html',
  styleUrls: ['./store.component.scss'],
})
export class StoreComponent implements OnInit {

  constructor( private router: Router) { }

  ngOnInit() {}

  card() {
    this.router.navigate(['/home/meine-karten/coupon'])
  }
}
