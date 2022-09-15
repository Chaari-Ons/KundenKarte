import { Component, OnInit } from '@angular/core';
import {NzModalService} from 'ng-zorro-antd/modal';
import {Router} from '@angular/router';
import {UserService} from './services/user.service';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.scss'],
})
export class UserComponent implements OnInit {
  addModalIsVisible = false;
  listUsers: any[] = [];

  constructor(private userService: UserService, private modal: NzModalService, private router: Router) {}

  ngOnInit(): void {
    this.getUsers();
  }

  getUsers() {
    this.userService.getUsers()
      .subscribe(response => {
        this.listUsers = response['data'];
      }, err => {
        console.log(err);
      });
  }

  showAddModal(): void {
    this.addModalIsVisible = true;
  }

  handleCancelAddModal(): void {
    this.addModalIsVisible = false;
  }

}
