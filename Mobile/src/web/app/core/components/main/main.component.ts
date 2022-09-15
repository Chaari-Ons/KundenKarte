import { Component, OnInit } from '@angular/core';
import {AuthService} from '../../../features/auth/services/auth.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.scss'],
})
export class MainComponent implements OnInit {
  isCollapsed = false;

  constructor(private authService: AuthService,
              private router: Router) { }

  ngOnInit() {}

  logout() {
    this.authService.logout();
    this.router.navigateByUrl('/auth/login');
  }

}
