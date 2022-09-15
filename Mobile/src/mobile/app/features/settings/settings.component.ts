import { Component, OnInit } from '@angular/core';
import {AuthService} from "../auth/services/auth.service";
import {Router} from "@angular/router";
import { Location } from '@angular/common';


@Component({
  selector: 'app-settings',
  templateUrl: './settings.component.html',
  styleUrls: ['./settings.component.scss'],
})
export class SettingsComponent implements OnInit {

  constructor( private authService: AuthService, private router: Router, private location: Location) { }

  ngOnInit() {}
  logout(){
    this.authService.logout();
    this.router.navigate(['login']);
  }

  card() {
    this.router.navigate(['/home/meine-karten/coupon'])
  }

  back(): void {
    this.location.back()
  }
}
